<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<script src="<?=JSQ?>jquery-ui.min.js"></script>

<?php 
	//changelog :
	/*
		23-APRIL-2015	ibnu		PMO suggests that bank account and account manager buttons are to be hidden
									because they are not in the top level flow of form entry steps
	*/		
	

	if(!isset($reg_progress)){
		
		$reg_progress = array(
								'GI'	=> 0,
								'BILL'	=> 0, 
								'BANK'	=> 0,
								'AM'	=> 0,
								'CEO'	=> 0,
								'BOD'	=> 0,
								'PBM'	=> 0,
								'NON_PBM'	=> 0,
								'SA'	=> 0,
								'SAPIC'	=> 0
							);
	}
	
	if(isset($last_sync_status))
	{
		if(count($last_sync_status)<1)
		{
			$last_sync_status = array(
									'STATUS_IU'	=> '',
									'STATUS_SIMKAPAL'	=> '', 
									'STATUS_SIMKEU'	=> '',
									'DATE_STAGING_INSERTED'	=> ''
								);		
		}
	}
	else
	{
		$last_sync_status = array(
								'STATUS_IU'	=> '',
								'STATUS_SIMKAPAL'	=> '', 
								'STATUS_SIMKEU'	=> '',
								'DATE_STAGING_INSERTED'	=> ''
							);
	}
	
	if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="8" or $this->session->userdata('group_phd')=="p")
	{
		$is_submit = true;
	}
	else
		$is_submit = false;

	if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="a")
	{
		$is_sync = true;
	}
	else
		$is_sync = false;
	
//	var_dump($billing_ids);die;
//	var_dump($reg_progress);die;

	if(!isset($billing_ids)||sizeof($billing_ids)==0){
		$billing_ids = array( array(	'BILLING_ID'	=>	0) );
	}
	$billing_id = $billing_ids[0]['BILLING_ID'];
	
	if(!isset($ceo_id)||sizeof($ceo_id)==0){
		$ceo_id = '';
	}
		
	if(!isset($shipping_agent_id)||sizeof($shipping_agent_id)==0){
		$shipping_agent_id = '';
	}
	if(!isset($pbm_id)||sizeof($pbm_id)==0){
		$pbm_id = '';
	}	
	if(!isset($non_pbm_id)||sizeof($non_pbm_id)==0){
		$non_pbm_id = '';
	}

	//print_r($cust_types['COMPANY_TYPE']); die();
	$cekRM = 'N';

	if(!isset($cust_types)||sizeof($cust_types)==0){
		$cust_types = array(	'IS_SHIPPING_AGENT'	=> 'N',
								'IS_SHIPPING_LINE'	=> 'N',
								'IS_PBM'	=> 'N',
								'IS_FF'	=> 'N',
								'IS_EMKL'	=> 'N',
								'IS_PPJK'	=> 'N',
								'IS_MITRA'	=> 'N',
								'IS_CUSTOMER'	=> 'N',
								'IS_RUPA'	=> 'N',
							);
	}else if($cust_types['IS_CUSTOMER'] == 'Y' && $cust_types['IS_MITRA'] == 'Y' && $cust_types['IS_RUPA'] == 'Y'){
		$mitra_pic = 'Y';
		$cekRM = 'Y';
	}else if($cust_types['IS_MITRA'] == 'Y' && $cust_types['IS_RUPA'] == 'Y'){
		$mitra_pic = 'Y';
		$cekRM = 'Y';
	}else if($cust_types['IS_CUSTOMER'] == 'Y' && $cust_types['IS_RUPA'] == 'Y'){
		$rupa = 'Y';
		$cekRM = 'Y';
	}
	
	if(!isset($customer_id)){$customer_id = '';}
	
	$is_shipping_agent = $cust_types['IS_SHIPPING_AGENT'];
	$is_shipping_line = $cust_types['IS_SHIPPING_LINE'];
	$is_pbm = $cust_types['IS_PBM'];
	$is_ff = $cust_types['IS_FF'];
	$is_emkl = $cust_types['IS_EMKL'];
	$is_ppjk = $cust_types['IS_PPJK'];
	$is_consignee = $cust_types['IS_CONSIGNEE'];
	
		
	//set labels
	if($cust_types['COMPANY_TYPE'] == 'SEMPL' || $cust_types['COMPANY_TYPE'] == 'KPRSI'){
		if($cust_types['COMPANY_TYPE'] == 'SEMPL'){
			if($is_consignee == 'Y')
			{	
				$forms 	= array(	"General Information",
									"Billing Accounts"
								);
			}
			else if($mitra_pic == 'Y'){
				$forms 	= array(	"General Information",
									"Billing Accounts",
									//"Bank Accounts",
									//"Account Managers",
									//"CEO Information",
									//"BOD Information",
									"Mitra PIC"
								);	
			}
			else if($rupa == 'Y'){
				$forms 	= array(	"General Information",
									"Billing Accounts"
								);
			}else
			{
				$forms 	= array(	"General Information",
									"Billing Accounts",
									//"Bank Accounts",
									//"Account Managers",
									"CEO Information",
									"BOD Information"						
								);	
			}
		
			//set links				
			$urls = array();
			if($mitra_pic == 'Y'){
				$urls['INCOMPLETE']	= array(	
								ROOT."register/general_information/".$customer_id,
								ROOT."register/billing_list/".$customer_id,
								//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
								//ROOT."register/am_list/".$billing_id,
								//ROOT."register/ceo/".$customer_id,
								//ROOT."register/bod_list/".$customer_id,
								ROOT."register/sa_pic_list/".$customer_id
							);
				$urls['COMPLETE']	= array(	
								ROOT."register/edit/".$customer_id,
								ROOT."register/billing_list/".$customer_id,
								//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
								//ROOT."register/am_list/".$billing_id,
								//ROOT."register/ceo_edit/".$ceo_id,
								//ROOT."register/bod_list/".$customer_id,
								ROOT."register/sa_pic_list/".$customer_id
							);
				$urls['DISABLED']	= array(
								'',
								'',
								//'',
								//'',
								//'',
								''
							);

				unset($reg_progress['AM']);
				unset($reg_progress['SA']);
				unset($reg_progress['PPJK']);
				unset($reg_progress['PBM']);
				unset($reg_progress['PBM']);
				unset($reg_progress['NON_PBM']);
				unset($reg_progress['BANK']);
				unset($reg_progress['CEO']);
				unset($reg_progress['BOD']);
				//unset($reg_progress['BILL']);
				//print_r($reg_progress); die();
			}
			else if($rupa == 'Y'){
				$urls['INCOMPLETE']	= array(	
								ROOT."register/general_information/".$customer_id,
								ROOT."register/billing_list/".$customer_id
							);
				$urls['COMPLETE']	= array(	
								ROOT."register/edit/".$customer_id,
								ROOT."register/billing_list/".$customer_id
							);
				$urls['DISABLED']	= array(
								'',
								''
							);
				unset($reg_progress['PBM']);
				unset($reg_progress['NON_PBM']);
				//unset($reg_progress['BILL']);
				unset($reg_progress['BANK']);
				unset($reg_progress['AM']);
				unset($reg_progress['CEO']);
				unset($reg_progress['BOD']);
				unset($reg_progress['SA']);
				unset($reg_progress['SAPIC']);
				unset($reg_progress['PPJK']);
							//print_r($reg_progress); die();
			}
			else{
				$urls['INCOMPLETE']	= array(	
						ROOT."register/general_information/".$customer_id,
						ROOT."register/billing_list/".$customer_id,
						//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
						//ROOT."register/am_list/".$billing_id,
						ROOT."register/ceo/".$customer_id,
						ROOT."register/bod_list/".$customer_id
					);
				$urls['COMPLETE']	= array(	
						ROOT."register/edit/".$customer_id,
						ROOT."register/billing_list/".$customer_id,
						//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
						//ROOT."register/am_list/".$billing_id,
						ROOT."register/ceo_edit/".$ceo_id,
						ROOT."register/bod_list/".$customer_id
							);
				$urls['DISABLED']	= array(
						'',
						'',
						//'',
						//'',
						'',
						''
							);
			}

		}else{
			//strt
			if($is_consignee == 'Y')
			{	
				$forms 	= array(	"General Information",
									"Billing Accounts"
								);
			}
			else if($mitra_pic == 'Y'){
				$forms 	= array(	"General Information",
									"Billing Accounts"
									//"Bank Accounts",
									//"Account Managers",
									//"CEO Information",
									//"BOD Information",
									//"Mitra PIC"
								);	
			}
			else if($rupa == 'Y'){
				$forms 	= array(	"General Information",
									"Billing Accounts"
								);
			}else
			{
				$forms 	= array(	"General Information",
									"Billing Accounts",
									//"Bank Accounts",
									//"Account Managers",
									"CEO Information",
									"BOD Information"						
								);	
			}
	
			//set links				
			$urls = array();
			if($mitra_pic == 'Y'){
				$urls['INCOMPLETE']	= array(	
								ROOT."register/general_information/".$customer_id,
								ROOT."register/billing_list/".$customer_id
								//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
								//ROOT."register/am_list/".$billing_id,
								//ROOT."register/ceo/".$customer_id,
								//ROOT."register/bod_list/".$customer_id,
								//ROOT."register/sa_pic_list/".$customer_id
							);
				$urls['COMPLETE']	= array(	
								ROOT."register/edit/".$customer_id,
								ROOT."register/billing_list/".$customer_id
								//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
								//ROOT."register/am_list/".$billing_id,
								//ROOT."register/ceo_edit/".$ceo_id,
								//ROOT."register/bod_list/".$customer_id,
								//ROOT."register/sa_pic_list/".$customer_id
							);
				$urls['DISABLED']	= array(
								'',
								//'',
								//'',
								//'',
								//'',
								''
							);

				unset($reg_progress['AM']);
				unset($reg_progress['SA']);
				unset($reg_progress['PPJK']);
				unset($reg_progress['PBM']);
				unset($reg_progress['PBM']);
				unset($reg_progress['NON_PBM']);
				unset($reg_progress['BANK']);
				unset($reg_progress['CEO']);
				unset($reg_progress['BOD']);
				unset($reg_progress['SAPIC']);
				//unset($reg_progress['BILL']);
				//print_r($reg_progress); die();
			}
			else if($rupa == 'Y'){
				$urls['INCOMPLETE']	= array(	
								ROOT."register/general_information/".$customer_id,
								ROOT."register/billing_list/".$customer_id
							);
				$urls['COMPLETE']	= array(	
								ROOT."register/edit/".$customer_id,
								ROOT."register/billing_list/".$customer_id
							);
				$urls['DISABLED']	= array(
								'',
								''
							);
				unset($reg_progress['PBM']);
				unset($reg_progress['NON_PBM']);
				//unset($reg_progress['BILL']);
				unset($reg_progress['BANK']);
				unset($reg_progress['AM']);
				unset($reg_progress['CEO']);
				unset($reg_progress['BOD']);
				unset($reg_progress['SA']);
				unset($reg_progress['SAPIC']);
				unset($reg_progress['PPJK']);
							//print_r($reg_progress); die();
			}
			else{
				$urls['INCOMPLETE']	= array(	
								ROOT."register/general_information/".$customer_id,
								ROOT."register/billing_list/".$customer_id,
								//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
								//ROOT."register/am_list/".$billing_id,
								ROOT."register/ceo/".$customer_id,
								ROOT."register/bod_list/".$customer_id
							);
				$urls['COMPLETE']	= array(	
								ROOT."register/edit/".$customer_id,
								ROOT."register/billing_list/".$customer_id,
								//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
								//ROOT."register/am_list/".$billing_id,
								ROOT."register/ceo_edit/".$ceo_id,
								ROOT."register/bod_list/".$customer_id
							);
				$urls['DISABLED']	= array(
								'',
								'',
								//'',
								//'',
								'',
								''
							);
				}
		}
		//end
	}else{
		if($is_consignee == 'Y')
		{	
			$forms 	= array(	"General Information",
								"Billing Accounts"
							);
		}
		else if($mitra_pic == 'Y'){
			$forms 	= array(	"General Information",
								"Billing Accounts",
								//"Bank Accounts",
								//"Account Managers",
								"CEO Information",
								"BOD Information",
								"Mitra PIC"
							);	
		}
		else if($rupa == 'Y'){
			$forms 	= array(	"General Information",
								"Billing Accounts"
							);
		}else
		{
			$forms 	= array(	"General Information",
								"Billing Accounts",
								//"Bank Accounts",
								//"Account Managers",
								"CEO Information",
								"BOD Information"						
							);	
		}
		
		//set links				
		$urls = array();
		if($mitra_pic == 'Y'){
			$urls['INCOMPLETE']	= array(	
							ROOT."register/general_information/".$customer_id,
							ROOT."register/billing_list/".$customer_id,
							//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
							//ROOT."register/am_list/".$billing_id,
							ROOT."register/ceo/".$customer_id,
							ROOT."register/bod_list/".$customer_id,
							ROOT."register/sa_pic_list/".$customer_id
						);
			$urls['COMPLETE']	= array(	
							ROOT."register/edit/".$customer_id,
							ROOT."register/billing_list/".$customer_id,
							//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
							//ROOT."register/am_list/".$billing_id,
							ROOT."register/ceo_edit/".$ceo_id,
							ROOT."register/bod_list/".$customer_id,
							ROOT."register/sa_pic_list/".$customer_id
						);
			$urls['DISABLED']	= array(
							'',
							'',
							'',
							//'',
							'',
							''
						);

			unset($reg_progress['AM']);
			unset($reg_progress['SA']);
			unset($reg_progress['PPJK']);
			unset($reg_progress['PBM']);
			unset($reg_progress['PBM']);
			unset($reg_progress['NON_PBM']);
			unset($reg_progress['BANK']);
			//unset($reg_progress['BILL']);
			//print_r($reg_progress); die();
		}
		else if($rupa == 'Y'){
			$urls['INCOMPLETE']	= array(	
							ROOT."register/general_information/".$customer_id,
							ROOT."register/billing_list/".$customer_id
						);
			$urls['COMPLETE']	= array(	
							ROOT."register/edit/".$customer_id,
							ROOT."register/billing_list/".$customer_id
						);
			$urls['DISABLED']	= array(
							'',
							''
						);
			unset($reg_progress['PBM']);
			unset($reg_progress['NON_PBM']);
			//unset($reg_progress['BILL']);
			unset($reg_progress['BANK']);
			unset($reg_progress['AM']);
			unset($reg_progress['CEO']);
			unset($reg_progress['BOD']);
			unset($reg_progress['SA']);
			unset($reg_progress['SAPIC']);
			unset($reg_progress['PPJK']);
						//print_r($reg_progress); die();
		}
		else{
			$urls['INCOMPLETE']	= array(	
							ROOT."register/general_information/".$customer_id,
							ROOT."register/billing_list/".$customer_id,
							//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
							//ROOT."register/am_list/".$billing_id,
							ROOT."register/ceo/".$customer_id,
							ROOT."register/bod_list/".$customer_id
						);
			$urls['COMPLETE']	= array(	
							ROOT."register/edit/".$customer_id,
							ROOT."register/billing_list/".$customer_id,
							//ROOT."register/billing_edit/".$billing_id."#bank_placeholder",
							//ROOT."register/am_list/".$billing_id,
							ROOT."register/ceo_edit/".$ceo_id,
							ROOT."register/bod_list/".$customer_id
						);
			$urls['DISABLED']	= array(
							'',
							'',
							//'',
							//'',
							'',
							''
						);
		}
	}

	//additional forms according to each customer's business type
	if ($is_shipping_agent == 'Y' || $is_shipping_line == 'Y'){
		$forms[] 	= "Shipping Agent";
		$forms[] 	= "Shipping Agent PIC";
		
		$urls['INCOMPLETE'][]	= ROOT."register/shipping_agent_list/".$customer_id;
		$urls['INCOMPLETE'][]	= ROOT."register/sa_pic_list/".$customer_id;
		// $urls['COMPLETE'][]		= ROOT."register/shipping_agent_edit/".$shipping_agent_id;
		$urls['COMPLETE'][]		= ROOT."register/shipping_agent_list/".$customer_id;
		
		$urls['COMPLETE'][]		= ROOT."register/sa_pic_list/".$customer_id;
		$urls['DISABLED'][]		= '';
		$urls['DISABLED'][]		= '';
		
		unset($reg_progress['PBM']);
		unset($reg_progress['NON_PBM']);
		
	}
	
	if($is_pbm == 'Y')
	{
		$forms[] 	= "PBM";
		$forms[] 	= "PBM PIC";
		
		$urls['INCOMPLETE'][]	= ROOT."register/pbm_list/".$customer_id;
		$urls['INCOMPLETE'][]	= ROOT."register/sa_pic_list/".$customer_id;
		$urls['COMPLETE'][]		= ROOT."register/pbm_list/".$customer_id;
		$urls['COMPLETE'][]		= ROOT."register/sa_pic_list/".$customer_id;
		$urls['DISABLED'][]		= '';
		$urls['DISABLED'][]		= '';
		
		unset($reg_progress['SA']);
		unset($reg_progress['NON_PBM']);
	}
	
	if($is_ff == 'Y'||$is_emkl == 'Y'||$is_ppjk == 'Y')
	{
		if($is_ff=="Y")
		{
			$forms[] 	= "FREIGHT FORWARDER";
			$forms[] 	= "FREIGHT FORWARDER PIC";
		}
		else if($is_emkl=="Y")
		{
			$forms[] 	= "EMKL";
			$forms[] 	= "EMKL PIC";
			$forms[] 	= "EMKL CONSIGNEE";
		}
		else if($is_ppjk=="Y")
		{
			$forms[] 	= "PPJK";
			$forms[] 	= "PPJK PIC";
			
		}
		
		$urls['INCOMPLETE'][]	= ROOT."register/non_pbm/".$customer_id;
		$urls['INCOMPLETE'][]	= ROOT."register/sa_pic_list/".$customer_id;
		$urls['INCOMPLETE'][]	= ROOT."register/ppjk_consg_list/".$customer_id;
		$urls['COMPLETE'][]		= ROOT."register/non_pbm_edit/".$non_pbm_id;
		$urls['COMPLETE'][]		= ROOT."register/sa_pic_list/".$customer_id;
		$urls['COMPLETE'][]		= ROOT."register/ppjk_consg_list/".$customer_id;;
		$urls['DISABLED'][]		= '';
		$urls['DISABLED'][]		= '';
		$urls['DISABLED'][]		= '';
		
		unset($reg_progress['SA']);
		unset($reg_progress['PBM']);
	}
	
	if($is_consignee == 'Y')
	{
		unset($reg_progress['CEO']);
		unset($reg_progress['BOD']);
		unset($reg_progress['SA']);
		unset($reg_progress['SAPIC']);
		unset($reg_progress['PBM']);		
		unset($reg_progress['NON_PBM']);
	}
	
	if ($is_shipping_line == 'Y'){
		//TODO : TBD
	}
	
	// assign status of each form completion
	$status = array ();
	//print_r($reg_progress); die();
	
	$cnt_prog = 0;
	foreach($reg_progress as $k => $r){
		if ($r > 0){
			$status[$k] = 'COMPLETE'; 
		}
		else{
			$status[$k] = 'INCOMPLETE'; 
		}
		$cnt_prog++;
	}

	if($cnt_prog == 0){
		$status['GI'] = 'INCOMPLETE';
	}
	
	//prerequisite logic
	// 1. if general info is incomplete, all other forms are disabled
	if( $status['GI'] == 'INCOMPLETE'){
		foreach ($status as $k => &$s){
			if ($k != 'GI'){
				$s = 'DISABLED';
			}
		}
	}
	// 2. if customer haven't filled any billing account, banks and account managers are disabled
	/*
	else if( $status['BILL'] == 'INCOMPLETE'){
		$status['BANK'] = 'DISABLED';
		$status['AM'] = 'DISABLED';
	}
	*/
	
	// 2.v2 if customer haven't filled the account managers and bank accounts, 
	// the billing account is set to incomplete
	else if ($status['BANK'] != 'COMPLETE' && $status['AM'] != 'COMPLETE'){
		//var_dump($status);
		//echo 'status...'; die;
		if($is_emkl!='Y' && $is_consignee!='Y' && $cekRM !='Y')
		{
			$status['BILL'] = 'INCOMPLETE';
		}
	}
	//remove bank and account managers from array...
	unset($status['BANK']);
	unset($status['AM']);
	
	//setup visuals
	$styles = array(	"COMPLETE" 		=> 'class="main-box infographic-box colored emerald-bg"',
						"INCOMPLETE"	=> 'class="main-box infographic-box colored yellow-bg"',
						"DISABLED"		=> 'class="main-box infographic-box colored gray-bg" style="cursor:not-allowed"'
				);
	
	$icons = array(		"COMPLETE" 		=> 'class="fa fa-check"',
						"INCOMPLETE"	=> 'class="fa fa-unlock"',
						"DISABLED"		=> 'class="fa fa-lock"'
				);
	//print_r($status); die();
	//calculate percent progress
	$percent 	= 100;
	$count 		= 0;
	$divisor	= 0;

	foreach ($status as $k => $s){
		if ($s == "COMPLETE"){
			$count++;
		}else{
			//khusus emkl ceo information & bod information boleh diisi
			if($is_emkl=="Y" && ($k == 'CEO'|| $k == 'BOD'))
			{
				$count++;
			}	
			
			//PPJK boleh tidak diisi
			if($k == 'PPJK') 
				$count++;
		}
		$divisor++;
	}
	
	if ($divisor > 0){
		$percent = $percent * ($count / $divisor);
	}
	else{
		$percent = 0;
	}
	//echo " count : $count, divisor : $divisor ";
	
	//reindex to non associative array
	$s_tmp = array();
	foreach($status as $s){
		$s_tmp[] = $s;
	}
	$status = $s_tmp;	
	//print_r($urls['COMPLETE']); die();
?>
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Progress <span id="progress_info" class="label"></span></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="progress progress-striped progress-4x">
												<div id="progress_bar" class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent;?>%">
													<span class="sr-only">80% Complete (danger)</span>
												</div> 
											</div>
											
											<div class="row">
										<?php
											$idx = 0;
											foreach ($forms as $f){
										?>
												<a href="<?php echo $urls[$status[$idx]][$idx];?>">
													<div class="col-lg-3">
														<div <?php echo $styles[$status[$idx]];?> >
															<i <?php echo $icons[$status[$idx]];?>></i>
															<span class="headline"><?php echo $f;?></span>
															<span class="value">&nbsp;</span>
														</div>
													</div>
												</a>
										<?php
												$idx++;
												
												if (($idx % 4) == 0){
											?>
												<div class="clearfix"></div>
											<?php
												}
											}
										?>		
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						if ($percent == 100){
					?>
							<?php
							if($is_submit)
							{
							?>
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Submit Customer Data</h2>
										</header>
										<div class="main-box-body clearfix">
											<div class="form-group col-md-12">
												<label>Submit Customer Data to Headquarter</label>
												<?php
												if($status_approval=="N")
												{
													 $status_approval = "DRAFT";
													 $badge_approval = "badge-info";
												}
												else if($status_approval=="W")
												{
													 $status_approval = "WAITING APPROVE";
													 $badge_approval = "badge-warning";
												}
												else if($status_approval=="P")
												{
													 $status_approval = "APPROVE / SYN IN PROGRESS";
													 $badge_approval = "badge-warning";
													 $button_submit = "disabled";
												}												
												else if($status_approval=="A")
												{
													 $status_approval = "APPROVE";
													 $badge_approval = "badge-success";
												}
												else if($status_approval=="R")
												{
													 $status_approval = "REJECT ".$reject_notes;
													 $badge_approval = "badge-danger";
												}
												else if($status_approval=="FP")
												{
													 $status_approval = "Failed Sync";
													 $badge_approval = "badge-danger";
													 $button_submit = "disabled";
												}
												else
												{
													 $status_approval = "UNDEFINED";
													 $badge_approval = "badge-warning";													
												}
												
												?>
												<?php
												if($button_submit!="disabled")
												{
												?>
												<button type="button" class="btn btn-success pull-right" id="submit"><i class="glyphicon glyphicon-transfer"></i> &nbsp; Submit</button>
												<?php
												}?>
											</div>
											<div class="form-group col-md-12">
												<label>Status Customer</label>
												<span class="badge <?=$badge_approval?>" id="status_approval"><?php echo $status_approval?></span>
											</div>
										</div>
									</div>	
								</div>	
							</div>
							<?php 
							}
							?>
							<?php
							if($is_sync)
							{
							?>
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Sign Customer</h2>
										</header>
										<div class="main-box-body clearfix">
											<div class="form-group col-md-12">
												<label>Sign Customer to Other Branch</label>
												<br>
												<?php 
													$x = options_params($box_branch, 'branch[]', '', $sel_branch);
													echo options_group_loader('checkbox', $x);
												?>
												<button type="button" class="btn btn-success pull-right" id="sign"><i class="glyphicon glyphicon-transfer"></i> &nbsp; Sign</button>
											</div>
											<div class="form-group col-md-12">
												<label>
													<span>Status Sinkronisasi</span>
												</label>						
												<ul class="list-group" id="status_all" style="display:none;">
													<li class="list-group-item">
														<span class="badge" id="status_simop">STATUS</span>
														SIMOP
													</li>
													<li class="list-group-item">
														<span class="badge" id="status_simkeu">STATUS</span>
														SIMKEU
													</li>
													<li class="list-group-item" id="status_error" style="display:none">
														<!-- error log -->
													</li>
													<li class="list-group-item" id="status_success" style="display:none">
														<!-- success log -->
													</li>
												</ul>
												<br>
												<?php
													$badge_simop = "";
													$status_simop = "";
													$badge_simkeu = "";
													$status_simkeu = "";													
												?>
												<div id="status_all2">
													<label id="label_status_all2">
														<span>Last Sync ~ <?php echo $last_sync_status["DATE_STAGING_INSERTED"]?></span>
													</label>
												
														<?php
														switch($last_sync_status["STATUS_SIMKAPAL"])
														{
															case "S" : 
																$badge_simop = "badge-success";
																$status_simop = "S";
															break;
															case "P" : 
																$badge_simop = "badge-warning";
																$status_simop = "IN PROGRESS";
															break;
															default:
																if($last_sync_status["STATUS_IU"]!="")
																{
																	$badge_simop = "badge-danger";
																	$status_simop = "FAILED";
																}
															break;															
														}
														switch($last_sync_status["STATUS_SIMKEU"])
														{
															case "S" : 
																$badge_simkeu = "badge-success";
																$status_simkeu = "S";
															break;
															case "F" : 
																$badge_simkeu = "badge-danger";
																$status_simkeu = "FAILED";
															break;
															default:
																if($last_sync_status["STATUS_SIMKAPAL"]=="P" && $last_sync_status["STATUS_IU"]=="P")
																{
																	$badge_simkeu = "badge-warning";
																	$status_simkeu = "IN PROGRESS";
																}
															break;										
														}														
														?>
														~ 
														SIMOP <span class="badge <?php echo $badge_simop?>" id="status_simop"><?php echo $status_simop?></span>
														
														SIMKEU <span class="badge <?php echo $badge_simkeu?>" id="status_simkeu"><?php echo $status_simkeu?></span>
														
												</div>
											</div>
										</div>
									</div>	
								</div>	
							</div>
							<?php 
							}
							?>
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<!--<button type="button" class="btn btn-success pull-left" id="audittrail"><i class=""></i> &nbsp; Customer History</button>-->
											<button type="button" class="btn btn-success pull-right" id="printcustomer"><i class=""></i> &nbsp; Print Customer Info</button>
										</header>					
										<header class="main-box-header clearfix">
											<button type="button" class="btn btn-danger pull-right" id="customerprofile"><i class=""></i> &nbsp; Customer Profile</button>
										</header>					
									</div>	
								</div>	
							</div>							

							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
										<h4><b>AUDIT TRAIL INFO</b></h4>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<?php
															$tmpl = array (
																'table_open'          => '<table id="table-audit" class="table table-hover">',
																'heading_row_start'   => '<tr class=\'clickableRow\'>',
																'heading_row_end'     => '</tr>',
																'heading_cell_start'   => '',
																'heading_cell_end'     => ''
														  );

															$this->table->set_template($tmpl);												
															echo $this->table->generate();
														?>
												</table>
											</div>
										</div>
									</div>	
								</div>	
							</div>	
							
							<div id="dialogAuditTrail"></div>
					<?php
						}
					?>	
					
	<div id="dialogSubmit" style="display:none">
		<table class="tablebase">
		<tr>
			<td width="130">Customer ID</td>
			<td><?=$customer_id;?></td>
		</tr>		
		<tr>
			<td colspan="3">&nbsp</td>
		</tr>		
		<tr>
			<td>Notes</td>
			<td>
				<textarea class="form-control" id="notes" name="notes" placeholder="" title="Notes" cols="30"></textarea>
				<input type="hidden" id="customer_id" name="customer_id" value="<?=$customer_id;?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp </td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="button" value="CONFIRM SUBMIT" class="btn btn-primary" id="confirm_submit"></td>
		</tr>
		</table>
	</div>
	
				<script>	
				
				$(function(){
					function do_check(){
						$.unblockUI();
							//setTimeout(function () {
								$.get("<?=ROOT;?>register/check_sync/<?=$customer_id;?>", function(data){
									console.log(data);
									
									$('#status_all').show();
									$('#status_all2').hide();
									$('#label_status_all2').hide();
									
									$('#status_error, #status_success').hide();
									$('#status_error, #status_success').html('');
									
									try{
										feed = data.split("^");
										console.log(feed);
										
										rc			= feed[0];
										rcmsg		= feed[1];
										
										m_simop		= feed[2];
										m_simkeu	= feed[3];
										s_simop		= feed[4];
										s_simkeu	= feed[5];
										s_iu		= feed[6];
										
										s_simop_pending = false;
										s_simkeu_pending = false;
										
									}
									catch(err){
										$('#status_error').show();
										$('#status_error').html('Error message: <pre>'+data+err+'</pre>');
										s_simop = 'F';
										s_simkeu = 'F';
									}
									finally{
										if (s_simop == 'S'){
											$('#status_simop').removeClass('badge-danger');
											$('#status_simop').addClass('badge-success');
											$('#status_simop').html('SUCCESS');									
										}
										else if (s_simop == 'P'){
											$('#status_simop').removeClass('badge-success');
											$('#status_simop').addClass('badge-warning');
											$('#status_simop').html('IN PROGRESS');
										}
										else{
											$('#status_simop').removeClass('badge-success');
											$('#status_simop').addClass('badge-danger');
											$('#status_simop').html('FAILED');								
										}
										
										if (s_simkeu == 'S'){
											$('#status_simkeu').removeClass('badge-danger');
											$('#status_simkeu').addClass('badge-success');
											$('#status_simkeu').html('SUCCESS');									
										}			
										else if (s_simop=='P' && s_iu == 'P'){
											$('#status_simkeu').removeClass('badge-success');
											$('#status_simkeu').addClass('badge-warning');
											$('#status_simkeu').html('IN PROGRESS');
										}																		
										else{
											$('#status_simkeu').removeClass('badge-success');
											$('#status_simkeu').addClass('badge-danger');
											$('#status_simkeu').html('FAILED');								
										}
										
										if(s_simop=='P' && s_iu=='P' )
										{
											rcmsg = "REQUEST IN PROGRESS, PLEASE WAIT.";
										}

										$('#status_success').show();
										$('#status_success').html('<pre>'+rcmsg+'</pre>');
									}
								});
					}
					
					$('#submit').click(function(){
						$('#notes').val("");
						$('#dialogSubmit').dialog({modal:false, height:275,width:500,title: 'Submit Customer',close: function( event, ui ) {$('a').removeAttr('disabled');}});
						return;
					});					
					
					$('#confirm_submit').click(function(){
						$.blockUI();
						if(!window.confirm("Submit Customer Data to Headquarter?"))
						{
							$.unblockUI();
							return;
						}
						
						var url = "<?=ROOT?>register/submit_customer/<?=$customer_id;?>";
						var notes = $("#notes").val();
						$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',notes:notes}, function(data){
							$.unblockUI();
							$('#dialogSubmit').dialog('close');
							window.location = "<?=ROOT."register/index/".$customer_id?>";
							try{
								
							}
							catch(err){
								
							}
							finally{
								if (data == 'A'){
									$('#status_approval').removeClass('badge-danger');
									$('#status_approval').removeClass('badge-warning');
									$('#status_approval').removeClass('badge-info');
									$('#status_approval').addClass('badge-success');
									$('#status_approval').html('APPROVE');									
								} 
								else if (data == 'W'){
									$('#status_approval').removeClass('badge-danger');
									$('#status_approval').removeClass('badge-success');
									$('#status_approval').removeClass('badge-info');
									$('#status_approval').addClass('badge-warning');
									$('#status_approval').html('WAITING APPROVE');
								}
								else if (data == 'R'){
									$('#status_approval').removeClass('badge-warning');
									$('#status_approval').removeClass('badge-success');
									$('#status_approval').removeClass('badge-info');
									$('#status_approval').addClass('badge-danger');
									$('#status_approval').html('REJECT');
								}
								else if (data == 'N'){
									$('#status_approval').removeClass('badge-warning');
									$('#status_approval').removeClass('badge-success');
									$('#status_approval').removeClass('badge-danger');
									$('#status_approval').addClass('badge-info');
									$('#status_approval').html('DRAFT');
								}
								else {
									$('#status_approval').removeClass('badge-warning');
									$('#status_approval').removeClass('badge-success');
									$('#status_approval').removeClass('badge-danger');
									$('#status_approval').addClass('badge-info');
									$('#status_approval').html(data);
								}										
							}							
						});
					});					
					
					$('#sync').click(function(){
						$.blockUI();
						
						$.get("<?=ROOT;?>register/sync_all/<?=$customer_id;?>", function(data){//send sync request 
							console.log(data);
							$.unblockUI();
							
							$('#status_all').show();
							$('#status_all2').hide();
							$('#label_status_all2').hide();
							
							$('#status_error, #status_success').hide();
							$('#status_error, #status_success').html('');
							
							try{
								feed = JSON.parse(data);
								console.log(feed);
								
								rc			= feed.rc;
								rcmsg		= feed.rcmsg;
								
								m_simop		= feed.data.respons.message_to_simop;
								m_simkeu	= feed.data.respons.message_to_simkeu;
								s_simop		= feed.data.respons.update_to_simop;
								s_simkeu	= feed.data.respons.update_to_simkeu;
								
							}
							catch(err){
								$('#status_error').show();
								$('#status_error').html('Error message: <pre>'+data+'</pre>');
								s_simop = 'F';
								s_simkeu = 'F';
								//do_check();
							}
							finally{
								if (s_simop == 'S'){
									$('#status_simop').removeClass('badge-danger');
									$('#status_simop').addClass('badge-success');
									$('#status_simop').html('SUCCESS');									
								}
								else{
									$('#status_simop').removeClass('badge-success');
									$('#status_simop').addClass('badge-danger');
									$('#status_simop').html('FAILED');								
								}
								
								if (s_simkeu == 'S'){
									$('#status_simkeu').removeClass('badge-danger');
									$('#status_simkeu').addClass('badge-success');
									$('#status_simkeu').html('SUCCESS');									
								}
								else{
									$('#status_simkeu').removeClass('badge-success');
									$('#status_simkeu').addClass('badge-danger');
									$('#status_simkeu').html('FAILED');								
								}
								
								$('#status_success').show();
								$('#status_success').html('<pre>'+rcmsg+'</pre>');
								
								//make sure get latest status
								//do_check();
							}
						});
						setTimeout(function(){ do_check();}, 60000);
					});
					
					
					$('#sign').click(function(){
						$.blockUI();
						var data = new Array();
						$("input[name='branch[]']:checked").each(function(i) {
							data.push($(this).val());
						});

						var url = "<?=ROOT?>register/sign_customer/<?=$customer_id;?>"; 
						$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',data}, function(data){
							$.unblockUI();
							try{
								
							}
							catch(err){
								
							}
							finally{
								alert(data);
							}						
						});						
					});					
					
					$('#printcustomer').click(function(){
						window.open('<?=ROOT?>register/print_cust/<?=$customer_id?>', '_blank')
					});
					$('#audittrail').click(function(){
						$('#dialogAuditTrail').load("<?=ROOT?>register/audit_trail/<?=$customer_id?>")
							.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
					});
					$('#customerprofile').click(function(){
						window.open('<?=ROOT?>customer_profile/index/<?=$customer_id?>', '_blank')
					});	
					
					var table2 = $('#table-audit').dataTable({
						'info': false,
						'sDom': 'lTfr<"clearfix">tip',
						'oTableTools': {
							'aButtons': [
								{
									'sExtends':    'collection',
									'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
									'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
								}
							]
						},
						"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
					});					
				})
				
				</script>