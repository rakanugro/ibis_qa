/*
	Author 		: 	Ibnu Alam
	Date		:	24 April 2015
	Description	:	This function is used in conjunction with CodeIgniter, jQuery, and select2.js.
					It loads the City, 'Kecamatan', 'Kelurahan', and Post Code and attaches the 
					onChange event so each field updates automatically.
					This will only work on this project as the data path (db query) is hard coded 
					and tightly coupled with the current code.

	variables	:	params : array of 
						root 		site root
						city		assigned value
						camat		assigned value
						lurah		assigned value
						pos			assigned value
						prov_id		selector id
						city_id		selector id
						camat_id	selector id
						lurah_id	selector id
						pos_id		selector id
						city_name	selector name
						camat_name	selector name
						lurah_name	selector name
						pos_name	selector name	
*/


	function initAddress( params ){
		
		//loading city...
		$.get(params.root+"register/loadlocation/city/"+toGetString($('#'+params.prov_id).val())+"/"+params.city_name+"/"+params.city_id, function(data){
			$('#'+params.city_id).html($(data).html());
			$('#'+params.city_id).select2();
			
			if (params.city == ''){
				params.city = $('#'+params.city_id).val();
			}
			else{
				$('#'+params.city_id).select2('val', params.city);
			}
		})
		.done(function(){
			$.get(params.root+"register/loadlocation/postalcode/"+toGetString($('#'+params.city_id).val())+"/"+params.pos_name+"/"+params.pos_id, function(data){
				$('#'+params.pos_id).html($(data).html());
				$('#'+params.pos_id).select2();
				
				if (params.pos == ''){
				params.pos = $('#'+params.pos_id).val();
				}
				else{
					$('#'+params.pos_id).select2('val', params.pos);
				}
			});
			$.get(params.root+"register/loadlocation/kecamatan/"+toGetString($('#'+params.city_id).val())+"/"+params.camat_name+"/"+params.camat_id, function(data){
				$('#'+params.camat_id).html($(data).html());
				$('#'+params.camat_id).select2();
				
				if(params.camat == ''){
					params.camat = $('#'+params.camat_id).val();
				}
				else{
					$('#'+params.camat_id).select2("val", params.camat);
				}
			})
			.done(function(){
				$.get(params.root+"register/loadlocation/kelurahan/"+toGetString($('#'+params.camat_id).val())+"/"+params.lurah_name+"/"+params.lurah_id, function(data){
					$('#'+params.lurah_id).html($(data).html());
					$('#'+params.lurah_id).select2();
					
					if(params.lurah != ''){
						$('#'+params.lurah_id).select2("val", params.lurah);
					}
				})
			});
		});
		
		//lv 1
		$('#'+params.prov_id).change(function(e){
			$.get(params.root+"register/loadlocation/city/"+toGetString($('#'+params.prov_id).val())+"/"+params.city_name+"/"+params.city_id, function(data){				
				$('#'+params.city_id).html($(data).html());
				$('#'+params.city_id).select2();
			}).done(function(){
				$.get(params.root+"register/loadlocation/postalcode/"+toGetString($('#'+params.city_id).val())+"/"+params.pos_name+"/"+params.pos_id, function(data){
					$('#'+params.pos_id).html($(data).html());
					$('#'+params.pos_id).select2();
				})
				
				$.get(params.root+"register/loadlocation/kecamatan/"+toGetString($('#'+params.city_id).val())+"/"+params.camat_name+"/"+params.camat_id, function(data){
					$('#'+params.camat_id).html($(data).html());
					$('#'+params.camat_id).select2();
				})
				.done(function(){
					$.get(params.root+"register/loadlocation/kelurahan/"+toGetString($('#'+params.camat_id).val())+"/"+params.lurah_name+"/"+params.lurah_id, function(data){
						$('#'+params.lurah_id).html($(data).html());
						$('#'+params.lurah_id).select2();
					})
				});
			})
		});
		
		//lv 2
		$('#'+params.city_id).change(function(e){
			$.get(params.root+"register/loadlocation/postalcode/"+toGetString($('#'+params.city_id).val())+"/"+params.pos_name+"/"+params.pos_id, function(data){
				$('#'+params.pos_id).html($(data).html());
				$('#'+params.pos_id).select2();
			});
			
			$.get(params.root+"register/loadlocation/kecamatan/"+toGetString($('#'+params.city_id).val())+"/"+params.camat_name+"/"+params.camat_id, function(data){
				$('#'+params.camat_id).html($(data).html());
				$('#'+params.camat_id).select2();
			})
			.done(function(){
				$.get(params.root+"register/loadlocation/kelurahan/"+toGetString($('#'+params.camat_id).val())+"/"+params.lurah_name+"/"+params.lurah_id, function(data){
					$('#'+params.lurah_id).html($(data).html());
					$('#'+params.lurah_id).select2();
				})
			});
		});
		
		//lv 3
		$('#'+params.camat_id).change(function(e){
			$.get(params.root+"register/loadlocation/kelurahan/"+toGetString($('#'+params.camat_id).val())+"/"+params.lurah_name+"/"+params.lurah_id, function(data){
				$('#'+params.lurah_id).html($(data).html());
				$('#'+params.lurah_id).select2();
			})
		});
	}