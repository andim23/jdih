<?php

class MY_Form_validation extends CI_Form_validation
{
    function edit_unique($value, $params)
    {
        $this->set_message('edit_unique', "This %s is already in use!");
        list($table, $field, $field_id, $current_id) = explode(".", $params);
		
		$sql = 'select ' . $field . ' from ' . $table . ' where ' . $field_id . ' != "' . $current_id . '" and ' . $field . ' = "' . $value . '"';
        $query = $this->CI->db->query($sql);
		$result = $query->result();
		return ($result) ? FALSE : TRUE;
    }
}

?>