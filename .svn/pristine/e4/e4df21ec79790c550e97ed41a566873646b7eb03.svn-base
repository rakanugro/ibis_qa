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
                    <div class="col-md-6 col-md-offset-3">
                    	<div class="form-group">
                    	    <label>Layanan</label>
                          <select class="form-control" id="layanan" name="layanan">
                              <?php foreach($services[0] as $service) : ?>
                    	        <option value="<?php echo $service; ?>"><?php echo $service; ?></option>
                              <?php endforeach; ?>
                    	    </select>
                    	</div>
                    	<div class="form-group">
                    	  <label for="exampleAutocomplete">Customer Number</label>
                    	  <input type="text" class="form-control" id="search_input" name="search_input" value="" placeholder="">
                    	</div>

                    	<div class="form-group example-twitter-oss">
                    	  <input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success"/>
                    	</div>
                    </div>

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
                          <th></th>
          								<th>No</th>
          								<th>Tgl Transaksi</th>
          								<th>Layanan</th>
          								<th>No Faktur</th>
          								<th>Nama Pelanggan</th>
                          <th>Cabang</th>
                          <th>Jumlah Tagihan</th>
                          <th>Payment Code</th>
      							    </tr>
      						    </thead>
      						   <tbody id=show_data>
      						   </tbody>
      					    </table>
                    <div>
                      <center>
                        <button class="btn btn-success" onclick="add_to_cart()" id="btn_cart" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add To Cart</button>
    										<a href="<?=ROOT?>va/transaction/cart" class="btn btn-info" id="btn_cart" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
    									</center>
                    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="dialogViewReq"></div>

					<script>
          function load_table()
            {
              //alert('test');
              $.blockUI();
              var layanan 	= $("#layanan").val();
          		var search 	  = $("#search_input").val();
              var url = "<?=ROOT?>va/transaction/search_by_customer";
              $('#mastertable').DataTable( {
          				"pageLength": 10,
          				"destroy": true,
          				"dom" : "lfrtip",
          				"ajax": {
          			    "url": url,
          			    data : function (d) {
          	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
          	          		d.layanan = layanan;
          	          		d.search = search;

          		      },
          			    "type": "POST",
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        // Note: You can use "textStatus" to describe the error.
                        // Custom
                        switch(jqXHR.status)
                        {
                            case 404:
                                alert('Nota oleh pelanggan tersebut tidak ditemukan, error : 404');
                            break;

                            case 500:
                                alert('Nota oleh pelanggan tersebut tidak ditemukan, error : 500');
                            break;

                            default:
                                alert('Unexpected unknow error');
                            break;
                        }
                    }
            			},
          				"columns": [
                              { "data": "checkbox" },
          										{ "data": "id" },
          										{ "data": "trx_date" },
                              { "data": "service" },
          										{ "data": "proforma" },
          										{ "data": "customer" },
          										{ "data": "cabang" },
                              { "data": "amount_currency" },
                              { "data": "payment_code"}
        				               ]} );
              $.unblockUI();
            }

          function add_to_cart()
          {
            var r = confirm("Apakah anda yakin akan membayar proforma di list?");
            if (r == true) {
              doAddToCart();
            } else {

            }
          }

          function doAddToCart()
          {
            var collections = [];

            var checkedBoxes = document.querySelectorAll('input[name=mycheckboxes]:checked');
            if(checkedBoxes.length > 0) {
               checkedBoxes.forEach(function(row) {
                 collections.push(row.value);
               });

               var add_to_cart_url = "<?=ROOT?>va/transaction/add_to_cart";

               console.log(collections);

               $.ajax({
                 url: add_to_cart_url,
                 type: "post",
                 data: {
                   <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                   data : collections,
                   layanan : $("#layanan").val()
                 },
                 beforeSend: function() {
                  $.blockUI();
                 },
                 success: function(response) {
                     var parseResponse = JSON.parse(response);
                     alert('Keranjang berhasil di update, proforma sukses: ' + parseResponse.success + ' dan proforma gagal: ' + parseResponse.failed + ' karena sudah berada di keranjang.');
                 },
                 error: function(error) {
                   alert('Gagal, Tidak berhasil di tambahkan di keranjang');
                 }
               });
            }
            $.unblockUI();
          }

					</script>
