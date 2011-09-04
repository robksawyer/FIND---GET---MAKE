var showingContainer = false;

$(document).ready(function(){

	// fade out good flash messages after 3 seconds  
	$('.flash_good').animate({opacity: 1.0}, 3000).hide("slow");
	//var t=setTimeout("javascript statement",milliseconds);
		
	$(".debuggg").click(function () {
			      $(".debuggg-inner").slideToggle("slow");
			    });
			
	
	// fade out flash 'success' messages
	$('#flashMessage').delay(3000).hide('slow');
	
	$("#slidingDiv").hide();
	$(".show_hide").show();
	
	$('.show_hide').click(function(){
		$(this).next('#slidingDiv').slideToggle();
		if($(this).html() == "<h3>Hide Details</h3>"){
			$(this).html('<h3>Show Details</h3>');
		}else{
			$(this).html('<h3>Hide Details</h3>');
		}
	});
	
	//Add external links icon
	$('a[target="_blank"]').filter(function() {
		return this.hostname && this.hostname !== location.hostname;
	}).after(' <img src="/img/icons/external.png" alt="" class="external"/>');
	
	
	
	$("img").hover(
		function(){
			this.src = this.src.replace("_off", "_on");
		},
		function(){
			this.src = this.src.replace("_on", "_off");
		}
	);
	
	//Get our elements for faster access and set overlay width
	 var div = $('div#attachments'),
			 		ul = $('ul.wrapper'),
					// unordered list's left margin
					ulPadding = 15;

	//Get menu width
	var divWidth = div.width();

	//Remove scrollbars
	div.css({overflow: 'hidden'});

	//Find last image container
	var lastLi = ul.find('li:last-child');

	//When user move mouse over menu
	div.mousemove(function(e){
		//As images are loaded ul width increases,
		//so we recalculate it each time
		var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;

		var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
		div.scrollLeft(left);
	});
	
	$("#add-container #inner-container").hide();
	
});

/**
 * 
 * @param 
 * @return 
 * 
*/
function showContainer(){
	if(showingContainer == false){
		showingContainer = true;
		$("#add-container a.show-container").text('Hide the Add Form');
		$("#add-container #inner-container").fadeIn(400);
	}else{
		showingContainer = false;
		$("#add-container a.show-container").text('Show the Add Form');
		$("#add-container #inner-container").fadeOut(400);
	}
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function refresh_page(o){
	window.location.reload();
}





