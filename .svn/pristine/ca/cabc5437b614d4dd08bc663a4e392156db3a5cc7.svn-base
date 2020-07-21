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

<script>
	$(document).ready(function() {
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[?~`!$<>|{}+@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}<>@!|._\[\]/\\]/gi, ''));
		});
		
		$("#service").on("change", function() {
			$("#content_service").load("request/service/"+this.value);
		})
		
		//======================================= autocomplete vessel==========================================//
		$( "#vessel_autocomplete" ).autocomplete({
			minLength: 3,
			source: function(request, response) {
				$.getJSON("<?=ROOT?>autocomplete/getVesselList",{  term: $( "#vessel_autocomplete" ).val(), port: $("#port").val()}, response);
				},
			focus: function( event, ui ) 
			{
				$( "#vessel" ).val( ui.item.VESSEL);
				return false;
			},
			select: function( event, ui ) 
			{
				$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
				$( "#voyage_in" ).val( ui.item.VOYAGE_IN);
				$( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item ) 
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'>" + item.VESSEL + "<br>" +item.VOYAGE_IN+" - " +item.VOYAGE_OUT+"</a>")
			.appendTo( ul );
		
		};
		
		<?php
			if($_GET['container_number']!="")
			{
				if ($no_container=="")
				{
			?>
					var notification = new NotificationFx({
						message : '<p>Data Tidak Ditemukan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'error' // notice, warning, error or success
						
					});

					// show the notification
					notification.show();
			<?php
				}		
			else {?>
					var notification = new NotificationFx({
						message : '<p>Data Ditemukan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
						
					});

					// show the notification
					notification.show();
			<?php }  
			}
		?>
	});

	function check()
	{
		var container_number = $( "#container_number" ).val();
		var port = $( "select[name=port]" ).val();
		
		//alert(container_number);
		//alert(port);
		
		if(container_number=="")
		{
			alert("Nomor Container harus diisi");
			$( "#container_number" ).focus();
			return false;
		}
		
		if(port=="")
		{
			alert("Terminal harus diisi");
			$( "select[name=port]" ).focus();
			return false;
		}		
	}
</script>

<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>							
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<!--<h2><?//=get_content($this->user_model,"tracking","choose_vessel")?></h2>-->
									<h2>Choose Vessel Test</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<form class="form-inline" role="form">
										<div class="form-group">
											<table>
											<tr>
											<td width="20%"><label>Pelayanan</label></td>
											<td>
												<select id="service" name="service" class="form-control">
													<option value=""> -- Pilih Pelayanan -- </option>
													<option value="receiving"> Receiving </option>
													<option value="delivery"> Delivery </option>
												</select>
											</td>
											</tr>
											</table>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">													
										</div><br/>
									</form>
								</div>
							</div>
						</div>	
					</div>
					
					<div class="row">
						<div class="col-lg-12" id="content_service">
							
						</div>
					</div>
					
		<script>
			function resetVessel()
			{
				$('#vessel_autocomplete').val("");
				$('#voyage_in').val("");
				$('#voyage_out').val("");
			}
		
			var table2 = $('#table-handling').dataTable({
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
				"lengthMenu": [[-1, 10, 25, 50], ["All", 10, 25, 50]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');

			var table3 = $('#table-billing').dataTable({
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
				"lengthMenu": [[3, 10, 25, 50, -1], [3, 10, 25, 50, "All"]]
			});
			
			var tt3 = new $.fn.dataTable.TableTools(table3);
			//$( tt3.fnContainer() ).insertBefore('div.dataTables_wrapper');							
		</script>
		
		
	<script>
		$("#container_number").keyup(function(event) {
			var inp = String.fromCharCode(event.keyCode);
			var val = $(this).val();
			if (/[a-zA-Z]/.test(inp)){
				$(this).val(val.toUpperCase());
			} else if (/ /.test(inp)){
				$(this).val( val.replace(' ', '') );
			}
		});
	</script>