<script src="<?=CUBE_?>js/jquery-ui.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>js/jquery-ui.css">
<style>
.blink_me {
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
    
    -moz-animation-name: blinker;
    -moz-animation-duration: 1s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;
    
    animation-name: blinker;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@-moz-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}
</style>
<script>
	function approveRestitution(id_req){
		var url="<?=ROOT?>port_cooperation/approve_restitution";
		 if(confirm("Are you sure?"))
			{
				$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_REQ:id_req},
				function(data){	
					var row_data = data;
					var explode = row_data.split(',');
					var v_msg = explode[0];
					var v_description = explode[1];
					if (v_msg!='OK')
					{
						alert('Cancel gagal : '+v_msg);
						return false;
					}
					else
					{
						alert(v_msg);
						window.location = "<?=ROOT?>port_cooperation/request_restitusi";
					}	
				});				
			}
			else
			{
				e.preventDefault();
			}
	}
    
    function act_completeRestitution(){
        var urlact="<?=ROOT?>/port_cooperation/complete_restitution";
        var nojkk = $("#nojkk").val();
        var remark = $("#remark").val();
        var id_req = $("#id_req").val();
		 if(confirm("Are you sure?"))
			{
				$.post(urlact,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_REQ:id_req,NO_JKK:nojkk,REMARK:remark},
				function(data){	
					var row_data = data;
					var explode = row_data.split(',');
					var v_msg = explode[0];
					var v_description = explode[1];
					if (v_msg!='OK')
					{
						alert('Cancel gagal : '+v_msg);
						return false;
					}
					else
					{
						alert(v_msg);
						window.location = "<?=ROOT?>/port_cooperation/request_restitusi";
					}	
				});				
			}
			else
			{
				e.preventDefault();
			}
    }
    
    function close_dialog(){
        $("#confirm_complete").dialog('close');
        $("#id_req").val('');
    }
    
    $(function() {
        $( "#confirm_complete" ).dialog({
          autoOpen: false,
          show: {
            effect: "blind",
            duration: 1000
          },
          hide: {
            effect: "blind",
            duration: 1000
          },
            minWidth: 500,
            maxWidth: 500
        });
      });
    
    function completeRestitution(id_req){        
        $("#confirm_complete").dialog('open');
        $("#id_req").val(id_req);
		
	}
    
    function cancelRestitution(id_req){
		var url="<?=ROOT?>port_cooperation/cancel_restitution";
		 if(confirm("Are you sure?"))
			{
                var notification = new NotificationFx({
                        message : '<span class="icon fa fa-cog fa-2x"></span><p>Request berhasil dihapus.</p>',
                        layout : 'bar',
                        effect : 'exploader',
                        type : 'success', // notice, warning or error
                        onClose : function() {
                            //bttnExpandingLoader.disabled = false;
                        }
                });

                notification.show();
				$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_REQ:id_req},
				function(data){	
					var row_data = data;
					var explode = row_data.split(',');
					var v_msg = explode[0];
					var v_description = explode[1];
					if (v_msg!='OK')
					{
						alert('Cancel gagal : '+v_msg);
						return false;
					}
					else
					{
						alert(v_msg);
						window.location = "<?=ROOT?>port_cooperation/request_restitusi";
					}	
				});				
			}
			else
			{
				e.preventDefault();
			}
	}
	
	function requestRestitution(id_joint_vessel,vessel,voyage_in,voyage_out,terminal,call_sign){
		var url="<?=ROOT?>port_cooperation/request_restitution";
		if(confirm("Are you sure?"))
		{
            var notification = new NotificationFx({
					message : '<span class="icon fa fa-cog fa-2x"></span><p>Request Berhasil Disimpan.</p>',
					layout : 'bar',
					effect : 'exploader',
					type : 'success', // notice, warning or error
					onClose : function() {
						//bttnExpandingLoader.disabled = false;
					}
			});
            
            notification.show();
            
			$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_JOINT_VESSEL:id_joint_vessel,VESSEL:vessel,VOYAGE_IN:voyage_in,VOYAGE_OUT:voyage_out,TERMINAL:terminal,CALL_SIGN:call_sign},
			function(data){	
				var row_data = data;
				var explode = row_data.split(',');
				var v_msg = explode[0];
				var v_description = explode[1];
				if (v_msg!='OK')
				{
					alert('Cancel gagal : '+v_msg);
					return false;
				}
				else
				{
					alert(v_msg);
					window.location = "<?=ROOT?>port_cooperation/request_restitusi";
				}	
			});				
		}
		else
		{
			e.preventDefault();
		}
	}
	
	function viewRestitution(id_joint_vessel){
		var url="<?=ROOT?>port_cooperation/view_restitution";
		if(confirm("Are you sure?"))
		{
			$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_JOINT_VESSEL:id_joint_vessel},
			function(data){	
				var row_data = data;
				var explode = row_data.split(',');
				var v_msg = explode[0];
				var v_description = explode[1];
				if (v_msg!='OK')
				{
					alert('Cancel gagal : '+v_msg);
					return false;
				}
				else
				{
					alert(v_msg);
					window.location = "<?=ROOT?>port_cooperation/request_restitusi";
				}	
			});				
		}
		else
		{
			e.preventDefault();
		}
	}
    
    function uncompletedocRestitution($id_req){
        var url="<?=ROOT?>port_cooperation/uncomplete_document";
		if(confirm("Are you sure?"))
		{
			$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_REQ:$id_req},
			function(data){	
				var row_data = data;
				var explode = row_data.split(',');
				var v_msg = explode[0];
				var v_description = explode[1];
				if (v_msg!='OK')
				{
					alert('Cancel gagal : '+v_msg);
					return false;
				}
				else
				{
					alert(v_msg);
					window.location = "<?=ROOT?>port_cooperation/request_restitusi";
				}	
			});				
		}
		else
		{
			e.preventDefault();
		}
    }
</script>
<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>
<div id="content-wrapper">
                    <?php if($this->session->userdata('group_phd') == 4){?>
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Restitution Booking</a></li>
										<!--<li class="active"><span><?=get_content($this->user_model,"restitution","receiving_booking");?></span></li>-->
									</ol>
									
									<h1>Restitution Booking</h1>
								</div>
							</div>
							
							<!--<div class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2><?=get_content($this->user_model,"restitution","create_new")?></h2>
                                            <i>(<?=get_content($this->user_model,"restitution","create_tx")?>)</i>
										</header>
										
										<div class="main-box-body clearfix">
											<form class="form-inline" role="form" action="<?=ROOT?>port_cooperation/add_req_restitution">
												<button type="submit" class="btn btn-success"><?=get_content($this->user_model,"restitution","create")?></button>
											</form>
										</div>
									</div>
								</div>	
							</div>-->
						</div>
					</div>
                
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Restitution Booking List</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<?php
											$tmpl = array (
																'table_open'          => '<table id="table-vessel_list" class="table table-hover">'
														  );

											$this->table->set_template($tmpl);
											echo $this->table->generate();
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				    <?php }?>	
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Restitution Booking List</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-request-receiving" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );
													$this->table->clear();
													//create table
													if($idgroup == 3){
														$this->table->set_heading("No", 
																				  "No Request",
																				  "Vessel",
																				  "Voyage",
																				  "Port",
																				  "Date Request",
																				  "Amount",
																				  "Doc. Not Complete",
																				  "Doc. Complete",
																				  "Restitution Complete",
																				  "Status",
																				  "Quantity",
																				  "View",
																				  "Calculation"
																			 );
													}
													else {
														$this->table->set_heading("No", 
																				  "No Request",
																				  "Vessel",
																				  "Voyage",
																				  "Port",
                                                                                  "Date Request",
                                                                                  "Amount",
                                                                                  "Doc. Complete",
                                                                                  "Restitution Complete",
																				  "Status",
                                                                                  "Quantity",
																				  "View",
                                                                                  "Calculation",
																				  "Cancel"
																			 );
													}
													$this->table->set_template($tmpl);
                                                    if(count($restitution_list) > 0){
													for($i=0;$i<count($restitution_list);$i++){
														if($idgroup == 3){
															$this->table->add_row(
																$restitution_list[$i]['no'],
																$restitution_list[$i]['no_request'],
																$restitution_list[$i]['vessel'],
																$restitution_list[$i]['voyage'],
																$restitution_list[$i]['port'],
																$restitution_list[$i]['req_date'],
																$restitution_list[$i]['amount'],
																$restitution_list[$i]['doc_uncom'],
																$restitution_list[$i]['date_doc'],
																$restitution_list[$i]['date_req'],
																$restitution_list[$i]['status'],
																$restitution_list[$i]['qty'],
																$restitution_list[$i]['view'],
																$restitution_list[$i]['calc']
															);
														}
														else {
															$this->table->add_row(
																$restitution_list[$i]['no'],
																$restitution_list[$i]['no_request'],
																$restitution_list[$i]['vessel'],
																$restitution_list[$i]['voyage'],
																$restitution_list[$i]['port'],
																$restitution_list[$i]['req_date'],
																$restitution_list[$i]['amount'],
                                                                $restitution_list[$i]['date_doc'],
                                                                $restitution_list[$i]['date_req'],
																$restitution_list[$i]['status'],
                                                                $restitution_list[$i]['qty'],
																$restitution_list[$i]['view'],
                                                                $restitution_list[$i]['calc'],
																$restitution_list[$i]['cancel']
															);														}
													}
                                                    }
													echo $this->table->generate();
												?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
    <div id="confirm_complete" style="display:none">
    <table class="table table-striped table-hover">
        <tr>
            <td> No. JKK</td>
            <td> :</td>
            <td> <input type="text" id="nojkk"/>
            <input type="hidden" id="id_req"/>
            </td>
        </tr>            
        <tr>
            <td> Keterangan</td>
            <td> :</td>
            <td> <input type="text" id="remark"/></td>
        </tr> 
         
        <tr>
            <td><button type="button" onclick="act_completeRestitution()" class="btn btn-success">Save</button> </td>
            <td> </td>
            <td align="right"> <button type="button" onclick="close_dialog()" class="btn btn-success">Cancel</button></td>
        </tr>    
    </table>    
    </div>
					
					<script>
					var table2 = $('#table-request-receiving').dataTable({
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
					</script>