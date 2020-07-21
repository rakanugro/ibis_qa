<?
	
	if(!function_exists('rsArrToJSON')){
	
		// convert db result to 1 dimensional unassociative array (values only, key omitted)
		function rsArrToJSON($result){
			$r = array();
			foreach ($result as $o){
				$o = array_change_key_case($o,CASE_LOWER);
				$r[] = $o;
			}
			return json_encode($r) ; 
		}
	}
	

?>