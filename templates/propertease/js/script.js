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


	/* PRICE PAGE related code */
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

	//copy BTLogin form
	$('#login-form-plan .modal-content').empty().append($('<div class="btl-content-block">').html($('#btl-content-login-y .modal-content').html()));
	$('#registration-form .modal-content').empty().append($('<div class="btl-content-block">').html($('#btl-content-registration').html()));

	$('.block-price  .sbm-btn').click(function(e){
		e.preventDefault();
		if($('.block-price .greyed').length==0){
			return false;
		}
		jQuery('#login-form-plan').modal('show');
	});

	//auto display registration dialog if coming from other pages
	var hash = window.location.hash;
	if(hash =="#register-modal"){
		jQuery('#registration-form').modal('show');
		window.location.hash="";
	}
	//show registration form
	$('.btn-register').click(function(event){
		event.preventDefault();
		$('.modal').modal('hide');
		var url = window.location.href;
		if(url.match('plans.html')){

			setTimeout(function(){
				jQuery('#registration-form').modal('show');
			},500);
			
		}else{
			
			window.location.href=$(this).attr('href')+'#register-modal';
		}
		
		window.location.hash="";
	});



	/* end of sPRICE PAGE related code */
//END OF DOCUMENT READY	
});