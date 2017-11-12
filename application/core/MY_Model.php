<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - MY Model
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2017, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 *
 * I decided it was important to have the ACL related 
 * methods here because then I can access them from any model.
 * This has been especially useful in websites I work on.
 */

class MY_Model extends CI_Model
{
	/**
	 * ACL for a logged in user
	 * @var mixed
	 */
	public $acl = NULL;

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	// -----------------------------------------------------------------------

	/**
	 * Get all of the ACL records for a specific user
	 */
	public function acl_query( $user_id, $called_during_auth = FALSE )
	{
		// ACL table query
		$query = $this->db->select('b.action_id, b.action_code, c.category_code')
			->from( $this->db_table('acl_table') . ' a' )
			->join( $this->db_table('acl_actions_table') . ' b', 'a.action_id = b.action_id' )
			->join( $this->db_table('acl_categories_table') . ' c', 'b.category_id = c.category_id' )
			->where( 'a.user_id', $user_id )
			->get();

		/**
		 * ACL becomes an array, even if there were no results.
		 * It is this change that indicates that the query was 
		 * actually performed.
		 */
		$acl = [];

		if( $query->num_rows() > 0 )
		{
			// Add each permission to the ACL array
			foreach( $query->result() as $row )
			{
				// Permission identified by category + "." + action code
				$acl[$row->action_id] = $row->category_code . '.' . $row->action_code;
			}
		}

		if( $called_during_auth OR $user_id == config_item('auth_user_id') )
			$this->acl = $acl;

		return $acl;
	}
	
	// -----------------------------------------------------------------------

	/**
	 * Check if ACL permits user to take action.
	 *
	 * @param  string  the concatenation of ACL category 
	 *                 and action codes, joined by a period.
	 * @return bool
	 */
	public function acl_permits( $str )
	{
		list( $category_code, $action_code ) = explode( '.', $str );

		// We must have a legit category and action to proceed
		if( strlen( $category_code ) < 1 OR strlen( $action_code ) < 1 )
			return FALSE;

		// Get ACL for this user if not already available
		if( is_null( $this->acl ) )
		{
			if( $this->acl = $this->acl_query( config_item('auth_user_id') ) )
			{
				$this->load->vars( ['acl' => $this->acl] );
				$this->config->set_item( 'acl', $this->acl );
			}
		}

		if( 
			// If ACL gives permission for entire category
			in_array( $category_code . '.*', $this->acl ) OR  
			in_array( $category_code . '.all', $this->acl ) OR 

			// If ACL gives permission for specific action
			in_array( $category_code . '.' . $action_code, $this->acl )
		)
		{
			return TRUE;
		}

		return FALSE;
	}
	
	// -----------------------------------------------------------------------

	/**
	 * Check if the logged in user is a certain role or 
	 * in a comma delimited string of roles.
	 *
	 * @param  string  the role to check, or a comma delimited
	 *                 string of roles to check.
	 * @return bool
	 */
	public function is_role( $role = '' )
	{
		$auth_role = config_item('auth_role');

		if( $role != '' && ! empty( $auth_role ) )
		{
			$role_array = explode( ',', $role );

			if( in_array( $auth_role, $role_array ) )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	// -----------------------------------------------------------------------

	/**
	 * Retrieve the true name of a database table.
	 *
	 * @param  string  the alias (common name) of the table
	 *
	 * @return  string  the true name (with CI prefix) of the table
	 */
	public function db_table( $name )
	{
		$name = config_item( $name );

		return $this->db->dbprefix( $name );
	}
	
	// -----------------------------------------------------------------------
        
    /*Model for Datatables*/
    function Datatables($dt)
    {
       // echo '<pre>';
        //print_r($dt);
       // echo '</pre>';
        $columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];
        //$join = $dt['join'];
        $sql  = "SELECT {$columns} FROM {$dt['table']} ";
        //echo $sql;
        $data = $this->db->query($sql);
        $rowCount = $data->num_rows();
        $data->free_result();
        // pengkondisian aksi seperti next, search dan limit
        $columnd = $dt['col-display'];
        $count_c = count($columnd);
        // search
        $search = $dt['search']['value'];
        /**
         * Search Global
         * pencarian global pada pojok kanan atas
         */
        $where = '';
        if ($search != '') {   
            for ($i=0; $i < $count_c ; $i++) {
                $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                
                if ($i < $count_c - 1) {
                    $where .= ' OR ';
                }
            }
        }
        
        /**
         * Search Individual Kolom
         * pencarian dibawah kolom
         */
        for ($i=0; $i < $count_c; $i++) { 
            $searchCol = $dt['columns'][$i]['search']['value'];
            if ($searchCol != '') {
                $where = $columnd[$i] . ' LIKE "%' . $searchCol . '%" ';
                break;
            }
        }
        /**
         * pengecekan Form pencarian
         * pencarian aktif jika ada karakter masuk pada kolom pencarian.
         */
        if ($where != '') {
            $sql .= " WHERE " . $where;
            
        }
        
        // sorting
        $sql .= " ORDER BY {$columnd[$dt['order'][0]['column']]} {$dt['order'][0]['dir']}";
        
        // limit
        $start  = $dt['start'];
        $length = $dt['length'];
        $sql .= " LIMIT {$start}, {$length}";
        
        $list = $this->db->query($sql);
        /**
         * convert to json
         */
        $option['draw']            = $dt['draw'];
        $option['recordsTotal']    = $rowCount;
        $option['recordsFiltered'] = $rowCount;
        $option['data']            = array();
        ///print_r($list->result_array());
        foreach ($list->result_array() as $row) {
           
           $rows = array();
           for ($i=0; $i < $count_c; $i++) { 
                $rows[] = $row[$columnd[$i]];
           }
            $option['data'][] = $rows;
        }
        // eksekusi json
        echo json_encode($option);
    }
}

/* End of file MY_Model.php */
/* Location: /community_auth/core/MY_Model.php */