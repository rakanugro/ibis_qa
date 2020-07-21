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
							
<!-- top-2-title-search -->
<?
	if (!isset($searchterm)){
		$searchterm = '';	
	}
?>
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										
										<header class="main-box-header clearfix">
											<div class="filter-block pull-right">
												<div class="form-group pull-left">
												</div>
												<div class="form-group pull-left">
												<? 
													echo form_dropdown('atribute_type', $opt_attribute, $otherterm ,"class='form-control'"," - Pilih Jenis Atribut - ");
												?>
												</div>
												<div class="form-group pull-left">
													<input type="text" class="form-control" placeholder="Search..." id="searchBox" value="<?=$searchterm;?>">
													<i class="fa fa-search search-icon"></i>
												</div>
												<a href="#" class="btn btn-primary pull-right" id="addButton">
													<i class="fa fa-plus-circle fa-lg"></i> Tambah
												</a>
											</div>
										</header>
										
									</div>
								</div>
							</div>
							
							<div class="row">
							
								<div class="col-lg-12">
									<div class="main-box">
										
										<div class="main-box-body clearfix" id="table">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th class="text-center"><span>No</span></th>
															<th class="text-center"><span>Atribut</span></a></th>
															<th class="text-center"><span>Value</span></a></th>
															<th class="text-center"><span>Status</span></a></th>
															<th>&nbsp;</th>
														</tr>
													</thead>
													<tbody>
													<?
														$i = 0;
														$c = $table->num_rows();
														while( $i < $c && $x = $table->row_array($i++) ){
													?>
														<tr>
															<td>
																<?=($i);?>
															</td>
															<td class="text-left">
																<?=$this->options_model->getContent('BLACKLISTATRIBUTE','ID',$x['BLACKLIST_ATTRIBUTE']);?>
															</td>
															<td class="text-left">
																<?=$x['BLACKLIST_VALUE'];?>
															</td>
															<td align="center">
																<?php
																
																if($x['ACTIVE']=='Y')
																	echo "<span class=\"label label-success\">ACTIVE</span>";
																else
																	echo "<span class=\"label label-warning\">INACTIVE</span>";
																
																?>
															</td>
															<td>
																<a href="javascript:void(0)" class="table-link" onclick="edit('<?=$x['BLACKLIST_ID'];?>')">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
																	</span>
																</a>
																<?php
																if($x['ACTIVE']=='Y')
																{
																?>
																	<a href="javascript:void(0)" class="table-link" onclick="del('<?=$x['BLACKLIST_ID'];?>','<?=$this->options_model->getContent('BLACKLISTATRIBUTE','ID',$x['BLACKLIST_ATTRIBUTE']);?>:<?=$x['BLACKLIST_VALUE'];?>')">
																		<span class="fa-stack">
																			<i class="fa fa-square fa-stack-2x"></i>
																			<i class="fa fa-power-off fa-stack-1x fa-inverse"></i>
																		</span>
																	</a>
																<?php
																}
																else
																{
																?>
																	<a href="javascript:void(0)" class="table-link" onclick="activated('<?=$x['BLACKLIST_ID'];?>','<?=$this->options_model->getContent('BLACKLISTATRIBUTE','ID',$x['BLACKLIST_ATTRIBUTE']);?>:<?=$x['BLACKLIST_VALUE'];?>')">
																		<span class="fa-stack">
																			<i class="fa fa-square fa-stack-2x"></i>
																			<i class="fa fa-check fa-stack-1x fa-inverse"></i>
																		</span>
																	</a>
																<?php																
																}
																?>
															</td>
														</tr>
													<?
														}
													?>
													</tbody>
												</table>
											</div>
											<ul class="pull-left pagination">	
												<li><a>Rows <?=$pageinfo['STARTNUM'];?> - <?=$pageinfo['ENDNUM'];?> of <?=$pageinfo['TOTAL'];?>. Page <?=$currentpage;?> of <?=ceil($pageinfo['TOTAL']/$limit);?>.</a></li>
											</ul>
											<div>
												<ul class="pagination pull-right">
												<?  $page = 1;
													if($searchterm=="")
														$searchterm = "empty";
													if ($currentpage > 3) {$page = $currentpage-2;} ?>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$currentpage-1;?>/<?=$searchterm?>/<?=$otherterm?>"><i class="fa fa-chevron-left"></i></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$currentpage+1;?>/<?=$searchterm?>/<?=$otherterm?>"><i class="fa fa-chevron-right"></i></a></li>
												</ul>
											</div>
											
										</div>
									<div id="modalplaceholder"></div>
									</div>
								</div>
								
							</div>
							
	<div id="dialogReject" style="display:none">
		<table class="tablebase">
		<tr>
			<td width="130"><span id="blacklistket1"></span></td>
			<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			<td>
			<span id="blacklistket2"></span>
			</td>
		</tr>		
		<tr>
			<td colspan="3">&nbsp</td>
		</tr>		
		<tr>
			<td>Notes</td>
			<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			<td>
				<textarea class="form-control" id="notes" name="notes" placeholder="" title="Notes" cols="30"></textarea>
				<input type="hidden" id="blacklist_id">
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp</td>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="button" value="CONFIRM INACTIVE" class="btn btn-primary" id="confirm_delete"></td>
		</tr>
		</table>
	</div>							
	<!-- this page specific inline scripts lol-->
	<script>
	
	$("#addButton").click(function(){
		$.get("<?=ROOT;?>register/loadmodal_local/blacklist/", function(data){
			$('#modalplaceholder').html(data).children().modal('show');
		})
		.then(function(){
			//hack... can't assign through $data in controller
		});
	})
	
	function edit(id){
		$.get("<?=ROOT;?>register/loadmodal_local_edit/blacklist/blacklist/"+id, function(data){
			$('#modalplaceholder').html(data).children().modal('show');
		})
		.then(function(){
			//hack... can't assign through $data in controller
		});
	}
	
	function del(id,ket){
		
		$('#blacklist_id').val(id);
		var res = ket.split(":"); 
		$('#blacklistket1').text(res[0]);
		$('#blacklistket2').text(res[1]);
		$('#notes').val("");
		$('#dialogReject').dialog({modal:false, height:275,width:500,title: 'Inactive Blacklist',close: function( event, ui ) {$('a').removeAttr('disabled');}});

	}

	function activated(id,ket){
		var txt = 'Anda yakin akan mengaktifasi blacklist?';

		if (confirm(txt)){

			$.get('<?=ROOT;?>register/activate_blacklist/'+id)
			.then(function(){
				load_list();
				$('#modalplaceholder').children().modal('hide');
			});
		}
	}
	
	$("#confirm_delete").click(function() {
		var notes = $("#notes").val();
		var blacklist_id = $("#blacklist_id").val();

		if(blacklist_id=="")
		{
			alert("blacklist id empty");
			$("#blacklist_id").focus();
			return false;
		}

		if(notes=="")
		{
			alert("notes empty");
			$("#notes").focus();
			return false;
		}

		var r = confirm("Do you want to inactive?");
		if (r == true) {
			var url = "<?=ROOT?>register/delete_blacklist/";
			$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',blacklist_id:blacklist_id,notes:notes}, function(data){
				alert(data);
				$('#dialogReject').dialog('close');
				load_list();
			});
			$('a').removeAttr('disabled');
		} else {
			alert("cancel");
			$('a').removeAttr('disabled');
		}
	});	
	
	$("#searchBox").keypress(function(e) {
		if(e.which == 13) {	//enter key
			var q = $(this).val();
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			
			var jp = $( "select[name=atribute_type] option:selected" ).val();
			
			if(q=="")
				q = "empty";
			
			if(jp==" - Pilih Jenis Pelanggan - ")
				jp = "";
			
			//console.log(q);
			window.location.href= "<?=ROOT;?>register/blacklist_customer/"+q+"/"+jp;
		}
	});
	
	function load_list(){
		$.get("<?=ROOT;?>register/load_blacklist_customer/", function(data){
			$('#table').html(data);
		});
	}
	
	/////////////////////////////////template
	//for popup
	function validate_form(){
		console.log('validate');

		if ( $('#value').val() != ''){
			$('#saveButton').removeAttr('disabled');
		}
		else{
			$('#saveButton').attr('disabled','disabled');
		}
	}
	
	function save_form(funct){
		var tmp = {};

		//protip: don't select all 'input's blindly, 'radio' types need the :checked selector
		//or else they submits everything
		$('#form select, #form input[type=text],  #form textarea, #form input[type=hidden], #form input[type=radio]:checked, #form input[type=checkbox]:checked ')
			.each(function(){
				tmp[this.name] = this.value;
			});

		console.log(tmp);

		$.post('<?php echo ROOT;?>'+funct,tmp)
		.then(function(){
			load_list();
			$('#modalplaceholder').children().modal('hide');
		});
	}
	</script>