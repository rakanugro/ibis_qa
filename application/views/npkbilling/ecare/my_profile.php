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
											<h2>Customer Detail</h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">User ID </label>
												<input type="text" class="form-control" value="<?php echo $user_id;?>" id="user_id" name="user_id" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
											</div>
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">Customer ID </label>
												<input type="text" class="form-control" value="<?php echo $customer_id;?>" id="customer_id" name="customer_id" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
											</div>
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">Customer Name </label>
												<input type="text" class="form-control" value="<?php echo $customer_name;?>" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
											</div>
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">Address </label>
												<input type="text" class="form-control" value="<?php echo $address;?>" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
											</div>
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">NPWP </label>
												<input type="text" class="form-control" value="<?php echo $npwp;?>" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
											</div>
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">Email </label>
												<input type="text" class="form-control" value="<?php echo $email;?>" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
											</div>
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">Phone </label>
												<input type="text" class="form-control" value="<?php echo $phone;?>" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
											</div>																						
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Notification List</h2>
										</header>
										
										<div class="main-box-body clearfix"> 
											<div class="form-group">
											<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="d"){?>
												<label><b>VESSEL</b></label>
												<table>
													<tr>
														<td>
															Pengajuan PKK &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms01" value="sms01" <?php echo (isset($SMS01) ? $SMS01 : "")?>>
																<label for="sms01">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml01" value="eml01" <?php echo (isset($EML01) ? $EML01 : "");?>>
																<label for="eml01">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Pengajuan PPKB &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms02" value="sms02" <?php echo (isset($SMS02) ? $SMS02 : "")?>>
																<label for="sms02">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml02" value="eml02" <?php echo (isset($EML02) ? $EML02 : "");?>>
																<label for="eml02">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Penetapan PPKB &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms03" value="sms03" <?php echo (isset($SMS03) ? $SMS03 : "")?>>
																<label for="sms03">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml03" value="eml03" <?php echo (isset($EML03) ? $EML03 : "");?>>
																<label for="eml03">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Terbit DPJK, DTJK, dan NOTA &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms04" value="sms04" <?php echo (isset($SMS04) ? $SMS04 : "")?>>
																<label for="sms04">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml04" value="eml04" <?php echo (isset($EML04) ? $EML04 : "");?>>
																<label for="eml04">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Auto Collection -> Hold Amount &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms05" value="sms05" <?php echo (isset($SMS05) ? $SMS05 : "")?>>
																<label for="sms05">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml05" value="eml05" <?php echo (isset($EML05) ? $EML05 : "");?>>
																<label for="eml05">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Auto Collection -> Update &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms06" value="sms06" <?php echo (isset($SMS06) ? $SMS06 : "")?>>
																<label for="sms06">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml06" value="eml06" <?php echo (isset($EML06) ? $EML06 : "");?>>
																<label for="eml06">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Auto Collection -> Deduct - Payment Release &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms07" value="sms07" <?php echo (isset($SMS07) ? $SMS07 : "")?>>
																<label for="sms07">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml07" value="eml07" <?php echo (isset($EML07) ? $EML07 : "");?>>
																<label for="eml07">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
												</table>
												<br/>
											<?php }?>
											<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="5"){?>
												<label><b>CONTAINER</b></label>
												<table>
													<tr>
														<td>
															Confirm Request &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms08" value="sms08" <?php echo (isset($SMS08) ? $SMS08 : "")?>>
																<label for="sms08">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml08" value="eml08" <?php echo (isset($EML08) ? $EML08 : "");?>>
																<label for="eml08">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Approval Request &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms09" value="sms09" <?php echo (isset($SMS09) ? $SMS09 : "")?>>
																<label for="sms09">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml09" value="eml09" checked disabled>
																<label for="eml09">
																	EMAIL  * mandatory
																</label>
															</div>
														</td>
													</tr>		
													<tr>
														<td>
															Payment &nbsp; &nbsp;
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="sms10" value="sms10" <?php echo (isset($SMS10) ? $SMS10 : "")?>>
																<label for="sms10">
																	SMS
																</label>
															</div>
														</td>
														<td>
															<div class="checkbox-nice">
																<input type="checkbox" id="eml10" value="eml10" <?php echo (isset($EML10) ? $EML10 : "");?>>
																<label for="eml10">
																	EMAIL
																</label>
															</div>
														</td>
													</tr>															
												</table>				
												</br>
												<?php }?>
												<div class="form-group example-twitter-oss">
													<label for="exampleAutocomplete">No Telephone for SMS</label>
													<input type="text" class="form-control" value="<?php echo $uphone;?>" id="uphone" name="uphone" placeholder="" title="">
												</div>
												<div class="form-group example-twitter-oss">
													<label for="exampleAutocomplete">Notification Email</label>
													<input type="text" class="form-control" value="<?php echo $uemail;?>" id="uemail" name="uemail" placeholder="" title="">
												</div>
											</div>

											<input type="button" value="Simpan" onclick="submit_form()" id="submit_form" name="submit_form" class="btn btn-success"/>
										</div>
									</div>
								</div>
								
								<!-- sebelumnya change pass-->
								
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-6">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Customer Setup</h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">PDF Password</label>
												<input type="text" class="form-control" value="<?php echo $pdf_password;?>" id="pdf_password" name="pdf_password" placeholder="" title="password for open pdf file" readonly>
											</div>																				
										</div>
									</div>
								</div>	
								<div class="col-lg-6">
									<div class="main-box clearfix">										
										<div class="main-box-body clearfix"> 
											<div class="form-group">
											</div>
											<input type="button" value="Change Password" id="change_password" name="change_password" class="btn btn-success"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Assign Consignee</h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="form-group example-twitter-oss">
												<div class="col-lg-12">
													<label for="exampleAutocomplete">Consignee</label>
												</div>
												<div class="col-lg-6">
													<input type="text" class="form-control" id="consignee_autocomplete" name="consignee_name" value="<?=$consignee_name?>" placeholder="autocomplete" title="Masukkan Consignee">
												</div>
												<div class="col-lg-3">
													<input type="text" class="form-control" id="consignee_npwp" name="consignee_npwp" value="<?=$consignee_npwp?>" data-toggle="tooltip" data-placement="bottom" title="consignee npwp" size="5" readonly>
													<input type="hidden" class="form-control" id="consignee_id" name="consignee_id" value="<?=$consignee_id?>" data-toggle="tooltip" data-placement="bottom" title="consignee id" size="5">
												</div>
												<div class="col-lg-3">
													<input type="button" class="btn btn-success" value="Set Consignee" onclick="setConsignee();">
												</div>
											</div>
										</div>
									</div>
								</div>						
							</div>
							
						</div>
					</div>
					<div class="row" id="tabledata">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">List of Consignee</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<?php
													$tmpl = array (
														'table_open'          => '<table id="table-request" class="table table-hover">',
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
					
										
					<div id="modalplaceholder"></div>
<script>
    function submit_form() {
        var customer_id = $("#customer_id").val();
		var user_id = $("#user_id").val();
		var uphone = $("#uphone").val();
		var uemail = $("#uemail").val();
		var sms01 = $("#sms01").is(":checked");
		var eml01 = $("#eml01").is(":checked");
		var sms02 = $("#sms02").is(":checked");
		var eml02 = $("#eml02").is(":checked");
		var sms03 = $("#sms03").is(":checked");
		var eml03 = $("#eml03").is(":checked");
		var sms04 = $("#sms04").is(":checked");
		var eml04 = $("#eml04").is(":checked");
		var sms05 = $("#sms05").is(":checked");
		var eml05 = $("#eml05").is(":checked");
		var sms06 = $("#sms06").is(":checked");
		var eml06 = $("#eml06").is(":checked");
		var sms07 = $("#sms07").is(":checked");
		var eml07 = $("#eml07").is(":checked");
		var sms08 = $("#sms08").is(":checked");
		var eml08 = $("#eml08").is(":checked");
		var sms09 = $("#sms09").is(":checked");
		var eml09 = $("#eml09").is(":checked");
		var sms10 = $("#sms10").is(":checked");
		var eml10 = $("#eml10").is(":checked");
		
        $.post( "<?=ROOT?>customer/update_notif", {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
														submit_form:true, 
														user_id:user_id, uphone:uphone, uemail:uemail,
														customer_id:customer_id, sms01:sms01, eml01:eml01,
                                                        sms02:sms02, eml02:eml02, sms03:sms03, eml03:eml03, sms04:sms04, eml05:eml05,sms06:sms06, eml06:eml06,sms07:sms07, eml07:eml07,sms08:sms08, eml08:eml08,sms09:sms09, eml09:eml09,sms10:sms10, eml10:eml10
                                                        })
            .done(function( data ) {
                //alert( "Data Loaded: " + data );
                var obj = jQuery.parseJSON(data);

                if(obj.rc=="S")
                {
					alert("success");
					/*
                    var notification = new NotificationFx({
                        message : '<p>Update customer Sukses</p>',
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'success' // notice, warning, error or success
                        
                    });

                    // show the notification
                    notification.show();*/
                }
                else{
					alert("failed");
					//alert( "Data Loaded: " + data );
					/*
                    var notification = new NotificationFx({
                        message : '<p>Update Customer Gagal </p><br/>'+obj.rcmsg,
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'error' // notice, warning, error or success
                        
                    });

                    // show the notification
                    notification.show();*/
                }

        }).fail(function() {
			//alert( "Data Loaded: " + data );
            alert("error, update customer gagal");
        });

        return false;
    }
	
	function setConsignee()
	{
		var consignee = $("#consignee_autocomplete").val();
		var consignee_npwp = $("#consignee_npwp").val();
		var consignee_id = $("#consignee_id").val();
		
		$.post( "<?=ROOT?>customer/set_consignee", {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', setConsignee:true, consignee:consignee, consignee_npwp:consignee_npwp, consignee_id:consignee_id
		}).done(function( data ) {
			alert(data);
			window.location.href = "<?=ROOT?>mainpage";
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
	
	//===================================== autocomplete consignee========================================//
		$( "#consignee_autocomplete" ).autocomplete({
			minLength: 3,
			source: function(request, response) 
			{
				$.getJSON("<?=ROOT?>customer/get_consignee_list",{term: $( "#consignee_autocomplete" ).val()}, response);
			},
			focus: function( event, ui ) 
			{
				$( "#consignee_autocomplete" ).val( ui.item.NAME);
				return false;
			},
			select: function( event, ui ) 
			{
				$( "#consignee_autocomplete" ).val( ui.item.NAME);
				$( "#consignee_npwp" ).val( ui.item.NPWP);
				$( "#consignee_id" ).val( ui.item.CONSIGNEE_ID);
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item ) 
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'>" + item.NAME + " ("+item.CONSIGNEE_ID+") ("+item.BRANCH_NAME+")<br>" +item.NPWP+"</a>")
			.appendTo( ul );
		};

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
	
	$('#change_password').click(function(){
		$('#modalplaceholder').html('');
		var path = "<?=ROOT;?>register/loadmodal/modal-change_password_user";
		
		$.get(path, function(data){
			$('#modalplaceholder').html(data).children().modal('show');
		})
		.then(function(){
			//hack... can't assign through $data in controller
			$('#user_changepassword  [name=user_id]').val('<?php echo $user_id;?>');
		});			
	});	
	
	var table2 = $('#table-request').dataTable({
				'info': false,
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			});
});

		
//called from dialog
function updatePasswordUser(params){
	var path = '';
	path = "<?=ROOT;?>register/user_change_password/";

	$.post(path, params)
	.done(function( data ) {
		if(data)
		{
			alert("update password success");
			$('#modalplaceholder').children().modal('hide');
		}
		else 
			alert(data);
	})
	.then(function(){
	});
}
</script>