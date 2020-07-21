<!-- START OF TEMPLATE FOOTER -->
<!-- START OF TEMPLATE FOOTER -->
<!-- START OF TEMPLATE FOOTER -->
					<footer id="footer-bar" class="row">
						<p id="footer-copyright" class="col-xs-12">
							Indonesia Port Corporation @ <?php echo date("Y"); ?>
						</p>
					</footer>
				</div>
			</div>
		</div>
	</div>

	<div id="config-tool" class="closed hidden">
		<a id="config-tool-cog">
			<i class="fa fa-cog"></i>
		</a>

		<div id="config-tool-options">
			<h4>Layout Options</h4>
			<ul>
				<li>
					<div class="checkbox-nice">
						<input type="checkbox" id="config-fixed-header" />
						<label for="config-fixed-header">
							Fixed Header
						</label>
					</div>
				</li>
				<li>
					<div class="checkbox-nice">
						<input type="checkbox" id="config-fixed-sidebar" />
						<label for="config-fixed-sidebar">
							Fixed Left Menu
						</label>
					</div>
				</li>
				<li>
					<div class="checkbox-nice">
						<input type="checkbox" id="config-fixed-footer"/>
						<label for="config-fixed-footer" id="config-fixed-footerx">
							Fixed Footer
						</label>
					</div>
				</li>
				<li>
					<div class="checkbox-nice">
						<input type="checkbox" id="config-boxed-layout" />
						<label for="config-boxed-layout">
							Boxed Layout
						</label>
					</div>
				</li>
				<li>
					<div class="checkbox-nice">
						<input type="checkbox" id="config-rtl-layout" />
						<label for="config-rtl-layout">
							Right-to-Left
						</label>
					</div>
				</li>
			</ul>
			<br/>
			<h4>Skin Color</h4>
			<ul id="skin-colors" class="clearfix">
				<li>
					<a class="skin-changer" data-skin="" data-toggle="tooltip" title="Default" style="background-color: #34495e;">
					</a>
				</li>
				<li>
					<a class="skin-changer" data-skin="theme-white" data-toggle="tooltip" title="White/Green" style="background-color: #2ecc71;">
					</a>
				</li>
				<li>
					<a class="skin-changer blue-gradient" data-skin="theme-blue-gradient" data-toggle="tooltip" title="Gradient">
					</a>
				</li>
				<li>
					<a class="skin-changer" data-skin="theme-turquoise" data-toggle="tooltip" title="Green Sea" style="background-color: #1abc9c;">
					</a>
				</li>
				<li>
					<a class="skin-changer" data-skin="theme-amethyst" data-toggle="tooltip" title="Amethyst" style="background-color: #9b59b6;">
					</a>
				</li>
				<li>
					<a class="skin-changer" data-skin="theme-blue" data-toggle="tooltip" title="Blue" style="background-color: #2980b9;">
					</a>
				</li>
				<li>
					<a id="skin-changer-red" name="skin-changer-red" class="skin-changer" data-skin="theme-red" data-toggle="tooltip" title="Red" style="background-color: #e74c3c;">
					</a>
				</li>
				<li>
					<a class="skin-changer" data-skin="theme-whbl" data-toggle="tooltip" title="White/Blue" style="background-color: #3498db;">
					</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- this page specific inline scripts -->
	<script>
	$(document).ready(function() {

	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}

		if ($('#graph-bar').length) {
			var data1 = [
			    [gd(2015, 1, 1), 838], [gd(2015, 1, 2), 749], [gd(2015, 1, 3), 634], [gd(2015, 1, 4), 1080], [gd(2015, 1, 5), 850], [gd(2015, 1, 6), 465], [gd(2015, 1, 7), 453], [gd(2015, 1, 8), 646], [gd(2015, 1, 9), 738], [gd(2015, 1, 10), 899], [gd(2015, 1, 11), 830], [gd(2015, 1, 12), 789]
			];

			var data2 = [
			    [gd(2015, 1, 1), 342], [gd(2015, 1, 2), 721], [gd(2015, 1, 3), 493], [gd(2015, 1, 4), 403], [gd(2015, 1, 5), 657], [gd(2015, 1, 6), 782], [gd(2015, 1, 7), 609], [gd(2015, 1, 8), 543], [gd(2015, 1, 9), 599], [gd(2015, 1, 10), 359], [gd(2015, 1, 11), 783], [gd(2015, 1, 12), 680]
			];

			var series = new Array();

			series.push({
				data: data1,
				bars: {
					show : true,
					barWidth: 24 * 60 * 60 * 12000,
					lineWidth: 1,
					fill: 1,
					align: 'center'
				},
				label: 'Revenues'
			});
			series.push({
				data: data2,
				color: '#e84e40',
				lines: {
					show : true,
					lineWidth: 3,
				},
				points: {
					fillColor: "#e84e40",
					fillColor: '#ffffff',
					pointWidth: 1,
					show: true
				},
				label: 'Orders'
			});

			$.plot("#graph-bar", series, {
				colors: ['#03a9f4', '#f1c40f', '#2ecc71', '#3498db', '#9b59b6', '#95a5a6'],
				grid: {
					tickColor: "#f2f2f2",
					borderWidth: 0,
					hoverable: true,
					clickable: true
				},
				legend: {
					noColumns: 1,
					labelBoxBorderColor: "#000000",
					position: "ne"
				},
				shadowSize: 0,
				xaxis: {
					mode: "time",
					tickSize: [1, "month"],
					tickLength: 0,
					// axisLabel: "Date",
					axisLabelUseCanvas: true,
					axisLabelFontSizePixels: 12,
					axisLabelFontFamily: 'Open Sans, sans-serif',
					axisLabelPadding: 10
				}
			});

			var previousPoint = null;
			$("#graph-bar").bind("plothover", function (event, pos, item) {
				if (item) {
					if (previousPoint != item.dataIndex) {

						previousPoint = item.dataIndex;

						$("#flot-tooltip").remove();
						var x = item.datapoint[0],
						y = item.datapoint[1];

						showTooltip(item.pageX, item.pageY, item.series.label, y );
					}
				}
				else {
					$("#flot-tooltip").remove();
					previousPoint = [0,0,0];
				}
			});

			function showTooltip(x, y, label, data) {
				$('<div id="flot-tooltip">' + '<b>' + label + ': </b><i>' + data + '</i>' + '</div>').css({
					top: y + 5,
					left: x + 20
				}).appendTo("body").fadeIn(200);
			}
		}

		//WORLD MAP
		$('#world-map').vectorMap({
			map: 'world_merc_en',
			backgroundColor: '#ffffff',
			zoomOnScroll: false,
			regionStyle: {
				initial: {
					fill: '#e1e1e1',
					stroke: 'none',
					"stroke-width": 0,
					"stroke-opacity": 1
				},
				hover: {
					"fill-opacity": 0.8
				},
				selected: {
					fill: '#8dc859'
				},
				selectedHover: {
				}
			},
			markerStyle: {
				initial: {
					fill: '#e84e40',
					stroke: '#e84e40'
				}
			},
			markers: [
				{latLng: [38.35, -121.92], name: 'Los Angeles - 23'},
				{latLng: [39.36, -73.12], name: 'New York - 84'},
				{latLng: [50.49, -0.23], name: 'London - 43'},
				{latLng: [36.29, 138.54], name: 'Tokyo - 33'},
				{latLng: [37.02, 114.13], name: 'Beijing - 91'},
				{latLng: [-32.59, 150.21], name: 'Sydney - 22'},
			],
			series: {
				regions: [{
					values: gdpData,
					scale: ['#6fc4fe', '#2980b9'],
					normalizeFunction: 'polynomial'
				}]
			},
			onRegionLabelShow: function(e, el, code){
				el.html(el.html()+' ('+gdpData[code]+')');
			}
		});

		/* SPARKLINE - graph in header */
		var orderValues = [10,8,5,7,4,4,3,8,0,7,10,6,5,4,3,6,8,9];

		$('.spark-orders').sparkline(orderValues, {
			type: 'bar',
			barColor: '#ced9e2',
			height: 25,
			barWidth: 6
		});

		var revenuesValues = [8,3,2,6,4,9,1,10,8,2,5,8,6,9,3,4,2,3,7];

		$('.spark-revenues').sparkline(revenuesValues, {
			type: 'bar',
			barColor: '#ced9e2',
			height: 25,
			barWidth: 6
		});

		/* ANIMATED WEATHER */
		var skycons = new Skycons({"color": "#03a9f4"});
		// on Android, a nasty hack is needed: {"resizeClear": true}

		// you can add a canvas by it's ID...
		skycons.add("current-weather", Skycons.SNOW);

		// start animation!
		skycons.play();
		//alert("ivan");
		//console.log("ivan");
			//alert("ivan");
			//$( "#config-fixed-footer" ).prop( "checked", true );
			//console.log($( "#skin-changer-red" ));
			//$( "#config-fixed-footer" ).prop( "checked", true );
			/*if($("#config-fixed-footer").val()=="on"){
				alert("ivan ganteng");
				alert($("#config-fixed-footer").val());
				$( "#config-fixed-footer" ).prop( "checked", true );
			} else {
				//$("#config-fixed-footer").click();
				$( "#config-fixed-footer" ).prop( "checked", true );
				alert("ivan ganteng2");
				alert($("#config-fixed-footer").val());
			}*/
			//alert($("#config-fixed-footer").val());
			$( "#skin-changer-red" ).click();
			var usedSkin = localStorage.getItem('config-skin');
			$('body').addClass('fixed-footer');
			$('#config-fixed-footer').prop('checked', true);
			$('#skin-colors .skin-changer[data-skin="'+'theme-red'+'"]').addClass('active');
			//alert(usedSkin);
			/*if (usedSkin != '') {
				$('#skin-colors .skin-changer').removeClass('active');
				$('#skin-colors .skin-changer[data-skin="'+usedSkin+'"]').addClass('active');
			}*/
			//$( "#config-tool-cog" ).attr("class","hidden");
			//console.log($( "#config-fixed-footerx" ));
			//$( "#skin-changer-red" ).attr("class","skin-changer active");

	//--- this is the start of a php block ----
	<?php
			if ($this->session->userdata('notify')){
				$i = 0;
				foreach ($this->session->userdata('notify') as $n){
					$icon = 'fa-info-circle';
					$type = 'info';
					$message = '';
					$title = '';

					if (isset($n['type'])){
						$type = $n['type'];
						switch ($type){
							case 'success':
								$icon = 'fa-check-circle'; break;
							case 'info':
								$icon = 'fa-info-circle'; break;
							case 'warning':
								$icon = 'fa-warning'; break;
							case 'danger':
								$icon = 'fa-times-circle'; break;
						}
					}

					if (isset($n['message'])){
						$message = $n['message'];
					}
					if (isset($n['title'])){
						$title = $n['title'];
					}
	?>
					setTimeout(function() {
						$.notify(
								{
									// options
									icon: 'fa fa-fw fa-lg <?=$icon;?>',
									title: '<?=$title?>',
									message: '<?=$message;?>',
									url: '#',
									target: '_blank'
								},{
									type: '<?=$type;?>'
								}
							);

					}, <?=($i*750);?>);

	<?php
					$i++;
				}
			}
			$this->session->set_userdata('notify', array()); // empty the data
	?>
	//--- this is the end of a php block ----

	});

	var tableFixed = $('#table-example-fixed').dataTable({
		'info': true,
		'pageLength': 50
	});

	new $.fn.dataTable.FixedHeader( tableFixed );


	</script>
	<script type="text/javascript">
		$('#role_user').change(function(){

			var val = 	$(this).val();
			var user_id = "<?php echo $this->session->userdata('user_id')?>";
			var path = '';
			path = "<?php echo ROOT.'dashboard_invoice/change_role';?>";
			$.ajax({

			url			: path,
			data        : {

				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				'role_id':val,
				'user_id':user_id
			 },
			dataType 	: 'json',
			method		:'POST',
			cache 		: true,
			beforeSend: function() {
				$('.text_help').show();
				$('.text_help').text('Processing...');
			},
			success:function(json){
				$('.text_help').hide();

				if(json.status == 'success'){
				    window.location.href= json.aksi;

					}else if(json.status == 'gagal'){

				    alert('Gagal Memprocess');
				       //window.location.reload();
				}

			},
			error:function(json){
				alert('Error while request..');
				$('.text_help').text('Error while request..');
			}
			});


		});


		/*change unit */

		$('#unit_role').change(function(){

			var u_val  = $(this).val();
			//alert(u_val);

			var user_id = "<?php echo $this->session->userdata('user_id')?>";
			var path = '';
			path = "<?php echo ROOT.'dashboard_invoice/change_unit';?>";
			$.ajax({

			url			: path,
			data        : {

				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				'unit_id':u_val,
				'user_id':user_id
			 },
			dataType 	: 'json',
			method		:'POST',
			cache 		: true,
			beforeSend: function() {
				$('.text_help').show();
				$('.text_help').text('Processing...');
			},
			success:function(json){
				$('.text_help').hide();

				if(json.status == 'success'){
				    window.location.href= json.aksi;

					}else if(json.status == 'gagal'){

				    alert('Gagal Memprocess');
				       //window.location.reload();
				}

			},
			error:function(json){
				alert('Error while request..');
				$('.text_help').text('Error while request..');
			}
			});

		})

		function logout()
		{
			var r = confirm("Apakah anda yakin akan keluar?");
			if (r == true) {
			  doLogout();
			} else {
			  txt = "You pressed Cancel!";
			}
		}

		function doLogout()
		{
			window.location = "<?=ROOT?>main_invoice/logout";
		}
	</script>
</body>
</html>
