$(function() {
 
    var cache = {};
    
    $( "#e-names" ).autocomplete({
      minLength:2,
      source: function( request, response ) {
	        var term = request.term;
	        if ( term in cache ) {
	          response( cache[ term ] );
	          return;
	        }
	 
	        $.post("http://crm.sourcefit.com/hr/json-get-employee-list-by-name", request, response);
	    
	      },
      focus: function( event, ui ) {
        $( "#e-names" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#e-names" ).val( ui.item.label );
        $( "#project-id" ).val( ui.item.id );
        $( "#project-description" ).html( ui.item.desc );
      /*  $( "#project-icon" ).attr( "src",  ui.item.icon );*/
        console.log(ui.item.id+" selected")
 
        return false;
      }
    },"appendTo",".eventInsForm")
    .data('ui-autocomplete')._renderItem = function(ul, item) {
    	
    return $('<li></li>')
        .data('ui-autocomplete-item', item)
        .append('<a>'+
        		'<div class="pull-left">'+
        		'<img height="42" width="42"  class="img-circle" src="' + item.icon + '" />' + 
        		'</div>'+
        		'<h4>'+item.label + 
        		'<small><i class="fa users"></i>Employee</small>'+
        		'</h4>'+
        		'</a>').appendTo(ul);
   
};



$("#assign-employee-schedule").click(function(){
	
	if($( "#project-id" ).val().length > 0 && 
		$('#sched-id').val().length > 0){

	        $.ajax({
              cache: false,
               type: 'POST',
                url: "http://crm.sourcefit.com/hr/assign-sched-to-employee",
                data: {emp_id:$( "#sched-id" ).val(),sched_id:$( "#project-id" ).val()},
                dataType: "json",
             success: function(data){
                       // alert(data.result.sched_id);
            	 location.reload();
                      }
               });
	    
	    
	    
	    //reset
	    $( "#sched-id" ).val("");
	    $( "#project-id" ).val("");
	    $( "#e-names" ).val("");
     }
		
	
});



$('#edit-modal').on('show.bs.modal', function(e) {
    
    var $modal = $(this),
        esseyId = e.relatedTarget.id; // ID
    
//    $.ajax({
//        cache: false,
//        type: 'POST',
//        url: 'backend.php',
//        data: 'EID='+essay_id,
//        success: function(data) 
//        {
            //$modal.find('.edit-content').html(esseyId);
//        }
//    });
    
});


  });