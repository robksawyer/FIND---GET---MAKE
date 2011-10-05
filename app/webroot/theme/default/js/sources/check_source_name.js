$(document).ready(function() {
	$("#flashMessage").hide();
	$("#SourceName").focusout(function() {
		$(".ajax_status").css('display','inline');
		//$("#flashMessage").css('display','none');
		var $name = $("#SourceName").val();
		$.post("/ajax/sources/check_name/", {data:{Source:{name:$name}}}, function(data) {
			$(".ajax_status").css('display', 'none');
			if (data == 1) {
				//$("#flashMessage").attr('class','ajax_success');
				if($("#flashMessage").is('error-message')){
					$("#flashMessage").removeClass('error-message');
				}
				$("#flashMessage").addClass('message');
				$("#flashMessage").html('This source name is not in use.');
				$("#flashMessage").show();
			} else {
				//$("#flashMessage").attr('class', 'ajax_error');
				if($("#flashMessage").is('message')){
					$("#flashMessage").removeClass('message');
				}
				$("#flashMessage").addClass('error-message');
				$("#flashMessage").html('This source name is already in use.');
				$("#flashMessage").show();
			}
			//$("#flashMessage").css('display','inline');
		});
	});
});