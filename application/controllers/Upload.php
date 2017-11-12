<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * This Code Licence to SS <selametsubu@gmail.com>
 * SS <abu assyifa>  * 
 */

/**
 * Description of Upload
 *
 * @author Selamet Subu - Dell 5459
 */
class Upload extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        
        $this->is_logged_in();
        if( empty( $this->auth_role ) )
        {
            redirect("login");
        }
        
    }
    
    public function do_upload($dir=NULL){
        // set user priviledge
        if( !$this->verify_role('admin') )
            redirect("login");
        
        $config['upload_path'] = 'upload/';
        
        $config['allowed_types'] = 'png|jpg|jpeg|pdf|xls|xlsx|doc|docx|ppt|pptx';
        $config['max_size'] = '100000000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload("file") ){
            $r = array('info'=>'0', 'message' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['file_name'];
			$r = array('info'=>'1', 'message'=>'Upload Lokal berhail', 'file_name'=>$file_name);
        }
        
        echo json_encode($r);
    }
    
    public function do_upload_ph($dir=NULL){
        // set user priviledge
        if( !$this->verify_role('admin') )
            redirect("login");
        
        $config['upload_path'] = UPLOAD_PATH . 'produk_hukum/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = '100000000';
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload("file") ){
            $r = array('info'=>'0', 'message' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['file_name'];
            $file_type = $data['upload_data']['file_type'];
            $file_size = $data['upload_data']['file_size'];
            $r = array(
                'info'=>'1', 
                'message'=>'Upload Lokal berhail', 
                'file_name'=>$file_name,
                'file_type'=>$file_type,
                'file_size'=>$file_size
            );
        }
        
        echo json_encode($r);
    }
    
    public function do_upload_ks(){
        // set user priviledge
        if( !$this->verify_role('admin') )
            redirect("login");
        
        $config['upload_path'] = UPLOAD_PATH . 'konten_statis/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '100000000';
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload("file") ){
            $r = array('info'=>'0', 'message' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['file_name'];
            $file_type = $data['upload_data']['file_type'];
            $file_size = $data['upload_data']['file_size'];
            $r = array(
                'info'=>'1', 
                'message'=>'Upload Lokal berhail', 
                'file_name'=>$file_name,
                'file_type'=>$file_type,
                'file_size'=>$file_size
            );
        }
        
        echo json_encode($r);
    }

        public function delete_fileph_json(){
        $file_name = $this->input->get('file_name');
        
        $file_path = UPLOAD_PATH . 'produk_hukum/' . $file_name;
        if(file_exists($file_path) ){
            unlink ($file_path);
        }
        $r = array('status'=>'1', 'message'=>'Delete File berhasil');
        echo json_encode($r);
    }
	
    public function do_upload_profil_picture(){
        // set user priviledge
        if( !$this->verify_role('admin') )
            redirect("login");
        
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
            //Thumbnail Image Upload - End
        }
        
        echo json_encode($r);
    }
    
    public function delete_file_json(){
        $filename = $this->input->get('filename');
        
        $file_path = UPLOAD_PATH . $filename;
        $file_path_thumb = UPLOAD_PATH . 'thumb_' . $filename;
        if(file_exists($file_path) ){
            unlink ($file_path);
        }
        
        if(file_exists($file_path_thumb) ){
            unlink ($file_path_thumb);
        }
        
        $r = array('info'=>'1', 'message'=>'Delete File berhasil');
        
        echo json_encode($r);
    }
}
