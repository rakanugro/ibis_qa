<!-- <link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> 
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<script src="<?=JSQ?>jquery-ui.min.js"></script> -->

<style type="text/css">
.separate_content {
	width:31%;
    height:100px;
    border:1px solid red;
    margin-right:10px;
    float:left;
}
</style>

<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}<>|\[\]/\\]/gi, ''));
	});
});
	
	function searchRequest(page)
	{
		var cari = $("#search").val();
		var url = "<?=ROOT?>register/search_customer_activation/";
		var limit = $("#pagelimit").val();
		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',page:page,limit:limit,ambil:cari});
	}
	
</script>

<script>
	//search table js
	function load_table()
	{
		var url = "<?=ROOT?>register/search_customer_activation";
		var limit = $("#pagelimit").val();
		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',page:1,limit:limit});		
	}
	
	$( document ).ready(function() {
		load_table();
		//autoload
		var intervalID = setInterval(function(){load_table();}, 120000);
	});
</script>

<?
	if (!isset($register)){
		$register = array(
						'CUSTOMER_ID'	=> '',
						'NAME'			=> '',
						'ADDRESS'		=> '',
						'NPWP'			=> '',
						'PASSPORT'			=> '',
						'CITIZENSHIP'  	=> 'WNI',
						'EMAIL'			=> '',
						'WEBSITE'		=> '',
						'PHONE'			=> '',
						'COMPANY_TYPE'	=> '', 
						'ALT_NAME'		=> '', 
						'DEED_ESTABLISHMENT'	=> '',
						'CUSTOMER_GROUP'		=> '', 
		//				'CUSTOMER_TYPE'			=> '', 				// deprecated
						'SVC_VESSEL'		=> '', 
						'SVC_CARGO'			=> '',
						'SVC_CONTAINER'		=> '', 
						'SVC_MISC'			=> '', 
						'IS_SUBSIDIARY'		=> 'N', 
						'HOLDING_NAME'		=> '',
						'EMPLOYEE_COUNT'	=> '', 
						'IS_MAIN_BRANCH'	=> '', 
						'PARTNERSHIP_DATE'	=> '',
						'PROVINCE'			=> '', 
						'CITY'				=> '', 
						'FAX'				=> '', 
						'PARENT_ID'			=> '',
						'IS_SHIPPING_AGENT'	=> '',
						'IS_SHIPPING_LINE'	=> '',
						'IS_PBM'			=> '',
						'IS_FF'				=> '',
						'IS_EMKL'			=> '',
						'IS_PPJK'			=> '',
						'IS_CONSIGNEE'		=> '',
						'IS_RUPA'	=> '',
						'HEADQUARTERS_ID'		=> '',
						'HEADQUARTERS_NAME'		=> '',
						'REG_TYPE'			=> 'OLD'
					);	
	}

	$sel_partnership_date = $register['PARTNERSHIP_DATE'];

	$sel_register_type = array(
		($register['IS_CUSTOMER']=='Y'?'CUS':''),
		($register['IS_MITRA']=='Y'?'MTR':'')
	);
	
	$sel_service_type = array(
		($register['SVC_CARGO']=='Y'?'CONGC':''),
		($register['SVC_CONTAINER']=='Y'?'CONGC':''),
		($register['SVC_VESSEL']=='Y'?'VESSE':''),
		($register['SVC_MISC']=='Y'?'MISC':'')
	);
	
	// TO BE ADDED LATER WHEN OTHER CUSTOMER TYPES ARE AVAILABLE
	/*$sel_customer_type = array(
		($register['IS_SHIPPING_AGENT']=='Y'?'SHIPA':''),
		($register['IS_SHIPPING_LINE']=='Y'?'SHIPL':''),
		($register['IS_PBM']=='Y'?'STVCO':''),
		($register['IS_FF']=='Y'?'FFORW':''),
		($register['IS_EMKL']=='Y'?'EMKL':''),
		($register['IS_PPJK']=='Y'?'PPJK':''),
		($register['IS_CONSIGNEE']=='Y'?'CONSG':'')
	);*/
	$sel_customer_type="";
	if($register['IS_SHIPPING_AGENT']=='Y')
	{
		$sel_customer_type = 'SHIPA';
	}
	else if($register['IS_SHIPPING_LINE']=='Y')
	{
		$sel_customer_type = 'SHIPL';
	}
	else if($register['IS_PBM']=='Y')
	{
		$sel_customer_type = 'STVCO';
	}
	else if($register['IS_FF']=='Y')
	{
		$sel_customer_type = 'FFORW';
	}
	else if($register['IS_EMKL']=='Y')
	{
		$sel_customer_type = 'EMKL';
	}
	else if($register['IS_PPJK']=='Y')
	{
		$sel_customer_type = 'PPJK';
	}
	else if($register['IS_CONSIGNEE']=='Y')
	{
		$sel_customer_type = 'CONSG';
	}
	else if($register['IS_RUPA']=='Y'){
		$sel_customer_type = 'RUPA';
	}
	
	$sel_entity_type = ($register['IS_MAIN_BRANCH']=='Y'?'MAIN':'BRNCH');

	if(!isset($isEditing)){$isEditing = false;}
	if(!isset($simop_name)){$simop_name = '';}
	
	//custom format
	$sel_area_code = '';
	$sel_phone = ''; 
	parse_phone($register['PHONE'], $sel_area_code, $sel_phone);
	
	$sel_fax_area_code = '';
	$sel_fax = ''; 
	$sel_fax_ext = ''; 
	parse_phone_ext($register['FAX'], $sel_fax_area_code, $sel_fax, $sel_fax_ext);

?>

<script>
// Set the date we're counting down to
var countDownDate = new Date("Dec 15, 2017 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    

}, 1000);
</script>

	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />		
	<style type="text/css">
		
	</style>
						<div class="row">

									    <?php 
										$attributes = array('name' => 'registerform','id'=>'registerform','role'=>'form');
										echo form_open_multipart($action,$attributes);
										?>
											<div class="main-box-body clearfix">
											
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<div class="register_login_div">
															<header class="main-box-header clearfix">
																<h2>Informasi Umum</h2>
															</header>
															</div>
														<div class="main-box-body clearfix">
															<div class="register_login_div">
																<?php
																if($register['NAMA_CABANG']!="")
																{
																?>
																<div class="row">
																	<div class="form-group col-md-5">
																		Cabang Pendaftaran : <font size="4"><b><?=$register['NAMA_CABANG']?></b></font>
																	</div>
																</div>
																<?php
																}
																?>		
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-12">
																		<label for="simop_customer_name" >Nama Pelanggan</label>
																		<input type="text" class="form-control withTooltip" id="simop_customer_name" name="simop_customer_name"  data-toggle="tooltip" data-provide="typeahead" data-placement="right" title="Mencocokkan dengan basis data" value=""/>
																		<input type='hidden' id='simop_customer_id' name='simop_customer_id' value="<?php echo $register['CUSTOMER_ID']?>" />
																		<input type='hidden' id='simop_customer_id_nosync' name='simop_customer_id_nosync' value="<?php echo $register['CUSTOMER_ID']?>" />
																		<input type='hidden' id='<?php echo $this->security->get_csrf_token_name(); ?>' name='<?php echo $this->security->get_csrf_token_name(); ?>' value="<?php echo $this->security->get_csrf_hash(); ?>" />
																	</div>
																</div>
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-5">
																		<label for="holding" >ID Pelanggan</label>
																		<input type="text" class="form-control " id="pelanggan" name="pelanggan" title="Kantor pusat harus sudah terdaftar terlebih dahulu" readonly=""/>
																	</div>
																</div>
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-5">
																		<label for="holding" >NPWP</label>
																		<input type="text" class="form-control" id="npwp_id" name="npwp" readonly=""/>
																	</div>
																</div>
							
															<header class="main-box-header clearfix">
																<h2>Alasan Pembukaan Activasi Pelanggan</h2>
															</header>
															<div class="row">
																<div class="main-box-body clearfix">
																	<div class="form-group example-twitter-oss">
																			<input type="radio" id="one" name="alasan" value="Umum" checked>&nbsp;Dokumen Registrasi Telah Lengkap & Butuh Layanan Cepat<br/>  
																			 <input type="radio" id="two" name="alasan" value="Khusus">&nbsp;Alasan Khusus &nbsp;
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="form-group example-twitter-oss col-md-5">
																		<input type="text" name="alasan-khusus" class="form-control" id="input_khusus" disabled="disabled" placeholder="Input Alasan Khusus"><br/>
																</div>
															</div>
															<div class="row">			
																<div class="form-group">
																	<button type="button" id="submitButton" class="btn btn-success">Activate</button>
																</div>
															</div>
															</div>
														</div>
													<div class="row" id="tabledata">
												</div>
											</form>
										</div>								
									</div>
								</div>
							</div>
						</div>
				
											
											
											
											
												

											
													
					
	<!-- this page specific inline scripts -->
	<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>	
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>	
	<!--script src="<?//=CUBE_;?>js/typeahead.bundle.min.js"></script-->
	<script src="<?=CUBE_?>js/hogan.js"></script>
	<script src="<?=CUBE_?>js/typeahead.min.js"></script>
	<script>
	
$(function($) {
		//validation
		$("#submitButton").click(function(){
			
			var check = true;
			
			var filename = "";
			if(filename!="")
			{
				var ext = filename.split('.').pop().toLowerCase();
				if($.inArray(ext, ['pdf','xlxs','jpg','jpeg']) == -1) {
					alert('Dokumen Berita Acara Serah Terima harus : PDF/JPG/JPEG');
					var check = false;
					$('#acceptance_doc').focus();
				}
			}
			
			if(check)
			{
				var names = ['name', 'alt_name', 'address', 'email', 'address', 'deed_establishment', 'customer_group','registrationcompanyid'];
				
				var radios = ['company_type','customer_type'];
			
				if ( $('input[name=citizenship]:checked').val()=='WNI' ){
					names.push('npwp');
				}
				else 
				{
					names.push('passport');
				}
				
				if($('input[name=entity_type]:checked').val()=="BRNCH")
				{
					names.push('main_branch_id');
				}
				
				if($('#fax').val()!='')
				{
					names.push('fax_area_code');
				}
				if($('#fax_area_code').val()!='')
				{
					names.push('fax');
				}	
				
				if($('#phone').val()!='')
				{
					names.push('phone_area_code');
				}
				if($('#phone_area_code').val()!='')
				{
					names.push('phone');
				}			
				
				if ( $('input[name=reg_type]:checked').val()=='OLD' ){
					names.push('simop_customer_name');
					names.push('simop_customer_id');
				}
				
				if ($('[name=is_subsidiary]:checked').val()=='Y'){
					names.push('holding_company_id');
				}
				
				if($('[name=reg_type]:checked').val()=='OLD' && $('#simop_customer_id').val()=="")
				{
					alert('Please choose : Nama di ICT SIMOP');
					check= false;
				}

				if($('#simop_customer_name').val() == ""){
				alert('Please input : Nama Pelanggan !');
				check= false;
				}

				//validasi npwp
				var npwp = $('#npwp').val();
				var passport = $('#passport').val();
				var customer_id = "<?=$register['CUSTOMER_ID']?>";
				var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
				
				if ( $('input[name=citizenship]:checked').val()=='WNI' ){
					var url="<?=ROOT?>register/validate_npwp";
					$.ajax({
					  type: 'POST',
					  url: url,
					  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',npwp:npwp,customer_id:customer_id,registration_company_id:registration_company_id},
					  success: function(data) {
									if(data=="KO")
									{
										alert("NPWP Number Already Used by Another Customer.");
										$('#npwp').focus();
										check= false;
									}
									else if(data=="BLACKLIST")
									{
										alert("NPWP Number Is Blacklisted.");
										$('#npwp').focus();
										check= false;
									}
						},
						async:false
					});
				}
				else 
				{
					var url="<?=ROOT?>register/validate_passport";
					$.ajax({
					  type: 'POST',
					  url: url,
					  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',passport:passport,customer_id:customer_id,registration_company_id:registration_company_id},
					  success: function(data) {
									if(data=="KO")
									{
										alert("Passport Already Used by Another Customer.");
										$('#Passport').focus();
										check= false;
									}
									else if(data=="BLACKLIST")
									{
										alert("Passport Number Is Blacklisted.");
										$('#Passport').focus();
										check= false;
									}
						},
						async:false
					});
				}
				
				if(check)
				{
					if (	
							validateRadios('#registerform', radios) &&
							validateForm('#registerform', names)
						){
						$("#registerform").submit();
					}
				}
			}
		});
		
		$("input[name='alasan']").click(function(){
			
			var remember = document.getElementById('one');
			var remember1 = document.getElementById('two');
			var cek = 0;
			if(remember.checked){
				cek = 1;
			}
			if(remember1.checked){
				cek = 2;
			}
			if(cek == 2){
				document.getElementById("input_khusus").disabled = false;
			}else{
				document.getElementById("input_khusus").disabled = true;
				document.getElementById("input_khusus").value = "";
			}
		});
		
		$("input[name='register_type[]']").click( function () {
			var remember = document.getElementById('checkbox-register_type[]-MTR');
			var remember1 = document.getElementById('checkbox-register_type[]-CUS');
			var cek = 0;
			if(remember.checked){
				cek = 1;
			}
			if(remember1.checked){
				cek = 2;
			}
			
			if(cek == 1){
				document.getElementById("radio-customer_type-SHIPA").disabled = true;
				document.getElementById("radio-customer_type-EMKL").disabled = true;
				document.getElementById("radio-customer_type-CONSG").disabled = true;
				document.getElementById("radio-customer_type-STVCO").disabled = true;
				document.getElementById("radio-customer_type-SHIPA").checked = false;
				document.getElementById("radio-customer_type-EMKL").checked = false;
				document.getElementById("radio-customer_type-CONSG").checked = false;
				document.getElementById("radio-customer_type-STVCO").checked = false;
				document.getElementById("checkbox-service_type[]-VESSE").disabled = true;
				document.getElementById("checkbox-service_type[]-CONGC").disabled = true;
				document.getElementById("checkbox-service_type[]-MISC").checked = true;
			}else{
				document.getElementById("radio-customer_type-SHIPA").disabled = false;
				document.getElementById("radio-customer_type-EMKL").disabled = false;
				document.getElementById("radio-customer_type-CONSG").disabled = false;
				document.getElementById("radio-customer_type-STVCO").disabled = false;
				document.getElementById("checkbox-service_type[]-MISC").checked = false;
				document.getElementById("checkbox-service_type[]-VESSE").disabled = false;
				document.getElementById("checkbox-service_type[]-CONGC").disabled = false;
			}
		});
		
		
		$('#name').focusout(function(){
			var str = $('#name').val();
			if (	
					str.match(/^[.,]?(PT|CV|UD)[.,]?[\s]/) || 
					str.match(/^[.,]?(PT|CV|UD)[.,][\s]?/) || 
					str.match(/[\s][.,]?(PT|CV|UD)[.,]?$/) || 
					str.match(/[\s]?[.,](PT|CV|UD)[.,]?$/) || 
					str.match(/[\s][.,]?(PT|CV|UD)[.,]?[\s]/)
				)
			{
				alert ('Name cannot contain PT or CV or UD');
				$('#name').val('');
			}
		});
		
		$('#email').change(function(){
			
			if (!validateEmails('#registerform',['email'])){
				$('#email').val('');
			}
		});
		
		$("#checkbox-register_type").change(function(){
			
		});

		$('#website').change(function(){
			
			if (!validateWebsites('#registerform',['website'])){
				$('#website').val('');
			}
		});
		//-------------------
		
		//tooltip init
		$('.withTooltip').tooltip();
	
		//masked inputs
		$(".phone").mask("9999?9999");
		$(".area-code").mask("999?9");
		$(".ext").mask("?9999");
		$("#npwp").mask("99.999.999.9-999.999");
		//$("#passport").mask("99999?99999999999999");
		$("#ktp").mask("9999999999999999");
		$('.calendar').mask("99-99-9999");
		
		//nice select boxes
		$('.sel2').select2();
		
		//datepicker
		$('.calendar').datepicker({
		  format	: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  endDate	: '0d'
		});


		
		//HOLDING
		checkHolding();
		$('input[name=is_subsidiary]').change(function(){
			checkHolding();
		})
		
		checkCustomerType();
		$('input[name=citizenship]').change(function(){
			checkCustomerType();
		})
		
		$('input[name=company_type]').change(function(){
			checkCustomerType();
		})
		
		$('input[name=customer_type]').change(function(){
			checkCustomerType();
		})		
		
		//MAIN BRANCH
		checkMainBranch();
		$('input[name=entity_type]').change(function(){
			checkMainBranch();
		});
				
		//SIMOP CUSTOMER
		checkSimopName();
		$('input[name=reg_type]').change(function(){
			checkSimopName();
		});
		
		/*checkCursor('phone');
		checkCursor('area-code');
		checkCursor('ext');
		checkCursor('npwp');
		checkCursor('ktp');
		//checkCursor('calendar');
//		alert('end');*/
	})	
	
	function checkCursor(tagName){
		var inp = document.getElementsByTagName(tagName)[1];
        if (inp.createTextRange) {
            var part = inp.createTextRange();
            part.move("character", 0);
            part.select();
        }else if (inp.setSelectionRange){
            inp.setSelectionRange(0, 0);
		}
        inp.focus();
	}
	
	var testsource = 
[
{"company_id":"17400806","company_name":"PT.BAHARI SANDI PRATAMA","address":"JL.BELAWAN NO.42\/5 TELUK BAYUR","city":"PADANG","npwp":"02.118.172.2-211.000","value":"PT.BAHARI SANDI PRATAMA"},
{"company_id":"15401002","company_name":"BAHARI SANDI PRATAMA PT","address":"JL.RE MARTADINATA NO.11  ","city":"PALEMBANG","npwp":"02.118.172.2-301.001","value":"BAHARI SANDI PRATAMA PT"},
{"company_id":"12402128","company_name":"BAHARI SANDI PRATAMA PT","address":"LINK GEREM RAYA NO RT 001 RW 004 GEREM GROGOL CILEGON BANTEN","city":"CILEGON","npwp":"02.118.172.2-417.001","value":"BAHARI SANDI PRATAMA PT"},
{"company_id":"10400807","company_name":"PT. BAHARI SANDI PRATAMA","address":"JL.JEND.SUDIRMAN NO.21 THEHOK JAMBI, PH.26423\r\n","city":null,"npwp":"02.118.172.2-211.000","value":"PT. BAHARI SANDI PRATAMA"}
];

	var testsource2 = [{"company_id":"17400806","company_name":"PT.BAHARI SANDI PRATAMA","address":"JL.BELAWAN NO.42\/5 TELUK BAYUR","city":"PADANG","npwp":"02.118.172.2-211.000","value":"PT.BAHARI SANDI PRATAMA"},{"company_id":"15401002","company_name":"BAHARI SANDI PRATAMA PT","address":"JL.RE MARTADINATA NO.11  ","city":"PALEMBANG","npwp":"02.118.172.2-301.001","value":"BAHARI SANDI PRATAMA PT"},{"company_id":"12402128","company_name":"BAHARI SANDI PRATAMA PT","address":"LINK GEREM RAYA NO RT 001 RW 004 GEREM GROGOL CILEGON BANTEN","city":"CILEGON","npwp":"02.118.172.2-417.001","value":"BAHARI SANDI PRATAMA PT"},{"company_id":"10400807","company_name":"PT. BAHARI SANDI PRATAMA","address":"JL.JEND.SUDIRMAN NO.21 THEHOK JAMBI, PH.26423\r\n","city":null,"npwp":"02.118.172.2-211.000","value":"PT. BAHARI SANDI PRATAMA"}];
	
	function initSimopName(){
		$('#simop_customer_name').typeahead({
			name: 'simop_customer',
			remote: '<?=ROOT;?>register/testActivasi/%QUERY', 	// you can change anything but %QUERY
			//local: testsource,
			//local: testsource2,
			displayKey:'company_id',
			minLength: 3, 											// send AJAX request only after user type in at least 3 characters
			limit: 50, 												// limit to show only 10 results
			template: [
				'<p class="repo-language">{{npwp}}</p>',                              
				'<p class="repo-name">{{company_name}} ({{company_id}})</p>',                                      
				'<p class="repo-description">{{address}}</p>',                         
				'<p class="repo-description">{{city}}</p>'                         
			].join(''),
			engine: Hogan
		}).on("typeahead:selected",
				function(e,datum){ 
					$('#simop_customer_id').val(datum.company_id);
					$('#npwp_id').val(datum.npwp);
					$('#pelanggan').val(datum.company_id);
				} );
	}

	
	function checkSimopName(){
		
		if ( $('input[name=reg_type]:checked').val()=='OLD' ){
			$('#simop_customer_name').removeAttr('disabled');
			initSimopName();
		}
		else{
			$('#simop_customer_name').removeAttr('disabled');
			initSimopName();
		}
	}
	
	function initHolding(){
		$('#holding_name').typeahead({
			name: 'holding',
			remote: '<?=ROOT;?>register/searchcompanies/%QUERY', 	// you can change anything but %QUERY
			displayKey:'npwp',
			minLength: 3, 											// send AJAX request only after user type in at least 3 characters
			limit: 10, 												// limit to show only 10 results
			template: [                                                              
				'<p class="repo-language">{{npwp}}</p>',                              
				'<p class="repo-name">{{name}}</p>',                                      
				'<p class="repo-description">{{address}}</p>'                         
			].join(''),                                                                 
			engine: Hogan
		}).on("typeahead:selected",
				function(e,datum){ 
					//console.log('data....');
					//console.log(datum);
					$('#holding_company_id').val(	datum.customer_id	);
				} );		
	}
	
	function checkHolding(){
		
		if ( $('input[name=is_subsidiary]:checked').val()=='Y' ){
			$('#holding_name').removeAttr('disabled');
			initHolding();
		}
		else{
			$('#holding_name').typeahead('destroy');
			$('#holding_name').val('');
			$('#holding_company_id').val('');
			$('#holding_name').attr('disabled','disabled');
		}
	}

	function checkCustomerType(){
		if ( $('input[name=company_type]:checked').val()=='SEMPL' && $('input[name=customer_type]:checked').val()=='CONSG' && $('input[name=citizenship]:checked').val()=='WNA'){
			$('#npwp').attr('disabled','disabled');
			$('#npwp').val("");
			$('#passport').removeAttr('disabled');
		}
		else if($('input[name=citizenship]:checked').val()=='WNI')
		{
			$('#passport').attr('disabled','disabled');
			$('#passport').val("");
			$('#npwp').removeAttr('disabled');			
		}
		else
		{
			$('#npwp').attr('disabled','disabled');
			$('#npwp').val("");
			$('#passport').attr('disabled','disabled');
			$('#passport').val("");			
		}
	}	

	
	function initMainBranch(){
		$('#main_branch_name').typeahead({
			name: 'main_branch',
			remote: '<?=ROOT;?>register/searchcompanies/%QUERY', 	// you can change anything but %QUERY
			displayKey:'npwp',
			minLength: 3, 											// send AJAX request only after user type in at least 3 characters
			limit: 10, 												// limit to show only 10 results
			template: [                                                              
				'<p class="repo-language">{{npwp}}</p>',                              
				'<p class="repo-name">{{name}}</p>',                                      
				'<p class="repo-description">{{address}}</p>'                         
			].join(''),                                                                 
			engine: Hogan
		}).on("typeahead:selected",
				function(e,datum){ 
					//console.log('data....');
					//console.log(datum);
					$('#main_branch_id').val(	datum.customer_id	);
				} );
	}

	function checkMainBranch(){
		
		if ( $('input[name=entity_type]:checked').val()!='MAIN' ){
			$('#main_branch_name').removeAttr('disabled');
			initMainBranch();
		}
		else{
			$('#main_branch_name').typeahead('destroy');
			$('#main_branch_name').val('');
			$('#main_branch_id').val('');
			$('#main_branch_name').attr('disabled','disabled');
		}
	}
	
	//http://stackoverflow.com/a/19298244
	function encodeHtmlSpecChars(rawStr){
		return rawStr.replace(/[\u00A0-\u9999<>\&\(\)]/gim, 
								function(i) {
									return '&#'+i.charCodeAt(0)+';';
								});
	}	
	
	function toGetString(rawStr){
		return encodeURIComponent(encodeHtmlSpecChars(rawStr));
	}
	
	//		alert('last');
	
	//change to upper case
	$("#name").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#name").val(($("#name").val()).toUpperCase());
	});

	$("#alt_name").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#alt_name").val(($("#alt_name").val()).toUpperCase());
	});
	
	$("#address").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#address").val(($("#address").val()).toUpperCase());
	});
	
	</script>
	<script>
		$(document).ready(function() {
			//sql injection protection
			$(":input").keyup(function(event) {
				$(this).val($(this).val().replace(/[\*#=;:'"?%~`$^{}<>|\[\]]/gi, ''));
			});
			
			$("#holding_name").keyup(function() {
				$("#holding_company_id").val("");
			});
			
			$("#main_branch_name").keyup(function() {
				$("#main_branch_id").val("");
			});				
			
		});
	</script>
	<script>
		$(document).ready(function() {
			var hidden_div = "<?=$this->session->userdata('group_phd');?>";
			//alert(hidden_div);
			if(hidden_div == 'a'){
				$(".register_login_div").hide();
			}else{
				$(".register_login_div").show();
			}

		});
   </script>
	