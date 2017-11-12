<?php
	
	function PotongKata($Kata, $Jml)
	{
		$data = "";		
		$Kata = strip_tags($Kata);
		$temp = explode(" ", $Kata);

		if(count($temp) < $Jml)
			$Jml = count($temp);
		else
			$Jml = $Jml;
		
		for($i=0; $i<$Jml; $i++)
		{
			$data .= " " . $temp[$i];
		}

		return $data;
	}
	
	function TglIndo($tgl)
	{
		$bulan		= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tgl_tmp 	= "";
		$tgl_tmp	= explode(" ", $tgl);
		$jam		= $tgl_tmp[1];
		$tgl		= explode("-", $tgl_tmp[0]);
		$b			= intval($tgl[1])-1>=0?intval($tgl[1])-1:0;
		$tgl		= $tgl[2] . " " . $bulan[$b] . " " . $tgl[0] . " " . $jam;

		return $tgl; 
	}
	
	function TglUK($tgl)
	{
		if( !empty($tgl) )
		{
			$tgl		= explode("-", $tgl);
			$tgl		= $tgl[2] . "/" . $tgl[1] . "/" . $tgl[0];
		}
		else
		{
			$tgl = "";
		}
		return $tgl; 
	}
	
	function TglOnlyIndo($tgl)
	{
		$bulan		= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tgl		= explode("-", $tgl);
		$b			= intval($tgl[1])-1>=0?intval($tgl[1])-1:0;
		$tgl		= $tgl[2] . " " . $bulan[$b] . " " . $tgl[0];

		return $tgl; 
	}
	
	function ddmmyyyy($tgl)
	{
		if( isset($tgl) and !empty($tgl) ):
			$tgl = explode("-", $tgl);
			return $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];
		endif;
	}
	
	function yyyymmdd($tgl)
	{
		if( isset($tgl) and !empty($tgl) ):
			$tgl = explode("-", $tgl);
			return $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];
		endif;
	}
	
	function TglIndoSaja($tgl)
	{
		$bulan		= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		$tgl_tmp 	= "";
		$tgl_tmp	= explode(" ", $tgl);
		$jam		= isset($tgl_tmp[1])?$tgl_tmp[1]:"";
		$tgl		= explode("-", $tgl_tmp[0]);
		$b			= intval($tgl[1])-1>=0?intval($tgl[1])-1:0;
		$tgl		= $tgl[2] . " " . $bulan[$b] . " " . $tgl[0] ;

		return $tgl; 
	}
	
	function BlnIndoSaja($tgl)
	{
		$bulan		= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		$tgl		= explode("-", $tgl);
		$b			= intval($tgl[0])-1>=0?intval($tgl[0])-1:0;
		$tgl 		=  isset($tgl[1])?$tgl[1]:"";
		return $bulan[$b] . " " . $tgl; 
	}
	
	function tglSql($tgl=NULL)
	{
		$arr_tgl = explode("/", $tgl);
		$tgl = isset($arr_tgl[0])?$arr_tgl[0]:"";
		$bln = isset($arr_tgl[1])?$arr_tgl[1]:"";
		$thn = isset($arr_tgl[2])?$arr_tgl[2]:"";
		
		return $thn . "-" . $bln . "-" . $tgl;
	}
	
	function date_sql($tgl=NULL)
	{
		if( !empty($tgl) )
		{
			$arr_tgl = explode("-", $tgl);
			$tgl = isset($arr_tgl[0])?$arr_tgl[0]:"";
			$bln = isset($arr_tgl[1])?$arr_tgl[1]:"";
			$thn = isset($arr_tgl[2])?$arr_tgl[2]:"";
			
			return $thn . "-" . $bln . "-" . $tgl;
		}else{
			return NULL;
		}
	}
	
	function date_time_sql($datetime=NULL)
	{
		if( !empty($datetime) ){
		$arr_datetime = explode(" ", $datetime);
		
		$arr_date = explode('-', $arr_datetime[0]);
		$time = $arr_datetime[1];
		$tgl = isset($arr_date[0])?$arr_date[0]:"";
		$bln = isset($arr_date[1])?$arr_date[1]:"";
		$thn = isset($arr_date[2])?$arr_date[2]:"";
		
		return $thn . '-' . $bln . '-' . $tgl . ' ' . $time;
		}else{
			return NULL;
		}
	}
	
	function SEO($input){ 
		//SEO - friendly URL String Converter    
		//ex) this is an example -> this-is-an-example
		
		$input = str_replace("&nbsp;", " ", $input);
		$input = str_replace(array("'", "-"), "", $input); //remove single quote and dash
		//echo $input;
		$input = strtolower($input); //convert to lowercase
		
		$input = preg_replace("#[^a-zA-Z]+#", "-", $input); //replace everything non an with dashes
		$input = preg_replace("#(-){2,}#", "$1", $input); //replace multiple dashes with one
		$input = trim($input, "-"); //trim dashes from beginning and end of string if any
		
		return $input; 
	}
	
	function SEO2($input){ 
		//SEO - friendly URL String Converter    
		//ex) this is an example -> this-is-an-example
		
		$input = str_replace("&nbsp;", " ", $input);
		$input = str_replace(array("'", "-"), "", $input); //remove single quote and dash
		//echo $input;
		$input = strtolower($input); //convert to lowercase
		
		$input = preg_replace("#[^a-zA-Z0-9]+#", "-", $input); //replace everything non an with dashes
		$input = preg_replace("#(-){2,}#", "$1", $input); //replace multiple dashes with one
		$input = trim($input, "-"); //trim dashes from beginning and end of string if any
		
		return $input; 
	}
	
	function SEO_Dec($input)
	{
		$input = str_replace("-", "&nbsp;", $input);
		return $input;
	}
	
	function FormatUang($uang)
	{
		setlocale(LC_MONETARY, 'it_IT');
		return money_format('%.2n', $number) . "\n";
	}
	
	function get_user_fullname_by_id($userid){
		$ci=& get_instance();
        $ci->load->database(); 

        $ci->db->where( array('userid'=>$userid) );
		$query = $ci->db->get('sys_user');
        $result = $query->result();
		$name = isset($result[0]->fullname)?$result[0]->fullname:"No Data";
		return $name;
	}
	
	function get_user_photo_by_id($userid){
		$ci=& get_instance();
        $ci->load->database(); 

        $ci->db->where( array('userid'=>$userid) );
		$query = $ci->db->get('sys_user');
        $result = $query->result();
		$name = isset($result[0]->userphoto)?$result[0]->userphoto:"";
		return $name;
	}
	
	function stripQuotes($text) {
		$unquoted = preg_replace('/^(\'(.*)\'|"(.*)")$/', '$2$3', $text);
		return $unquoted;
	} 
	
	function replace_multiple_word($word){
		$output = preg_replace('/'.$word.'+/', $word, $word);
		return $output;
	}
	
	function portlet_open($title){
		$port = '
			<!-- Begin: life time stats -->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        '.$title.'
                    </div>
                </div>
                <div class="portlet-body">
		';
		return $port;
	}
	
	function portlet_close(){
		$port = '
				</div>
           	</div>
		';
		return $port;
	}
        
	function empty_to_null($var){
		$result = trim($var)!=''?$var:NULL;
		return $result;
	}
	
	function unsset_to_empty($var){
		return isset($var)?$var:'';
	}
?>