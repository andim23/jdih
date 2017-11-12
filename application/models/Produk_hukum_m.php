<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produk_hukum_m
 *
 * @author Selamet Subu - Dell 5459
 */
class Produk_hukum_m extends My_model {

    //put your code here
    var $table = "produk_hukum";
    var $view = "produk_hukum_view";
    var $primary_key = "id_produk_hukum";

    function get_data($where = NULL, $order_by = NULL) {
        if (!empty($where))
            $this->db->where($where);
        if (!empty($order_by))
            $this->db->order_by($order_by);
        $query = $this->db->get($this->view);
        return $query->result();
    }
    
    function get_data_terbaru($where = NULL, $order_by = NULL) {
        $this->db->limit(10);
        
        if (!empty($where))
            $this->db->where($where);
        if (!empty($order_by))
            $this->db->order_by($order_by);
        $query = $this->db->get($this->view);
        return $query->result();
    }
    
    function get_data_per_page($where = NULL, $order_by = NULL, $limit = null, $start = null, $like = null) {
        $this->db->limit($limit, $start);
        
        if(!empty($like))
            $this->db->or_like($like);
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

    public function insert($data = NULL, $data_berkas = null) {
        $this->db->trans_begin();
        
        $file_name = $data_berkas['file_name'];
        $file_size = $data_berkas['file_size'];
        $file_type = $data_berkas['file_type'];
        
        if(!empty($file_name)){
            // insert foto sebelum
            $this->db->insert('sys_attach', array('userinput' => $data['userinput']));
            $id_dokumen = $this->db->insert_id();
            $data['id_dokumen'] = $id_dokumen;
            
            for($i=0; $i<count($file_name); $i++){

                $dfs = array(
                    'attachid' => $id_dokumen,
                    'title' => $file_name[$i],
                    'description' => 'Berkas Upload',
                    'filename' => $file_name[$i],
                    'filetype' => $file_type[$i],
                    'filesize' => $file_size[$i]
                );
                $this->db->insert('sys_attach_dtl', $dfs);
            }
        }
        
        $this->db->insert($this->table, $data);
        
        if ($this->db->trans_status() === FALSE)
        {
            return $this->db->trans_rollback();
        }
        else
        {
            return $this->db->trans_commit();
        }
    }

    public function update_by_id($data = NULL, $id = NULL, $data_berkas = null) {
        $this->db->trans_begin();
        
        $file_name = $data_berkas['file_name'];
        $file_size = $data_berkas['file_size'];
        $file_type = $data_berkas['file_type'];
        
        if(!empty($file_name)){         
            
            if(empty($data['id_dokumen'])){
                $this->db->insert('sys_attach', array('userinput' => $data['userupdate']));
                $id_dokumen = $this->db->insert_id();
                $data['id_dokumen'] = $id_dokumen;
            }
            
            for($i=0; $i<count($file_name); $i++){
                $dfs = array(
                    'attachid' => $data['id_dokumen'],
                    'title' => $file_name[$i],
                    'description' => 'Berkas Upload',
                    'filename' => $file_name[$i],
                    'filetype' => $file_type[$i],
                    'filesize' => $file_size[$i]
                );
                $this->db->insert('sys_attach_dtl', $dfs);
            }
        }
        
        $this->db->update($this->table, $data, array($this->primary_key => $id));
        
        if ($this->db->trans_status() === FALSE)
        {
            return $this->db->trans_rollback();
        }
        else
        {
            return $this->db->trans_commit();
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

    function get_datatables($column_order, $order, $column_search, $where = null) {
        $this->_get_datatables_query($column_order, $order, $column_search);
        if ($_POST['length'] != -1)
            if (!empty($where))
                $this->db->where($where);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function count_filtered($column_order, $order, $column_search, $where = null) {
        if (!empty($where))
            $this->db->where($where);
        $this->_get_datatables_query($column_order, $order, $column_search);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($where = null, $like = null) {
        if( !empty($like) )
            $this->db->or_like($like);
        if (!empty($where))
            $this->db->where($where);
        $this->db->from($this->view);
        return $this->db->count_all_results();
    }
    
    public function get_tahun(){
        $sql = 'select DISTINCT tahun from produk_hukum_view order by tahun desc';
        $query = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
    // end fata tables
}
