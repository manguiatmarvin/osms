$(function() {
	//alert("DOM ready");
	
	//auto destruct dissmissable flash message 
	setTimeout(
			  function() 
			  {
				  $('.alert-dismissable').slideUp(500,function(){
					  $(this).hide();
				  })
				  
			  }, 5000);
	

});