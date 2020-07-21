<style>
	div.DTTT.btn-group{
		display:none !important;
	}

	.label {
		display: inline-block;
	}
</style>

			<div class="row">
					<div class="col-lg-12">
						<div class="main-box clearfix">
							<header class="main-box-header clearfix">
								<h2>Progress <span id="progress_info" class="label"></span></h2>
							</header>

							<div class="main-box-body clearfix">
								<div class="progress progress-striped progress-4x">
									<div id="progress_bar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
										<span class="sr-only">80% Complete (danger)</span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2">
										<div id='progress1' class="main-box infographic-box">
											<span class="headline">Request</span>
										</div>
									</div>
									<div class="col-lg-2">
										<div id='progress2' class="main-box infographic-box">
											<span class="headline">Realisasi</span>
										</div>
									</div>
									<div class="col-lg-3">
										<div id='progress3' class="main-box infographic-box">
											<span class="headline">Proforma</span>
										</div>
									</div>
									<div class="col-lg-2">
										<div id='progress4' class="main-box infographic-box">
											<span class="headline">Nota</span>
										</div>
									</div>
									<div class="col-lg-3">
										<div id='progress5' class="main-box infographic-box">
											<span class="headline">Transfer Simkeu</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="main-box clearfix">
							<header class="main-box-header clearfix">
								<h2 class="pull-left">Search Request</h2>
							</header>
							<div class="main-box-body clearfix">
							<div class="form-group example-twitter-oss">
								<label for="exampleAutocomplete">No Request</label>
								<input type="text" class="form-control" id="search_input" name="search_input" value="" placeholder="" style="width:50%;" />
							</div>
							<div class="form-group example-twitter-oss">
								<input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success"/>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="tabledata">
			</div>
		</div>
	</div>
	<div id="dialogViewReq"></div>
</div>

<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
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

<script src="<?=JSQ?>jquery-ui.min.js"></script>
<script>
	var list_equipment = [];
	var selected_id_port = "";
	$(document).ready(function() {
		//sql injection protection
		$(":input").keyup(function(event) {
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
		load_table();
		
		// load list equipment
		var url = "<?=ROOT?>om/stevedoringmanagement/get_list_equipment";
		var param = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'};
		$.post(url, param, function(data){
			// console.log(eval(data));
			list_equipment = eval(data);
		});
	});

	function load_table(){
		$.blockUI();
		var url = "<?=ROOT?>om/stevedoringmanagement/search_table";
		var search_input = $("#search_input").val();
		$("#tabledata").load(url, {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash(); ?>',search:search_input}, function(){
			$.unblockUI();
		});
	}

	function clickDialog1(a){
		$.blockUI();
		$('#dialogViewReq').load("<?=ROOT?>om/stevedoringmanagement/view_detail/"+a, function (){$.unblockUI();}).dialog({modal:false, height:500,width:900,title: 'Realisasi BM'});
		selected_id_port = $("#id_port_"+a).val();
	}

	function clickConfirm(mode, a, b){
		var r = confirm("Are you sure to confirm?");
		if (r == true) {
			alert("You will confirm this request");
			$.blockUI();
			var url = "<?=ROOT?>om/stevedoringmanagement/"+mode;
			var param = {};
			if (mode=="update_realisasi"){
				param = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id_req:a,dtl_no:b,qty:$("#detail_qty_"+b).val(),ton:$("#detail_ton_"+b).val(),cbc:$("#detail_cbc_"+b).val()};
			}else{
				param = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id_req:a,recalculate:b};
			}
			$.post(url, param, function(data){
				$.unblockUI();
				console.log(data);
				alert(data);
				if (mode=="update_realisasi"){
				}else{
					location.reload();
				}
			});
		}
	}
	
	function cancelConfirm(mode, a, b, c){
		var r = confirm("Are you sure to cancel?");
		if (r == true) {
			alert("You will cancel this "+c);
			$.blockUI();
			var url = "<?=ROOT?>om/stevedoringmanagement/"+mode;
			var param = {};
			if (mode=="update_realisasi"){
				param = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				id_req:a,
				dtl_no:b,
				qty:$("#detail_qty_"+b).val(),
				ton:$("#detail_ton_"+b).val(),
				cbc:$("#detail_cbc_"+b).val()};
			}else{
				param = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				id_req:a,
				recalculate:b,
				status:c};
			}
			$.post(url, param, function(data){
				$.unblockUI();
				console.log(data);
				alert(data);
				if (mode=="update_realisasi"){
				}else{
					location.reload();
				}
			});
		}
	}	
</script>
