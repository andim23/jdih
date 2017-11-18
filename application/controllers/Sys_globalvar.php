<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sys_globalvar
 *
 * @author Selamet Subu - Dell 5459
 */
class Sys_globalvar extends MY_Controller {
    
    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/global_setting/';
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Sys_globalvar_m');
        $this->load->library('form_validation');
        
        $this->is_logged_in();
        if( empty( $this->auth_role ) )
        {
            redirect("login");
        }
    }

    public function index() {
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
        
        $id = $this->input->post('varid');
        // set validation rules
        $config = array(
            array(
                'field' => 'varname',
                'label' => 'Nama Variabel',
                'rules' => 'required|edit_unique[sys_globalvar.varname.varid.'.$id.']|min_length[2]|max_length[255]'
            ),
            array(
                'field' => 'val_int',
                'label' => 'Nilai (Integer)',
                'rules' => 'integer'
            ),
            array(
                'field' => 'val_float',
                'label' => 'Nilai (Float)',
                'rules' => 'decimal'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $varname = $this->input->post('varname');
            $val_int = $this->input->post('val_int');
            $val_float = $this->input->post('val_float');
            $val_varchar = $this->input->post('val_varchar');
            $val_date = $this->input->post('val_date');
            $val_datetime = $this->input->post('val_datetime');
            $val_text = $this->input->post('val_text');
            $val_datefrom = $this->input->post('val_datefrom');
            $val_dateto = $this->input->post('val_dateto');
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'varname' => empty_to_null($varname),
                'val_int' => empty_to_null($val_int),
                'val_float' => empty_to_null($val_float),
                'val_varchar' => empty_to_null($val_varchar),
                'val_date' => date_sql(empty_to_null($val_date)),
                'val_datetime' => date_time_sql(empty_to_null($val_datetime)),
                'val_text' => empty_to_null($val_text),
                'val_datefrom' => date_sql(empty_to_null($val_datefrom)),
                'val_dateto' => date_sql(empty_to_null($val_dateto))
            );

            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->Sys_globalvar_m->update_by_id($data, $id);
            } else {
                $data['userinput'] = $userinput;
                $result = $this->Sys_globalvar_m->insert($data);
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
        $result = $this->Sys_globalvar_m->delete_by_id($id);
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

        

        $this->load->model('Sys_globalvar_m');

        $column_order = array(
            'varid', 'varname', 'val_int', 'val_float', 'val_varchar', 'val_date_char', 
            'val_datetime_char', 'varid'
        );
        $column_search = $column_order;
        $order = array('varid' => 'desc'); // default order 

        $list = $this->Sys_globalvar_m->get_datatables($column_order, $order, $column_search);
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
            "recordsTotal" => $this->Sys_globalvar_m->count_all(),
            "recordsFiltered" => $this->Sys_globalvar_m->count_filtered($column_order, $order, $column_search),
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
        $data = $this->Sys_globalvar_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
