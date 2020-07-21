							
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
															<td>
																<a href="#" class="table-link" onclick="edit('<?=$x['BLACKLIST_ID'];?>')">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
																	</span>
																</a>
																<a href="#" class="table-link" onclick="del('<?=$x['BLACKLIST_ID'];?>','<?=$this->options_model->getContent('BLACKLISTATRIBUTE','ID',$x['BLACKLIST_ATTRIBUTE']);?>:<?=$x['BLACKLIST_VALUE'];?>')">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
																	</span>
																</a>																
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
	
	function del(id,info){
		$('#info').val(info);
		$('#blacklist_id').text(a);
		$('#dialogReject').dialog({modal:false, height:250,width:500,title: 'Reject Request',close: function( event, ui ) {$('a').removeAttr('disabled');}});
	}
	
	$("#confirm_reject").click(function() {
		var notes = $("#notes").val();
		var blacklist_id = $("#blacklist_id").val();

		if(blacklist_id=="")
		{
			alert("Blacklist ID empty");
			$("#blacklist_id").focus();
			return false;
		}

		if(notes=="")
		{
			alert("notes empty");
			$("#notes").focus();
			return false;
		}

		var r = confirm("Do you want to reject?");
		if (r == true) {
			var url = "<?=ROOT?>register/delete_blacklist";
			$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',BLACKLIST_ID:blacklist_id,REJECT_NOTES:notes}, function(data){
				alert(data);
				location.reload();
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
		$('#form select, #form input[type=text],  #form input[type=hidden], #form input[type=radio]:checked, #form input[type=checkbox]:checked ')
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