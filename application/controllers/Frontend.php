<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frontend
 *
 * @author Selamet Subu - Dell 5459
 */
class Frontend extends MY_Controller {

    var $tmp_path = 'templates/frontend/index';
    var $main_path = 'pages/frontend/';

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        //$data['page'] = $this->main_path . 'main.php';
        $data['page'] = $this->main_path . "home/main";
        $data['title'] = ""; // Capitalize the first letter
        $data['htitle'] = "";
        $this->load->view($this->tmp_path, $data);
        
    }

    public function produk_hukum_per_kategori($id_kategori=null){
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Produk_hukum_m');
        $this->load->library('pagination');
        
        $opsi = $this->input->get('opsi');
        $kueri = $this->input->get('kueri');
        $where = array();
        if(!empty($id_kategori))
            $where['id_kategori'] = $id_kategori;
        
        $config['base_url'] = base_url() . 'frontend/produk_hukum_per_kategori/' . $id_kategori;
        $config['total_rows'] = $this->Produk_hukum_m->count_all($where);
        $config['per_page'] = 5;
        $config["full_tag_open"] = '<ul class="pagination m-0">';
        $config["full_tag_close"] = '</ul>';
        $config["cur_tag_open"] = '<li class="active"><a href="#">';
        $config["cur_tag_close"] = '</a></li>';
        $config["num_tag_open"] = '<li>';
        $config["num_tag_close"] = '</li>';
        $config['enable_query_strings'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'hal';
        $config['reuse_query_string'] = true;
        
        $config["first_link"] = "Awal";
        $config["last_link"] = "Akhir";
        
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        
        $config["prev_tag_open"] = '<li>';
        $config["prev_tag_close"] = '</li>';
        
        $config["next_link"] = 'Berikutnya';
        $config["prev_link"] = 'Sebelumnya';
        
        $start = $this->uri->segment(4);
        
        $this->pagination->initialize($config);
        $result = $this->Produk_hukum_m->get_data_per_page($where, 'tanggal desc', $config['per_page'], $start);
        $dkategori = $this->produk_hukum_kategori_m->get_data(null, 'no_urut');
        $tahun = $this->Produk_hukum_m->get_tahun();
        
        $data['tahun'] = $tahun;
        $data['dkategori'] = $dkategori;
        $data['kategori'] = $this->produk_hukum_kategori_m->get_data_by_id($id_kategori);
        $data['result'] = $result;
        $data['pagination'] = $this->pagination->create_links();       
        $data['page'] = $this->main_path . "produk_hukum/main";
        $data['title'] = "Produk Hukum"; // Capitalize the first letter
        $data['htitle'] = "Produk Hukum";
        $this->load->view($this->tmp_path, $data);
    }
    
    
    public function detail($id_kategori=null, $id_produk_hukum=null){
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Produk_hukum_m');
        $this->load->model('Produk_hukum_komentar_m');
        $this->load->model('Sys_attach_dtl_m');
        
        $where = array('id_kategori' => $id_kategori);

        $result = $this->Produk_hukum_m->get_data_by_id($id_produk_hukum);
        $terbaru = $this->Produk_hukum_m->get_data_terbaru($where, 'dateinput desc');
        $id_dokumen = isset($result[0]->id_dokumen)?$result[0]->id_dokumen:null;
        $attach = $this->Sys_attach_dtl_m->get_data(array('attachid' => $id_dokumen));
        $komentar = $this->Produk_hukum_komentar_m->get_data(array('id_produk_hukum' => $id_produk_hukum, 'publish' => 'Y'));
        
        $dkategori = $this->produk_hukum_kategori_m->get_data(null, 'no_urut');
        $tahun = $this->Produk_hukum_m->get_tahun();
        
        $data['tahun'] = $tahun;
        $data['dkategori'] = $dkategori;
        $data['komentar'] = $komentar;
        $data['attach'] = $attach;
        $data['kategori'] = $this->produk_hukum_kategori_m->get_data_by_id($id_kategori);
        $data['dkategori'] = $this->produk_hukum_kategori_m->get_data(null, "no_urut");
        $data['result'] = $result;
        $data['terbaru'] = $terbaru;
        $data['page'] = $this->main_path . "produk_hukum/detail_main";
        $data['title'] = "Produk Hukum"; // Capitalize the first letter
        $data['htitle'] = "Produk Hukum";
        $this->load->view($this->tmp_path, $data);
    }
    
    public function hasil_pencarian(){
        $this->load->model('produk_hukum_kategori_m');
        $this->load->model('Produk_hukum_m');
        $this->load->library('pagination');
        
        $where = array();
        $like = array();
        
        $tahun = $this->input->get('tahun');
        $id_kategori = $this->input->get('id_kategori');
        $kueri = $this->input->get('kueri');
        
        if(!empty($tahun))
            $where['tahun'] = $tahun;
        if(!empty($id_kategori))
            $where['id_kategori'] = $id_kategori;
        if(!empty($kueri)){
            $kueri = trim($kueri);
            $like['isi'] = $kueri;
            $like['judul'] = $kueri;
            $like['subjudul'] = $kueri;
            $like['abstrak'] = $kueri;
        }
        $config['base_url'] = base_url() . 'frontend/hasil_pencarian';
        $config['total_rows'] = $this->Produk_hukum_m->count_all($where, $like);
        $config['per_page'] = 5;
        //$config["uri_segment"] = 4;
        $config["full_tag_open"] = '<ul class="pagination m-0">';
        $config["full_tag_close"] = '</ul>';
        $config["cur_tag_open"] = '<li class="active"><a href="#">';
        $config["cur_tag_close"] = '</a></li>';
        $config["num_tag_open"] = '<li>';
        $config["num_tag_close"] = '</li>';
        $config['enable_query_strings'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'hal';
        $config['reuse_query_string'] = true;
        
        $config["first_link"] = "Awal";
        $config["last_link"] = "Akhir";
        
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        
        
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        
        $config["prev_tag_open"] = '<li>';
        $config["prev_tag_close"] = '</li>';
        
        $config["next_link"] = 'Berikutnya';
        $config["prev_link"] = 'Sebelumnya';
        
        $start = $this->input->get('hal');
        
        $this->pagination->initialize($config);
        $result = $this->Produk_hukum_m->get_data_per_page($where, null, $config['per_page'], $start, $like);
        
        
        $dkategori = $this->produk_hukum_kategori_m->get_data(null, 'no_urut');
        $tahun = $this->Produk_hukum_m->get_tahun();
        
        $data['tahun'] = $tahun;
        $data['dkategori'] = $dkategori;
        $data['result'] = $result;
        $data['pagination'] = $this->pagination->create_links();       
        $data['page'] = $this->main_path . "pencarian/main";
        $data['title'] = "Pencarian"; // Capitalize the first letter
        $data['htitle'] = "Pencarian";
        $this->load->view($this->tmp_path, $data);
    }

    public function komentar_proses(){
        $this->load->library('form_validation');
        $this->load->model('Produk_hukum_komentar_m');
        
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();
        
        // set validation rules
        $config = array(
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|min_length[2]|max_length[255]|valid_email'
            ),
            array(
                'field' => 'komentar',
                'label' => 'Komentar',
                'rules' => 'required|min_length[2]|max_length[500]'
            ),
            array(
                'field' => 'g-recaptcha-response',
                'label' => 'Re-Captha',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_produk_hukum',
                'label' => 'Produk Hukum',
                'rules' => 'required'
            ),
            
            
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules
        
        $id_produk_hukum = $this->input->post('id_produk_hukum');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $komentar = $this->input->post('komentar');
        $res = $this->input->post('g-recaptcha-response');
        
        if ($this->form_validation->run() !== false) {
            $data = array(
                'id_produk_hukum' => $id_produk_hukum,
                'nama' => $nama,
                'email' => $email,
                'komentar' => $komentar
            );
            
            $result = $this->Produk_hukum_komentar_m->insert($data);
            
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
    
    
    public function registrasi(){
        $this->load->model('produk_hukum_kategori_m');
        $dkategori = $this->produk_hukum_kategori_m->get_data(array('is_permohonan' => 'Y'), 'no_urut');
        $data['dkategori'] = $dkategori;
        $data['page'] = $this->main_path . "registrasi/main";
        $data['title'] = "Registrasi"; // Capitalize the first letter
        $data['htitle'] = "Registrasi";
        $this->load->view($this->tmp_path, $data);
    }
    
    public function registrasi_proses(){
        
    }

        public function konten_statis($nama=null){
        $this->load->model('Konten_statis_m');
        
        $where = array('nama' => $nama);
        
        $result = $this->Konten_statis_m->get_data($where, null);
        $judul = isset($result[0]->judul)?$result[0]->judul:"";
        $data['result'] = $result;
        $data['page'] = $this->main_path . "konten_statis/main";
        $data['title'] = $judul; // Capitalize the first letter
        $data['htitle'] = $judul;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function kontak(){
        $this->load->model('Konten_statis_m');
        $nama = 'kontak_jdih';
        $where = array('nama' => $nama);
        
        $result = $this->Konten_statis_m->get_data($where, null);
        $judul = isset($result[0]->judul)?$result[0]->judul:"";
        $data['result'] = $result;
        $data['page'] = $this->main_path . "profil/main";
        $data['title'] = $judul; // Capitalize the first letter
        $data['htitle'] = $judul;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function kontak_proses(){
        $this->load->library('form_validation');
        $this->load->model('Hubungi_kami_m');
        
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();
        
        // set validation rules
        $config = array(
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|min_length[2]|max_length[255]|valid_email'
            ),
            array(
                'field' => 'pesan',
                'label' => 'Pesan',
                'rules' => 'required|min_length[2]|max_length[5000]'
            ),
            array(
                'field' => 'g-recaptcha-response',
                'label' => 'Re-Captha',
                'rules' => 'required'
            ),
            array(
                'field' => 'subjek',
                'label' => 'Subjek',
                'rules' => 'required'
            ),
            
            
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules
        
        $subjek = $this->input->post('subjek');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $pesan = $this->input->post('pesan');
        $res = $this->input->post('g-recaptcha-response');
        
        if ($this->form_validation->run() !== false) {
            $data = array(
                'nama' => $nama,
                'email' => $email,
                'pesan' => $pesan,
                'subjek' => $subjek
            );
            
            $result = $this->Hubungi_kami_m->insert($data);
            
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
}
