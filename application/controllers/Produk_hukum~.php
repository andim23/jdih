<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produk_hukum
 *
 * @author Selamet Subu - Dell 5459
 */
class Produk_hukum extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/produk_hukum/produk/';
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_hukum_m');
        $this->load->library('form_validation');

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
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
        
        $kategori = $this->produk_hukum_kategori_m->get_data(array('is_permohonan' => 'N'), 'kategori');

        $data['kategori'] = $kategori;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = "Produk Hukum"; // Capitalize the first letter
        $data['htitle'] = "Produk Hukum";
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
                'field' => 'produk_hukum',
                'label' => 'Produk Hukum',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'subjudul',
                'label' => 'Sub Judul',
                'rules' => 'min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'abstrak',
                'label' => 'Abstrak',
                'rules' => 'min_length[2]|max_length[4000]'
            ),
            array(
                'field' => 'isi',
                'label' => 'Isi',
                'rules' => 'required|min_length[2]|max_length[4000]'
            ),
            array(
                'field' => 'catatan',
                'label' => 'Catatan',
                'rules' => 'max_length[255]'
            ),
            array(
                'field' => 'id_kategori',
                'label' => 'Jenis Produk Hukum',
                'rules' => 'required'
            ),
            array(
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_dokumen',
                'label' => 'Dokumen',
                'rules' => 'integer'
            )
            
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('id_produk_hukum');
            $produk_hukum = $this->input->post('produk_hukum');
            $tanggal = $this->input->post('tanggal');
            $tanggal = date_sql($tanggal);
            $judul = $this->input->post('judul');
            $subjudul = $this->input->post('subjudul');
            $abstrak = $this->input->post('abstrak');
            $isi = $this->input->post('isi');
            $catatan = $this->input->post('catatan');
            $id_kategori = $this->input->post('id_kategori');
            $userinput = $this->auth_user_id;
            $id_dokumen = $this->input->post('id_dokumen');
            // file
            $file_name = $this->input->post('file_name');
            $file_size = $this->input->post('file_size');
            $file_type = $this->input->post('file_type');
            // file
            
            
            // set POST data in Array
            $data = array(
                'id_kategori' => $id_kategori,
                'id_dokumen' => $id_dokumen,
                'produk_hukum' => $produk_hukum,
                'tanggal' => $tanggal,
                'judul' => $judul,
                'subjudul' => $subjudul,
                'abstrak' => $abstrak,
                'isi' => $isi,
                'catatan' => $catatan
            );
            
            $data_berkas = array(
                'file_name' => $file_name,
                'file_type' => $file_type,
                'file_size' => $file_size
            );
            
            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->Produk_hukum_m->update_by_id($data, $id, $data_berkas);
            } else {
                $data['userinput'] = $userinput;
                $result = $this->Produk_hukum_m->insert($data, $data_berkas);
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

        if (!$this->verify_role('admin')) {
            redirect("login");
        }
        $id = $this->input->get('id');
        $result = $this->Produk_hukum_m->delete_by_id($id);
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

        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        $this->load->model('Produk_hukum_m');
        
        
        $where = null;
        
        $id_kategori = $this->input->post('id_kategori');
        
        if( !empty($id_kategori) )
            $where['id_kategori'] = $id_kategori;
        
        $column_order = array(
            'id_produk_hukum', 'tahun', 'kategori', 'judul', 'subjudul', 'id_produk_hukum'
        );
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->Produk_hukum_m->get_datatables($column_order, $order, $column_search, $where);
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
            "recordsTotal" => $this->Produk_hukum_m->count_all($where),
            "recordsFiltered" => $this->Produk_hukum_m->count_filtered($column_order, $order, $column_search, $where),
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
        $data = $this->Produk_hukum_m->get_data_by_id($id);
        echo json_encode($data);
    }
    
    public function form($id=null){
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Sys_attach_dtl_m');
        
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);
        $dy = $this->Sys_sitemap->get_data_by_id($y);
        
        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y,
            'Form' => ''
        );
        
        $kategori = $this->produk_hukum_kategori_m->get_data(array('is_permohonan' => 'N'), 'kategori');
        $result = $this->Produk_hukum_m->get_data_by_id($id);
        $id_dokumen = isset($result[0]->id_dokumen)?$result[0]->id_dokumen:0;
        $where = array('attachid' => $id_dokumen);
        $berkas = $this->Sys_attach_dtl_m->get_data($where, '');
        
        $data['berkas'] = $berkas;
        $data['kategori'] = $kategori;        
        $data['result'] = $result;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'form_main.php';
        $data['title'] = "Form Produk Hukum"; // Capitalize the first letter
        $data['htitle'] = "Form Produk Hukum";
        $this->load->view($this->tmp_path, $data);
    }
    
    public function delete_fileph_json(){
        $this->load->model('Sys_attach_dtl_m');
        $recid = $this->input->get('recid');
        $file_name = $this->input->get('file_name');
        
        $result = $this->Sys_attach_dtl_m->delete_by_id($recid);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
            
            $file_path = UPLOAD_PATH . 'produk_hukum/' . $file_name;
            if(file_exists($file_path) ){
                unlink ($file_path);
            }
            
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }

}
