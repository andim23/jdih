<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
			parent::__construct();
			// Your own constructor code
	}
	
	public function index()
	{
		$this->load->model("user_m");
		$data['title'] = "Login Form";
		
		$this->load->view("pages/login/login_form", $data);
	}
	
	public function login_process()
	{
		$this->load->model("user_m");
		
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$where = array("username"=>$username, "password"=>hash('sha256', $password));
		
		$result = $this->user_m->auth_login($where);
		
		if( $result )
		{			
			$sess_array = array(
				 'id_user' => $result[0]->id_user,
				 'is_hqlogged' => true,
				 'username' => $result[0]->username
			);
			
			$this->session->set_userdata('gajiku_in', $sess_array);
			
			redirect("page");
		}
		else
		{
			$message = '<div class="alert alert-danger" role="alert"><strong>Gagal!</strong> Username dan Password tidak sesuai.</div>';
			$this->session->set_flashdata('pesan', $message);
			redirect("login");
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('gajiku_in');
		redirect("login", 'refresh');
	}
        
        
    // Lupa Password Proses 
    public function lupa_password_proses(){
        $this->load->helper('auth');
        $this->load->helper('string');
        $this->load->library('email');
        $this->load->model('Sys_user_m');
        $email = $this->input->post('email');
        $where = array('useremail' => $email);
        $data = $this->Sys_user_m->get_data( $where );
        
        // send email
        if( $data ){
            $passwd = ucfirst(random_string('alpha', 5)) . random_string('numeric', 3);
            $message = '
                    Password baru: '.$passwd.'
            ';
            $passwd = $this->authentication->hash_passwd($passwd);
            $d = array('userpass' => $passwd);
            $result = $this->Sys_user_m->update_user_auth_password_by_id($d, $data[0]->userid);
            
            if($result){
                $this->email->from('mpo2017kementan@gmail.com', 'Modal Pelaporan Online Kementarian Pertanian');
                $this->email->to($email);
                $this->email->subject('Resset Password');
                
                $this->email->message($message);
                
                if($this->email->send()){
                    $r = array(
                        'status'=>'1', 
                        'message'=>'Email terkirim ke email anda ' . $email . ' .'
                    );
                }else{
                    $r = array(
                        'status'=>'0', 
                        'message'=>'Email gagal terkirim.'
                    );
                }
            }else{
                $r = array(
                    'status'=>'0', 
                    'message'=>'Gagal Update Password.'
                );
            }
        }else{
            $r = array(
                'status'=>'0', 
                'message'=>'Email anda tidak terdaftar.'
            );
        }
        
         echo json_encode($r);
    }
}