							
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
													//echo form_dropdown('atribute_type', $opt_attribute, $otherterm ,"class='form-control'"," - Pilih Jenis Atribut - ");
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
										<header class="main-box-header clearfix">
											<h2>List Perusahaan</h2>
										</header>

										<!--<div class="main-box-body clearfix">
											<div class="col-md-4">
												<div class="form-group">
													<label>Cabang PPJK</label>
													<? 	
														echo form_dropdown('viewbranch', $opt_viewbranch, $sel_viewbranch ,"class='form-control' ".$is_readonly); 				
													?>
												</div>
											</div>
										</div>-->
										
										<div class="main-box-body clearfix" id="table">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th><span>No</span></th>
															<th><span>Consignee ID</span></a></th>
															<th><span>Name</span></a></th>
															<th><span>Expiry</span></a></th>
															<th><span>Registration Branch</span></a></th>
															<th>&nbsp;</th>
														</tr>
													</thead>
													<tbody>
													<? 
														$i = 0;
														$c = $list_consg->num_rows();
														while( $i < $c && $x = $list_consg->row_array($i++) ){ 
													?>
														<tr>
															<td>
																<?=($i);?>
															</td>
															<td class="text-left">
																<?=$x['CONSIGNEE_ID'];?>
															</td>
															<td class="text-left">
																<?=$x['CONSIGNEE_NAME'];?>
															</td>
															<td class="text-left">
																<?=$x['EXPIRED_DATE'];?>
															</td>
															<td class="text-left">
																<?=$x['BRANCH'];?>
															</td>
															<td>
																<a href="#" class="table-link" onclick="edit('<?=$x['ID'];?>')">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
																	</span>
																</a>
																<a href="#" class="table-link" onclick="del('<?=$x['ID'];?>')">
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
											
										</div>
									<div id="modalplaceholder"></div>
									</div>
								</div>
								
							</div>
	<!-- this page specific inline scripts lol-->
	<script>
	
	$("#addButton").click(function(){
		$.get("<?=ROOT;?>register/loadmodal_local/ppjk_consignee/", function(data){
			$('#modalplaceholder').html(data).children().modal('show');
		})
		.then(function(){
			//hack... can't assign through $data in controller
			$('[name=ppjk_id]').val('<?php echo $ppjk_id;?>');
		});
	})
	
	function edit(id){
		//alert ('edit implementation on progress');
		
		
		$.get("<?=ROOT;?>register/loadmodal_local_edit/ppjk_consignee/ppjk_consignee/"+id, function(data){
			$('#modalplaceholder').html(data).children().modal('show');
		})
		.then(function(){
			//hack... can't assign through $data in controller
		});
	}
	
	function del(id){
		if (confirm('Anda yakin akan menghapus data ini?')){
			var url = "<?php echo ROOT;?>register/ppjk_consg_delete/"+id;
			$.post(url, {test:'12345a','<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'})
				.done(function(){
				window.location.reload();
			})
		}
	}
	
	function load_list(){
		/*
		$.get("<?=ROOT;?>register/load_ppjk_consg/+<?php echo $ppjk_id;?>", function(data){
			$('#table').html(data);
		});
		*/
		location.reload();
	}
	
	/////////////////////////////////template
	//for popup
	function validate_form(){
		console.log('validate');

		if ( 	$('#consignee_id').val() != ''
			&& 	$('#expired_date').val() != ''
		)
		{
			$('#saveButton').removeAttr('disabled');
		}
		else{
			$('#saveButton').attr('disabled','disabled');
		}
	}
	
	function save_form(funct){
		var tmp = {};

		//protip: don't select all 'input's blindly, 'radio' types need the :checked selector
		//or else the form submits everything
		$('#form select, #form input[type=text],  #form input[type=hidden], #form input[type=radio]:checked, #form input[type=checkbox]:checked ')
			.each(function(){
				tmp[this.name] = this.value;
			});

		console.log(tmp);
		
		//window.onunload = function() { debugger; }
		$.post('<?php echo ROOT;?>'+funct,tmp,
			function(data){
				if(data=="already_add")
				{
					alert("Consignee Sudah Terdaftar");
				}

				console.log('RETURNED: '+data);
			}
		)
		.then(function(data){
			if(data!="already_add")
			{
				load_list();
				$('#modalplaceholder').children().modal('hide');
			}
		});
	}	
	</script>