<script src="../../config/cube/js/bootstrap.js"></script>
<script src="../../config/cube/js/jquery.nanoscroller.min.js"></script>
<script src="../../config/cube/js/modernizr.custom.js"></script>
<script src="../../config/cube/js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="../../config/cube/js/classie.js"></script>
<script src="../../config/cube/js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="../../config/cube/css/libs/ns-default.css"/>
	<link rel="stylesheet" type="text/css" href="../../config/cube/css/libs/ns-style-growl.css"/>
	<link rel="stylesheet" type="text/css" href="../../config/cube/css/libs/ns-style-bar.css"/>
	<link rel="stylesheet" type="text/css" href="../../config/cube/css/libs/ns-style-attached.css"/>
	<link rel="stylesheet" type="text/css" href="../../config/cube/css/libs/ns-style-other.css"/>
	<link rel="stylesheet" type="text/css" href="../../config/cube/css/libs/ns-style-theme.css"/>
							
							<div class="row">
								<div class="col-lg-6">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Customer Detail</h2>
										</header>
										
										<div class="main-box-body clearfix">
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
											<h2>Customer Service List</h2>
										</header>
										
										<div class="main-box-body clearfix"> 
											<div class="form-group">
												<label>TOOLS</label>
												<div class="checkbox-nice">
													<input type="checkbox" id="sms00" value="sms00" <?php echo (isset($SMS00) ? $SMS00 : "")?>>
													<label for="sms00">
														SMS NOTIFICATION
													</label>
												</div>
												<div class="checkbox-nice">
													<input type="checkbox" id="eml00" value="eml00" <?php echo (isset($EML00) ? $EML00 : "");?>>
													<label for="eml00">
														EMAIL NOTIFICATION
													</label>
												</div>
												<label>FACILITY</label>
												<div class="checkbox-nice">
													<input type="checkbox" id="vsl00" value="vsl00" <?php echo (isset($VSL00) ? $VSL00 : "");?>>
													<label for="vsl00">
														VESSEL
													</label>
												</div>
												<div class="checkbox-nice">
													<input type="checkbox" id="ctn00" value="ctn00" <?php echo (isset($CTN00) ? $CTN00 : "");?>>
													<label for="ctn00">
														CONTAINER
													</label>
												</div>
												<div class="checkbox-nice">
													<input type="checkbox" id="brg00" value="brg00" <?php echo (isset($BRG00) ? $BRG00 : "");?>>
													<label for="brg00">
														BARANG
													</label>
												</div>	
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">												
											</div>

											<input type="button" value="Simpan" onclick="submit_form()" id="submit_form" name="submit_form" class="btn btn-success"/>
										</div>
									</div>
								</div>								
							</div>
							
						</div>
					</div>
					
<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		$(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
	});
});

    function submit_form() {

        var customer_id = $("#customer_id").val();
		var sms00 = $("#sms00").is(":checked");
		var eml00 = $("#eml00").is(":checked");
		var vsl00 = $("#vsl00").is(":checked");
		var ctn00 = $("#ctn00").is(":checked");
		var brg00 = $("#brg00").is(":checked");
		
        if(customer_id=="")
        {
            alert("Customer ID kosong");
            $( "#customer_id" ).focus();
            return false;
        }
		
        $.post( "../setup_customer/update", {submit_form:true,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' ,customer_id:customer_id, sms00:sms00, eml00:eml00,
                                                         vsl00:vsl00, ctn00:ctn00, brg00:brg00
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
</script>