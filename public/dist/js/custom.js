$(function () {
   
	
	function toggleChevron(e) {
	    $(e.target)
	        .prev('.panel-heading')
	        .find("i.indicator")
	        .toggleClass(' fa-chevron-circle-down   fa-chevron-circle-up');
	}
	
	$('#accordion').on('hidden.bs.collapse', toggleChevron);
	$('#accordion').on('shown.bs.collapse', toggleChevron);

});