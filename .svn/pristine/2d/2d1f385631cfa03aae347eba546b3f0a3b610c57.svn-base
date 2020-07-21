<style>
    div.DTTT.btn-group{
        display:none !important;
    }
	.label {
		display: inline-block;
	}

	body {counter-reset: step;}
	#progressbar li {
	  list-style-type: none;
	  width: 30%;
	  float: left;
	  position: relative;
	  text-align: center;
	}
	#progressbar li:before {
	  content: counter(step);
	  counter-increment: step;
	  width: 60px;
	  height: 60px;
	  line-height: 56px;
	  display: block;
	  border-radius: 50%;
	  margin: 0 auto 10px auto;
	  border: 4px solid #ddd;
	  text-align: center;
	  background-color: white;
	  z-index: 99;
	  position: relative;
	}
	/*progressbar connectors*/
	#progressbar li:after {
	  content: '';
	  width: 100%;
	  height: 4px;
	  background-color: #ddd;
	  position: absolute;
	  left: -50%;
	  top: 30px;
	  z-index: 1; /*put it behind the numbers*/
	}
	#progressbar li:first-child:after {
	  /*connector not needed before the first step*/
	  content: none;
	}
	#progressbar li.active {
	  color: green;
	}
	#progressbar li.danger {
	  color: red;
	}
	#progressbar li.error {
	  color: red;
	}
	/*marking active/completed steps green*/
	/*The number of the step and the connector before it = green*/
	#progressbar li.active:before{
	  border-color: green;
	}
	#progressbar li.error:before{
	  border-color: red;
	}
	#progressbar li.active + li:after {
	  background-color: green;
	}
	.modal-large{width: 80%}
	.callout.boxcount {
	    border-color: #0097bc;
	    background: #eee;
	}
	.disbaled-div {
	  pointer-events:none;
	}
	#po_list tooltip:not(:first-child){
	    margin-left: -8px !important;
	}
	#progressbar li.current:before {
	  background: rgba(242,246,248,1);
	background: -moz-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 0%, rgba(224,239,249,1) 100%);
	background: -webkit-gradient(left top, right top, color-stop(0%, rgba(242,246,248,1)), color-stop(0%, rgba(216,225,231,1)), color-stop(100%, rgba(224,239,249,1)));
	background: -webkit-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 0%, rgba(224,239,249,1) 100%);
	background: -o-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 0%, rgba(224,239,249,1) 100%);
	background: -ms-linear-gradient(left, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 0%, rgba(224,239,249,1) 100%);
	background: linear-gradient(to right, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 0%, rgba(224,239,249,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9', GradientType=1 );
	}
</style>
<script>

</script>
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?=CUBE_?>js/jquery.dataTables.shortingEuro.js"></script>
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

						</div>
					</div>
          			<div class="row">
          			    <div class="col-lg-12">
          			    	<div class="main-box" style="padding: 0px 50px;">
          			    		<br/>
          			    		<div>
          			    			<center>
          			    				<h4><strong>Payment Code : <?php echo $this->input->get('payment_code'); ?></strong></h4>
          			    			</center>
          			    		</div>
          			    		<br/>
          			    		<table style="width: 100%;">
          			    			<tr>
          			    				<td width="100px;"> Trx Date </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="250px;"> <?php echo $payment_header->trxDate; ?> </td>

          			    				<td></td>

          			    				<td width="200px;"> Expired Date </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="200px;"> -</td>
          			    			</tr>
          			    			<tr>
          			    				<td width="100px;"> Biller Name </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="250px;"> <?php echo $payment_header->billerName; ?> </td>

          			    				<td></td>

          			    				<td width="200px;"> Status Payment Gateway </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="200px;"> <?php echo $payment_header->statusPaymentGate; ?></td>
          			    			</tr>
          			    			<tr>
          			    				<td width="100px;"> Bank </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="250px;"> <?php echo $payment_header->bankName; ?> </td>

          			    				<td></td>

          			    				<td width="200px;"> Status Bank </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="200px;"> - </td>
          			    			</tr>
          			    			<tr>
          			    				<td width="100px;"> Channel </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="250px;"> - </td>

          			    				<td></td>

          			    				<td width="200px;"> Status Merchant </td>
          			    				<td width="10px;"> : </td>
          			    				<td width="200px;"> <?php echo $payment_header->statusMerchant; ?> </td>
          			    			</tr>

          			    		</table>

          			    		<br/>
          			    	</div>
          			    </div>
          			 </div>
					<div class="row" id="gridRequest">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<!-- <h2 class="pull-left">Receiving Booking List</h2> -->

									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								<div class="main-box-body clearfix">

									<br/>
									<div class="col-md-6 col-md-offset-3 col-sm-offset-3">
										<center>
											<table style="width: 100%;">
												  <tr>
												    <td class="tg-0pky" width="130px" style="padding-left: 10px; text-align: right;">Biller Name</td>
												    <td width="100px" class="text-center">:</td>
												    <td class="tg-0pky"><?php echo $payment_header->billerName; ?></td>
												  </tr>
												  <tr>
												    <td class="tg-0pky" width="130px" style="padding-left: 10px; text-align: right;">Date</td>
												    <td width="100px" class="text-center">:</td>
												    <td class="tg-0pky"><?php echo date('d-F-Y H:i:s'); ?></td>
												  </tr>

											</table>
										</center>

									</div>
									<br/>
									<br/>
									<br/><br/><br/>
									<div class="table-responsive">
										<table class="table table-striped table-hover transaction-list" style="width:100%;">
											<thead>
												<th width='30px'>No</th>
												<th width='100px'>Trx Date</th>
												<th width='100px'>Proforma</th>
												<th width='100px'>No.Invoice</th>
												<th width='100px'>Customer</th>
												<th width='100px'>Service</th>
												<th width='100px'>Cabang</th>
												<th width='100px'>Amount</th>
											</thead>
											<tbody>
												<?php
												$i = 1;
												$total = 0;
												foreach ($payment_detail as $key => $value){

												?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $value['trx_date']; ?></td>
														<td><?php echo $value['proforma']; ?></td>
														<td><?php echo $value['no_invoice']; ?></td>
														<td><?php echo $value['customer']; ?></td>
														<td><?php echo $value['service']; ?></td>
														<td><?php echo $value['port']; ?></td>
														<td><?php echo $value['amount']; ?></td>
													</tr>
												<?php
													$i++;
													$total = $total + $value['amount'];
												 } ?>
											</tbody>
											<tfoot id="tfoot_total" class="">
												<tr>
													<td colspan="6" class="text-center"><strong>Total Pembayaran</strong></td>
													<td  colspan="2" id="totalnya"><?php echo $payment_header->totalAmount; ?></td>
												</tr>
											</tfoot>

										</table>
									</div>
                  <center>
										<button class="btn btn-info" id="btn_checkout" type="button" onclick="force_flagging(`<?php echo $this->input->get('payment_code'); ?>`)">Flagging</button>
									</center>
								</div>
							</div>
						</div>
					</div>
					<div id="dialogViewReq"></div>
					<script type="text/javascript">
            function force_flagging(id)
            {
              var r = confirm('Apakah yakin ingin melakukan force flagging / pengubahan status bayar?');
              if(r == true) {
                doFlagging(id);
              }
            }

						function doFlagging(id){
              var url = "<?=ROOT?>va/transaction/flagging_payment";
              $.ajax({
                url: url,
                type: "post",
                data: {
                  <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                  payment_code: id
                },
                beforeSend: function() {
                  $.blockUI();
                },
                success: function(response) {
                  var parseResponse = JSON.parse(response);

                  if(parseResponse.code == '201') {
                    alert('Gagal, No VA sudah lunas / terbayar');
                  }

                  if(parseResponse.code == '500') {
                    alert('Gagal, kesalahan di sistem.');
                  }

                  if(parseResponse.code == '501') {
                    alert('Gagal, No VA gagal di flagging');
                  }

                  if(parseResponse.code == '503') {
                    alert('Gagal, Silahkan input NO VA');
                  }

                  if(parseResponse.code == '200') {
                    alert('Success, NO VA sudah di flagging');
                    $('#btn_checkout').hide();
                    window.location.reload();
                  }
                },
                error: function(error) {
                  alert(error.responseJSON.message);
                }
              }).done(function() {
                $.unblockUI();
              });
						}
					</script>
