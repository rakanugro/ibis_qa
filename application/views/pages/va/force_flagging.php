<style>
    div.DTTT.btn-group{
        display:none !important;
    }
	.label {
		display: inline-block;
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

          </div>
					<div class="row" id="gridRequest">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<form action="<?=ROOT?>va/transaction/submit_payment" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover transaction-list" id="mastertable" style="width:100%;">
											<thead>
												<th width='30px'>No</th>
												<th width='100px'>Trx Date</th>
												<th width='100px'>Customer No</th>
												<th width='100px'>Payment Code</th>
												<th width='100px'>JKM Number</th>
                        <th width='100px'>Bank</th>
                        <th width='100px'>Amount</th>
                        <th width='100px'>Bank Status</th>
                        <th width='100px'>Bank Gateway</th>
												<th width='100px'>Merchant Status</th>
												<th width='50px'>Action</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot id="tfoot_total" class="hidden">
												<tr>
													<td colspan="6" class="text-center"><strong>Total Pembayaran</strong></td>
													<td  colspan="2" id="totalnya"></td>
												</tr>
											</tfoot>

										</table>
									</div>
									<center>
										<button class="btn btn-info hidden" id="btn_checkout" type="submit">Checkout</button>
									</center>
								</div>
								</form>
							</div>
						</div>
					</div>
					<div id="dialogViewReq"></div>

					<script>

					$(document).ready(function () {
            var url = "<?=ROOT?>va/transaction/list_force_flagging";

            $('#mastertable').DataTable( {
                "pageLength": 10,
                "destroy": true,
                "dom" : "lfrtip",
                "ajax": {
                "url": url,
                data : function (d) {
                      d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                },
                "type": "POST"
                },
                "columns": [
                            { "data": "id" },
                            { "data": "trx_date" },
                            { "data": "customer" },
                            { "data": "payment_code" },
                            { "data": "jkm_number" },
                            { "data": "bank_name" },
                            { "data": "amount" },
                            { "data": "status_bank" },
                            { "data": "status_bank" },
                            { "data": "status_merchant" },
                            { "data": "action" },
                ],} );
					});
					var counter = 0;

					$("#search_reqs").on("click", function () {
						var layanan = $("#layanan").val();
						var search_input = $("#search_input").val();
						var url = "<?=ROOT?>va/transaction/list_force_flagging";

						var data_transaction = [];
						if(sessionStorage.getItem("data_transaction")){
							var sessionnya = sessionStorage.getItem("data_transaction");
							data_transaction = JSON.parse(sessionnya);
						}

						$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',layanan:layanan,search_input: search_input},function(data){
							// console.log(data_transaction);
							var datanya = [];
							datanya = JSON.parse(data);
							data_transaction.push(datanya);
							sessionnya = JSON.stringify(data_transaction);
							sessionStorage.setItem("data_transaction", sessionnya);

							var newRow = $("<tr>");
							var cols = "";

              console.log(datanya);

							cols += '<td>'+(counter+1)+'</td>';
							cols += '<td>'+datanya['trx_date']+'</td>';
							cols += '<td>'+datanya['customer']+' <input type="hidden" name="proforma[]" value="'+datanya["customer"]+'"></td>';
							cols += '<td>'+datanya['customer']+'</td>';
							cols += '<td>'+datanya['service']+'</td>';
							cols += '<td>'+datanya['cabang']+'</td>';
							cols += '<td>'+datanya['amount']+' <input type="hidden" name="amount[]" value="'+datanya["amount"]+'"></input></td>';
							cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
							newRow.append(cols);

							$("table.transaction-list").append(newRow);
							counter++;

							$("#btn_checkout").removeClass("hidden");
							$("#tfoot_total").removeClass("hidden");

							var total = hitungTotal();
							$("#totalnya").text(total);


						});


					});


					$("table.transaction-list").on("click", ".ibtnDel", function (event) {
					       $(this).closest("tr").remove();
					       counter -= 1;
					       if(counter == 0){
					       		$("#btn_checkout").addClass("hidden");
					       		$("#tfoot_total").addClass("hidden");
					       }

					       var total = hitungTotal();
					       $("#totalnya").text(total);

					});

					function hitungTotal(){
						var jumlah = $("input[name=amount]").val();
						var total = 0;
						$('input[name^="amount"]').each(function() {
						    total = total + parseInt($(this).val());
						});

						return total;
					}

          function download()
          {
              var url = "<?=ROOT?>va/transaction/download_force_flagging";
              var search_input = $("#search_input").val();
              window.location.href= url + '?proforma='+search_input;
          }

          function flagging_payment()
          {
            var url = "<?=ROOT?>va/transaction/flagging_payment";
            $.ajax({
              url: url,
              type: "post",
              data: {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
                layanan: layanan,
                search: search_input
              },
              beforeSend: function() {
                $.blockUI();
              },
              success: function(response) {
                var parseResponse = JSON.parse(response);

                if (parseResponse.length == 0) {
                  alert('Maaf, data tidak ditemukan.');
                  $.unblockUI();
                }

                data = {
                  'amount': parseResponse[0].amount,
                  'trx_date': parseResponse[0].trx_date,
                  'cabang': parseResponse[0].cabang,
                  'customer': parseResponse[0].customer,
                  'customer_number': parseResponse[0].customer_number,
                  'proforma': parseResponse[0].proforma,
                  'service': parseResponse[0].service,
                  'layanan': layanan,
                  'payment_code': parseResponse[0].payment_code
                };

                if (cart_checkout.length == 0) {
                  if (parseResponse[0].payment_code != null) {
                    has_va = 1;
                    alert('Data gagal di tambahkan, proforma sudah ada nomor VA');
                  } else {
                    cart_checkout.push(data);
                    unique_proforma.push(data.proforma);
                    table_redraw();
                  }
                } else {
                  var result = unique_proforma.indexOf(data.proforma);
                  if (result != -1) {
                    alert('Gagal, Data duplicate : ' + data.proforma);
                  } else {
                    if (parseResponse[0].payment_code != null) {
                      has_va = 1;
                    } else {
                      cart_checkout.push(data);
                      unique_proforma.push(data.proforma);
                      table_redraw();
                    }
                  }

                  if (has_va > 0) {
                    alert('Data gagal di tambahkan, proforma sudah ada nomor VA');
                  }

                  console.log(result);
                }

                console.log(cart_checkout);
              },
              error: function(error) {
                alert(error.responseJSON.message);
              }
            }).done(function() {
              $.unblockUI();
            });
          }
					</script>
