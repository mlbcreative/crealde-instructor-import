jQuery(document).ready(function($){
	
	$('#loadingMsg').hide();
	
	$('#pii-form').submit(function() {
		$('#loadingMsg').show();
		var data = {
			action : 'pii_get_results',
			instructorid : $('#instructor_id').val()
		}
		

		$.post(ajaxurl, data, function(response){
			$('#loadingMsg').hide();
			alert(response);
			
		});
		
		
		return false; //prevent default behavior
	});
})