<style type="text/css">
.centered
{
    text-align:center;
}
th{
	text-align: center;
	width: 20px;
}

tbody>tr>td:nth-child(7){text-align:right;}
tbody>tr>td:nth-child(8){text-align:center;}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}

</style>
<?php
$no_ukk_create='';
if($no_ukk_create!= null) {
	$no_ukk_create =$_GET["UKK_CREATE"];
}

?>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Kapal</li>
			<li class="active"><span>Nota</span></li>
		</ol>

		<h1>NOTA KOREKSI KAPAL</h1>
	</div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
						<form class="form-horizontal" action="javascript:void(0);" id="formsearch">
							<div class="col-md-5">
								<div class="box-body">
									

									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No UKK</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="NO_UKK" id="NO_UKK" class="form-control" placeholder="No UKK" value="<?php echo $no_ukk_create ?>">
												</div>
											</div>
										</div>
									</div>

									
									<div class="form-group">
									
				               		</div>
								</div>
							</div>
	<!--						<div class="col-md-7">
								<div class="box-body">
								<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">KD PPKB</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="KD_PPKB" id="KD_PPKB" class="form-control" placeholder="No KD PPKB">
												</div>
											</div>
										</div>
									</div>
								
								</div>
							</div>-->


                            <div class="box-body">
							            <div class="col-sm-12 text-right">
								              <button type="button"  class="btn btn-primary btn-sm" data-toggle="" data-target="" onclick="clearreset()"> Clear</button>
								              <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i> Search</a></button>
							          		<!-- </div> -->
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
								<!-- <th>#</th> -->
						<!--		<th>No Nota</th>-->
                                <th>No UKK</th>
                                <th>No PPKB</th>
								<th>Jenis Nota</th>
								<th>Tanggal Nota</th>
								<th>Customer</th>
								<th>Jumlah Total</th>
								<th>Status Bayar</th>
								<th>Pernah Cetak</th>
								<th>Pernah Kirim</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
						<tr><td colspan="10" align="center">Silahkan lakukan pencarian terlebih dahulu</td></tr>
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
				<a href="javascript:void(0)" id="invoicing" class="btn btn-primary btn-sm" data-id="" onClick="create_invoice()" ><i class="fa fa fa-file-text-o"></i> Koreksi</a>
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
<script type="text/javascript">
 //    $(".form_datetime").datepicker({
 //        format: "dd/mm/yyyy",
 //        todayBtn: true,
 //        autoclose: true,
 //    });
    function clearreset() {
    	window.location.reload(true);	
    }

    function clearsearch(){
    	$("#NO_PPKB").val("");
		$("#NO_UKK").val("");
		$("#ID_NOTA").val("");
		$("#CUSTOMER").val("");
		$("#STATUS_BAYAR").val("");
		$("#TGL_NOTA_START").val("");
		$("#TGL_NOTA_FINISH").val("");
		loaddata();
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

  $("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

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
	
var ukk_ready = 0;
function create_invoice(){

ukk_ready = $('#ukk_ready').val();

var cab_ready = $('#cab_ready').val();

var ppkb_ready = $('#ppkb_ready').val();

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
</script>



<script>
	var table ;
	var tableinit= false;
	$(document).ready(function() {
		
		});

	function loaddata(){
		if(tableinit== false){
			initdatatable();
			tableinit= true; 
		}else {
		table.ajax.reload(null,false); //reload datatable ajax
		}
	}
	
	function initdatatable() {
		var path = '';
		path = "<?php echo ROOT.'einvoice/nota/kapalkoreksi';?>";


		table = $('#table-example').DataTable({
		"processing": true, //Feature control the processing indicator.
		"order": [[ 4, "desc" ]], //Initial no order.
		"dom" :"brtlp",
		"ajax": {
					"url": path,
					"type": "POST",
					"dom":"brtlp",
					"data":function (data){
					       data.<?php echo $this->security->get_csrf_token_name(); ?> ='<?php echo $this->security->get_csrf_hash(); ?>';
					       data.MODULE 			= 'KAPAL';
					       data.TRX_NUMBER 		= $("#ID_NOTA").val();
					       data.CUSTOMER_NAME 	= $("#CUSTOMER").val();
					       data.NO_UKK			= $("#NO_UKK").val();
					       data.NO_PPKB			= $("#NO_PPKB").val();
						   data.KD_PPKB			= $("#KD_PPKB").val();
					       data.START_DATE		= $("#TGL_NOTA_START").val();
					       data.END_DATE		= $('#TGL_NOTA_FINISH').val();
					       data.STATUS_LUNAS	= $("#STATUS_BAYAR").val();
					       data.KODE_LAYANAN	= $("#KODE_LAYANAN").val();
						   data.KODE_LAYANAN	= $("#KODE_LAYANAN").val();
					       //tambahan
					       data.UNIT_CODE 		= '<?php echo $this->session->userdata('unit_id') ?>';
					       data.ROLE_TYPE		= '<?php echo $this->session->userdata('role_type') ?>';
					       data.ORG_ID			= '<?php echo $this->session->userdata('unit_org') ?>';
					     },
		},
		//Set column definition initialisation properties.
			});
	} 

	$(document).on('click','.btn-ok',function(e){

                 var ukk = $(this).attr('data-id');
                 var cab 	= $(this).attr('data-branch');
                 var ppkb = $(this).attr('data-ppkb');
               /* $("#invoicing").css("display","none");
                jQuery.ajax({

	           		url: '<?php echo ROOT;?>dashboard_invoice/cekInvoicing/'+ukk,
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
	        	});*/
                 // alert(ukk + '-' + cab +'-'+ppkb);
                 $('#form_dtjk').modal({

						show:true,
						backdrop:'static'



				});
                 $('.text-help').text(ukk);

                 // $( "#review" ).load(window.location.href + " #review" );

                 jQuery.ajax({

	           		url: '<?php echo ROOT;?>einvoice/nota/cetak_koreksi/'+ukk+'/'+ppkb,
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
						var url ='<?php echo ROOT;?>einvoice/nota/cetak_koreksi/'+ukk+'/'+ppkb;
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

	function exportall(){
			var TRX_NUMBER 		= $("#ID_NOTA").val();
			var CUSTOMER_NAME 	= $("#CUSTOMER").val();
			var NO_PKK			= $("#NO_PKK").val();
			var NO_PPKB			= $("#NO_PPKB").val();
			var START_DATE		= $("#TGL_NOTA_START").val();
			var END_DATE		= $('#TGL_NOTA_FINISH').val();
			var STATUS_LUNAS	= $("#STATUS_BAYAR").val();
			var KODE_LAYANAN	= $("#KODE_LAYANAN").val();
		window.open('<?php echo ROOT.'einvoice/nota_kapal/cetak_nota_kapal_all';?>?'
			+"TRX_NUMBER="+TRX_NUMBER+"&"
			+"CUSTOMER_NAME="+CUSTOMER_NAME+"&"
			+"NO_PKK="+NO_PKK+"&"
			+"NO_PPKB="+NO_PPKB+"&"
			+"START_DATE="+START_DATE+"&"
			+"END_DATE="+END_DATE+"&"
			+"STATUS_LUNAS="+STATUS_LUNAS+"&"
			+"KODE_LAYANAN="+KODE_LAYANAN+"&"
			+"ORG_ID="+'<?php echo $this->session->userdata('unit_org') ?>'+"&"
			,'_blank');
		
	}
</script>


<script type="text/javascript">

function link_kapal(){
	window.location.href="<?php echo ROOT;?>einvoice/nota/adv_kapal_koreksi";
}

function Cetak(){
	location.reload();
}

function cetak_nota(){
	
}







</script>
