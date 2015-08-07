 //<![CDATA[  
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {  
    var msViewportStyle = document.createElement("style");  
    msViewportStyle.appendChild(  
         document.createTextNode("@-ms-viewport{width:auto!important}")  
    );  
    document.getElementsByTagName("head")[0].appendChild(msViewportStyle);  
}  
//]]> 
jQuery(window).on('load', function() {  
                     new JCaption('img.caption');  
                });  
 jQuery(document).ready(function(){  
      jQuery('.hasTooltip').tooltip({"html": true,"container": "body"});  
 }); 
jQuery(document).ready(function($){
	Joomla.JText.load({"REQUIRED_FILL_ALL":"Please enter data in all fields.","E_LOGIN_AUTHENTICATE":"Username and password do not match or you do not have an account yet.","REQUIRED_NAME":"Please enter your name!","REQUIRED_USERNAME":"Please enter your username!","REQUIRED_PASSWORD":"Please enter your password!","REQUIRED_VERIFY_PASSWORD":"Please re-enter your password!","PASSWORD_NOT_MATCH":"Password does not match the verify password!","REQUIRED_EMAIL":"Please enter your email!","EMAIL_INVALID":"Please enter a valid email!","REQUIRED_VERIFY_EMAIL":"Please re-enter your email!","EMAIL_NOT_MATCH":"Email does not match the verify email!","CAPTCHA_REQUIRED":"Please enter captcha key"});  

	 $('.selectpicker').selectpicker();
	$('#report-name').focus(function(){
		var e = $(this);
		if(e.val()=="Give this report a name"){e.val(''); }
	}).focusout(function(){
		var e = $(this);
		if(e.val()==""){e.val('Give this report a name');/* $('.step-process li').removeClass('active');*/ }
		else{
			$('.step-process ul li:nth-child(1)').addClass('active');
			$('#refw input').val(e.val());
		}
	});

	$('.state-n').change(function(){
		if($(this).val() == " - "){
			$(this).parent('span').parent('a').removeClass('filled-step');
			return false;
		}
		$('#state').val($(this).val());
		get_council();
		$('.step-process ul li:nth-child(2)').addClass('active');
		$(this).parent('span').parent('a').addClass('filled-step');
	});
	$('.council-n').change(function(){
		$('#council').val($(this).val());
		get_scheme();
		$('.step-process ul li:nth-child(3)').addClass('active');
		$(this).parent('span').parent('a').addClass('filled-step');
	});
	$('.scheme-n').change(function(){
		$('#scheme').val($(this).val());
		get_restriction();
		$('.step-process ul li:nth-child(4)').addClass('active');
		$(this).parent('span').parent('a').addClass('filled-step');
		setTimeout(function(){
			$('#collapseFour .panel-body').empty().append(
				$('<div class="videoins">').append($('#videoins').html()),
				$('<div class="helpins">').append($('#helpins').html()),
				$('<div class="clearfix">')
			);
		//$(this).parent('span').parent('a').trigger('click');
	},500);
		
	});
	$('.zone-n').change(function(){
		$('#zone').val($(this).val());
		get_submit();
		$('.step-process ul li:nth-child(5)').addClass('active');
		$(this).parent('span').parent('a').addClass('filled-step');
	});
	$('.overlays-n select').change(function(){
		$('#overlays').find("option[selected]").removeAttr("selected");
		$(this).find('option:selected').each(function(){
		 	$('#overlays').find('[value="'+$(this).val()+'"]').attr('selected','selected');
		});
		$('.step-process ul li:nth-child(6)').addClass('active');
	});
	$('.precinct-n').change(function(){
		$('#plan').val($(this).val());
		$('.step-process ul li:nth-child(7)').addClass('active');
		$(this).parent('span').parent('a').addClass('filled-step');
		$('.btn-sbm').addClass('btn-active-submit');
	});
	$('.btn-sbm').click(function(){
		$('#submitw input').trigger('click');
	});
	$('#getpdf').click(function(){
		$('#downloadpdf').trigger('click');
	});
});