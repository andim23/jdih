<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_profile
 *
 * @author Selamet Subu - Dell 5459
 */
class User_profile extends MY_Controller {

    var $tmp_path = 'templates/index_horizontal_menu/index';
    var $main_path = 'pages/profile/';
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_profile_m');
        $this->load->library('form_validation');
        $this->load->model('Sys_user_m');
        
        $this->is_logged_in();
        if( empty( $this->auth_role ) )
        {
            redirect("login");
        }	
    }

    public function index() {
        $this->load->model('Sys_user_m');
        
        $user_id = $this->auth_user_id;
        $profile = $this->Sys_user_m->get_data_by_id($user_id);
        $last_act = $this->User_profile_m->get_last_activity($this->auth_user_id);
        
        $data['last_act'] = $last_act;
        $data['profile'] = $profile;
        $data['page'] = $this->main_path . 'main';
        $data['htitle'] = 'Profile User';

        $this->load->view($this->tmp_path, $data);
    }

    public function oldpassword_check(){
        $this->is_logged_in();
        $this->load->helper('auth');
        $old_password = $this->input->post('old_userpass');
        $user_id = $this->auth_user_id;

        $data = $this->Sys_user_m->get_data_by_id($user_id);
        //print_r($data);
        $pass = $data[0]->userpass;

        if( !$this->authentication->check_passwd( $pass, $old_password ) )
        {
            $this->form_validation->set_message('oldpassword_check', 'Password lama tidak sesuai.');
            return false;
        }
        return true;
    }
    
    public function ganti_password_json(){
        $this->load->model('examples/validation_callables');
        $user_id = $this->auth_user_id;
        $userpass = $this->input->post('userpass');
        
        $config = 
        [
            [
                'field' => 'old_userpass',
                'label' => 'Password Lama',
                'rules' => 
                [
                    'trim',
                    'required',
                    'callback_oldpassword_check'
                ],
                'errors' => 
                [
                    'required' => 'Password Lama Harus diisi.'
                ]
            ],
            [
                'field' => 'userpass',
                'label' => 'Password',
                'rules' => 
                [
                    'trim',
                    'required',
                    [ 
                            '_check_password_strength', 
                            [ $this->validation_callables, '_check_password_strength' ] 
                    ]
                ],
                'errors' => 
                [
                    'required' => 'Password Baru Harus diisi.'
                ]
            ],
            [
                'field' => 're_userpass',
                'label' => 'Ulangi Password',
                'rules' => 
                [
                    'trim',
                    'required',
                    'matches[userpass]'
                ],
                'errors' => 
                [
                    'required' => 'Ulangi Password Harus diisi.',
                    'matches' => 'Ulangi Password tidak sesuai'
                ]
            ]
        ];
        
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        
        if ($this->form_validation->run() !== false) {
            // Post data
            $userpass = $this->input->post('userpass');
            $userinput = $this->auth_user_id;
            // set POST data in Array
            $data['userupdate'] = $userinput;
            $data['dateupdate'] = date('Y-m-d');
            $data['userpass'] = $this->authentication->hash_passwd($userpass);
            //print_r($data); exit;
            $result = $this->Sys_user_m->update_user_password_auth_by_id($data, $userinput);

            if ($result) {
                $r = array('status' => '1', 'message' => 'Data tersimpan');
            } else {
                $r = array('status' => '0', 'message' => 'Data gagal tersimpan');
            }
        } else {
            $r = array('status' => '0');
            foreach ($_POST as $key => $value) {
                $r['message'][$key] = form_error($key);
            }
        }

        echo json_encode($r);
        
    }
    
    public function simpan_json(){  
        $this->load->model('Sys_user_m');
        $id = $this->auth_user_id;
        
        // set validation rules
        $config = array(
            array(
                'field' => 'nickname',
                'label' => 'Nama Panggilan',
                'rules' => 'required|min_length[2]|max_length[50]'
            ),
            array(
                'field' => 'fullname',
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[2]|max_length[50]'
            ),
            array(
                'field' => 'usertelpno',
                'label' => 'Telp',
                'rules' => 'required|min_length[2]|max_length[50]'
            )
        );
        
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run() !== false) {
            // Post data
            //$username = $this->input->post('username');
            //$useremail = $this->input->post('useremail');
            $nickname = $this->input->post('nickname');
            $fullname = $this->input->post('fullname');
            $usertelpno = $this->input->post('usertelpno');
            $dinasid = $this->input->post('dinasid');
            //$idsatker = $this->input->post('idsatker');
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                //'username' => $username,
                //'useremail' => $useremail,
                'nickname' => $nickname,
                'fullname' => $fullname,
                'usertelpno' => $usertelpno,
                'dinasid' => $dinasid
            );

            $data['userupdate'] = $userinput;
            $data['dateupdate'] = date('Y-m-d');

            $result = $this->Sys_user_m->update_by_id($data, $id);

            if ($result) {
                $r = array('status' => '1', 'message' => 'Data tersimpan');
            } else {
                $r = array('status' => '0', 'message' => 'Data gagal tersimpan');
            }
        } else {
            $r = array('status' => '0');
            foreach ($_POST as $key => $value) {
                $r['message'][$key] = form_error($key);
            }
        }

        echo json_encode($r);
    }
    
    public function do_upload_profil_picture(){
        $config['upload_path'] = 'mpo_upload/';
	$config['allowed_types'] = 'png|jpg|jpeg';
        $config['max_size'] = '100000000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
	
        if ( ! $this->upload->do_upload("file") ){
            $r = array('info'=>'0', 'message' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['file_name'];
            
            $d = $this->Sys_user_m->get_data_by_id($this->auth_user_id);
            if( !empty($d[0]->userphoto) ){
                $path = 'mpo_upload/' . $d[0]->userphoto;
                $tpath = 'mpo_upload/thumb_' . $d[0]->userphoto;
                
                if(is_file($path) )
                    unlink ($path);
                if(is_file($tpath))
                    unlink ($tpath);
            }
            $data = array('userphoto' => $file_name);
            $this->Sys_user_m->update_by_id($data, $this->auth_user_id);
            
            //Thumbnail Image Upload - Start
            $config['image_library'] = 'gd2';
            $config['source_image'] = './mpo_upload/'. $file_name;
            $config['new_image'] = './mpo_upload/thumb_'. $file_name;
            $config['width'] = 162;
            $config['height'] = 180;

            //load resize library
            $this->load->library('image_lib', $config);
            if($this->image_lib->resize()){
                $r = array('info'=>'1', 'message'=>'Upload Lokal berhasil', 'file_name'=>$file_name, 'thumb_file_name'=>'thumb_'.$file_name);
            }else{
                $r = array('info'=>'0', 'message'=>'Upload Lokal Gagal', 'file_name'=>$file_name, 'thumb_file_name'=>'thumb_'.$file_name);
            }
        }
        
        echo json_encode($r);
    }

}
