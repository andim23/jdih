<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard
 *
 * @author Selamet Subu - Dell 5459
 */
class Dashboard extends MY_Controller {

    var $tmp_path = 'templates/index_horizontal_menu/index';
    var $main_path = 'pages/home/';

    public function __construct() {
        parent::__construct();

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
    }

    public function index() {
        $this->load->model('Permohonan_status_m');
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Sys_user_m');
        $this->load->model('Permohonan_m');

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            'Dashboard' => base_url() . 'dashboard'
        );
        
        $tahun = date('Y');
        $user_id = $this->auth_role != 'admin'?$this->auth_user_id:null;
        
        if( $this->auth_role != 'admin' ){
            $data['permohonan'] = $this->Permohonan_m->get_latest_permohonan(array('user_id' => $this->auth_user_id));
        }
        
        $data['user'] = $this->Sys_user_m->get_data_by_id($this->auth_user_id);
        $data['chart1'] = $this->Permohonan_status_m->get_summary_permohonan_status($tahun, $user_id);
        $data['chart2'] = $this->produk_hukum_kategori_m->summary_kategori($tahun, $user_id);
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = 'Dashboard'; // Capitalize the first letter
        $data['htitle'] = 'Dashboard';
        $this->load->view($this->tmp_path, $data);
    }

}
