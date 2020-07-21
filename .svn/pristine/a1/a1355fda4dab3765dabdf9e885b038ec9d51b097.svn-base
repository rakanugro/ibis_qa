<style type="text/css">
.centered
{
    text-align:center;
}
th{
	text-align: center;
	width: 20px;
}
tbody>tr>td:nth-child(6){text-align:center;}
tbody>tr>td:nth-child(8){text-align:center;}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Kapal</li>
			<li class="active"><span>KK</span></li>
		</ol>

		<h1>DATA KOREKSI KAPAL</h1>
	</div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal" action="javascript:loaddata()" method="post" id="search_form">
							<div class="col-md-8">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label text-center">Tanggal Awal</label>
											<div class="row">
												<div class="col-xs-3 text-right">
													<div class='input-group date' id='datetimepicker2'>
														<input type='date' class="form-control" name="TGL_JAM_TIBA" id="tgl_tiba"  placeholder="mm/dd/yyyy"/>

													</div>
													<div class="help-block with-errors"></div>

												</div>
											<label for="" class="col-sm-2 control-label text-center">Tanggal Akhir</label>
												<div class="col-xs-3 text-right">
													<div class='input-group date' id='datetimepicker2'>
														<input type='date' class="form-control" name="TGL_JAM_BERANGKAT" id="tgl_berangkat" placeholder="mm/dd/yyyy"/>

													</div>
													<div class="help-block with-errors"></div>
												</div>
					                		</div>
					             		</div>
				             		</div>
								</div>
							</div>


								<div class="box-body">
							            <div class="col-sm-12 text-right">
								              <button type="button" class="btn btn-primary btn-sm" data-toggle="" data-target="" onclick="clearreset()"> Clear</button>
								              <button  type="submit" id="submit" name="submit"  class="btn btn-primary btn_user_save btn-sm"> <i class="fa fa-search"></i> Search</button>
							            </div>
			  					</div>


						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table id="table-example" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>No PKK</th>
								<th>No PPKB</th>
								<th>Customer</th>
								<th>Kapal</th>
								<th class="col-md-2">Tanggal Berangkat</th>
								<th>Pukul</th>
								<th class="col-md-2">Ket</th>

							</tr>
						</thead>
						<tbody>


						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="form_dtjk" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div id="review">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">DTJK DPJK <span class="text-help"></span></h4>
	        </div>
			<div class="modal-body" style="height:500px; ">
				<input type="text" id="ukk_ready" value=""  class="hidden">
				<input type="text" id="cab_ready" value="" class="hidden">
				<input type="text" id="ppkb_ready" value="" class="hidden">
				<span class="text-me"></span>
			</div>

			<div class="modal-footer">
				<a href="javascript:void(0)" id="invoicing" class="btn btn-primary btn-sm" data-id="" onClick="create_invoice()" ><i class="fa fa fa-file-text-o"></i> Invoice</a>
			<button type="button" class="btn btn-sm pull-left" data-dismiss="modal">Tutup</button>
			</div>

	    </div>

	   </div>

	</div>

</div>





<div id="confirmModal" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">

		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Confirmation</span></h4>
	        </div>
			<div class="modal-body" style="height:300px; ">
				<span class="convert_help">Apakah Anda yakin untuk  mengubah status nota ini menjadi 4A?</span>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm" id="ok">OK</button>
				<button type="button" data-dismiss="modal" class="btn btn-primary btn-sm">Cancel</button>
			</div>

	    </div>


	</div>

</div>





<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js">
</script>

<script type="text/javascript">
	 //$('#tgl_tiba').datepicker({
	 	//autoclose: true,
	 	//format: 'dd-mm-yyyy',
	 //});
	 //$('#tgl_berangkat').datepicker({
	 	//autoclose:true,
	 	//format: 'dd-mm-yyyy',
	 //});
</script>

<script>

function clearreset() {
	window.location.reload(true);
}
//loaddata();
$( document ).ready(function() {
  loaddata();
	});

//var table;

function loaddata() {
  var
  // KD_CABANG 			= 10,
  TGL_JAM_TIBA 		= $("#tgl_tiba").val();
  TGL_JAM_BERANGKAT 	= $("#tgl_berangkat").val();
  		var path = "<?php echo ROOT.'einvoice/nota/kapalkoreksi';?>";
  		$('#table-example').DataTable({
  		//"processing": true, //Feature control the processing indicator.
      "destroy" : true,
  		"order": [[ 5, "desc" ], [6,"desc"]],
  		 //Initial no order.
  		"dom" :"brtlp",
  		"ajax": {
  					"url": path,
  					"type": "POST",
  					"dom":"brtlp",
  					"data":function (data){
  					       data.<?php echo $this->security->get_csrf_token_name(); ?> ='<?php echo $this->security->get_csrf_hash(); ?>';
  					       // data.KD_CABANG = KD_CABANG;
  					       data.TGL_JAM_TIBA = $("#tgl_tiba").val();;
  					       data.TGL_JAM_BERANGKAT = $("#tgl_berangkat").val();;
  					       // data.UNIT_CODE = '<?php echo $this->session->userdata('unit_id') ?>';
  					     },
  		},
  		//Set column definition initialisation properties.
  			});
}

</script>



<script>
function link_kapal(){
	window.location.href="<?php echo ROOT;?>einvoice/nota/adv_kapal_koreksi";
}
//$('#search_form').validator().on('submit', function (e) {
	//	if (e.isDefaultPrevented()) {
		//	return false;
		// handle the invalid form...
		//} else {
			//table.ajax.reload(null,false); //reload datatable ajax
			//return false;
	//	}
// });
function refresh(){
	//$('#search_form').reset[0];
	$('#search_form')[0].reset();
	table.ajax.reload(null,false); //reload datatable ajax
}

$("#search_form").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

  $(document).on('click','.btn-ok',function(e){

                 var ukk = $(this).attr('data-id');
                 var cab 	= $(this).attr('data-branch');
                 var ppkb = $(this).attr('data-ppkb');
                $("#invoicing").css("display","none");
                jQuery.ajax({

	           		url: '<?php echo ROOT;?>dashboard_invoice/cekInvoicingKoreksi/'+ukk,
	                type: "POST",
	               	data: {
		               	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                  	},
	                success:function(data){
	                	console.log("====>"+data);
	                	if(data=="1"){
	                		$("#invoicing").css("display","");
	                	}else{
	                		alert('Data kapal belum dapat invoicing.');
	                	}
	                },
	                error: function (jqXHR, textStatus, errorThrown){
				 	  	alert('False Exeption while request..');
				 		return false;
				 	}
	        	});
                 // alert(ukk + '-' + cab +'-'+ppkb);
                 $('#form_dtjk').modal({

						show:true,
						backdrop:'static'



				});
                 $('.text-help').text(ukk);

                 // $( "#review" ).load(window.location.href + " #review" );

                 jQuery.ajax({

	           		url: '<?php echo ROOT;?>dashboard_invoice/cetak_dpjk/'+ukk+'/'+cab+'/'+ppkb,
	                type: "POST",
		               data: {
		               	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
	                  	NO_UKK:ukk,
	                  	BRANCH_CODE:cab,
	                  	KD_PPKB:ppkb
	                  },

	                beforeSend: function() {
	                       $('.text-me').text('  Loading data... Please wait');
	                       $('.check_invoice').attr('disabled',true);

	                 		},
	                success:function(data){
	                	$('.text-help').text(ukk);
						var url ='<?php echo ROOT;?>dashboard_invoice/cetak_dpjk/'+ukk+'/'+cab+'/'+ppkb;
	                	$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" /></iframe>')
						$('#ukk_ready').val(ukk);
						$('#cab_ready').val(cab);
						$('#ppkb_ready').val(ppkb);
						 $('.check_invoice').attr('disabled',false);
	     //            	$('.modal-body').load(location.href );
	     //            	$('.the_pdf').attr('src', url);



	                },
	                 error: function (jqXHR, textStatus, errorThrown){
				 	  	alert('False Exeption while request..');
				 	 	 return false;
				 	 }





	        	});



        });

var ukk_ready = 0;
function create_invoice(){
ukk_ready = $('#ukk_ready').val();
//var cab_ready = $('#cab_ready').val();
//var ppkb_ready = $('#ppkb_ready').val();
//+ukk_ready+'-'+cab_ready+'-'+ppkb_ready
$('.convert_help').text('Apakah Anda yakin untuk  mengubah status nota ini menjadi 4A?');

$('#confirmModal').modal("show");

$('#ok').on('click', function (e) {
				$('#ok').attr('disabled',true);
                $.ajax(
                 {
                     url: "<?php echo ROOT;?>einvoice/nota_kapal/convert_invoice/",
                     type: "POST",
                     data: {
                     	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                        NO_UKK	: ukk_ready,
                        ORG_ID 	: 89, //masih statis nanti diganti session
                        NO_PPKB : ppkb_ready
                     },
                    beforeSend: function() {

                    $('.convert_help').text('Updating...');

                     },


                    success: function (e) {

                    	$('.convert_help').text(e);
                    	$('.convert_help').text('Success!');
                    	$('#ok').attr('disabled',false);
                    	/*table.ajax.reload(null,false);*/ //reload datatable ajax

                    	setTimeout(function(){
                    		$('#confirmModal').modal("toggle");
                            }, 10000);

                    	setTimeout(function(){
                    		$('#form_dtjk').modal("toggle");
                            }, 10002);
                    	// window.locatio n.href="<?php echo ROOT; ?>einvoice/nota/kapal?UKK_CREATE="+ukk_ready;
						/*clearreset();*/
						// window.location.reload(true);

                     },
	                error: function (jqXHR, textStatus, errorThrown){
				 	  	alert('False Exeption while request..');
				 	 	 return false;
				 	 }

                 });



       });


}




function SetDate($date){
		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
							"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var dt1;
		var formattedDate1 = new Date($date);
		var d1 = formattedDate1.getDate();
		var m1 = monthNames[formattedDate1.getMonth()];
		var y1 = formattedDate1.getFullYear();
		dt1  = d1+'-'+m1+'-'+y1;

		return dt1;
	}

	function GetDate(str)
	{
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1+months.indexOf(arr[1].toLowerCase())).toString();
		if(month.length==1) month='0'+month;
		var year = '20' + parseInt(arr[2]);
		var day = parseInt(arr[0]);
		var result = year + '-' + month + '-' + ((day < 10 ) ? "0"+day : day);
		return result;
	}
	function GetDateCustom(str)
	{
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1+months.indexOf(arr[1].toLowerCase())).toString();
		if(month.length==1) month='0'+month;
		var year = '20' + parseInt(arr[2]);
		var result = month + '/' + parseInt(arr[0]) + '/' + year ;
		return result;
	}
</script>
