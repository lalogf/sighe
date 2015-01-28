$(document).ready(function() {  	
	$('.contenidoTab').hide();
	$('.contenidoTab:first').show();
	
	$('.tabs-nav li').click(function(){

		$('.tabs-nav li').removeClass('active');
		$(this).addClass('active');
		
		$('.contenidoTab').hide();
		
		var contenido_activo=$(this).find('a').attr('href');
		$(contenido_activo).fadeIn();		
	})
})