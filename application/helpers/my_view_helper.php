<?

	if(!function_exists('view_loader')){

		function view_loader($view, $vars=array(), $output = false){
			$CI = &get_instance();
			return $CI->load->view($view, $vars, $output);
		}
	}
	
	if(!function_exists('modal_loader')){

		function modal_loader($modal, $vars=array(), $output = false){
			$CI = &get_instance();
			return $CI->load->view('modals/'.$modal, $vars, $output);
		}
	}
	
	if(!function_exists('options_group_loader')){
		
		function options_group_loader($type, $vars=array(), $output = false){
			$CI = &get_instance();
			return $CI->load->view('options/'.$type, $vars, $output);
		}
	}
	
	if(!function_exists('options_params')){
		
		function options_params($resultset, $name, $class, $selected, $disabled,$custom=""){
			
			return array(
						'results' 		=> $resultset,
						'name_assigned' => $name,
						'class_assigned'=> $class,
						'selected'		=> $selected,
						'disabled'      => $disabled,
						'custom'		=> $custom
					);
		}
	}

?>