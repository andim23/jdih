<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sys_user_m
 *
 * @author Selamet Subu - Dell 5459
 */
class Sys_user_m extends My_model {

    //put your code here
    var $table = "auth_users";
    var $view = "auth_users";
    var $primary_key = "user_id";

    function get_data($where = NULL, $order_by = NULL) {
        if (!empty($where))
            $this->db->where($where);
        if (!empty($order_by))
            $this->db->order_by($order_by);
        $query = $this->db->get($this->view);
        return $query->result();
    }

    function get_data_count() {
        if (!empty($where))
            $this->db->where(array($this->primary_key => $id));
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    function get_data_by_id($id = NULL) {
        $this->db->where(array($this->primary_key => $id));
        $query = $this->db->get($this->view);
        return $query->result();
    }

    public function insert($data = NULL) {
        return $this->db->insert($this->table, $data);
    }
    
    public function insert_user_auth($data = NULL) {
        $this->db->trans_start();
        // insert into sus_user
        $this->db->insert($this->table, $data);
        
        // insert into auth_users
        $d['user_id'] = $this->db->insert_id();
        $d['username'] = $data['username'];
        $d['email'] = $data['useremail'];
        $d['passwd'] = $data['userpass'];
        $d['auth_level'] = $data['roleid'];
        $d['created_at'] = date('Y-m-d H:i:s');
        
        $this->db->insert('auth_users', $d);
        
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_by_id($data = NULL, $id = NULL) {
        return $this->db->update($this->table, $data, array($this->primary_key => $id));
    }
    
    public function update_user_auth_by_id($data = NULL, $id = NULL) {
        $this->db->trans_start();
        
        $this->db->update($this->table, $data, array($this->primary_key => $id));
        
        $d['username'] = $data['username'];
        $d['email'] = $data['useremail'];
        $d['auth_level'] = $data['roleid'];
        $d['modified_at'] = date('Y-m-d H:i:s');
        if( !empty($data['userpass']) )
            $d['passwd'] = $data['userpass'];
        
        $this->db->update('auth_users', $d, array('user_id' => $id));
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }else{
            return true;
        }
    }

    public function delete_user_auth_by_id($id) {
        $this->db->trans_start();
        $this->db->delete($this->table, array($this->primary_key => $id));
        $this->db->delete('auth_users', array('user_id' => $id));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }else{
            return true;
        }
    }
    
    public function delete_by_id($id) {
        return $this->db->delete($this->table, array($this->primary_key => $id));
    }

    // For Data Tables
    private function _get_datatables_query($column_order, $order, $column_search) {
        // you can use table or view
        $this->db->from($this->view);

        $i = 0;

        foreach ($column_search as $item) { // loop column 
            if (isset($_POST[$item]) && !empty($_POST[$item])) { // if datatable send GET for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST[$item]);
                } else {
                    $this->db->like($item, $_POST[$item]);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($column_order, $order, $column_search) {
        $this->_get_datatables_query($column_order, $order, $column_search);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function count_filtered($column_order, $order, $column_search) {
        $this->_get_datatables_query($column_order, $order, $column_search);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // end fata tables
    
    public function update_user_auth_password_by_id($data = NULL, $id = NULL) {
        $this->db->trans_start();

        $this->db->update('auth_users', $data, array('user_id' => $id));
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }else{
            return true;
        }
    }
}
