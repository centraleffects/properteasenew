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

	$('.scheme-n').change(function(){
		$('.step-process ul li:nth-child(4)').addClass('active');
		$('#collapsethree').addClass('filled-step');
	});
	$('#getpdf').click(function(){
		$('#downloadpdf').trigger('click');
	});
	$('.block-price .block').click(function(){
		$('.block-price .block').addClass('greyed');
		$(this).removeClass('greyed');
		$('.block-price  .sbm-btn').addClass('btn-green');
	});
	$('.block-price  .sbm-btn').click(function(e){
		e.preventDefault();
		//jQuery('#login-popup').modal('show');
		/*$('#btl-panel-login-y').trigger('click');
		setTimeout(function(){ 
			$('#btl-panel-login-y').removeAttr('style');
		},900);*/
		alert('');
	});
});