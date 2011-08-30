//<![CDATA[
//Wait for the DOM
$(document).ready(function(){

	$("#ownership-form-button").live('click', function(event) {
		$(this).addClass("selected");
		$(".pop").slideFadeToggle()
		return false;
	});

	$(".close").live('click', function() {
		$(".pop").slideFadeToggle();
		$(".messagepop fieldset.form-type").show();
		$(".messagepop fieldset.return-type").hide();
		$(".messagepop fieldset.return-type").html("");
		$("#ownership-form-button").removeClass("selected");
		return false;
	});

	$(".ok-button").live('click', function() {
		$(".pop").slideFadeToggle();
		$(".messagepop fieldset.form-type").show();
		$(".messagepop fieldset.return-type").hide();
		$(".messagepop fieldset.return-type").html("");
		$("#ownership-form-button").removeClass("selected");
		return false;
	});
});
	
$.fn.slideFadeToggle = function(easing, callback) {
	return this.animate({ opacity: 'toggle', height: 'toggle' }, "fast", easing, callback);
};

/**
 * 
 * @param model
 * @return 
 * 
*/
function doSubmit(model,model_id){
	//var model = this.model;
	//var model_id = this.model_id;
	var data = $("#OwnershipSetOwnershipForm").serialize();
	
	$.ajax({
		type: "post",
		url: "/ownerships/set_ownership/"+model+"/"+model_id,
		target:	'.messagepop fieldset.return-type',
		data: data,
		dataType: "json",
		success: showResponse,
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			$('.messagepop fieldset.return-type').html(textStatus + " : " +errorThrown);
			$('.messagepop fieldset.return-type').show();
			//handleError(XMLHttpRequest, textStatus, errorThrown);
		}
	});
	
	function showResponse(response, status) {
		//var data = jQuery.parseJSON(responseText);
		console.log(response);
		//console.log(status);
		// Response was a success
		if (response.success === true) {
			data = response.data;
			//Update the counts
			var totalWhoHave = data.total_who_have;
			var totalWhoWant = data.total_who_want;
			//var totalWhoHad = data.total_who_had;
			//alert(totalWhoHave + " : " + totalWhoWant + " : "+ totalWhoHad);

			$(".ownership-counts .haveuser-count").html(totalWhoHave);
			$(".ownership-counts .wantuser-count").html(totalWhoWant);
			//$(".ownership-counts .haduser-count").html(totalWhoHad);

			$(".messagepop").css('width','250px');
			$(".ownership-button").addClass('selected');
			$(".messagepop fieldset.form-type").hide();
			$(".messagepop fieldset.return-type").show();
			$(".messagepop fieldset.return-type").html("<p>This item has been added to your "+data.ownership_type+" list.</p><p class='ok-button'><a href='javascript:void(0);' title='ok'>ok</a></p>");
			$("#ownership-form-button").text("+ you "+data.ownership_type+" it");
		}

		return false;
		/*alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
			'\n\nThe output div should have already been updated with the responseText.'); */
	}
}
	
//]]>