<?php 

	if(!function_exists('notify')){
		
		function notify($message, $config=array()){
			// type : 'succes' 'info' 'warning' 'danger'
			// title : 'your title'
			// url : 'www.google.com'
			// target : '_blank'
			
			if($message == '' || $message == null ){
				return;
			}
			
			$CI = &get_instance();
			if(!$notify = $CI->session->userdata('notify')){
				$notify = array();
			}
				
			
			$note = array();
			$note['message'] 	= $message;										
			
			foreach ($config as $k => $cf){
				$note[strtolower($k)] = $cf;
			}
			
			//var_dump ($note); die;
			
			$notify[] = $note;
			$CI->session->set_userdata('notify', $notify);
		}
	}
	
	if(!function_exists('js_notify_show')){
		
		function js_notify_show(){
			
		}
		
	}

?>