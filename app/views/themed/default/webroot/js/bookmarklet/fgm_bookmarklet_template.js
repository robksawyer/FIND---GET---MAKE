/*
 * Crossbrowser getElementsByClassName
 */
var getElementsByClassName=function(className,tag,elm){if(document.getElementsByClassName){getElementsByClassName=function(className,tag,elm){elm=elm||document;var elements=elm.getElementsByClassName(className),nodeName=(tag)?new RegExp("\\b"+tag+"\\b","i"):null,returnElements=[],current;for(var i=0,il=elements.length;i<il;i+=1){current=elements[i];if(!nodeName||nodeName.test(current.nodeName)){returnElements.push(current);}}return returnElements;};}else if(document.evaluate){getElementsByClassName=function(className,tag,elm){tag=tag||"*";elm=elm||document;var classes=className.split(" "),classesToCheck="",xhtmlNamespace="http://www.w3.org/1999/xhtml",namespaceResolver=(document.documentElement.namespaceURI===xhtmlNamespace)?xhtmlNamespace:null,returnElements=[],elements,node;for(var j=0,jl=classes.length;j<jl;j+=1){classesToCheck+="[contains(concat(' ', @class, ' '), ' "+classes[j]+" ')]";}try{elements=document.evaluate(".//"+tag+classesToCheck,elm,namespaceResolver,0,null);}catch(e){elements=document.evaluate(".//"+tag+classesToCheck,elm,null,0,null);}while((node=elements.iterateNext())){returnElements.push(node);}return returnElements;};}else{getElementsByClassName=function(className,tag,elm){tag=tag||"*";elm=elm||document;var classes=className.split(" "),classesToCheck=[],elements=(tag==="*"&&elm.all)?elm.all:elm.getElementsByTagName(tag),current,returnElements=[],match;for(var k=0,kl=classes.length;k<kl;k+=1){classesToCheck.push(new RegExp("(^|\\s)"+classes[k]+"(\\s|$)"));}for(var l=0,ll=elements.length;l<ll;l+=1){current=elements[l];match=false;for(var m=0,ml=classesToCheck.length;m<ml;m+=1){match=classesToCheck[m].test(current.className);if(!match){break;}}if(match){returnElements.push(current);}}return returnElements;};}return getElementsByClassName(className,tag,elm);};

/*
* Load jQuery
*/
var fgmLoadJquery = function(){
  var head = document.head || document.getElementsByTagName('head')[0] || document.documentElement,
		  script;

  script = document.createElement('script');
  script.async = "async";
  script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js';
  script.onload = script.onreadystatechange = function(){
	 if(!this.readyState || this.readyState === "loaded" || this.readyState === "complete"){
		script.onload = script.onreadystatechange = null;
		window.fgm_js_loaded = true;
	 }
  };

  head.appendChild(script);
  window.fgm_jquery_native = false;
};

/*
 * FGM Jquery
 */
var fgm_jquery;

/*
 * Add jQuery if needed
 */
if(typeof(jQuery) === 'undefined'){
  // load jquery
  fgmLoadJquery();
} else {
  /*
	* A function to check the jQuery version
	* Thanks: http://stackoverflow.com/questions/2655308/jquery-version-compatibility-detection/3113707#3113707
	*/
  (function($){$.isVersion=function(left,oper,right){if(left){var pre=/pre/i,replace=/[^\d]+/g,oper=oper||"==",right=right||$().jquery,l=left.replace(replace,''),r=right.replace(replace,''),l_len=l.length,r_len=r.length,l_pre=pre.test(left),r_pre=pre.test(right);l=(r_len>l_len?parseInt(l)*((r_len-l_len)*10):parseInt(l));r=(l_len>r_len?parseInt(r)*((l_len-r_len)*10):parseInt(r));switch(oper){case"==":{return(true===(l==r&&(l_pre==r_pre)));}case">=":{return(true===(l>=r&&(!l_pre||l_pre==r_pre)));}case"<=":{return(true===(l<=r&&(!r_pre||r_pre==l_pre)));}case">":{return(true===(l>r||(l==r&&r_pre)));}case"<":{return(true===(l<r||(l==r&&l_pre)));}}}return false;}})(jQuery);

  if(jQuery.isVersion('1.3', '<')){
	 window.fgm_jquery_native = true;
	 window.fgm_js_loaded = true;
  } else {
	 // load jquery
	 fgmLoadJquery();
  }
}

/*
 * Adapted from Product Bookmarking
 * Copyright 2011, Svpply Inc.
 */
function fgm_finder(){
	this.id = 0;
	this.fgm_finds = new Array();
	this.selection = new Object();
	this.needsCategory = true;
	this.needsPrice = true;
	this.base_url = REPLACE_BASE_URL;
	this.array_category = [
		{"id":1,"label":"Accessory"},
		{"id":5,"label":"Furniture"},
		{"id":7,"label":"Lighting"},
		{"id":15,"label":"Textile"},
		{"id":16,"label":"Wallcovering or Finish"},
		{"id":5,"label":"Rug or Mat"},
		{"id":2,"label":"Art or Antique"},
		{"id":43,"label":"Other"}
	];
	this.array_price = new Array("$1-20", "$20-50", "$50-100", "$100-200", "$200-500", "$500-5000", "$5000+");
	
	this.init = function() {
		try {
			// first try to trigger a product button on the page if there is one
			fgm_api.product_buttons[0].generate_iframe();
		} catch(e) {
			// if there's no product button, insert the normal bookmarklet
			this.build();
			this.finder();

			this.selection["public_key"] = REPLACE_PUBLIC_KEY;
			this.selection["referringUrl"] = document.referrer;
			this.selection["baseUrl"] = location.href; // document.baseURI;
			this.selection["pageTitle"] = document.title;
			this.selection["category"] = false;
			this.selection["price"] = false;
		}
	};
		
	this.build = function() {
		if(!document.getElementById("fgm_finder")) {
			var css = document.createElement("link");
			var randNum=Math.floor(Math.random()*11);
			css.setAttribute("href", this.base_url+"theme/default/css/bookmarklet/bookmarklet.001.css?"+randNum);
			css.setAttribute("rel", "stylesheet");
			css.setAttribute("type", "text/css");
			document.getElementsByTagName("head")[0].appendChild(css);

			var container = document.createElement("div");
			container.id = "fgm_finder_container";
			document.getElementsByTagName("body")[0].appendChild(container);

			var overlay = document.createElement("div");
			overlay.id = "fgm_finder";
			overlay.setAttribute("class", "fgm_finder");

			var fgm_user = REPLACE_USERNAME;
			fgm_user = (fgm_user) ? fgm_user : window['fgm_user'];

			var html = '<div class="fgm_finder_header">';
					html += '<img width="300" height="" src="'+this.base_url+'theme/default/img/logo.png"/>';
					html += '<div onclick="fgm_finder.close(0)">CLOSE <span>X</span></div>';
				html += '</div>';
				html += '<div id="fgm_finder_flash" style="display:none;">';
					html += '<div id="fgm_finder_flash_header">Added!</div>';
					html += '<p><a href='+this.base_url+'"profile/'+fgm_user+'">Check it out on your profile.</a> (This window will close momentarily)</p>';
				html += '</div>';
				html += '<div class="fgm_finder_option" id="fgm_finder_category">';
					html += '<div class="separator"></div>';
					html += '<div class="fgm_finder_label">SELECT A CATEGORY <span>(REQUIRED)</span></div>';
					html += '<div class="fgm_finder_selections">';
					html += '<ul>';
					for (var i = 0; i < this.array_category.length; i++) {
						var cat = this.array_category[i];
						if (i == 0) {
							html += "<li class='fgm_finder_first' onclick='fgm_finder.setCategory(" + cat.id + ")' id='fgm_finder_cat_" + cat.id + "'>";
						} else {
							html += "<li onclick='fgm_finder.setCategory(" + cat.id + ")' id='fgm_finder_cat_" + cat.id + "'>";
						}
						html += cat.label + "</li>";
					}
					html += '</ul>';
					html += '<br class="fgm_finder_clear" />';
				html += '</div>';
				html += '<div class="separator"></div>';
				html += '<div class="fgm_finder_option" id="fgm_finder_price">';
					html += '<div class="fgm_finder_label">SELECT A PRICE <span>(REQUIRED)</span></div>';
					html += '<div class="fgm_finder_selections">';
					html += '<ul>';
					for (var i = 0; i < this.array_price.length; i++) {
						if (i == 0) {
							html += "<li class='fgm_finder_first' onclick='fgm_finder.setPrice(" + i + ")' id='fgm_finder_price_" + i + "'>";
						} else {
							html += "<li onclick='fgm_finder.setPrice(" + i + ")' id='fgm_finder_price_" + i + "'>";
						}
						html += this.array_price[i] + "</li>";
					}
					html += '</ul>';
					html += '<br class="fgm_finder_clear" />';
					html += '</div>';
				html += '</div>';
				html += '</div>';

			overlay.innerHTML = html;
			document.getElementsByTagName("body")[0].appendChild(overlay);
			document.getElementById("fgm_finder").style.display = "none";
		}
	};
	
	this.finder = function() {
		var images = document.getElementsByTagName("img"),
			imageCount = images.length,
			availableImages = [],
			self = this;
		
		fgm_jquery.each(images, function(k, v){
			var image = v,
			 imageCheck = fgm_jquery('<img>');
			
			if(v.offsetHeight >= 100 && v.offsetWidth >= 100){
				(function(image){
					imageCheck
					.attr('src', image.src)
					.css({ display: 'none' })
					.load(function(){
					  var width, height, left, top,
							overlay = fgm_jquery('<div>'),
							id = self.id;

					  if(this.width >= 100 && this.height >= 100){
						 self.fgm_finds[id] = image;

						 width = image.offsetWidth;
						 height= image.offsetHeight;
						 left	 = self.positionImage(image)[0];
						 top	 = self.positionImage(image)[1];

						 overlay.attr({
							id: 'fgm_finder_overlay_' + id,
							'class': 'fgm_finder_overlay'
						 }).click(function(){
							self.selectImage(id);
						 }).css({
							display: 'block',
							width: width-40,
							height: height-40,
							left: left,
							top: top
						 })
						 .html("<div id='fgm_finder_inner_" + self.id + "'>CLICK TO ADD</div>").appendTo('#fgm_finder_container');

						 // append this internal counter
						 self.id++;
					  }
					});
			  })(image);
			}
		});
	};
	
	this.positionImage = function(pObj) {
		var posX = pObj.offsetLeft;
		var posY = pObj.offsetTop;

		while (pObj.offsetParent) {
			posX = posX + pObj.offsetParent.offsetLeft;
			posY = posY + pObj.offsetParent.offsetTop;

			if (pObj == document.getElementsByTagName("body")[0]) {
				break;
			} else {
				pObj = pObj.offsetParent;
			}
		}

		return [posX, posY];
	};
	
	this.moveImage = function() {
		for (var i = 0; i < this.id; i++) {
			var overlay = document.getElementById("fgm_finder_overlay_" + i);
			var left = this.positionImage(this.fgm_finds[i])[0];
			var top = this.positionImage(this.fgm_finds[i])[1];

			overlay.style.left = left + "px";
			overlay.style.top = top + "px";
		}
	};
	
	this.selectImage = function(pId) {
		this.selection["id"] = pId;
		this.selection["image"] = this.fgm_finds[pId].src;

		document.getElementById("fgm_finder_inner_" + pId).style.display = "none";

		this.closeImage(pId);
		this.showOverlay();
	};

	this.closeImage = function(pId) {
		for (var i = 0; i < this.id; i++) {
			if (i != pId) {
				document.getElementById("fgm_finder_overlay_" + i).style.display = "none";
			}
		}
	};
	
	this.showOverlay = function() {
		var overlay = document.getElementById("fgm_finder");
		overlay.style.top = (((this.dimensions()[1] / 2) - 126) + this.dimensions()[2]) + "px";
		overlay.style.left = (((this.dimensions()[0] / 2) - 250) + this.dimensions()[3]) + "px";
		overlay.style.display = "block";
		var dragable1 = dragHandler.attach(document.getElementById("fgm_finder"));
	};

	this.moveOverlay = function() {
		var dimensions = this.dimensions();
		var overlay = document.getElementById("fgm_finder");
		overlay.style.top = (((dimensions[1] / 2) - 126) + dimensions[2]) + "px";
		overlay.style.left = (((dimensions[0] / 2) - 250) + dimensions[3]) + "px";
	};
	
	this.setCategory = function(pId) {
		this.selection["category"] = pId;
		this.needsCategory = false;

		for (var i = 0; i < this.array_category.length; i++) {
			if (i == pId) {
				document.getElementById("fgm_finder_cat_" + i).style.color = "#fff100";
			} else {
				document.getElementById("fgm_finder_cat_" + i).style.color = "#fff";
			}
		}

		if (pId == 0 || pId == 1 || pId == 2) {
			//document.getElementById("fgm_finder_category").style.display = "none";
			//document.getElementById("fgm_gender").style.display = "block";
		}

		this.checkSend();
	};
	
	this.setPrice = function(pId) {
		this.selection["price"] = pId;
		this.needsPrice = false;

		for (var i = 0; i < this.array_price.length; i++) {
			if (i == pId) {
				document.getElementById("fgm_finder_price_" + i).style.color = "#fff100";
			} else {
				document.getElementById("fgm_finder_price_" + i).style.color = "#fff";
			}
		}

		this.checkSend();
	};
	
	this.checkSend = function() {
		if (!this.needsCategory && !this.needsPrice) {
			this.send();
		}
	};
	
	this.send = function() {
		var call = this.base_url+"b/"; //The site base url
		call += this.selection["public_key"]; //Check to make sure the key is valid
		call += "?";
		call += "c=" + encodeURIComponent(this.selection["category"]) + "&";
		call += "p=" + encodeURIComponent(this.selection["price"]) + "&";
		call += "i=" + encodeURIComponent(this.selection["image"]) + "&";
		call += "r=" + encodeURIComponent(this.selection["baseUrl"]) + "&";
		call += "t=" + encodeURIComponent(this.selection["pageTitle"]) + "&";
		call += "l=" + encodeURIComponent(this.selection["referringUrl"]);

		// check to see if the bookmarklet needs to communicate through an iframe
		if(!window['fgm_needs_x_domain']){
			var req = document.createElement("script");
			req.setAttribute("src", call);
			req.setAttribute( "method", 'post' );
			req.setAttribute("type", "text/javascript");
			document.getElementsByTagName("head")[0].appendChild(req);
		} else {
			var message = {
						type: 'submit',
						url: call
			};
			// only one of these can actually post, so just do it twice
			var gateway = document.getElementsByClassName('fgm_finder_gateway')[0];
			if(gateway){
				gateway.contentWindow.postMessage(JSON.stringify(message), this.base_url);
			}
		}
		document.getElementById("fgm_finder_inner_" + this.selection["id"]).style.display = "block";
		document.getElementById("fgm_finder_inner_" + this.selection["id"]).innerHTML = "ADDED!";

		this.close(1);
	};
	
	this.close = function(pSuccess) {
		for (var i = 0; i < this.array_category.length; i++) {
			document.getElementById("fgm_finder_cat_" + i).style.color = "#FFF";
		}

		for (var i = 0; i < this.array_price.length; i++) {
			document.getElementById("fgm_finder_price_" + i).style.color = "#FFF";
		}

		this.selection["category"] = false;
		this.selection["price"] = false;

		if(pSuccess) {
			document.getElementById("fgm_finder_price").style.display = "none";
			document.getElementById("fgm_finder_category").style.display = "none";
			document.getElementById("fgm_finder_flash").style.display = "block";
			var _self = this;
			setTimeout(function(){_self.cleanup();}, 1500);
		} else {
			document.getElementById("fgm_finder").style.display = "none";
			this.cleanup();
		}

		// These reset the finder so that all the required fields need to be selected again
		// if the finder is run again on the same page.
		this.needsCategory = true;
		this.needsPrice = true;
		this.isFinding = false;
	};
	
	this.cleanup = function() {
		var body = document.getElementsByTagName('body')[0];
		var container = document.getElementById("fgm_finder_container");
		var fgm_finder = document.getElementById("fgm_finder");
		body.removeChild(container);
		body.removeChild(fgm_finder);

		var message = {
			type: 'cleanup',
		};
		// clean up the iframes if the user closes the scavenger
		var gateway = document.getElementsByClassName('fgm_finder_gateway')[0];
		if(gateway){
			gateway.contentWindow.postMessage(JSON.stringify(message), this.base_url);
		}

		window.fgm_needs_x_domain = null;
		window.fgm_running = false;
		this.id = 0;
	};
	
	this.dimensions = function() {
		var WINDOW_W = 0, WINDOW_H = 0, SCROLL_H = 0, SCROLL_W = 0;

		if (typeof(window.innerWidth) == "number") {
			WINDOW_W = window.innerWidth;
			WINDOW_H = window.innerHeight;
			SCROLL_H = window.pageYOffset;
			SCROLL_W = window.pageXOffset;
		} else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
			WINDOW_W = document.documentElement.clientWidth;
			WINDOW_H = document.documentElement.clientHeight;
			SCROLL_H = document.documentElement.scrollTop;
			SCROLL_W = document.documentElement.scrollLeft;
		} else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
			WINDOW_W = document.body.clientWidth;
			WINDOW_H = document.body.clientHeight;
			SCROLL_H = document.body.scrollTop;
			SCROLL_W = document.body.scrollLeft;
		}

		return [WINDOW_W, WINDOW_H, SCROLL_H, SCROLL_W];
	};
	
	var dragHandler = {
		_oElem : null,
		attach : function(oElem) {
			oElem.onmousedown = dragHandler._dragBegin;
			oElem.dragBegin = new Function();
			oElem.drag = new Function();
			oElem.dragEnd = new Function();
			return oElem;
		},
		_dragBegin : function(e) {
			var oElem = dragHandler._oElem = this;
			if (isNaN(parseInt(oElem.style.left))) { oElem.style.left = '0px'; }
			if (isNaN(parseInt(oElem.style.top))) { oElem.style.top = '0px'; }
			var x = parseInt(oElem.style.left);
			var y = parseInt(oElem.style.top);
			e = e ? e : window.event;
			oElem.mouseX = e.clientX;
			oElem.mouseY = e.clientY;
			oElem.dragBegin(oElem, x, y);
			document.onmousemove = dragHandler._drag;
			document.onmouseup = dragHandler._dragEnd;
			return false;
		},
		_drag : function(e) {
			var oElem = dragHandler._oElem;
			var x = parseInt(oElem.style.left);
			var y = parseInt(oElem.style.top);
			e = e ? e : window.event;
			oElem.style.left = x + (e.clientX - oElem.mouseX) + 'px';
			oElem.style.top = y + (e.clientY - oElem.mouseY) + 'px';
			oElem.mouseX = e.clientX;
			oElem.mouseY = e.clientY;
			oElem.drag(oElem, x, y);
			return false;
		},
		_dragEnd : function() {
			var oElem = dragHandler._oElem;
			var x = parseInt(oElem.style.left);
			var y = parseInt(oElem.style.top);
			oElem.dragEnd(oElem, x, y);
			document.onmousemove = null;
			document.onmouseup = null;
			dragHandler._oElem = null;
		}
	};
	
	//Initialize The FIND|GET|MAKE Finder
	this.init();
}

if(!window.fgm_finder_running){
	var fgm_finder;
	if(!window.fgm_js_loaded){
		var fgm_load_check = setInterval(function(){
			if(!window.fgm_js_loaded){
				return false;
			} else {
				if(!window.fgm_jquery_native){
					fgm_jquery = $.noConflict(true);
				} else {
					fgm_jquery = jQuery;
				}
				clearInterval(fgm_load_check);
				window.fgm_running = true;
				fgm_finder = new fgm_finder();
			}
		}, 100);
	} else {
		if(!window.fgm_jquery_native){
			fgm_jquery = $.noConflict(true);
	 	} else {
			fgm_jquery = jQuery;
		}
		window.fgm_finder_running = true;
		fgm_finder = new fgm_finder();
	}
}
