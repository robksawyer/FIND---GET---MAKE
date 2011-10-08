// source: http://msdn.microsoft.com/en-us/library/ms537509(v=vs.85).aspx
function getInternetExplorerVersion()
// Returns the version of Internet Explorer or a -1
// (indicating the use of another browser).
{
	var rv = false; // Return value assumes failure.
	if (navigator.appName == 'Microsoft Internet Explorer'){
		var ua = navigator.userAgent;
		var re	= new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null) rv = parseFloat( RegExp.$1 );
	}
	return rv;
}

function addEvent( obj, evt, fn ) {
	if ( typeof obj.attachEvent != 'undefined' )  {
		obj.attachEvent( "on" + evt, fn );
	}
	else if ( typeof obj.addEventListener != 'undefined' ) {
		obj.addEventListener( evt, fn, false );
	}
};

function addElementAfter( node, tag_type, html ) {
	var new_element = document.createElement( tag_type );
	if(html) new_element.innerHTML = html;
	node.parentNode.insertBefore( new_element, node.nextSibling );
};

function getElementsByClassName(cl) {
	var retnode = [];
	var myclass = new RegExp('\\b'+cl+'\\b');
	var elem = document.getElementsByTagName('*');
	for (var i = 0; i < elem.length; i++) {
		var classes = elem[i].className;
		if (myclass.test(classes)) retnode.push(elem[i]);
	}
	return retnode;
};

// source: https://gist.github.com/992575
var jsonp = {
	callbackCounter: 0,
	fetch: function(url, callback) {
		var fn = 'JSONPCallback_' + this.callbackCounter++;
		window[fn] = this.evalJSONP(callback);
		url = url.replace('=JSONPCallback', '=' + fn);
		var scriptTag = document.createElement('SCRIPT');
		scriptTag.src = url;
		document.getElementsByTagName('HEAD')[0].appendChild(scriptTag);
	},
	evalJSONP: function(callback) {
	   return function(data) {
		   var validJSON = false;
		if (typeof data == "string") {
			try {validJSON = JSON.parse(data);} catch (e) {
				/*invalid JSON*/
			}
		} else {
			validJSON = JSON.parse(JSON.stringify(data));
				window.console && console.warn(
				'response data was not a JSON string');
		   }
		   if (validJSON) {
			   callback(validJSON);
		   } else {
			   throw("JSONP call returned invalid or empty JSON");
		   }
	   }
	}
};

/**
 * 
 * @param 
 * @return 
 * 
*/
function refresh_page(o){
	window.location.reload();
}

$(function(){
	
	// fade out good flash messages after 3 seconds  
	$('.flash_good').animate({opacity: 1.0}, 3000).hide("slow");
	//var t=setTimeout("javascript statement",milliseconds);
	
	// fade out flash 'success' messages
	$('#flashMessage').delay(3000).hide('slow');
	
	/*$("#slidingDiv").hide();
	$(".show_hide").show();
	
	$('.show_hide').click(function(){
		$(this).next('#slidingDiv').slideToggle();
		if($(this).html() == "<h3>Hide Details</h3>"){
			$(this).html('<h3>Show Details</h3>');
		}else{
			$(this).html('<h3>Hide Details</h3>');
		}
	});*/
	
	//Add external links icon
	/*$('a[target="_blank"]').filter(function() {
		return this.hostname && this.hostname !== location.hostname;
	}).after(' <img src="/img/icons/external.png" alt="" class="external"/>');*/
	
	$("img").hover(
		function(){
			this.src = this.src.replace("_off", "_on");
		},
		function(){
			this.src = this.src.replace("_on", "_off");
		}
	);
	
	//Get our elements for faster access and set overlay width
	 /*var div = $('div#attachments'),
			 		ul = $('ul.wrapper'),
					// unordered list's left margin
					ulPadding = 15;

	//Remove scrollbars
	div.css({overflow: 'hidden'});
					
	//Get menu width
	var divWidth = div.width();

	//Find last image container
	var lastLi = ul.find('li:last-child');

	//When user move mouse over menu
	div.mousemove(function(e){
		//As images are loaded ul width increases,
		//so we recalculate it each time
		var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;

		var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
		div.scrollLeft(left);
	});*/
});




