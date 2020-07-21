<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
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

<style type="text/css">
.separate_content {
	width:31%;
    height:100px;
    border:1px solid red;
    margin-right:10px;
    float:left;
}

.btn_click{
	cursor: pointer;
	background: #cdcdcd;
	padding: 7px;
	border-radius: 20%;
	font-size: 13px;
	color: #000;
}

.glyphicon:hover{
	font-size: 15px;
	background: #717171;
}
</style>

<div>
</div>

<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>

<div class="col-lg-12">
	<div class="main-box clearfix">
	    <div class="main-box-body clearfix">
		 	<div class="table-responsive">
		  		<table class="table table-striped table-hover table-bordered" id="example">
				  	<thead>
				    	<tr>
				    		<th></th>
					      	<th scope="col">NO REQUEST</th>
					      	<th scope="col">TANGGAL REQUEST</th>
					      	<th scope="col">CUSTOMER NAME</th>
					      	<th scope="col">NAMA VESSEL</th>
					      	<th scope="col">STATUS</th>
					      	<th scope="col">REMARK</th>
					      	
					      	<th scope="col" >ACTION</th>
				    	</tr>
				  	</thead>
			  		<tbody>
					    
			  		</tbody>
				</table>
			</div>	
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {
	    var table = $("#example tbody");
		//var booking_type = 'receiving';

		$.ajax({
		    type: "GET",

		   	url: "<?=ROOT?>npkbilling/approval_receiving/getListApprovalReceiving",
	    	data: {},  // <== change is here
		    success: function(data){

		    	//console.log(data);
		    	
		    	var obj = JSON.parse(JSON.parse(data));

		    	

		    	console.log(obj);
		    	var arr =[];
	            var jmlresponse =  obj['result']['length'];
	            //alert(jmlresponse);
	            for(i=0;i<jmlresponse;i++)
				{
					
					//var bm_no						= obj[i]['bm_no'];
					//var rec_no          		=obj['result'][i]['rec_no'];
					var rec_date				=obj['result'][i]['rec_date'];
					var rec_cust_name			=obj['result'][i]['rec_cust_name'];	
					var rec_vessel_name			=obj['result'][i]['rec_vessel_name'];
					var rec_status				=obj['result'][i]['rec_status'];
					var rec_mark 				=obj['result'][i]['rec_mark'];


				}

				obj['result'].forEach(function(abc) {
					if(abc.rec_mark == null) abc.rec_mark = "N/A"; 
				    table.append(
				       '<tr>' +

							'<td>'+ '<Input type = "Radio" name ="radio">' +'</td>' +	
						    '<td>'+ abc.rec_no +'</td>' +
						    '<td>'+ abc.rec_date +'</td>' +
						    '<td>'+ abc.rec_cust_name +'</td>' +
						    '<td>'+ abc.rec_vessel_name +'</td>' +
						    '<td>'+ abc.reff_name +'</td>' +
						    '<td>'+ abc.rec_mark +'</td>' +
						    '<td>'+
								//'<a class=\'btn btn-primary\'  href="<?=ROOT?>"><span class="glyphicon glyphicon-pencil"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
								//'<a class=\'btn btn-primary\'  href="<?=ROOT?>"><span class="glyphicon glyphicon-trash"></span></a>'+
								'<a class=\'btn btn-primary\'  href="<?=ROOT?>npkbilling/approval_receiving/preview_approval_receiving?id='+abc.rec_id+'" ><span class="glyphicon glyphicon-pencil"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
							'</td>'+
						'</tr>'
			        );

		       });
		 
		           $("#example").DataTable();
		           $.unblockUI();
		    }
				
				
		

	});
});

</script>
<script language="JavaScript" type="text/javascript">   
    $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
 </script>
