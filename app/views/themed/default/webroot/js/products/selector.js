//var products;
var scrollPane;
var scrollContent;
var scrollbar;
var handleHelper;
var scrollContentWidth;
var selector_activated = false;
/**
 * @param inspiration_id The current inspiration
 * @param Array jsonProducts An array of all products in the system, minus the ones that are
 * already added to the inspiration. 
 * @param contentWidth The content width of the content inside of the scrollpane
**/ 
function product_selector_init(contentWidth){
	this.scrollContentWidth = contentWidth;
	//alert(contentWidth);
	setupScrollPane();
	
	resetSelector();
}

/** 
 * The main initialization method to setup the scrollpane
 * @param
 */ 
function setupScrollPane(){
	//alert("Setting up scrollpane...");
	var img = $("img")[0]; // Get my img elem
	//Scrollbar
	//scrollpane parts
	scrollPane = $(".scroll-pane" );
	scrollContent = $(".scroll-content");
	
	//Set the scroll content width
	if(scrollContentWidth < 500){
		//If the width is less than the scrollpane width, the scrollbar doesn't function properly and the items don't position properly.
		//scrollContentWidth = 600; 
	}
	scrollContent.css('width',scrollContentWidth);
	scrollContent.width(scrollContentWidth);
	
	$("#selectable" ).selectable({
								filter: 'li',
								selected: function(event, ui) {
									$(".ui-selected").each(function() {
										var itemID = $(this).children('img').attr("id");
										itemID = itemID.replace("Product","");
										$('select#ProductProduct option[value="'+itemID+'"]').attr('selected',true);
									});
								},
								unselected: function(event, ui) {
									$(ui.unselected).each(function() {
										var itemID = $(this).children('img').attr("id");
										itemID = itemID.replace("Product","");
										$('select#ProductProduct option[value="'+itemID+'"]').removeAttr('selected');
									});
								}
								});
								
	//build slider
	scrollbar = $( ".scroll-bar" ).slider({
		slide: function( event, ui ) {
			if ( scrollContent.width() > scrollPane.width() ) {
				scrollContent.css( "margin-left", Math.round(
					ui.value / 100 * ( scrollPane.width() - scrollContent.width() )
				) + "px" );
			} else {
				scrollContent.css({
					"margin-left":"0px !important"
					});
			}
		}
	});
	
	//append icon to handle
	//Only do this once and not everytime the modal is opened.
	handleHelper = scrollbar.find( ".ui-slider-handle" )
	.mousedown(function() {
		scrollbar.width( handleHelper.width() );
	})
	.mouseup(function() {
		scrollbar.width( "100%");
	})
	.append( "<span class='ui-icon ui-icon-grip-dotted-vertical'></span>" )
	.wrap( "<div class='ui-handle-helper-parent'></div>" ).parent();
	
	//change overflow to hidden now that slider handles the scrolling
	scrollPane.css( "overflow", "hidden" );
	
	//init scrollbar size
	setTimeout( sizeScrollbar, 10 );//safari wants a timeout
	
}


/**
 * Setup the product scrollpane and filters
 * @param model The model to target
 * @param controller The controller to target
 * @param int Id of the current item
 * @param Array A JSON array of all of the products
 * @param String productOptions The options for the filter input
 * 
 * @description When the user clicks on the image, it'll highlight and show that it's selected. When the user clicks on a button
 * named Add to model. The products selected will be added to the model.
 **/
function setProducts(model, controller, id,products,productOptions){
	//alert("Loading selector products...");
	var counter = 0;
	this.products = products;
	this.productOptions = productOptions;
	this.item_id = id;
	this.model = model;
	this.controller = controller;
	//alert(products[0].Attachment[0].path_small);
	var products_form = '';
	products_form += '<div class="side-by-side clearfix"><div>';
		
	products_form += this.productOptions;
	products_form += '</div></div>';
	
	products_form += '<form id="'+this.model+'AdminAddForm" enctype="multipart/form-data" method="post" action="/'+this.controller+'/addProducts/'+this.item_id+'" accept-charset="utf-8">';
	products_form += '<input type="hidden" name="data['+this.model+'][id]" value="'+this.item_id+'" id="'+this.model+'Id" />';
	products_form += '<select type="hidden" name="data[Product][Product][]" multiple="multiple" id="ProductProduct" style="display:none;">';
	for(var i=0;i<this.products.length;i++){
		if(this.products[i].Attachment[0]){
			products_form += "<option value='"+this.products[i].Product.id+"'>"+this.products[i].Product.name+"</option>";
		}
	}
	products_form += '</select>';	
	products_form += '<div class="scroll-pane ui-widget ui-widget-header ui-corner-all">';
	products_form += '<ol id="selectable" class="scroll-content">';
	for(var i=0;i<this.products.length;i++){
		if(this.products[i].Attachment[0]){
			products_form += "<li class='ui-state-default scroll-content-item ui-widget-header'>";
			products_form += "<img src='"+this.products[i].Attachment[0].path_small+"' alt='"+this.products[i].Product.name+"' height='100' id='Product"+this.products[i].Product.id+"'/><br/>";
			products_form += "<span>"+this.products[i].Product.name+"</span>";
			products_form += "</li>\n";
		}
	}
	products_form += '</ol>';
	products_form += '<div class="scroll-bar-wrap ui-widget-content ui-corner-bottom">';
	products_form += '<div class="scroll-bar"></div>';
	products_form += '</div>';
	products_form += '</div>';
	//products_form += '<div class="clear"></div>';
	products_form += '<div class="submit"><input type="submit" value="Attach Products"></div>';
	products_form += '</form>';
	//products_form += '<script type="text\/javascript">$(".chzn-select").chosen();<\/script>';
	
	var products_selector_html = products_form;
	
	$("#model-content-products").html(products_selector_html);
}

/**
 * Resets the scroll pane area.
 **/ 
function resetSelector(){
	//alert("Resetting selector...");
	applyChosenDropboxes();
	
	resetValue();
	sizeScrollbar();
	reflowContent();
	
}

/**
 * Sets up the chosen dropdown boxes.
 * http://harvesthq.github.com/chosen/
 */ 
function applyChosenDropboxes(){
	
	var hidden = [];
	var option_id;
	var selected_items;
	
	$(".chzn-select").chosen();
	$(".chzn-select").change(function(val) { 
		var the_val = $(this).val();
		
		if(option_id && the_val){
			selected_items = the_val.toString().split(',');

			if(selected_items){
				if(selected_items.length > 1){
					option_id = [];

					//Hide the products that aren't in the selected item
					for(var y=0;y<products.length;y++){
						var product_id = products[y].Product.id;
						//alert(jQuery.inArray(product_id,selected_items) + " : " + product_id);
						if(jQuery.inArray(product_id,selected_items)==-1){
							if($("img#Product"+product_id).parent().is(":visible")){
								$("img#Product"+product_id).parent().fadeOut();
								hidden.push(product_id);
							}
						}
					}

					for(var j=0;j<selected_items.length;j++){
						//Show the hidden product
						$("img#Product"+selected_items[j]).parent().fadeIn();
						option_id[j] = selected_items[j];
						for(var i=0;i<hidden.length;i++){
							if(selected_items[j] == hidden[i]){
								hidden[i] = null;
							}
						}
					}

				}else{

					//Hide the products that aren't in the selected item
					for(var y=0;y<products.length;y++){
						var product_id = products[y].Product.id;
						if(jQuery.inArray(product_id,selected_items)==-1){
							if($("img#Product"+product_id).parent().is(":visible")){
								$("img#Product"+product_id).parent().fadeOut();
								hidden.push(product_id);
							}
						}
					}

					$("img#Product"+selected_items).parent().fadeIn();
					option_id = selected_items;
					for(var i=0;i<hidden.length;i++){
						if(selected_items == hidden[i]){
							hidden[i] = null;
						}
					}
				}
			}else{
				if(option_id != $(this).val()){
					for(var i=0;i<hidden.length;i++){
						$("img#Product"+hidden[i]).parent().fadeIn();
						hidden[i] = null;
					}
				}
				selected_items = null;
				option_id = null;
			}
		}else{
			//First selection
			option_id = $(this).val();
			selected_items = option_id;

			if(option_id){
				for(var i=0;i<products.length;i++){
					//alert(products[i].Product.id);
					var product_id = products[i].Product.id;
					if(product_id != option_id){
						$("img#Product"+product_id).parent().fadeOut();
						hidden.push(product_id);
					}
				}
			}else{
				for(var y=0;y<products.length;y++){
					var product_id = products[y].Product.id;
					$("img#Product"+product_id).parent().fadeIn();
					hidden = [];
				}
			}
		}

		//alert(selected_items.length);
		/*if(selected_items){
			var scrollContentWidth = parseInt((selected_items.length) * (170+10+5));
			if(scrollContentWidth < scrollPane.width()){
				scrollContentWidth = scrollPane.width();
				scrollContent.width(scrollContentWidth);
			}
			$(".scroll-content").css('width',scrollContentWidth);
			$(".scroll-content").width(scrollContentWidth);

			resetValue();
			sizeScrollbar();
			reflowContent();
		}*/

	});
}


//change handle position on window resize
$(window).resize(function() {
	resetValue();
	sizeScrollbar();
	reflowContent();
});

//size scrollbar and handle proportionally to scroll distance
function sizeScrollbar() {
	var remainder = scrollContent.width() - scrollPane.width();
	if(remainder < 1){
		//remainder = scrollContent.width();
		scrollbar.find( ".ui-slider-handle" ).hide();
	}else{
		scrollbar.find( ".ui-slider-handle" ).show();
	}
	var proportion = remainder / scrollContent.width();
	var handleSize = scrollPane.width() - ( proportion * scrollPane.width() );
	scrollbar.find( ".ui-slider-handle" ).css({
		width: handleSize,
		"margin-left": -handleSize / 2
	});
	handleHelper.width( "" ).width( scrollbar.width() - handleSize );
}

//reset slider value based on scroll content position
function resetValue() {
	var remainder = scrollPane.width() - scrollContent.width();
	var leftVal = scrollContent.css( "margin-left" ) === "auto" ? 0 :
		parseInt( scrollContent.css( "margin-left" ) );
	var percentage = Math.round( leftVal / remainder * 100 );
	scrollbar.slider( "value", percentage );
}

//if the slider is 100% and window gets larger, reveal content
function reflowContent() {
	var showing = scrollContent.width() + parseInt( scrollContent.css( "margin-left" ), 10 );
	var gap = scrollPane.width() - showing;
	if ( gap > 0 ) {
		scrollContent.css( "margin-left", parseInt( scrollContent.css( "margin-left" ), 10 ) + gap );
	}
	
	/*
		CHANGED Extra check to make sure that the content aligns to the left if scrollContent is not as wide as the scrollPane.
	*/
	if ( scrollContent.width() < scrollPane.width() ) {
		scrollContent.css({
			"margin-left":"0px !important"
			});
	}
}