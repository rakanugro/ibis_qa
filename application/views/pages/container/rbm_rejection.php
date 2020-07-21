<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/bootstrap.js"></script>
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>

<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});

	function serachRequest()
	{
		$.blockUI();
		var idreq=$("#request_no").val();
		var url="<?=ROOT?>/approval_request/search_request";
		$("#gridapprove").load(url,{ID_REQ:idreq},function() {
										  $.unblockUI();
										});
		
	}
</script>
<div class="row">
								<div class="col-lg-6">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2><?=$xmainhead1?></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xnm_kapal?></label>
													<div class="col-lg-9">
													<input type="text" id="nama_kapal" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xbendera?></label>
													<div class="col-lg-9">
													<input type="text" id="bendera" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">LOA</label>
													<div class="col-lg-9">
													<input type="text" id="loa" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">DWT / GRT</label>
													<div class="col-lg-4">
														<input type="text" id="dwt" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-1" align="center">/</div>
													<div class="col-lg-4">
														<input type="text" id="grt" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xdraft?></label>
													<div class="col-lg-4">
														<input type="text" id="front_draft" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-1" align="center">/</div>
													<div class="col-lg-4">
														<input type="text" id="back_draft" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xkemasan?></label>
													<div class="col-lg-9">
													<input type="text" id="cont_type" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xtipe_voyage?></label>
													<div class="col-lg-9">
													<input type="text" id="voy_type" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xkunjungan?></label>
													<div class="col-lg-9">
													<input type="text" id="kunjungan" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>					
											</form>
										</div>
									</div>
								</div>