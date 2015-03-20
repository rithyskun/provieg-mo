function keyEnable(e,cond)
{
var key;
var keychar;

if (window.event)
key = window.event.keyCode;
else if (e)
key = e.which;
else 
return true;

keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();

type = arguments[1];
	var exception = arguments[2]+',';
	var object = arguments[3];
	var size = arguments[4];
	var max_char = arguments[5];

if(cond=='text'){

	if ((key==null) || (key==0) || (key==8) ||
	(key==9) || (key==13) || (key==27) || (key>=65 && key <=122 ) )
	
	return true;
	else
	return false;
}else if(cond=='textlower'){

	if ((key==null) || (key==0) || (key==8) ||
	(key==9) || (key==13) || (key==27) || (key>=97&& key <=122) )
	return true;
	else
	return false;
}else if(cond=='exitblur'){
	if($("#num_lantern").val()==''){
	$("#num_lantern").val(1);
	}

}
else if(cond=='exitblur2'){
   	$(".qty").each(function(){
   		if($(this).val() == ''){
   		$(this).val(1);
   		}
   	});  

}else if(cond=='textupper'){
	if ((key==null) || (key==0) || (key==8) ||
	(key==9) || (key==13) || (key==27) || (key>=65&& key <=90) )
	return true;
	else
	return false;
}else if(cond=='number'){	
	if ((key==null) || (key==0) || (key==8) ||
	(key==9) || (key==13) || (key==27) ) 
	return true;
	if ((("0123456789").indexOf(keychar) > -1)){
		if(object){
			in_stock = $('#in_stock_'+$(object).attr('id')).val();			
			totalkeychar = $(object).val() + keychar;						
				if((parseInt(keychar) >= parseInt(in_stock)) || (totalkeychar >= parseInt(in_stock))){
					
					if(totalkeychar == 0){

					$(object).val(0);
					return false;
					}else{
					$(object).val(parseInt(in_stock));
						return false;
					}					
				}
				else if((parseInt(keychar) < parseInt(in_stock)) || (totalkeychar < parseInt(in_stock))){

					if(totalkeychar == 0){
					$(object).val(0);
					return false;
					}
					else if(totalkeychar > 0){
						if($(object).val() == 0){
						$(object).val(parseInt(keychar));						
						return false;
						}
					}
				}
				if(totalkeychar==0 && keychar==0){
				    $(object).val(1);
				    return false;
				}
				
		}
		
	}
	else{
		//return false and show alert sms/////////////////////////////////////
				var float_num='00';
				var timeout = null;
				var delay_sms_show = 1000;
				function getOffsetLeft(object){
					offset = $(object).offset(); 
					if($.browser.msie && $.browser.version<8){
						return (offset.left/2)+10;
					}
					return(offset.left);	
				}
				function removeSms(object){
					if (timeout) clearTimeout(timeout);	
					setTimeout(function(){
				    		$('#keyEnableSms').remove();
				    }, delay_sms_show);
				}
					var key;
			
				
				if (window.event)
				key = window.event.keyCode;
				else if (e)
				key = e.which;
				else
				return true;
				keychar = String.fromCharCode(key);
				
				type = arguments[1];
				var exception = arguments[2]+',';
				var object = arguments[3];
				var size = arguments[4];
				var max_char = arguments[5];
				
				if(size && object.value.length >= size && !exception.match(key)) {return false;}
				$('#keyEnableSms').remove();
				if (!keychar.match(/[0-9]/) && !exception.match(key)){
					if(object){
						$('#keyEnableSms').remove();
						offset = $(object).offset();
						if(key != "32"){
							$('body').append('<div id="keyEnableSms" style="left: '+($.browser.msie?((getOffsetLeft(object)*2)-20):getOffsetLeft(object))+'px; top: '+offset.top+'px;"> Field requires number character</div>');
						}
										
						removeSms(object);
						return false;
					}
					return false;	
				}
		//*************End*********************************//
	}
	
}
else if(cond=='textnumber'){
	if ((key==null) || (key==0) || (key==8) || (key==32) ||
	(key==9) || (key==13) || (key==27) || (key>=65 && key <=122 && !(key >= 91 && key <= 96)) )
	return true;
	
	if ((("0123456789").indexOf(keychar) > -1))
	return true;
	else
	return false;
}
else if(cond=="allstring"){
	if ((key==null) || (key==0) || (key==8) ||
	(key==9) || (key==13) || (key==27) || (key==32)|| (key==35)|| (key==36)|| (key==46)|| (key==116) || (key>=32 && key <=255) )
	return true;
	
	if ((("0123456789").indexOf(keychar) > -1))
	return true;
	else
	
	return false;
}


}