<style>
    div.DTTT.btn-group{
        display:none !important;
    }
	.label {
		display: inline-block;
	}
</style>
<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});

	$( document ).ready(function() {

		$( "#table-request a" ).on( "mouseup", function() {
			$( "#table-request a" ).attr('disabled','disabled');
		});
	});

	function clickDialog1(a)
	{
		$('#dialogViewReq').load("<?=ROOT?>container/view_request/"+a)
		.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
	}
	function clickConfirm(a)
	{
		var r = confirm("Are you sure to confirm?");
		if (r == true) {
			var url = "<?=ROOT?>container/confirm_request";
			$.blockUI();
			$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',REQUEST:a}, function(data){
				$.unblockUI();
				alert(data);
				if(data=="Success")
					location.reload();
			});
		}
		$('a').removeAttr('disabled');
	}
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
                <div class="main-box">
                  <div class="main-box clearfix">
                    <header class="main-box-header clearfix">
                      <!-- <h2 class="pull-left">Search Request</h2> -->
                    </header>
                    <div class="main-box-body clearfix">
                    <form class="form-inline" action="">
                    	<div class="form-group">
	                        <label for="email">Date Filter</label>
	                        <select class="form-control" id="jenis_date">
	                        	<option value="transaction_date">Transaction Date</option>
	                        	<option value="settle_date">Settle Date</option>
	                        </select>
                      	</div>
                      	<div class="form-group">
                      		<label for="email">From</label>
                      		<input type="date" class="form-control" id="from_date"></input>
                      	</div>
                      	<div class="form-group">
                      		<label for="email">To</label>
                      		<input type="date" class="form-control" id="to_date"></input>
                      	</div>
                      	<div class="form-group">
                      		<input type="text" class="form-control" id="search_input" placeholder="search"></input>
                      	</div>
                    <!-- <div class="col-md-12">
                    	<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
                    	<input type="checkbox" class="custom-control-input" id="customControlInline">
                    	<div class="form-group example-twitter-oss"> -->
                    	  <input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success"/>
                    	  <button class="btn btn-success" onclick="download()" type="button"><i class="fa fa-file-excel-o"></i></button>
                    	<!-- </div>
                    </div> -->
                    </form>
                    </div>
                  </div>
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
									<div class="table-responsive">
                    <table id="mastertable" class="table table-hover">
      						    <thead>
      							    <tr>
          								<th>Tgl Transaksi</th>
          								<th>Kode Bayar</th>
                          <th>Tgl Akhir</th>
          								<th>Bank</th>
                          <th>Jumlah</th>
                          <th>Status Bank</th>
                          <th>Status Gateway</th>
                          <th>Status Merchant</th>
          								<th>Action</th>
      							    </tr>
      						    </thead>
      						   <tbody id=show_data>
      						   </tbody>
      					    </table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="dialogViewReq"></div>

          <div id="billPaymentFormat" style="display:none; width:80mm;">
            <div class="page-thermal">
               <div class="header-thermal">
                  <img src="http://localhost/ibis_qa/config/cube/img/logo-black.png" alt="" class="normal-logo logo-white" style="display:block; margin:0;">
               </div>
               <div>
                <h3 style="margin:0;padding:0;">Payment Code</h3>
                <h2 style="margin:0;padding:0;" id="paymentCode"></h2>
              </div>
               <div class="body-thermal">
                  <table style="width:80mm; margin-top:15px;">
                    <thead>
                      <tr>
                        <th align="left">Biller Name</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="billerName"></td>
                      </tr>
                      <tr>
                        <th align="left">Customer Name</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="customerName"></td>
                      </tr>
                      <tr>
                        <th align="left">Transaction Date</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="trxDate"></td>
                      </tr>
                    </thead>
                  </table>
               </div>
               <div class="body-thermal">
                  <table style="width:80mm; margin-top:15px;">
                    <thead>
                      <tr>
                        <th align="left">Transaction Number</th>
                        <th align="left">Amount</th>
                      </tr>
                      <tr class="billPaymentFormatThead">
                      </td>
                      <tr>
                        <th align="left">Total</th>
                        <th align="left" id="totalProforma"></th>
                      </tr>
                    </thead>
                  </table>
               </div>
               <div class="body-thermal">
                  <table style="width:80mm; margin-top:15px;">
                    <thead>
                      <tr>
                        <th align="left">Bank Channel</th>
                      </tr>
                    </thead>
                    <tbody id="bankBill">
                    </tbody>
                  </table>
               </div>
               <div class="body-thermal">
                  <table style="width:80mm; margin-top:15px;">
                    <thead>
                      <tr>
                        <th align="left">Batas Waktu Pembayaran:</th>
                      </tr>
                      <tr>
                        <td align="left" id="expiredDate"></td>
                      </tr>
                    </thead>
                  </table>
               </div>
            </div>
          </div>

          <div id="billTransactionFormat" style="display:none; width:80mm;">
            <div class="page-thermal">
               <div class="header-thermal">
                 <center>
                  <img src="http://localhost/ibis_qa/config/cube/img/logo-black.png" alt="" class="normal-logo logo-white" style="display:block; margin:0;">
                 <center>
               </div>
               <center>
                  <h3>Payment Code</h3>
                  <h2 class="paymentCodeTrx"></h2>
               </center>
               <div class="body-thermal">
                  <table style="width:80mm;">
                    <thead>
                      <tr>
                        <th align="left">Payment Code</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" class="paymentCodeTrx"></td>
                      </tr>
                      <tr>
                        <th align="left">Biller Name</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="billerNameTrx"></td>
                      </tr>
                      <tr>
                        <th align="left">Customer Name</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="customerNameTrx"></td>
                      </tr>
                      <tr>
                        <th align="left">Payment Status</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="paymentStatusTrx"></td>
                      </tr>
                      <tr>
                        <th align="left">Payment Date</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="PaymentDateTrx"></td>
                      </tr>
                      <tr>
                        <th align="left">Bank Name</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="BankTrx"></td>
                      </tr>
                      <tr>
                        <th align="left">Channel</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left">H2H</td>
                      </tr>
                      <tr>
                        <th align="left">Refnum</th>
                        <th align="left" style="vertical-align:top;">:</th>
                        <td align="left" id="RefNumTrx"></td>
                      </tr>
                    </thead>
                  </table>
               </div>
            </div>
          </div>


					<script>
          $(document).ready(function() {
            load_table();

            var date = new Date();
            var currentDate = date.toISOString().slice(0,10);
            var currentTime = date.getHours() + ':' + date.getMinutes();

            document.getElementById('from_date').value = currentDate;
            document.getElementById('to_date').value = currentDate;
          });

          function load_table()
            {
              //alert('test');
              $.blockUI();
              var url = "<?=ROOT?>va/transaction/search_transaction";
              var search_input = $("#search_input").val();
              var jenis_date = $("#jenis_date").val();
              var from_date = $("#from_date").val();
              var to_date = $("#to_date").val();
              var limit = $("#pagelimit").val();

              $('#mastertable').DataTable( {
          				"pageLength": 10,
          				"destroy": true,
          				"dom" : "lfrtip",
                  "order": [[ 0, "desc" ]],
          				"ajax": {
        			    "url": url,
        			    data : function (d) {
        	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
        	          		d.layanan = jenis_date;
        	          		d.search = search_input;
                        d.to_date = to_date;
                        d.from_date = from_date;

        		      },
        			    "type": "POST"
          			  },
          				"columns": [
          										{ "data": "trx_date" },
                              { "data": "payment_code" },
                              { "data": "expired_date" },
                              { "data": "bank_name" },
                              { "data": "amount" },
                              { "data": "status_bank"},
                              { "data": "status_payment"},
                              { "data": "status_merchant" },
                              { "data": "action" },
          				],} );
              $.unblockUI();
            }

            function download()
            {
                var url = "<?=ROOT?>va/transaction/download_transaction";
                var search_input = $("#search_input").val();
                var jenis_date = $("#jenis_date").val();
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();
                var limit = $("#pagelimit").val();

                const date1 = new Date(from_date);
                const date2 = new Date(to_date);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                console.log(diffDays);


                if(from_date == '' || from_date == NaN) {
                  alert('Maaf, silahkan isi tanggal di kolom FROM / format tanggal anda salah');
                }

                if(to_date == '' || to_date == NaN) {
                  alert('Maaf, silahkan isi tanggal di kolom TO / format tanggal anda salah');
                }

                if(diffDays > 30) {
                  from_date = $("#from_date").val('');
                  to_date = $("#to_date").val('');
                  alert('Maaf, data yang di export tidak boleh melebihi dari 30 hari.');
                }

                if(diffDays < 30 && diffDays > -1) {
                  console.log(diffDays);
                  window.location.href= url + '?jenis_date='+jenis_date+'&from_date='+from_date+'&to_date='+to_date;
                }

            }

            function print_bill(customer_number, payment_code)
            {
                var url = "<?=ROOT?>va/transaction/get_print_bill";
                $.ajax({
                  url: url,
                  type: "post",
                  data: {
                    <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                    payment_code: payment_code,
                    customer_number: customer_number
                  },
                  beforeSend: function() {
                    $.blockUI();
                  },
                  success: function(response) {
                    var parseResponse = JSON.parse(response);
                    var total = 0;
                    var biller_name = 0;
                    var customer_name = 0;
                    var payment_code = 0;
                    var expired_date = 0;
                    var trx_date = 0;
                    if(parseResponse.status == 'success') {

                      $('.billPaymentFormatThead').html("");
                      $('#totalProforma').html("");
                      $('#billerName').html("");
                      $('#customerName').html("");
                      $('#paymentCode').html("");
                      $('#expiredDate').html("");
                      $('#trxDate').html("");
                      $('#bankBill').html("");

                      parseResponse.result.forEach(function(row) {
                        table = $('.billPaymentFormatThead').append(`
                          <tr>
                            <td align="left">${row.proforma}</td>
                            <td align="left">${row.amount_format}</td>
                          </tr>
                          `);
                          total = parseInt(total) + parseInt(row.amount);
                          biller_name = row.biller_name;
                          customer_name = row.customer_name;
                          payment_code = row.payment_code;
                          expired_date = row.expired_date;
                          trx_date = row.trx_date;
                      });

                      if(parseResponse.banks == null){

                      }else {
                        parseResponse.banks.forEach(function(row){
                          table = $('#bankBill').append(`
                            <tr>
                              <td align="left">${row.bank}</td>
                              <td align="left">:</td>
                              <td align="left">${row.payment_code}${row.payment_code}${parseResponse.result[0].payment_code}</td>
                            </tr>
                            `);
                        });
                      }

                      $('#totalProforma').append('Rp. ' + parseResponse.total);
                      $('#billerName').append(biller_name);
                      $('#customerName').append(customer_name);
                      $('#paymentCode').append(payment_code);
                      $('#expiredDate').append(expired_date);
                      $('#trxDate').append(trx_date);

                      var print_div = document.getElementById("billPaymentFormat");
                      print_div.style.visibility = "block";
          						var print_area = window.open();
          						print_area.document.write(print_div.innerHTML);
          						print_area.document.close();
          						print_area.focus();
          						print_area.print();
          						print_area.close();
                    } else {

                    }
                  },
                  error: function(error) {
                    alert(error.responseJSON.message);
                  }
                }).done(function() {
                   $.unblockUI();
                });
                // var print_div = document.getElementById("billPaymentFormat");
                // print_div.style.visibility = "block";
    						// var print_area = window.open();
    						// print_area.document.write(print_div.innerHTML);
    						// print_area.document.close();
    						// print_area.focus();
    						// print_area.print();
    						// print_area.close();
    						// This is the code print a particular div element
            }

            function print_transaction(customer_number, payment_code)
            {
              var url = "<?=ROOT?>va/transaction/get_print_payment";
              $.ajax({
                url: url,
                type: "post",
                data: {
                  <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                  payment_code: payment_code,
                  customer_number: customer_number
                },
                beforeSend: function() {
                  $.blockUI();
                },
                success: function(response) {
                  var parseResponse = JSON.parse(response);
                  var total = 0;
                  var biller_name = 0;
                  var customer_name = 0;
                  var payment_code = 0;
                  if(parseResponse.status == 'success') {

                    $('.paymentCodeTrx').html("");
                    $('#billerNameTrx').html("");
                    $('#customerNameTrx').html("");
                    $('#paymentStatusTrx').html("");
                    $('#PaymentDateTrx').html("");
                    $('#BankTrx').html("");
                    $('#trxDate').html("");


                    $('.paymentCodeTrx').append(parseResponse.result.payment_code);
                    $('#billerNameTrx').append(parseResponse.result.biller_name);
                    $('#customerNameTrx').append(parseResponse.result.customer_name);
                    $('#paymentStatusTrx').append(parseResponse.result.payment_gateway);
                    $('#PaymentDateTrx').append(parseResponse.result.paid_date);
                    $('#BankTrx').append(parseResponse.result.bank);
                    $('#trxDate').append(parseResponse.result.trx_date);

                    console.log(parseResponse);

                    var print_div = document.getElementById("billTransactionFormat");
                    var print_area = window.open();
                    print_div.style.visibility = "block";
        						print_area.document.write(print_div.innerHTML);
        						print_area.document.close();
        						print_area.focus();
        						print_area.print();
        						print_area.close();
                  } else {

                  }
                },
                error: function(error) {
                  alert(error.responseJSON.message);
                }
              }).done(function() {
                 $.unblockUI();
              });
            }

            function cancel_transaction(customer, va){
              var r = confirm("Are you sure to confirm?");
              if(r == true) {
                doCancelTransaction(customer, va);
              }
            }

            function doCancelTransaction(customer, va)
            {
              var url = "<?=ROOT?>va/transaction/remove_transaction";
              $.ajax({
                url: url,
                type: "post",
                data: {
                  <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                  payment_code: va,
                  customer_number: customer
                },
                beforeSend: function() {
                  $.blockUI();
                },
                success: function(response) {
                  var parseResponse = JSON.parse(response);
                  if(parseResponse.status == 'success') {
                    alert('Success, data telah berhasil di hapus');
                    load_table();
                  } else {
                    alert('Gagal, data tidak terhapus');
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
