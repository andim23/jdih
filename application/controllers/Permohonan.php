<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permohonan
 *
 * @author Selamet Subu - Dell 5459
 */
class Permohonan extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/';

    public function __construct() {
        parent::__construct();
        $this->load->model('Permohonan_m');
        $this->load->library('form_validation');

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
    }
    
    public function index(){
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Sys_user_m');
        
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
        $data['page'] = $this->main_path . 'status_permohonan/main.php';
        $data['title'] = "Form Pengajuan"; // Capitalize the first letter
        $data['htitle'] = "Form Pengajuan";
        $this->load->view($this->tmp_path, $data);
    }

    public function form_pengajuan() {
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Sys_user_m');
        
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);
        $dy = $this->Sys_sitemap->get_data_by_id($y);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y
        );
        
        $du = $this->Sys_user_m->get_data_by_id($this->auth_user_id);
        
        $data['du'] = $du;
        $dkategori = $this->produk_hukum_kategori_m->get_data(array('is_permohonan' => 'Y'), 'no_urut');
        $data['dkategori'] = $dkategori;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'form_pengajuan/main.php';
        $data['title'] = "Form Pengajuan"; // Capitalize the first letter
        $data['htitle'] = "Form Pengajuan";
        $this->load->view($this->tmp_path, $data);
    }

    public function simpan_json() {
        $this->load->model('Sys_globalvar_m');
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();


        // set validation rules
        $config = array(
            array(
                'field' => 'id_kategori',
                'label' => 'Jenis Produk Hukum',
                'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[10]'
            ),
            array(
                'field' => 'pengusul',
                'label' => 'Pengusul',
                'rules' => 'required|min_length[3]|max_length[50]'
            ),
            array(
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'required|min_length[3]|max_length[255]'
            ),
            array(
                'field' => 'no_nota_dinas',
                'label' => 'Nomor Nota Dinas',
                'rules' => 'required|min_length[3]|max_length[50]'
            ),
            array(
                'field' => 'tanggal_nota_dinas',
                'label' => 'Tanggal Nota Dinas',
                'rules' => 'required'
            ),
            array(
                'field' => 'tanggal_nota_dinas',
                'label' => 'Tanggal Nota Dinas',
                'rules' => 'required'
            ),
            array(
                'field' => 'no_permohonan',
                'label' => 'no_permohonan',
                'rules' => 'required'
            )
            
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $user_id = $this->auth_user_id;
            $tanggal_nota_dinas = date_sql($this->input->post('tanggal_nota_dinas'));
            $nota_dinas_file = $this->input->post('nota_dinas_file');
            $position_paper_file = $this->input->post('position_paper_file');
            $draft_rancangan_file = $this->input->post('draft_rancangan_file');
            $tahapan_pembahasan_file = $this->input->post('tahapan_pembahasan_file');
            
            // set POST data in Array
            $data = array(
                'user_id' => $user_id,
                'id_kategori' => $this->input->post('id_kategori'),
                'id_permohonan_status' => '1',
                'pengusul' => $this->input->post('pengusul'),
                'judul' => $this->input->post('judul'),
                'no_nota_dinas' => $this->input->post('no_nota_dinas'),
                'tanggal_nota_dinas' => $tanggal_nota_dinas,
                'notes' => $this->input->post('notes'),
                'no_permohonan' => $this->input->post('no_permohonan')
            );
            
            $dataf = array(
                'nota_dinas_file' =>   $nota_dinas_file,
                'position_paper_file' => $position_paper_file,
                'draft_rancangan_file' => $draft_rancangan_file,
                'tahapan_pembahasan_file' => $tahapan_pembahasan_file
            );

            $result = $this->Permohonan_m->insert_data($data, $dataf);
            
            $dp = $this->Sys_globalvar_m->get_data(array('varname' => 'pesan_sukses_permohonan'));
            $val_text = isset($dp[0]->val_text)?$dp[0]->val_text:"";
            
            if ($result) {
                $r = array('status' => '1', 'message' => $val_text);
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
        $result = $this->Permohonan_m->delete_by_id($id);
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


        $this->load->model('Permohonan_m');

        $where = array(
            'user_id' => $this->auth_user_id
        );
        
        $column_order = array(
            'id_permohonan', 'no_permohonan', 'tanggal', 'kategori', 'judul', 'status', 'id_permohonan'
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
        
        $data['his'] = $his;
        $data['detail'] = $detail;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'status_permohonan/detail_main.php';
        $data['title'] = "Form Detail Pengajuan"; // Capitalize the first letter
        $data['htitle'] = "Form Detail Pengajuan";
        $this->load->view($this->tmp_path, $data);
    }

    public function get_data_by_id_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();


        $id = $this->input->get("id");
        $data = $this->Permohonan_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
