<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/bootstrap.js"></script>
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

<script>
	var table2 = $('#table-approval-request').dataTable({
		'info': false,
		'sDom': 'lTfr<"clearfix">tip',
		'oTableTools': {
			'aButtons': [
				{
					'sExtends':    'collection',
					'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
					'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
				}
			]
		},
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
	});

	var tt2 = new $.fn.dataTable.TableTools(table2);
	$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');		

	function clickDialog1(a){
		$('#dialogViewReq').load("<?=ROOT?>/approval_request/view_request/"+a).dialog({modal:false, height:500,width:650,title: 'View Content'});
	}
	
	function clickDialogDoc(a,b){
		if((b=='NPE') ||(b=='DO'))
		{
			$('#frameDoc1').attr('src', a);
			$("#dialogDoc1").dialog({modal:false, height:500,width:650,title: 'View '+b+' file'});
			
		}
		else if((b=='PEB')||(b=='SPPB'))
		{
			$('#frameDoc2').attr('src', a);
			$("#dialogDoc2").dialog({modal:false, height:500,width:650,title: 'View '+b+' file'});
		}
		else if(b=='BKS')
		{
			$('#frameDoc3').attr('src', a);
			$("#dialogDoc3").dialog({modal:false, height:500,width:650,title: 'View Booking Shipping file'});
		}
	}
	
   function approveD(z,a,b)
   {
	    var txt;
		var r = confirm("Do you want to approve?");
		if (r == true) {
			if (z=='RECEIVING')
			{
				var url = "<?=ROOT?>/container_receiving/submit_request";
			}
			else if (z=='DELIVERY')
			{
				var url = "<?=ROOT?>/container/save_request_delivery";
			}
			else if (z=='PERPANJANGAN DELIVERY')
			{
				var url = "<?=ROOT?>/container/save_request_deliveryperp";
			}
			else if ((z=='CALBG') || (z=='CALAG') || (z=='CALDG'))
			{
				var url = "<?=ROOT?>/container_alihkapal/save_request_alihkapal";
			}
			
			$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:a,port:b},function(data){
             var obj = jQuery.parseJSON(data);
             if ((obj.rc=="S") || (obj.rc=="OK")){
                 var notification = new NotificationFx({
                        message : '<p>Approve successfully</p>',
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'success', // notice, warning, error or success 
                        onClose : function() {
						  window.open("<?=ROOT?>/approval_request/main_approval","_self");
					   }
                });
                 notification.show();
             }
             else {
                 var notification = new NotificationFx({
                        message : '<p>Failed</p><br/>'+obj.rcmsg,
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'error' // notice, warning, error or success 
						,
						onClose : function() {
						  window.open("<?=ROOT?>/approval_request/main_approval","_self");
					   }
                });
             }
        });
		} else {
			alert("cancel");
		}
   }
	
	function rejectD()
   {
	    var txt;
		var r = confirm("Do you want to reject?");
		if (r == true) {
			alert("yes");
		} else {
			alert("cancel");
		}
   }
	
</script>

<script>
	function changePage(info)
	{
		alert(info);
	}
	
	function searchRequest(info)
	{
		alert(info);
	}	
</script>


<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Booking</a></li>
										<li><a href="<?=ROOT?>/approval_request/main_approval">Approval Request</a></li>
										
									</ol>
									
									<h1>Approval Request</h1>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2 class="pull-left">Approval Request</h2>
											
											<div class="filter-block pull-right">
												<div class="form-group pull-left">
													<input type="text" class="form-control" placeholder="Search...">
													<a onclick="searchRequest('noreq')"><i class="fa fa-search search-icon"></i></a>
												</div>
											</div>
										</header>
										
										<div class="main-box-body clearfix">
											<div id="table-approval">
											
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th><span>No</span></th>
																<th class="text-center"><span>Request Number</span></th>
																<th class="text-center"><span>Request Date</span></th>
																<th class="text-center"><span>Customer</span></th>
																<th class="text-center"><span>Port</span></th>
																<th class="text-center"><span>Terminal</span></th>
																<th class="text-center"><span>Vessel-Voyage</span></th>
																<th class="text-center"><span>View</span></th>
																<th class="text-center"><span>Document</span></th>
																<th class="text-center"><span>Approve</span></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	1
																</td>
																<td class="text-right">
																	reqnumber
																</td>
																<td class="text-center">
																	reqdate
																</td>
																<td class="text-center">
																	customer
																</td>
																<td style="width: 15%;">
																	port
																</td>
																<td style="width: 15%;">
																	terminal
																</td>
																<td style="width: 15%;">
																	vesvoy
																</td>
																<td style="width: 15%;">
																	view
																</td>
																<td style="width: 15%;">
																	<?php echo $doc1.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc1file.'","'.$doc1c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc2.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc2file.'","'.$doc2c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc3.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc3file.'","'.$doc3c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>';?>
																</td>
																<td style="width: 15%;">
																	<?php  echo '<a  class=\'btn btn-primary\'  href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';?>
																</td>
															</tr>
															<tr>
																<td>
																	2
																</td>
																<td class="text-right">
																	reqnumber2
																</td>
																<td class="text-center">
																	reqdate2
																</td>
																<td class="text-center">
																	customer2
																</td>
																<td style="width: 15%;">
																	port2
																</td>
																<td style="width: 15%;">
																	terminal2
																</td>
																<td style="width: 15%;">
																	vesvoy2
																</td>
																<td style="width: 15%;">
																	view2
																</td>
																<td style="width: 15%;">
																	<?php echo $doc1.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc1file.'","'.$doc1c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc2.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc2file.'","'.$doc2c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc3.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc3file.'","'.$doc3c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>';?>
																</td>
																<td style="width: 15%;">
																	<?php  echo '<a  class=\'btn btn-primary\'  href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';?>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<ul class="pagination pull-right">
													<li><a onclick="changePage('0');"><i class="fa fa-chevron-left"></i></a></li>
													<li><a onclick="changePage('1');">1</a></li>
													<li><a onclick="changePage('2');">2</a></li>
													<li><a onclick="changePage('3');">3</a></li>
													<li><a onclick="changePage('4');">4</a></li>
													<li><a onclick="changePage('5');">5</a></li>
													<li><a onclick="changePage('6');"><i class="fa fa-chevron-right"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>