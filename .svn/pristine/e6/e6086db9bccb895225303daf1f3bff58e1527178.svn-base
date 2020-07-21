<script>
	function button_confirm(){
		var url="<?=ROOT?>/container/save_payment_confirmation";
		var no_request = $("#no_request").val();
		var no_proforma=$( "#no_proforma" ).val();
		var method=$( "#method" ).val();
		var via=$( "#via" ).val();
		var amount=$( "#total_payment" ).val();
		
		if (amount == '' || amount == '0')
		{
			alert("Jumlah yang dibayarkan harus diisi");
			$( "#total_payment" ).focus();
			return;
		}
		
		$.post(url,{no_request:no_request,no_proforma:no_proforma,method:method,via:via,amount:amount},
		function(data){	
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert('Save gagal : '+v_msg);
				return false;
			}
			else
			{
				alert('Payment Confirmation Success');
				window.location = "<?=ROOT?>/container/payment";
			}	
		});	
	}
</script>
<script>
	$(document).ready(function() {
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[!@a><a-zA-Z\*\-_#=,.;:'"()?%~`$^&+{}|\[\]/\\]/gi, ''));
		});
	});
</script>
							
					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Data Permintaan</h2>
								</header>
								
									<div class="main-box-body clearfix">
										<div class="form-group">
											Pembayaran dapat dilakukan melalui Transfer, ATM, dan Internet Banking bank-bank berikut ini:</br>
											<!--<table>
											<tr>
												<td>
													<img src="<?=CUBE_?>img/bri.png" alt="" height="40"> 
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													PTP BRI IDR 0186.01.000966.30.5
												</td>
											</tr>
											<tr>
												<td>
													<img src="<?=CUBE_?>img/mandiri.jpg" alt="" height="40">
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													PTP Mandiri IDR 120.00.4107201.3
												</td>
											</tr>
											<tr>
												<td>
													<img src="<?=CUBE_?>img/bni.jpg" alt="" height="40"> 
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													PTP BNI IDR 888.600.2013
												</td>
											</tr>
											<tr>
												<td>
													<img src="<?=CUBE_?>img/niaga.png" alt="" height="30">
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													PTP CIMB Niaga IDR 428.01.00607.00.3
												</td>
											</tr>
											</table>-->
										</div>
										<div class="form-group">
											<label for="exampleTooltip">No Permintaan</label>
											<input name="no_request" id="no_request" type="text" class="form-control" placeholder="-" data-toggle="tooltip" data-placement="bottom" title="Nomor Permintaan" size="20" value="<?=$no_request?>" readOnly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">No Proforma</label>
											<input name="no_proforma" id="no_proforma" type="text" class="form-control" placeholder="-" data-toggle="tooltip" data-placement="bottom" title="Nomor Proforma" size="20" value="<?=$id_proforma?>" readOnly>
										</div>
										<div class="form-group">
												<label>Metode Pembayaran</label>
												<select id="method" name="method" class="form-control">
													<option value="ATM">ATM</option>
													<option value="INTBANK">Internet Banking</option>
												</select>
										</div>
										<div class="form-group">
												<label>Bank Tujuan</label>
												<select id="via" class="form-control">
													<option value="PTP BRI IDR 0186.01.000966.30.5">PTP BRI IDR 0186.01.000966.30.5</option>
													<option value="PTP Mandiri IDR 120.00.4107201.3">PTP Mandiri IDR 120.00.4107201.3</option>
													<option value="PTP BNI IDR 888.600.2013">PTP BNI IDR 888.600.2013</option>
													<option value="PTP CIMB Niaga IDR 428.01.00607.00.3">PTP CIMB Niaga IDR 428.01.00607.00.3</option>
												</select>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Jumlah Yang Dibayarkan</label>
											<input name="total_payment" id="total_payment" type="text" class="form-control" placeholder="" data-toggle="tooltip" data-placement="bottom" title="Total Pembayaran" size="20">
										</div>
										<button onclick="button_confirm()" class="btn btn-success" name="button_confirm" id="button_confirm">Simpan</button>
								</div>								
							</div>
						</div>	
					</div>
				</div>
			</div>