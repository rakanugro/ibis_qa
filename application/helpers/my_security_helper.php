<?php 
function is_access($model, $no_request,$access)
{
	//access = C / R / U / D
	$ret['ret'] = true;
	$ret['message'] = "";
	if(substr($no_request, 0, 2)=='RE' || substr($no_request, 0, 1)=='S'){
		//request delivery
		$request_data=$model->get_request_delivery($no_request);
	} else if(substr($no_request, 0, 1)=='A'){
		//request receiving
		$request_data=$model->get_request_receiving($no_request);
	} else if(substr($no_request, 0, 2)=='RL'){
		// request alih kapal
		$request_data=$model->getHeaderDataAlihKapal($no_request);
	}
	
	if($request_data['STATUS']=="S" && ($access="C" || $access="U" || $access="D")){
		$ret['ret']=false;
		$ret['message']="Request Already Saved":
	}
	
	if($request_data['STATUS']=="P" && ($access="C" || $access="U" || $access="D")){
		$ret['ret']=false;
		$ret['message']="Request Already Paid":
	}
	
	if($request_data['STATUS']=="X" && ($access="C" || $access="U" || $access="D")){
		$ret['ret']=false;
		$ret['message']="Request Already Canceled":
	}
	
	if($request_data['CUSTOMER_ID']!=$this->session->userdata('customerid_phd') && 
		$this->session->userdata('group_phd') != '1'){
			//jika bukan milik dia dan bukan admin
			$ret['ret']=false;
			$ret['message']="Not Authorize":
	}
		
	return $ret;
}

?>