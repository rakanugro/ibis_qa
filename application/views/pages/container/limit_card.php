<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>

<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
							
							<div class="row">
								<div class="col-lg-6">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Service List</h2>
										</header>
										
										<div class="main-box-body clearfix"> 
											<div class="form-group">										
											<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="8"){?>
												<label><b>CONTAINER</b></label>
												<table>
													<tr>
														<td>
															Receiving &nbsp; &nbsp;
														</td>
														<td>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-fax"></i></span>
																<input type="text" class="form-control" id="rec" name="rec" value="<?=$rec_card?>" style="width:60px"/>
															</div>
														</td>
														<td>
														    &nbsp;&nbsp; Card
														</td>
													</tr>
													<tr>
														<td>
															Delivery &nbsp; &nbsp;
														</td>
														<td>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-fax"></i></span>
																<input type="text" class="form-control" id="del" name="del" value="<?=$del_card?>" style="width:60px"/>
															</div>
														</td>
														<td>
														    &nbsp;&nbsp; Card
														</td>
													</tr>		
													<tr>
														<td>
															Loading Cancel Before Gate In &nbsp; &nbsp;
														</td>
														<td>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-fax"></i></span>
																<input type="text" class="form-control" id="calbg" name="calbg" value="<?=$calbg_card?>" style="width:60px"/> 
															</div>
														</td>
														<td>
														    &nbsp;&nbsp; Card
														</td>
													</tr>		
													<tr>
														<td>
															Loading Cancel After Gate In &nbsp; &nbsp;
														</td>
														<td>
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-fax"></i></span>
																<input type="text" class="form-control" id="calag" name="calag" value="<?=$calag_card?>" style="width:60px"/> 
															</div>
														</td>
														<td>
														    &nbsp;&nbsp; Card
														</td>
													</tr>															
												</table>				
												</br>
												<?php }?>
											</div>

											<input type="button" value="Simpan" onclick="submit_form()" id="submit_form" name="submit_form" class="btn btn-success"/>
										</div>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>		
					<div id="modalplaceholder"></div>
<script>
    //masked inputs
	$("#rec").mask("9?99");
	$("#del").mask("9?99");
	$("#calbg").mask("9?99");
	$("#calag").mask("9?99");

    function submit_form() {
        var rec_limit = $("#rec").val();
		var del_limit = $("#del").val();
		var calbg_limit = $("#calbg").val();
		var calag_limit = $("#calag").val();
		
        $.post( "<?=ROOT?>register/update_limit_card", {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
														submit_form:true, 
														rec:rec_limit, 
														del:del_limit, 
														calbg:calbg_limit,
														calag:calag_limit
                                                        })
            .done(function( data ) {
                alert( "Data Loaded: " + data );

        }).fail(function() {
			//alert( "Data Loaded: " + data );
            alert("error, update gagal");
        });

        return false;
    }
</script>
<script>	
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});

	<?php
	if(isset($msg)){
	?>
	var notification = new NotificationFx({
		message : '<p><?php echo $msg?></p>',
		layout : 'bar',
		effect : 'exploader',
		type : 'warning' // notice, warning, error or success
	});

	// show the notification
	notification.show();
	<?}?>
	
});

</script>