<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {

    var $tmp_path = 'templates/index_horizontal_menu/index';
    var $main_path = 'pages/home/';

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->is_logged_in();
        if( empty( $this->auth_role ) )
        {
            redirect("login");
        }
    }

    public function index()
    {	
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = "Dashboard"; // Capitalize the first letter
        $this->load->view('templates/index_horizontal_menu/index', $data);
    }
    
    public function get_left_menu(){
        $this->load->model('Sys_sitemap');
        
        $x = $this->input->get('x');
        
        $where = array(
            'sitemapid_parent' => $x,
            'role_name' => $this->auth_role
        );
        
        $order = 'sortno asc';
        
        $data = $this->Sys_sitemap->get_data_first_row($where, $order);
        $y = isset($data[0]->sitemapid)?$data[0]->sitemapid:null;

        if( !empty($y) ){
            $url = isset($data[0]->url)?$data[0]->url . '?x=' . $x . '&y=' . $y:NULL;
            if( !empty($url) ){
                redirect($url);
            }
            else
            {
                $data['page'] = 'templates/layout_horizontal_sidebar_menu/content_empty';
                $data['htitle'] = "JDIH"; // Capitalize the first letter
                $data['id_menu'] = 'mpo_play';
                $this->load->view('templates/layout_horizontal_sidebar_menu/index', $data);
            }
        }else{
            show_404();
        }
		
    }
    
}
