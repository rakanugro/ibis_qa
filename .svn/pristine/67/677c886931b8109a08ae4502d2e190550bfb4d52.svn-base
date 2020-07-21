<?

	if(!function_exists('parse_phone')){

		function parse_phone($phonestring, &$area_out, &$phone_out){
			if (strlen($phonestring) > 0 ){
				$p 			= explode('.', $phonestring);
				
				if (sizeof($p) > 1){
					$area_out 	= $p[0];
					$phone_out 	= $p[1];					
				}
				else{
					$phone_out = $phonestring;
				}
			}	
		}
	}

	if(!function_exists('parse_phone_ext')){

		function parse_phone_ext($phonestring, &$area_out, &$phone_out, &$extension_out){
			if (strlen($phonestring) > 0 ){
				$p 				= preg_split( "/(\.|-)/", $phonestring, 3, PREG_SPLIT_NO_EMPTY );								
				
				if (sizeof($p) > 1){
					$area_out 	= $p[0];
					$phone_out 	= $p[1];					
										
					if(sizeof($p) > 2){
						$extension_out 	= $p[2];
					}
				}
				else{
					$phone_out = $phonestring;
				}
			}	
		}
	}	
?>