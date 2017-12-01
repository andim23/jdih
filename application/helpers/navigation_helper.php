<?php
    function get_top_navigation($roleid){
        $ci=& get_instance();
        $ci->load->database(); 

        $sql =  "
				SELECT     y.* 
                FROM        sys_privilege x
                left join   sys_sitemap y on y.sitemapid = x.sitemapid
                where       y.sitemapid_parent = 0 and x.roleid = '" . $roleid . "'
                order by    sortno "
                ; 

        $query = $ci->db->query($sql);
        $result = $query->result();
	return $result;
   }
   
   function get_ftop_navigation($sitemapid_parent){
        $ci=& get_instance();
        $ci->load->database(); 

        $sql =  "
					SELECT     	y.* 
					FROM        sys_sitemap y
					where       y.sitemapid_parent = '".$sitemapid_parent."'
					order by    sortno
				"
                ; 

        $query = $ci->db->query($sql);
        $result = $query->result();
	return $result;
   }
   
   function get_frontend_nav(){
   		$data = get_ftop_navigation('100');
		foreach($data as $row){
			$sitemapid_parent = $row->sitemapid;
			$row->sub = get_ftop_navigation($sitemapid_parent);
		}

		return $data;
   }
   
   function get_left_navigation($sitemapid_parent=NULL, $roleid=NULL){
        $ci=& get_instance();
        $ci->load->model('Sys_privilege_m');
		$where = array('sitemapid_parent'=>$sitemapid_parent, 'roleid'=>$roleid);
        $order = 'sortno';
        $nav = $ci->Sys_privilege_m->get_data($where, $order);
        
        foreach ($nav as $row) {
            $sitemapid = $row->sitemapid;
            $row->sub = $ci->Sys_privilege_m->get_data(array('sitemapid_parent'=>$sitemapid, 'roleid'=>$roleid), 'sortno');
        }
        
        return $nav;
   }
   
   function get_globalvar_by_name($name=null, $field=null){
   		$ci =& get_instance();
		$ci->load->model('Sys_globalvar_m');
		$where = array('varname' => $name);
		$result = $ci->Sys_globalvar_m->get_data($where, null);
		$data = isset($result[0]->$field)?$result[0]->$field:"";
		return $data;
   }
?>