<?
	if(!function_exists('load_options')){

		function load_options($context, $language){
			$CI = &get_instance();
			$CI->load->model('options_model');
			
			return $CI->options_model->getOptions($context, $language);
		}
	}
	
	if(!function_exists('rsArrToOptArr')){
	
		function rsArrToOptArr($result){
			$r = $result;
			$opt = array();
			for ($i = 0; $i<sizeof($r); $i++){
				$opt[$r[$i]['VALUE']] = $r[$i]['TEXT'];
			}
			return $opt;
		}
	}
	
	if(!function_exists('years_options')){
		
		function years_options($low = null, $high = null){
			$def_low = 1900;
			$inc_high = 100;
			if ($high == null){
				$high	= date('Y') + $inc_high;				
			}
			else {
				$high = (int) $high;
			}
			
			if ($low == null){
				$low	= $def_low;
			}
			else if ($low == 'limited'){
				$low	= $def_low;
				$high	= date('Y'); //2015...				
			}
			else {
				$low = (int) $low;
			}
			
	//------final check-----------------------------
			if ($low >= $high){
				$low = $def_low;
				$high = date('Y') + $inc_high;
			}
			
			//populate
			$years = array();
			$x = 0;
			for($i = $low; $i <= $high; $i++){
				$years[$x] = array();
				$years[$x]['TEXT'] = $i;
				$years[$x]['VALUE'] = $i;
				$x++;
			}
			
			return $years;
		}
	}
	

?>