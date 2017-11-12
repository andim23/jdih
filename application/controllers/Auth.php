<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Community Auth - Examples Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2017, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('auth');
    }

    /**
     * Here we simply verify if a user is logged in, but
     * not enforcing authentication. The presence of auth 
     * related variables that are not empty indicates 
     * that somebody is logged in. Also showing how to 
     * get the contents of the HTTP user cookie.
     */
    public function simple_verification()
    {
        $this->is_logged_in();

        if( ! empty( $this->auth_role ) )
        {
            redirect ("page");
            /*echo $this->auth_role . ' logged in!<br />
                    User ID is ' . $this->auth_user_id . '<br />
                    Auth level is ' . $this->auth_level . '<br />
                    Username is ' . $this->auth_username; 
            exit;
             * /
             */
            /*
            if( $http_user_cookie_contents = $this->input->cookie( config_item('http_user_cookie_name') ) )
            {
                $http_user_cookie_contents = unserialize( $http_user_cookie_contents );
                print_r( $http_user_cookie_contents );
            }*/
            
            /*
            if( config_item('add_acl_query_to_auth_functions') && $this->acl )
            {
                print_r( $this->acl );
            }*/

            /**
             * ACL usage doesn't require ACL be added to auth vars.
             * If query not performed during authentication, 
             * the acl_permits function will query the DB.
             */
            /*if( $this->acl_permits('general.secret_action') )
            {
                echo '<p>ACL permission grants action!</p>';
            }*/
          
            

        }
        else
        {
            redirect("auth/login");
        }
    }
	
    // -----------------------------------------------------------------------

    /**
     * Most minimal user creation. You will of course make your
     * own interface for adding users, and you may even let users
     * register and create their own accounts.
     *
     * The password used in the $user_data array needs to meet the
     * following default strength requirements:
     *   - Must be at least 8 characters long
     *   - Must be at less than 72 characters long
     *   - Must have at least one digit
     *   - Must have at least one lower case letter
     *   - Must have at least one upper case letter
     *   - Must not have any space, tab, or other whitespace characters
     *   - No backslash, apostrophe or quote chars are allowed
     */
    public function create_user()
    {
            // Customize this array for your user
            $user_data = [
                'username'   => 'selametsubu',
                'passwd'     => 'Selamet123',
                'email'      => 'selametsubu@gmail.com',
                'auth_level' => '1', // 9 if you want to login @ examples/index.
            ];

            $this->is_logged_in();

            echo $this->load->view('examples/page_header', '', TRUE);

            // Load resources
            $this->load->helper('auth');
            $this->load->model('examples/examples_model');
            $this->load->model('examples/validation_callables');
            $this->load->library('form_validation');

            $this->form_validation->set_data( $user_data );

            $validation_rules = [
                    [
                            'field' => 'username',
                            'label' => 'username',
                            'rules' => 'max_length[12]|is_unique[' . db_table('user_table') . '.username]',
                            'errors' => [
                                    'is_unique' => 'Username already in use.'
                            ]
                    ],
                    [
                            'field' => 'passwd',
                            'label' => 'passwd',
                            'rules' => [
                                    'trim',
                                    'required',
                                    [ 
                                            '_check_password_strength', 
                                            [ $this->validation_callables, '_check_password_strength' ] 
                                    ]
                            ],
                            'errors' => [
                                    'required' => 'The password field is required.'
                            ]
                    ],
                    [
                            'field'  => 'email',
                            'label'  => 'email',
                            'rules'  => 'trim|required|valid_email|is_unique[' . db_table('user_table') . '.email]',
                            'errors' => [
                                    'is_unique' => 'Email address already in use.'
                            ]
                    ],
                    [
                            'field' => 'auth_level',
                            'label' => 'auth_level',
                            'rules' => 'required|integer|in_list[1,6,9]'
                    ]
            ];

            $this->form_validation->set_rules( $validation_rules );

            if( $this->form_validation->run() )
            {
                    $user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
                    $user_data['user_id']    = $this->examples_model->get_unused_id();
                    $user_data['created_at'] = date('Y-m-d H:i:s');

                    // If username is not used, it must be entered into the record as NULL
                    if( empty( $user_data['username'] ) )
                    {
                            $user_data['username'] = NULL;
                    }

                    $this->db->set($user_data)
                            ->insert(db_table('user_table'));

                    if( $this->db->affected_rows() == 1 )
                            echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
            }
            else
            {
                    echo '<h1>User Creation Error(s)</h1>' . validation_errors();
            }

            echo $this->load->view('examples/page_footer', '', TRUE);
    }

    // -----------------------------------------------------------------------

    /**
     * This login method only serves to redirect a user to a 
     * location once they have successfully logged in. It does
     * not attempt to confirm that the user has permission to 
     * be on the page they are being redirected to.
     */
    public function login()
    {   
        $this->is_logged_in();
	if( ! empty( $this->auth_role ) )
            redirect("page");
		
        // Method should not be directly accessible
        if( $this->uri->uri_string() == 'auth/login')
            show_404();
        // set user auth member
        if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
            $this->require_min_level(1,2,3,4,5,6,7,8,9,10,11);

        $this->setup_login_form();

        $html = $this->load->view("pages/login/login_form", '', TRUE);

        echo $html;
    }

    // --------------------------------------------------------------

    /**
     * Log out
     */
    public function logout()
    {
        $this->is_logged_in();

		$this->authentication->logout();
		$redirect_protocol = USE_SSL ? 'https' : NULL;
		redirect( site_url( LOGIN_PAGE . '?logout=1', $redirect_protocol ) );
    }
	
}

/* End of file Examples.php */
/* Location: /community_auth/controllers/Examples.php */
