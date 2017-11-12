<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Konten_statis
 *
 * @author Selamet Subu - Dell 5459
 */
class Konten_statis extends MY_Controller {

    var $tmp_path = 'templates/index_horizontal_menu/index';
    var $main_path = 'pages/konten_statis/';

    public function __construct() {
        parent::__construct();
        $this->load->model('Konten_statis_m');
        $this->load->library('form_validation');

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
    }

    public function index() {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );

        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = "Konten Statis"; // Capitalize the first letter
        $data['htitle'] = "Konten Statis";
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
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'isi',
                'label' => 'Isi',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('recid');
            $nama = $this->input->post('nama');
            $judul = $this->input->post('judul');
            $isi = $this->input->post('isi');
            $gambar = $this->input->post('gambar');
            $id_gambar = $this->input->post('id_gambar');
            
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'nama' => $nama,
                'judul' => $judul,
                'isi' => $isi,
                'id_gambar' => $id_gambar
            );

            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->Konten_statis_m->update_by_id($data, $id, $gambar);
            } else {
                $data['userinput'] = $userinput;
                $result = $this->Konten_statis_m->insert($data, $gambar);
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
        $result = $this->Konten_statis_m->delete_by_id($id);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }
    
    public function hapus_gambar_json(){
        $this->load->model('Sys_attach_dtl_m');
        $id_gambar = $this->input->get('id_gambar');
        
        $data = $this->Sys_attach_dtl_m->get_data(array('attachid' => $id_gambar));
        $filename = $data[0]->filename;
        $recid = $data[0]->recid;
        
        $path = base_url() . 'upload/konten_statis/' . $filename;
        if(is_file($path) ){
            unlink($path);
        }
        
        $result = $this->Sys_attach_dtl_m->delete_by_id($recid);
        
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

        $this->load->model('Konten_statis_m');

        $column_order = array(
            'recid', 'nama', 'judul', 'dateinput'
        );
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->Konten_statis_m->get_datatables($column_order, $order, $column_search);
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
            "recordsTotal" => $this->Konten_statis_m->count_all(),
            "recordsFiltered" => $this->Konten_statis_m->count_filtered($column_order, $order, $column_search),
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
        $data = $this->Konten_statis_m->get_data_by_id($id);
        echo json_encode($data);
    }

}