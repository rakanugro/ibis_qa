/*
	Author 		: 	Ibnu Alam
	Date		:	7 July 2015
	Description	:	This function is used in conjunction with Bootstrap.
					Validates form.

	variables	:	selector		#id, .class of scope of validation e.g. '#myForm'
					fieldnames		array of names of input field e.g. ['name','password']
*/

	function validateForm(selector, fieldnames, silent){
		if (typeof silent==='undefined'){silent=false;}
		
		var tg = true;
		$(selector+" input, "+ selector+" textarea, "+ selector+" select").each(function(){
			//alert("[name="+this.name+"]:" + this.value);
			if (fieldnames.indexOf(this.name) >= 0 && (this.value == '' || this.value == null || this.value == '-')){
				//if (!silent){
					$("[name="+this.name+"]").focus();
					field = $("[name="+this.name+"]").closest('div').children('label').html();
					field = field ? field : $("[name="+this.name+"]").closest('.form-group').children('label').html();
					alert('Please fill : ' + field);
				//}
				console.log(this.name);
				tg = false;
				return false;
			}
		});
		
		return tg;
	}
	
	function validateEmails(selector, fieldnames, silent){
		if (typeof silent==='undefined'){silent=false;}
		var tg = true;
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/; //http://www.w3resource.com/javascript/form/email-validation.php
		
		$(selector+" input, "+ selector+" textarea").each(function(){
			if (fieldnames.indexOf(this.name) >= 0 && (this.value == '' || this.value == null || !this.value.match(mailformat))){
				if (!silent){
					$("[name="+this.name+"]").focus();
					field = $("[name="+this.name+"]").closest('div').children('label').html();
					field = field ? field : $("[name="+this.name+"]").closest('.form-group').children('label').html();					
					alert('Please enter a valid email : ' + field);
				}
				console.log(this.name);
				tg = false;
				return false;
			}
		});
			
		return tg;
	}
	
	function validateWebsites(selector, fieldnames, silent){
		if (typeof silent==='undefined'){silent=false;}
		var tg = true;
		//http://stackoverflow.com/a/18593669
		//urlformat = /^(http|https):\/\/(([a-zA-Z0-9$\-_.+!*'(),;:&=]|%[0-9a-fA-F]{2})+@)?(((25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])){3})|localhost|([a-zA-Z0-9\-\u00C0-\u017F]+\.)+([a-zA-Z]{2,}))(:[0-9]+)?(\/(([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*(\/([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*)*)?(\?([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?(\#([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?)?$/;
		//modified, http not required but still valid if present
		var urlformat = /^((http|https):\/\/)?(([a-zA-Z0-9$\-_.+!*'(),;:&=]|%[0-9a-fA-F]{2})+@)?(((25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])){3})|localhost|([a-zA-Z0-9\-\u00C0-\u017F]+\.)+([a-zA-Z]{2,}))(:[0-9]+)?(\/(([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*(\/([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*)*)?(\?([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?(\#([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?)?$/;
		
		$(selector+" input, "+ selector+" textarea").each(function(){
			if (fieldnames.indexOf(this.name) >= 0 && (this.value == '' || this.value == null || !this.value.match(urlformat))){
				if (!silent){
					$("[name="+this.name+"]").focus();
					alert('Please enter a valid website : ' + $("[name="+this.name+"]").closest('div').children('label').html());
				}
				console.log(this.name);
				tg = false;
				return false;
			}
		});
			
		return tg;
	}
	
	function validateRadios(selector, fieldnames, silent){
		if (typeof silent==='undefined'){silent=false;}
		var tg = true;
		
		$(selector+" input[type=radio]").each(function(){
			if(  fieldnames.indexOf(this.name) >= 0 && $('[name='+this.name+']:checked').length==0 ){
			   
			   if(!silent){
				   $("[name="+this.name+"]").first().parent().first().focus();
				   alert('Please choose an option : ' + $("[name="+this.name+"]").first().parent().parent().parent().children('label').html());
			   }
			   
			   console.log('kosong   : '+this.name);
			   tg = false;
			   return false;

			}
			else{
			   console.log('isi      : '+this.name);     
			}
		});
		return tg;
	}
	
	//function validateBirthday(date)