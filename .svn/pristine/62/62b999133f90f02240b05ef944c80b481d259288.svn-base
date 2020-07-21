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

<!-- Bootstrap styling for Typeahead -->
<link href="<?=CUBE_?>tokenfield/css/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
<!-- Tokenfield CSS -->
<link href="<?=CUBE_?>tokenfield/css/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?=CUBE_?>tokenfield/bootstrap-tokenfield.min.js" charset="UTF-8"></script>
    
<?php //echo var_dump($request_data);die;?>
<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}<>|\[\]/\\]/gi, ''));
	});
});
</script>
<script>
$(document).ready(function() {
	
	$( "#customer_autocomplete" ).autocomplete({
		minLength: 3,
		source: function(request, response) {
            console.log('a');
            console.log($(this));
			$.getJSON("<?=ROOT?>register/get_customer_list?",{  customer_name: $( "#customer_autocomplete" ).val(),org_id: $("select[name=registration_branch] option:selected").val()}, response);
			},
		focus: function( event, ui ) 
		{
			$( "#customer_autocomplete" ).val( ui.item.NAME);
			return false;
		},
		select: function( event, ui ) 
		{
			$( "#customer_autocomplete" ).val( ui.item.NAME);
			$( "#customer_id" ).val( ui.item.CUSTOMER_ID);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item ) 
	{
		return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a align='center'>" + item.NAME + "<br>"+item.CUSTOMER_ID+"</a>")
            .appendTo( ul );
        
	};
    
    // multiple customer autocomplete
    $('#multi_customer_autocomplete').tokenfield({
      autocomplete: {
        minLength: 3,
        // source: [{ label: 'red', value: '1' }, { label: 'green', value: '2' }, { label: 'blue', value: '3' }, { label: 'yellow', value: '4' }],
        source: function(request, response) {
            console.log(request.term);
            $.getJSON("<?=ROOT?>register/get_customer_list?",{  customer_name: request.term, type: 'multi'}, response);
            return response;
        },
        delay: 100
      },
      showAutocompleteOnFocus: true
    });
    // .data( "uiAutocomplete" )._renderItem = function( ul, item ) 
	// {
		// return $( "<li></li>" )
		// .data( "item.autocomplete", item )
		// .append( "<a align='center'>" + item.NAME + "<br>"+item.CUSTOMER_ID+"</a>")
		// .appendTo( ul );
	// }
    
    // set data PPJK pakai Javascript
    var isPPJK = '<?php echo json_encode($request_data['IS_PPJK'])?>';
    console.log(isPPJK);
    
    if (isPPJK === '"Y"'){
        console.log("adalah Y");
        $("input[name='is_ppjk']").prop('checked', true);
    } else {
        console.log("tidak sama");
        $("input[name='is_ppjk']").prop('checked', false);
    }
    
    // set data to tokenfield
    var dataConsignee = jQuery.parseJSON('<?php echo json_encode($data_ppjk)?>');
    console.log(dataConsignee);
    
    if (typeof dataConsignee != 'undefined'){
        var dataToken = [];
        for(var i=0;i<dataConsignee.length;i++){
            var elToken = {
                label: dataConsignee[i].NAME,
                value: dataConsignee[i].CONSIGNEE_ID
            };
            dataToken.push(elToken);
        }
        
        $("#multi_customer_autocomplete").tokenfield('setTokens', dataToken);
    }
    
});

    function submitheader() {
		var username = $("#username").val();
		var name = $("#name").val();
		var email = $("#email").val();
        var category = $("input[name=category]:checked").val();
		
		if($("input[name='is_ppjk']").is(":checked"))
			var is_ppjk = $("input[name='is_ppjk']").val();
		else 
			var is_ppjk = 'N';
		
        if (is_ppjk == 'N'){
            var customer_id = $("#customer_id").val();
        } else {
            customer_id = $("#multi_customer_autocomplete").val();
        }
        
        var registration_branch = $("select[name=registration_branch] option:selected").val();
		var active = $("[name=active]");
		if(active.is(":checked"))
		{
			active = "1";
		}
		else
		{
			active = "0";
		}

		var terminal_type = new Array();
		$.each($("input[name='terminal_type[]']:checked"), function() {
            terminal_type.push($(this).val());
		});
		
		var url = "<?=ROOT?>register/update_user";
        $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',username:username,name:name,email:email,category: category,is_ppjk:is_ppjk,customer_id: customer_id,active: active,registration_branch:registration_branch,terminal_type: terminal_type}, function(data){
			//alert(data);
			if(data==null || !data){
				alert("Simpan Gagal");
			} else {
				alert("Simpan Berhasil");
			}
        });
    }
</script>

<script type="text/javascript">

$( document ).ready(function() {

	$( "#username" ).val('<?=$request_data["USERNAME"];?>');
	$( "#name" ).val('<?=$request_data["NAME"];?>');
	$( "#email" ).val('<?=$request_data["EMAIL"];?>');
	$( "#customer_autocomplete" ).val('<?=$request_data["CUSTOMER_NAME"];?>');
	$( "#customer_id" ).val('<?=$request_data["CUSTOMER_ID"];?>');
	
	$("input[name='is_ppjk']").change(function () {
        // console.log('change: ' + $("input[name='is_ppjk']").is(":checked"));
		// if($("input[name='is_ppjk']").is(":checked"))
			// var is_ppjk = $("input[name='is_ppjk']").val();
		// else 
			// var is_ppjk = 'N';
		// alert(is_ppjk);
        console.log('change: ' + this.checked);
        $("#customer_autocomplete").val("");
        $("#multi_customer_autocomplete").tokenfield('setTokens', []);
        $("#customer_id").val("");
        $("#multi_customer_autocomplete").val("");
        if (this.checked){
            $("#container_single").addClass('hideme');
            $("#container_multi").removeClass('hideme');
            $("#eservice_customer_label").html("eService Customer (Multiple)");
        } else {
            $("#container_single").removeClass('hideme');
            $("#container_multi").addClass('hideme');
            $("#eservice_customer_label").html("eService Customer");
        }
	})

});
</script>

<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
	
	.hidden_content {
		display: none;
	}
	
	#component_type {
		float: left;
	}
	
	#component_reefer {
		float: left;
		margin-left: 10px;
	}
	
    .onoffswitch {
        width: 110px;
    }

    .onoffswitch-inner:before {
        content: "ACTIVE";
    }
    .onoffswitch-inner:after {
        content: "INACTIVE";
    }
    .onoffswitch-switch {
        right: 76px;
    }
    .hideme
    {
        display:none;
        visibility:hidden;
    }
</style>

	<div id="content-wrapper">
		<div class="row">
			<div class="col-lg-12">
							
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="#">User</a></li>
							<li><a href="<?=ROOT?>register/list_user">User List</a></li>
							<li class="active"><span>Edit User</span></li>
						</ol>
						
						<h1>Edit User</h1>
					</div>
				</div>
							
				<div class="row">
					<div class="col-lg-12">
						<div class="main-box">
							<header class="main-box-header clearfix">
								<h2>User Data</h2>
							</header>
						
							<div class="main-box-body clearfix">
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">eService Username</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="" title="" readonly>
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Name</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="" title="">
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Email</label>
									<input type="text" class="form-control" id="email" name="email" placeholder="" title="">
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">User Category</label>
									<div class="row">
									<?php 
										$x = options_params($box_group_type, 'category', '', $group_type);
										echo options_group_loader('radio', $x);
									?>																
									</div>
								</div>
								<!--<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Apakah PPJK?</label>
									<div class="row">
									<?php 
                                        //echo $request_data["IS_PPJK"];
										$x = options_params($box_ppjk, 'is_ppjk', '', $request_data["IS_PPJK"]);
										echo options_group_loader('checkbox', $x).'';
									?>																
									</div>
								</div>				-->				
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Branch * Customer Registration / Billing Operator / Customer Helpdesk</label>
									<div class="row">
									<? 	
										echo form_dropdown('registration_branch', $opt_registration_branch, $request_data["REGISTRATION_COMPANY_ID"] ,"class='form-control' ".$is_readonly); 				
									?>								
									</div>
								</div>						
								<div class="form-group example-twitter-oss">
                                
                                    <?php if ($request_data["IS_PPJK"] == 'N'){
                                        $vis_single = "";
                                        $vis_multi = "hideme";
                                        $autocom_label = "eService Customer";
                                    } else {
                                        $vis_single = "hideme";
                                        $vis_multi = "";
                                        $autocom_label = "eService Customer (Multiple)";
                                    }?>
                                    
									<label for="exampleAutocomplete"><span id="eservice_customer_label"><?php echo $autocom_label?></span></label>
                                    
                                    <div id="container_single" class="<?php echo $vis_single?>">
                                        <input type="text" class="form-control" id="customer_autocomplete" name="customer_autocomplete" placeholder="autocomplete" title="Masukkan nama pelanggan"/>
                                        <input type="hidden" class="form-control" id="customer_id" name="customer_id" placeholder="" title="">
                                    </div>
                                    
                                    <div id="container_multi" class="<?php echo $vis_multi?>">
                                        <input type="text" class="form-control" id="multi_customer_autocomplete" name="multi_customer_autocomplete" placeholder="multiple" title="Masukkan nama pelanggan"/>
                                        <input type="hidden" class="form-control" id="multi_customer_id" name="multi_customer_id" placeholder="" title="">
                                    </div>
								</div>								
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Terminal</label>
									<div class="row">
									<?php 
										$x = options_params($box_terminal_type, 'terminal_type[]', '', $terminal_type);
										echo options_group_loader('checkbox', $x).'';
									?>																
									</div>
								</div>				
								<div class="form-group example-twitter-oss">
									<div class="onoffswitch onoffswitch-success">
										<?php
											if($request_data["ENABLED"]=="1")
											{
												$checked = "checked";
											}
											else 
												$checked = "";
										?>
										<input type="checkbox" name="active" class="onoffswitch-checkbox" id="myonoffswitch4" <?=$checked?>>
										<label class="onoffswitch-label" for="myonoffswitch4">
											<div class="onoffswitch-inner"></div>
											<div class="onoffswitch-switch"></div>
										</label>
									</div>
								</div>								
								<div class="form-group example-twitter-oss" align="right">
									<label for="exampleAutocomplete" ><b>Created Date : </b><?=$request_data["CREATED_DATE"];?></label>
								<label for="exampleAutocomplete" ><b>Updated Date : </b><?=$request_data["UPDATED_DATE"];?></label>
									<label for="exampleAutocomplete"><b>Last Login : </b><?=$request_data["LAST_LOGIN"];?></label>
								</div>
								<button id="submit_header" onclick="submitheader();" class="btn btn-success"/>Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>