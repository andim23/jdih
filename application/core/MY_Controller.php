<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - MY Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2017, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

require_once APPPATH . 'third_party/community_auth/core/Auth_Controller.php';

class MY_Controller extends Auth_Controller
{
	/**
	 * Class constructor
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('navigation');
        $this->load->model('Sys_sitemap');
    }

    function xss_checking(){
        foreach ($_POST as $key => $value) {
            if ($this->security->xss_clean($value, TRUE) === FALSE)
            {
                show_error('XSS not Allowed');
            }
        }
    }
    
    function __get_curent_sessionid(){
        //$sessionid = $this->session->userdata('sessionid');
        $sessionid = $this->session->userdata('sessionid');
        return $sessionid;
    }
}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */