<style type="text/css">
	#image-container{
		position: relative;
		float: left;
	}
	#main-description {
		float: left;
		margin: 0px 0px 0px 25px;
	}
	#smaller-images ul{
		list-style-type: none;
		margin: 5px 0;
		padding: 0;
	}
	#smaller-images ul li{
		list-style-type: none;
		display: inline;
		margin: 0 2px;
		padding: 0;
	}
	/****** FGM FINDER ******/
	div.separator{
		background: lightGrey;
		height: 1px;
		margin: 20px 0px;
	}
	.fgm_clear{
		clear: both;
		margin: 0px;
		padding: 0px;
	}
	#fgm_finder_container *{
		border: 0px;
		font-family: inherit;
		font-size: 100%;
		font-style: inherit;
		font-weight: inherit;
		line-height: 100%;
		list-style: none;
		margin: 0px;
		outline: 0px;
		padding: 0px;
		text-transform: none;
		vertical-align: baseline;
	}
	
	#fgm_finder_container .fgm_finder_overlay{
		font-family: Arial, Helvetica, sans-serif;
		position: absolute;
		padding: 0px;
		margin: 0;
		font-size: 14px;
		font-weight: bold;
		border: 10px solid #ff5237;
		cursor: pointer;
		left: -10px;
		top: -10px;
		z-index: 5e+06;
	}
	#fgm_finder_container .fgm_finder_overlay:hover{
		border: 10px solid #ef3f23;
	}
	#fgm_finder_container .fgm_finder_overlay div{
		background: #ff5237;
		color: black;
		padding: 10px;
		text-align: center;
	}
	#fgm_finder_container .fgm_finder_overlay div:hover{
		background: #ef3f23;
	}
	
	.fgm_finder{
		display: block;
		background: black;
		font-family: Arial, sans-serif;
		padding: 30px;
		position: absolute;
		width: 600px;
		z-index: 5e+06;
	}
	.fgm_header div{
		color: #777;
		cursor: pointer;
		float: right;
		font-size: 11px;
		text-align: left;
	}
	.fgm_header div:hover{
		color: #999;
	}
	.fgm_header span{ color: lightGrey; }
	#fgm_flash{ 
		border-top: 1px solid white;
		color: white;
		display: none;
		margin-bottom: 10px;
		margin-top: 20px;
		text-align: left;
	}
	/****** END FGM FINDER ******/
</style>
<div id="bookmarklet-test">
	<div id="image-container">
		<div id="main-image">
			<?php echo $this->Html->image('http://fpoimg.com/500x550',array('alt' => 'Main image')); ?>
		</div>
		<div id="smaller-images">
			<ul>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
			</ul>
		</div>
	</div>
	<div id="main-description">
		<h4><?php echo $this->Html->link('Allen Edmonds','#',array()); ?></h4>
		<h1>Allen Edmonds Men's Mora Double Monk Strap</h1>
		<p class="rating">5.0 out of 5 stars  See all reviews (1 customer review) | Like (0)</p>
		<p>
			Currently unavailable.
			We don't know when or if this item will be back in stock.
		</p>
		<ul>
			<li>leather</li>
			<li>Leather sole</li>
			<li>Welted construction for outstanding support and durability</li>
		</ul>
		<?php echo $this->Html->link('Show more','#',array()); ?>
	</div>
</div>
<script type="text/javascript">
var fgm_finder = new FGMFinder();

$(window).load(function(){
	fgm_finder.initialize(); //Init the finder class
	var largestImage = getMaxImage();
	$(largestImage).before("<div id='fgm_finder_container'><div class='fgm_finder_overlay'><div class='fgm_finder_inner'>CLICK HERE TO ADD</div></div></div>");
	
	/*$("#fgm_finder_container").after('<div id="fgm_find" class="fgm_finder" style="display:none"><div class="fgm_header"><img width="300" src="http://www.find-get-make.com/theme/default/img/logo.png"/><div onclick="fgm_find.close(0)">CLOSE <span>X</span></div></div><div id="fgm_flash" style="display:none;"><div id="fgm_flash_header">Added!</div><p><a href="http://find-get-make.com/profile/robksawyer">Check it out on your profile.</a> (This window will close momentarily)</p></div><div id="fgm_category"><div class="separator"></div><div class="fgm_label">SELECT A CATEGORY <span>(REQUIRED)</span></div><div class="fgm_selections"><ul><li class="scavenger_first" onclick="fgm_finder.setCategory(0)" id="fgm_cat_0">Apparel</li><li onclick="fgm_finder.setCategory(1)" id="fgm_cat_1">Accessories</li><li onclick="fgm_finder.setCategory(2)" id="fgm_cat_2">Shoes</li><li onclick="fgm_finder.setCategory(3)" id="fgm_cat_3">Tech</li><li onclick="fgm_finder.setCategory(4)" id="fgm_cat_4">Media</li><li onclick="fgm_finder.setCategory(5)" id="fgm_cat_5">Home</li><li onclick="fgm_finder.setCategory(7)" id="fgm_cat_7">Art</li><li onclick="fgm_finder.setCategory(6)" id="fgm_cat_6">Other</li></ul><br class="fgm_clear"></div><div class="separator"></div><div class="fgm_option" id="fgm_price"><div class="fgm_label">SELECT A PRICE <span>(REQUIRED)</span></div><div class="fgm_selections"><ul><li class="fgm_first" onclick="fgm_finder.setPrice(0)" id="fgm_price_0">$1-20</li><li onclick="fgm_finder.setPrice(1)" id="fgm_price_1">$20-50</li><li onclick="fgm_finder.setPrice(2)" id="fgm_price_2">$50-100</li><li onclick="fgm_finder.setPrice(3)" id="fgm_price_3">$100-200</li><li onclick="fgm_finder.setPrice(4)" id="fgm_price_4">$200-500</li><li onclick="fgm_finder.setPrice(5)" id="fgm_price_5">$500-5000</li><li onclick="fgm_finder.setPrice(6)" id="fgm_price_6">$5000+</li></ul><br class="fgm_clear"></div></div></div></div>');*/
	
	$(".fgm_finder_overlay").css({width:$(largestImage).width(),height:$(largestImage).height()});
	
	$(".fgm_finder_overlay").click(function(){
		//Position the form
		var topPos = 75;
 		var leftPos = ($(document).width()/2) - ($("#fgm_finder_container").width()+15);
		$("#fgm_find").css({left: leftPos+"px", top: topPos+"px"});
		//Pass the image source along and load the main popup form
		$("#fgm_find").show();
	});
});


//Build a method to submit the form to FGM
function fgm_finder(){
	this.id = 0;
	this.fgm_finds = new Array();
	this.selection = new Object();
	this.needsCategory = true;
	this.needsPrice = true;
	this.array_category = [
		{"id":0,"label":"Apparel"},
		{"id":1,"label":"Accessories"},
		{"id":2,"label":"Shoes"},
		{"id":3,"label":"Tech"},
		{"id":4,"label":"Media"},
		{"id":5,"label":"Home"},
		{"id":7,"label":"Art"},
		{"id":6,"label":"Other"}
	];
	this.array_price = new Array("$1-20", "$20-50", "$50-100", "$100-200", "$200-500", "$500-5000", "$5000+");
	
	this.init = function() {
		try {
			// first try to trigger a product button on the page if there is one
			//svpply_api.product_buttons[0].generate_iframe();
		} catch(e) {
			// if there's no product button, insert the normal bookmarklet
			this.build();
			this.grab();

			//this.selection["public_key"] = 'svpk_5eeeca1a0b2ed4c29df34327bf8e0ffe';
			this.selection["referringUrl"] = document.referrer;
			this.selection["baseUrl"] = location.href; // document.baseURI;
			this.selection["pageTitle"] = document.title;
			this.selection["category"] = false;
			this.selection["price"] = false;
		}
		
		this.build = function() {
			if(!document.getElementById("fgm_find")) {
				var css = document.createElement("link");
				css.setAttribute("href", "http://svpply.com/assets/css/bookmarklet.001.css");
				css.setAttribute("rel", "stylesheet");
				css.setAttribute("type", "text/css");
				document.getElementsByTagName("head")[0].appendChild(css);

				var container = document.createElement("div");
				container.id = "fgm_finder_container";
				document.getElementsByTagName("body")[0].appendChild(container);

				var overlay = document.createElement("div");
				overlay.id = "fgm_find";
				overlay.setAttribute("class", "fgm_finder");

				var fgm_user = 'robksawyer';
				fgm_user = (fgm_user) ? fgm_user : window['fgm_user'];


				var html = '<div class="fgm_header">';
						html += '<img width="300" src="http://www.find-get-make.com/theme/default/img/logo.png"/>';
						html += '<div onclick="fgm_find.close(0)">CLOSE <span>X</span></div>';
					html += '</div>';
					html += '<div id="fgm_flash" style="display:none;">';
						html += '<div id="fgm_flash_header">Added!</div>';
						html += '<p><a href="http://find-get-make.com/profile/robksawyer">Check it out on your profile.</a> (This window will close momentarily)</p>';
					html += '</div>';
					html += '<div id="fgm_category">';
						html += '<div class="separator"></div>';
						html += '<div class="fgm_label">SELECT A CATEGORY <span>(REQUIRED)</span></div>';
						html += '<div class="fgm_selections">';
						html += '<ul>';
						for (var i = 0; i < this.array_category.length; i++) {
							var cat = this.array_category[i];
							if (i == 0) {
								html += "<li class='fgm_first' onclick='fgm_finder.setCategory(" + cat.id + ")' id='fgm_cat_" + cat.id + "'>";
							} else {
								html += "<li onclick='fgm_finder.setCategory(" + cat.id + ")' id='fgm_cat_" + cat.id + "'>";
							}
							html += cat.label + "</li>";
						}
						html += '</ul>';
						html += '<br class="fgm_clear" />';
					html += '</div>';
					html += '<div class="separator"></div>';
					html += '<div class="fgm_option" id="fgm_price">';
						html += '<div class="fgm_label">SELECT A PRICE <span>(REQUIRED)</span></div>';
						html += '<div class="fgm_selections">';
						html += '<ul>';
						for (var i = 0; i < this.array_price.length; i++) {
							if (i == 0) {
								html += "<li class='fgm_first' onclick='fgm_finder.setPrice(" + i + ")' id='fgm_price_" + i + "'>";
							} else {
								html += "<li onclick='fgm_finder.setPrice(" + i + ")' id='fgm_price_" + i + "'>";
							}
							html += this.array_price[i] + "</li>";
						}
						html += '</ul>';
						html += '<br class="fgm_clear" />';
						html += '</div>';
					html += '</div>';
					html += '</div>';

				overlay.innerHTML = html;
				document.getElementsByTagName("body")[0].appendChild(overlay);
				document.getElementById("fgm_find").style.display = "none";
			}
		};
		
		this.find = function() {
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
								overlay = sv_jquery('<div>'),
								id = self.id;

						  if(this.width >= 100 && this.height >= 100){
							 self.scavenges[id] = image;

							 width = image.offsetWidth;
							 height= image.offsetHeight;
							 left	 = self.positionImage(image)[0];
							 top	 = self.positionImage(image)[1];

							 overlay.attr({
								id: 'fgm_overlay_' + id,
								'class': 'fgm_overlay'
							 }).click(function(){
								self.selectImage(id);
							 }).css({
								display: 'block',
								width: width-40,
								height: height-40,
								left: left,
								top: top
							 })
							 .html("<div id='fgm_inner_" + self.id + "'>CLICK TO ADD</div>").appendTo('#fgm_container');

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
				var overlay = document.getElementById("fgm_overlay_" + i);
				var left = this.positionImage(this.fgm_finds[i])[0];
				var top = this.positionImage(this.fgm_finds[i])[1];

				overlay.style.left = left + "px";
				overlay.style.top = top + "px";
			}
		};
		
		this.selectImage = function(pId) {
			this.selection["id"] = pId;
			this.selection["image"] = this.fgm_finds[pId].src;

			document.getElementById("fgm_inner_" + pId).style.display = "none";

			this.closeImage(pId);
			this.showOverlay();
		};

		this.closeImage = function(pId) {
			for (var i = 0; i < this.id; i++) {
				if (i != pId) {
					document.getElementById("fgm_overlay_" + i).style.display = "none";
				}
			}
		};
		
		this.showOverlay = function() {
			var overlay = document.getElementById("fgm_find");
			overlay.style.top = (((this.dimensions()[1] / 2) - 126) + this.dimensions()[2]) + "px";
			overlay.style.left = (((this.dimensions()[0] / 2) - 250) + this.dimensions()[3]) + "px";
			overlay.style.display = "block";
			var dragable1 = dragHandler.attach(document.getElementById("fgm_find"));
		};

		this.moveOverlay = function() {
			var dimensions = this.dimensions();
			var overlay = document.getElementById("fgm_find");
			overlay.style.top = (((dimensions[1] / 2) - 126) + dimensions[2]) + "px";
			overlay.style.left = (((dimensions[0] / 2) - 250) + dimensions[3]) + "px";
		};
		
		this.setCategory = function(pId) {
			this.selection["category"] = pId;
			this.needsCategory = false;

			for (var i = 0; i < this.array_category.length; i++) {
				if (i == pId) {
					document.getElementById("fgm_cat_" + i).style.color = "#fff100";
				} else {
					document.getElementById("fgm_cat_" + i).style.color = "#fff";
				}
			}

			if (pId == 0 || pId == 1 || pId == 2) {
				this.needsGender = true;

				document.getElementById("fgm_category").style.display = "none";
				document.getElementById("fgm_gender").style.display = "block";
			}

			this.checkSend();
		};
		
		this.setPrice = function(pId) {
			this.selection["price"] = pId;
			this.needsPrice = false;

			for (var i = 0; i < this.array_price.length; i++) {
				if (i == pId) {
					document.getElementById("fgm_price_" + i).style.color = "#fff100";
				} else {
					document.getElementById("fgm_price_" + i).style.color = "#fff";
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
			var call = "http://find-get-make.com/b/";
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
				var gateway = document.getElementsByClassName('fgm_gateway')[0];
				if(gateway){
					gateway.contentWindow.postMessage(JSON.stringify(message), 'http://find-get-make.com');
				}
			}
			document.getElementById("fgm_inner_" + this.selection["id"]).style.display = "block";
			document.getElementById("fgm_inner_" + this.selection["id"]).innerHTML = "ADDED!";

			this.close(1);
		};
		
		this.close = function(pSuccess) {
			for (var i = 0; i < this.array_category.length; i++) {
				document.getElementById("fgm_cat_" + i).style.color = "#FFF";
			}

			for (var i = 0; i < this.array_price.length; i++) {
				document.getElementById("fgm_price_" + i).style.color = "#FFF";
			}

			this.selection["category"] = false;
			this.selection["price"] = false;

			if(pSuccess) {
				document.getElementById("fgm_price").style.display = "none";
				document.getElementById("fgm_category").style.display = "none";
				document.getElementById("fgm_flash").style.display = "block";
				var _self = this;
				setTimeout(function(){_self.cleanup();}, 1500);
			} else {
				document.getElementById("fgm_find").style.display = "none";
				this.cleanup();
			}

			// These reset the grabber so that all the required fields need to be selected again
			// if the grabber is run again on the same page.
			this.needsCategory = true;
			this.needsPrice = true;
			this.isGrabbing = false;
		};
		
		this.cleanup = function() {
			var body = document.getElementsByTagName('body')[0];
			var container = document.getElementById("fgm_finder_container");
			var fgm_finder = document.getElementById("fgm_find");
			body.removeChild(container);
			body.removeChild(fgm_finder);

			var message = {
				type: 'cleanup',
			};
			// clean up the iframes if the user closes the scavenger
			var gateway = document.getElementsByClassName('fgm_gateway')[0];
			if(gateway){
				gateway.contentWindow.postMessage(JSON.stringify(message), 'http://find-get-make.com');
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
		
	};
	
	//Initialize The FIND|GET|MAKE Finder
	this.init();
};

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


function getMaxImage() {
	var maxDimension = 0;
	var maxImage = null;

	// Iterate through all the images.
	var imgElements = document.getElementsByTagName('img');
	for (var index in imgElements) {
		var img = imgElements[index];
		var currDimension = img.width * img.height;
		if (currDimension  > maxDimension){
			maxDimension = currDimension
			maxImage = img;
		}
	}
	// Check if an image has been found.
	if (maxImage){
		return maxImage;
	}else{
		return null;
	}
}
</script>