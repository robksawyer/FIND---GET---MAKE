/* 
 * Title: Photo Tagging
 * Author: Neill Horsman
 * URL: http://www.neillh.com.au
 * Edited: Rob Sawyer
 * URL: http://robksawyer.com
 * Credits: jQuery, imgAreaSelect 
*/
/**
 * This method initializes the image select area.
 */ 
function activateImageSelect(){
	$('img#imageid').imgAreaSelect({
		disable: false, //enable/disable tagging
		hide: false,
		handles: true, //grab handels when selecting the area
		keys: { arrows: 15, shift: 5 }, //keyboard support
		//aspectRatio: '1:1',
		//maxWidth: 62, //adjust the max tag width
		//maxHeight: 62, //adjust the max tag height
		fadeSpeed: 200,
		onSelectEnd: function(img, selection){ //after you have selected an area, show the form and insert tag location values into a form
			//get the position of the placeholder element
			var pos = $('.imgareaselect-selection').offset(); 
			var width = selection.width;
			/*$("#AttachmentTagAddForm").show();
			$("#AttachmentTagAddForm").offset({left:(pos.left), top:pos.top+width});*/
			$('input#x1').val(selection.x1);
			$('input#y1').val(selection.y1);
			$('input#x2').val(selection.x2);
			$('input#y2').val(selection.y2);
			$('input#width').val(selection.width);
			$('input#height').val(selection.height);
			$('#title_container').css('left', (selection.x1)); //Position the form x-value
			$('#title_container').css('top', (selection.y2)); //Position the form y-value
			$('#title_container').removeClass("hide");
			if (selection.width == 0 && selection.height == 0) { 
				$('#title_container').addClass("hide"); 
			} //if there is no selection, hide the form
		},
		onSelectStart: function(img, selection){
			$('#title_container').addClass("hide"); //if reselecting, hide the form
		},
	});
	
}

/**
 * This method disables the image select area.
 */
function disableImageSelect(){
	//Hide the photo tagging form
	$('.start-tagging').removeClass("hide");
	$('.finish-tagging').addClass("hide");
	$('#title_container').addClass("hide");
	$('img#imageid').imgAreaSelect({ 
								disable: true, 
								hide: true 
								}); //disable imgareaselect, this along with start/finish-tagging can be removed if needed
	
}

/**
 * This method is called when the photo tag form is submitted
 */
function doSubmit(id){
	
	var item_id = id;
	var data = $("#InspirationPhotoTagViewForm").serialize();
	disableImageSelect();
	
	$.ajax({
		type: "post",
		url: "/inspiration_photo_tags/add/"+item_id,
		data: data,
		dataType: "json",
		success: function(response, status) {
			handleCallback(response, status);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			handleError(XMLHttpRequest, textStatus, errorThrown);
		}
	});
	
	/**
	* Handle the AJAX callbacks
	*/
	function handleCallback(response, status) {
		// Response was a success
		if (response.success === true) {
			$("#responseSuccess").html("The tag was added.").slideDown();
			
			var counter = 0;
			var titles_html = $(".tag_titles ul#titles").html();
			var map_html = $("#photo-tag-map ul.map").html();
			
			//$.each(response.data, function(key, value) { 
			//Add the new tag to the current html
			//alert(key + ': ' + value); 
			map_html += "<li><a href='#' title='"+response.data.name+"' class=tag_"+response.data.id+"><div style='display:none'>"+response.data.name+"</div></a></li>\n";
			titles_html += "<li><a href='#' class='title' id='tag_"+response.data.id+"'>"+response.data.name+" (<a href='javascript:doDelete("+response.data.id+","+item_id+");' title='Delete tag'>Delete</a>)</li>\n";
			
			//Just in case there were no tags before this one.
			$(".tag_titles").show();
			$("#photo-tag-map ul.map").show();
			
			$('#photo-tag-map').hide();
			
			var titleCSSObj = {
				'margin': '0 0 5px 15px',
				'list-style': 'none',
				'display': 'inline'
				//'border-right': '1px solid #000000',
				//'padding-right': '10px'
			}

			var titleCSSObjLastChild = {
				'border-right':'none'
			}
			
			//Write the html object for the lower title section
			$(".tag_titles ul#titles").html(titles_html);
			$("#titles li").css(titleCSSObj);
			//$("#titles li:last-child").css(titleCSSObjLastChild);
			
			
			var cssObject = {
				'position': 'absolute',
				'left': response.data.x1 + "px !important",
				'top' : response.data.y1 + "px !important",
				'width': response.data.width + "px !important",
				'height': response.data.height + "px !important"
			}
			//This moves the title below the hotspot area
			/*var cssHoverObject = {
				'position': 'relative',
				'top' : response.data.height + "px",
				'left': "0px",
			}*/
			
			$("#photo-tag-map ul.map").html(map_html);
			$("#photo-tag-map ul.map li a.tag_"+response.data.id).css(cssObject);
			//$("#photo-tag-map ul.map li .hover").css(cssLiHoverObject);
			
			//Apply css to the titles
			applyTitleEffects();
			
			$('#photo-tag-map').show();
			
			activateImageSelect();
			
		// Response contains errors
		} else {
			var errors = new Array;

			if (typeof(response.data) == ("object" || "array")) {
				$.each(response.data, function(key, value) {
					var text = (isNaN(key)) ? key +": "+ value : value;
					errors[errors.length] = "<li>"+ text +"</li>";
				});
			} else {
				errors[errors.length] = "<li>"+ response.data +"</li>";
			}

			errors = errors.join("\n");
			$("#responseError").html(errors).slideDown();
		}

		// Remove message after 5 seconds
		setTimeout(function() {
			$(".message").slideUp();
		}, 5000);

		return false;
	}

	/**
	* Handle an AJAX failure
	*/
	function handleError(XMLHttpRequest, textStatus, errorThrown) {
		var error = "<li>An unexpected error has occurred.</li>";
		$("#responseError").html(error).slideDown();
	}
	
	return false;
}


/**
 * This method is called when the photo tag form is submitted
 */
function doDelete(item_id, view_id){
	
	var item_id = item_id;
	var view_id = view_id;
	var data = $("#InspirationPhotoTagViewForm").serialize();

	disableImageSelect();
	
	$.ajax({
		type: "post",
		url: "/inspiration_photo_tags/delete/"+item_id+"/"+view_id,
		data: data,
		dataType: "json",
		success: function(response, status) {
			handleDeleteCallback(response, status);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			handleDeleteError(XMLHttpRequest, textStatus, errorThrown);
		}
	});
	
	/**
	* Handle the AJAX callbacks
	*/
	function handleDeleteCallback(response, status) {
		// Response was a success
		if (response.success === true) {
			$("#responseSuccess").html("The tag was deleted.").slideDown();
			
			$('#photo-tag-map').hide();

			//Remove the item from the display stack
			$("#photo-tag-map ul.map li a.tag_"+item_id).remove();
			$("ul#titles li a#tag_"+item_id).parent().remove();

			//Apply css to the titles
			applyTitleEffects();
			
			$('#photo-tag-map').show();
			
			activateImageSelect();
			
		// Response contains errors
		} else {
			var errors = new Array;

			if (typeof(response.data) == ("object" || "array")) {
				$.each(response.data, function(key, value) {
					var text = (isNaN(key)) ? key +": "+ value : value;
					errors[errors.length] = "<li>"+ text +"</li>";
				});
			} else {
				errors[errors.length] = "<li>"+ response.data +"</li>";
			}

			errors = errors.join("\n");
			$("#responseError").html(errors).slideDown();
		}

		// Remove message after 5 seconds
		setTimeout(function() {
			$(".message").slideUp();
		}, 5000);

		return false;
	}

	/**
	* Handle an AJAX failure
	*/
	function handleDeleteError(XMLHttpRequest, textStatus, errorThrown) {
		var error = "<li>An unexpected error has occurred.</li>";
		$("#responseError").html(error).slideDown();
	}
	
	return false;
}


/** 
 * This method applies the css needed to update the photo tag map
 * when an item in the #titles div is hovered over.
 */
function applyTitleEffects(){
	
	//Tag list hovers ( when hovering the list of tags show the titles.
	$('#titles a.title').hover(function() {
		$('.map li').find('a.' + $(this).attr('id')).addClass('hover');
		$('.map li').find('a.' + $(this).attr('id')).find('div').show().addClass('selected');
	}, function() {
		$('.map li').find('a.' + $(this).attr('id')).removeClass('hover');
		$('.map li').find('a.' + $(this).attr('id')).find('div').hide().removeClass('selected');
	});
	
	//when hovering the tagged areas show the title
	$('.map li a').hover(function() {
		$(this).find('div').show();
	}, function() {
		$(this).find('div').hide();	 
	});
}

/**
 * This method handles positioning the image tag map relative to items on the page.
 * You'll have to customize this if items on the page change.
 */
function positionMap(){
	var img = $('img#imageid'); 
	//or however you get a handle to the IMG
	var offset = img.offset();
	var imgWidth = img.width();
	//var imgHeight = img.height();
	//alert(offset.left);
	
	//Position the tags in the relative area of the image.
	$('ul.map').css({width:imgWidth});
	//$('ul.map').css({position:'absolute',left:offset.left-12,top:offset.top});	
}
