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
    
    public function sampleXml(){
        $string  = '<?xml version="1.0" encoding="UTF-8"?>
                    <response>
                            <message>
                                    <messageId>MDM-9118314861</messageId>
                                    <to>628111102714</to>
                                    <status>0</status>
                                    <text>Success</text>
                                    <balance>358</balance>
                                    <srv>165</srv>
                            </message>
                    </response>';
        return $string;
    }
    
    function sendSMS($nohp=null, $pesan=null) {
        $status = '0';
        if(!empty($nohp)){
        
            // Nomor Tujuan dan Isi SMS
            $sms = ['nohp' => $nohp, 'pesan' => $pesan];

            // Prepare dan Konfigurasi
            $baseUrl = 'https://alpha.zenziva.net/apps/smsapi.php';
            $config = ['userkey' => '15n0s8','passkey' => 'Kyr12014'];

            $params = array_merge($config, $sms);
            $uri = $baseUrl . '?' . http_build_query($params);

            // Kirim HTTP GET
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_URL, $uri);
            $result = curl_exec($curl);
            $xml = simplexml_load_string($result);

            $r = $xml->message->status;
            if($r === '0'){
                $status = '1';
            }
        }
        
        return $status;
    }

}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */