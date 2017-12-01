<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Update_permohonan
 *
 * @author Selamet Subu - Dell 5459
 */
class Update_permohonan extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/update_permohonan/';

    public function __construct() {
        parent::__construct();
        $this->load->model('Permohonan_m');
        $this->load->library('form_validation');

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
    }

    public function index() {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);
        $dy = $this->Sys_sitemap->get_data_by_id($y);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y
        );

        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = $dy[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dy[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }

    public function simpan_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        // check user  login
        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        // set validation rules
        $config = array(
            array(
                'field' => 'id_permohonan_status',
                'label' => 'Status',
                'rules' => 'required'
            ),
            array(
                'field' => 'notes',
                'label' => 'Keterangan',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('id_permohonan');
            $id_permohonan_status = $this->input->post('id_permohonan_status');
            $notes = $this->input->post('notes');
            $file_name = $this->input->post('file_name');
            $userinput = $this->auth_user_id;
            
            // set POST data in Array
            $data = array(
                'id_permohonan_status' => $id_permohonan_status,
                'notes' => $notes
            );

            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->Permohonan_m->update_data_by_id($data, $id, $file_name);
            } else {
                $result = false;
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

    public function admin_ajax_list() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();


        $this->load->model('Permohonan_m');

        $where = array();
        
        $column_order = array(
            'id_permohonan', 'no_permohonan', 'tanggal_char', 'kategori', 'judul', 'status', 'id_permohonan'
        );
        $column_search = $column_order;
        $order = array('tanggal' => 'desc'); // default order 

        $list = $this->Permohonan_m->get_datatables($column_order, $order, $column_search, $where);
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
            "recordsTotal" => $this->Permohonan_m->count_all($where),
            "recordsFiltered" => $this->Permohonan_m->count_filtered($column_order, $order, $column_search, $where),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function status_detail($id_permohonan=null){
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Sys_user_m');
        $this->load->model('Permohonan_status_h_m');
        $this->load->model('Permohonan_status_m');
        $this->load->model('Sys_attach_dtl_m');
        
        
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);
        $dy = $this->Sys_sitemap->get_data_by_id($y);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y,
            'Detail Permohonan' => ''
        );
        
        $detail = $this->Permohonan_m->get_data_by_id($id_permohonan);
        $where = array(
            'id_permohonan' => $id_permohonan
        );
        $his = $this->Permohonan_status_h_m->get_data($where, 'dateinput desc');
        
        foreach($his as $rh){
            $id_berkas = $rh->id_berkas;
            $rh->berkas = $this->Sys_attach_dtl_m->get_data( array('attachid' => $id_berkas) );
        }

        $data['status'] = $this->Permohonan_status_m->get_data(array('status !=' => 'Pengajuan'), 'no_urut');
        $data['his'] = $his;
        $data['detail'] = $detail;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'detail_main.php';
        $data['title'] = "Form Detail Pengajuan"; // Capitalize the first letter
        $data['htitle'] = "Form Detail Pengajuan";
        $this->load->view($this->tmp_path, $data);
    }

}
