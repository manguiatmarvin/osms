$(function() {
	//auto destruct dissmissable flash message 
	setTimeout(
			  function() 
			  {
				  for(i=0;i<3;i++) {
					  $('.alert-dismissable').fadeTo('fast', 0.5).fadeTo('fast', 1.0);
                  }
				  fadeOut();
				  
			  }, 300);
	
	
	
	function fadeOut(){
		setTimeout(
				  function(){
					  $('.alert-dismissable').fadeOut('slow');	  
					  
				  },5000);	
	}
	
	
	
	$( ".datepicker" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
	      dateFormat:'mm/dd/yy'
	      
	 });
	
	$( "button, input[type='button']" ).addClass( "btn btn-primary" );
	$('#image-file').addClass( "btn btn-primary" );
	
	
});// end function