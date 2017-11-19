<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sys_user
 *
 * @author Selamet Subu - Dell 5459
 */
class Sys_user extends MY_Controller {
    
    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/user/';
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Sys_user_m');
        $this->load->library('form_validation');
        
        
        $this->is_logged_in();
        if( empty( $this->auth_role ) )
        {
            redirect("login");
        }
    }

    public function index() {
        $this->load->model('produk_hukum_kategori_m');
        
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);
        $dy = $this->Sys_sitemap->get_data_by_id($y);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y
        );
        
        $dkategori = $this->produk_hukum_kategori_m->get_data(array('is_permohonan' => 'Y'), 'no_urut');
        $data['dkategori'] = $dkategori;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = "Form Pengajuan"; // Capitalize the first letter
        $data['htitle'] = "Form Pengajuan";
        $this->load->view($this->tmp_path, $data);
    }

    public function simpan_json() {
        $this->load->model('examples/validation_callables');
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        // check user  login
        
        
        $id = $this->input->post('user_id');
        
        // set validation rules
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|edit_unique[auth_users.username.user_id.'.$id.']|min_length[2]|max_length[50]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|edit_unique[auth_users.email.user_id.'.$id.']|min_length[2]|max_length[50]'
            ),
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
                'field' => 'auth_level',
                'label' => 'Peran',
                'rules' => 'required'
            ),
            array(
                'field' => 'banned',
                'label' => 'Status',
                'rules' => 'required'
            )
        );
        // if New Data
        if( $id == "" || $this->input->post('passwd') != ''){
            $config2 = 
            [
                'field' => 'passwd',
                'label' => 'Password',
                'rules' => 
                [
                    'trim',
                    'required',
                    [ 
                            '_check_password_strength', 
                            [ $this->validation_callables, '_check_password_strength' ] 
                    ]
                ]
            ];
            array_push($config, $config2); 
            $config3 = array(
                    'field' => 're_passwd',
                    'label' => 'Ulangi Password',
                    'rules' => 'min_length[2]|max_length[50]|matches[passwd]'
            );
            
            array_push($config, $config3); 
        }
        //echo "<pre>";
        //print_r($config);exit;
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $username = $this->input->post('username');
            $passwd = $this->input->post('passwd');
            $email = $this->input->post('email');
            $nickname = $this->input->post('nickname');
            $biro = $this->input->post('biro');
            $fullname = $this->input->post('fullname');
            $usertelpno = $this->input->post('usertelpno');
            $auth_level = $this->input->post('auth_level');
            $banned = $this->input->post('banned');
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'username' => $username,
                'email' => $email,
                'biro' => $biro,
                'nickname' => $nickname,
                'fullname' => $fullname,
                'usertelpno' => $usertelpno,
                'auth_level' => $auth_level,
                'banned' => $banned
            );

            if (!empty($id)) {
                $data['modified_at'] = date('Y-m-d');
                
                if( !empty($passwd) )
                    $data['passwd'] = $this->authentication->hash_passwd($passwd);
                
                $result = $this->Sys_user_m->update_by_id($data, $id);
            } else {
                $data['created_at'] = date('Y-m-d');
                $data['passwd'] = $this->authentication->hash_passwd($passwd);
                $result = $this->Sys_user_m->insert($data);
            }

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

    public function hapus_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        
        $id = $this->input->get('id');
        
        // get file name
        $data = $this->Sys_user_m->get_data( array('user_id'=>$id), NULL );
        $filename = isset( $data[0]->userphoto )?$data[0]->userphoto:NULL;
        $file_path = UPLOAD_PATH . $filename;
        $file_path_thumb = UPLOAD_PATH . 'thumb_' . $filename;
        if( is_file($file_path) ){
            unlink ($file_path);
        }
        
        if( is_file($file_path_thumb) ){
            unlink ($file_path_thumb);
        }
        
        $result = $this->Sys_user_m->delete_user_auth_by_id($id);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }

    public function admin_ajax_list() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        

        $this->load->model('Sys_user_m');

        $column_order = array(
            'user_id', 'username', 'email', 'biro', 'usertelpno', 'user_id'
        );
        $column_search = $column_order;
        $order = array('user_id' => 'desc'); // default order 

        $list = $this->Sys_user_m->get_datatables($column_order, $order, $column_search);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            for ($i = 0; $i < count($column_search); $i++) {
                $row[] = $r[$column_search[$i]];
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Sys_user_m->count_all(),
            "recordsFiltered" => $this->Sys_user_m->count_filtered($column_order, $order, $column_search),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_data_by_id_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();


        $id = $this->input->get("id");
        $data = $this->Sys_user_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
