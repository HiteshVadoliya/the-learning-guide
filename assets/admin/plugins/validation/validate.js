//empty value focus border become red
function requireandfocus(name)
{
	if($('#'+name).val().trim().length<=0){
		$('#'+name).focus().addClass('text-error');
		return true;
	}else{
		$('#'+name).focus().removeClass('text-error');
		return false;
	}
}
function requireandmessage(name,message = 'Valid Value')
{
	if($('#'+name).val().trim().length <= 0){
		$('#'+name).focus();
		$('#'+name+'-error').html('Please Enter '+message);
		return true;
	}else{
		$('#'+name+'-error').html('');
		return false;
	}
}
function isexistfile(name,message = 'File First')
{
	if($('#'+name).val().trim().length <= 0){
		$('#'+name).focus();
		$('#'+name+'-error').html('Please Select '+message);
		return true;
	}else{
		$('#'+name+'-error').html('');
		return false;
	}
}
//select empty
function isemptydropdown(name)
{
	if($('#'+name).val() == 'Select' || $('#'+name).val() == '') {
		$('#'+name).focus().addClass('text-error');
	 	return true;        
	}else{
		$('#'+name).focus().removeClass('text-error');
		return false;
	}
}
function isemptyselect(name,message = 'Option')
{
	if($('#'+name).val() == 'Select' || $('#'+name).val() == '')
	{
		$('#'+name).focus();
		$('#'+name+'-error').html('Please Select Atleast One '+message+'!');
	 	return true;
	}else{
		$('#'+name+'-error').html('');
		return false;
	}
}
//email
function isvalidemail(name,message="Valid Email")
{
	if (!($('#'+name).val()).match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)){
		$('#'+name).focus();
		$('#'+name+'-error').html('Please Enter '+message+'!');
		return true;        
	}else{
		$('#'+name+'-error').html('');
		return false;
	}
}
function isconfirmpassword(password,confirmpassword)
{
	if (($('#'+password).val()) != ($('#'+confirmpassword).val()))
	{
		$('#'+confirmpassword).focus();
		$('#'+password+'-error').html('Password Does Not Match Please Re-Enter Password!');
		return true;
	}else{
		$('#'+password+'-error').html('');
		return false;
	}
}
//Key Press
function onlynumberpressdot(name)
{
  $(document).on('keypress','#'+name,function (evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if(charCode == 46 || charCode == 8 || charCode == 37 || charCode == 39 || charCode == 46){//For Delete ,BackSpace & Dot
    	return true;
    } else if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
	return true;
  });
}
function isword_char(name,message="Alfabet Only")
{
if (!($('#'+name).val()).match(/^([a-zA-Z]+\s)*[a-zA-Z]+$/))
 {
  $('#'+name).focus();
  	$('#'+name+'-error').html('Please Enter '+message+'!');
    return true;        
  }else{
  	$('#'+name+'-error').html('');
    return false;
  }
}
// auto remove bs-alert wich affected on alert calass
function autoremovealert()
{
  $(document).ready(function () {
    window.setTimeout(function() {
        $(".remove-alert").fadeTo(1000, 0).slideUp(1000, function(){
            $(this).remove(); 
        });
    }, 6000);
  });
}
/* ajex Loader Function */
/* 1st arguments:-
        var loader_image='<?php echo base_url('/assets/img/ajax-loader.gif'); ?>';
    2nd arguments:-
       if you want to put images then----- "var loader_text='<img src="<?php echo base_url('/assets/img/loding-text.gif'); ?>">';
       if you want to put text then------- var loader_text="Loading...";
*/
function load_ajex_loader(loader_image,loader_text)
{
  function ajaxindicatorstart(text)
  {
    if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
    jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="'+loader_image+'"><div>'+text+'</div></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({ 'width':'100%', 'height':'100%', 'position':'fixed', 'z-index':'10000000', 'top':'0', 'left':'0', 'right':'0', 'bottom':'0', 'margin':'auto'
    });
    jQuery('#resultLoading .bg').css({'background':'#000000', 'opacity':'0.7', 'width':'100%', 'height':'100%', 'position':'absolute', 'top':'0'
    });
    jQuery('#resultLoading>div:first').css({ 'width': '160px', 'height':'75px', 'text-align': 'center', 'position': 'fixed', 'top':'0', 'left':'0', 'right':'0', 'bottom':'0', 'margin':'auto', 'font-size':'16px', 'z-index':'10', 'color':'#ffffff'
    // jQuery('#resultLoading>div:first').css({ 'width': '250px', 'height':'75px', 'text-align': 'center', 'position': 'fixed', 'top':'0', 'left':'0', 'right':'0', 'bottom':'0', 'margin':'auto', 'font-size':'16px', 'z-index':'10', 'color':'#ffffff'
    });
      jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeIn(300);
      jQuery('body').css('cursor', 'wait');
  }       
  function ajaxindicatorstop()
  {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
  }
jQuery(document).ajaxStart(function () {
      //show ajax indicator
    ajaxindicatorstart(loader_text);
  }).ajaxStop(function () {
    //hide ajax indicator
    ajaxindicatorstop();
  });
  jQuery.ajax({
   global: false,
   // ajax stuff
  });
}
/* end ajex loader */