<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permohonan_m
 *
 * @author Selamet Subu - Dell 5459
 */
class Permohonan_m extends My_model {

    //put your code here
    var $table = "permohonan";
    var $view = "permohonan_view";
    var $primary_key = "id_permohonan";

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
    
    public function insert_data($data = NULL, $dataf = null) {
        $this->db->trans_begin();
        
        //nota dinas
        if(!empty($dataf['nota_dinas_file'])){
            // insert 
            $this->db->insert('sys_attach', array('userinput' => $data['user_id']));
            $id_dok_notadinas = $this->db->insert_id();
            $data['id_dok_notadinas'] = $id_dok_notadinas;

            $dnd = array(
                'attachid' => $id_dok_notadinas,
                'title' => 'Nota Dinas',
                'filename' => $dataf['nota_dinas_file']
            );
            $this->db->insert('sys_attach_dtl', $dnd);
        }
        // position paper
        if(!empty($dataf['position_paper_file'])){
            // insert 
            $this->db->insert('sys_attach', array('userinput' => $data['user_id']));
            $id_dok_position_paper = $this->db->insert_id();
            $data['id_dok_position_paper'] = $id_dok_position_paper;

            $dpp = array(
                'attachid' => $id_dok_position_paper,
                'title' => 'Position Paper File',
                'filename' => $dataf['position_paper_file']
            );
            $this->db->insert('sys_attach_dtl', $dpp);
        }
        // draft rancangan
        if(!empty($dataf['draft_rancangan_file'])){
            // insert 
            $this->db->insert('sys_attach', array('userinput' => $data['user_id']));
            $id_dok_draft_rancangan = $this->db->insert_id();
            $data['id_dok_draft_rancangan'] = $id_dok_draft_rancangan;

            $dpp = array(
                'attachid' => $id_dok_draft_rancangan,
                'title' => 'Draft Rancangan File',
                'filename' => $dataf['draft_rancangan_file']
            );
            $this->db->insert('sys_attach_dtl', $dpp);
        }
        // tahap pembahasan
        if(!empty($dataf['tahapan_pembahasan_file'])){
            // insert 
            $this->db->insert('sys_attach', array('userinput' => $data['user_id']));
            $id_dok_tahap_pembahasan = $this->db->insert_id();
            $data['id_dok_tahap_pembahasan'] = $id_dok_tahap_pembahasan;

            $dpp = array(
                'attachid' => $id_dok_tahap_pembahasan,
                'title' => 'Draft Rancangan File',
                'filename' => $dataf['tahapan_pembahasan_file']
            );
            $this->db->insert('sys_attach_dtl', $dpp);
        }
        // inser permohonan
        $this->db->insert($this->table, $data);
        $id_permohonan = $this->db->insert_id();
        // insert histori
        $dh = array(
            'id_permohonan' => $id_permohonan,
            'id_permohonan_status' => $data['id_permohonan_status'],
            'notes' => $data['notes']
        );
        $this->db->insert('permohonan_status_h', $dh);
        
        if ($this->db->trans_status() === FALSE)
        {
            return $this->db->trans_rollback();
        }
        else
        {
            return $this->db->trans_commit();
        }
    }

    public function update_by_id($data = NULL, $id = NULL) {
        return $this->db->update($this->table, $data, array($this->primary_key => $id));
    }

    public function update_data_by_id($data = NULL, $id = NULL) {
        $this->db->trans_begin();
        
        $this->db->update($this->table, $data, array($this->primary_key => $id));
        
        // insert histori
        $dh = array(
            'id_permohonan' => $id,
            'id_permohonan_status' => $data['id_permohonan_status'],
            'notes' => $data['notes']
        );
        $this->db->insert('permohonan_status_h', $dh);
        
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

    public function count_all($where = null) {
        if (!empty($where))
            $this->db->where($where);
        $this->db->from($this->view);
        return $this->db->count_all_results();
    }

    // end fata tables
}
