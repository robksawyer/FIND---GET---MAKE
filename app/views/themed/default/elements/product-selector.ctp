<?php
	//CSS
	echo $this->Html->css('product-selector','stylesheet',array('inline'=>false));
	echo $this->Html->css('modal/productselector','stylesheet',array('inline'=>false));
	//JS
	//echo $this->Html->script('inspirations/product-selector',array('inline'=>false));
	echo $this->Html->script('products/selector',array('inline'=>false));
	//echo $this->Html->script('modal/jquery.productselectormodal.min',array('inline'=>false));
	
	//Get all of the products in the system and create a JSON array of these objects
	//Pass along the id so that only the items that aren't already added can be added.
	//$products = $this->requestAction("products/getAll");
	//$productList = $this->requestAction("products/getList");
	
	if(!empty($products)){
		//Create a products array of the current products
		$currentProducts = array();
		for($i=0;$i<count($item['Product']);$i++){
			$currentProducts[] = $item['Product'][$i]['id'];
		}
		
		$removeItem = array();
		$clean_products = array();
		//debug(count($products));

		for($i=0;$i<count($products);$i++){
			if(!empty($currentProducts)){
				if(in_array($products[$i]['Product']['id'],$currentProducts)){
					$removeItem[] = $products[$i]['Product']['id'];
					//unset($products[$i]);
				}elseif(empty($products[$i]['Attachment'])){
					//Check to make sure that there's an image associated with the product.
					$removeItem[] = $products[$i]['Product']['id'];
					//unset($products[$i]);
				}elseif(empty($products[$i]['Attachment'][0]['path_small'])){
					//Check to make sure that there's an image associated with the product.
					$removeItem[] = $products[$i]['Product']['id'];
					//unset($products[$i]);
				}else{
					$clean_products[] = $products[$i];
				}
			}else{
				if(empty($products[$i]['Attachment'])){
					//Check to make sure that there's an image associated with the product.
					$removeItem[] = $products[$i]['Product']['id'];
					//unset($products[$i]);
				}elseif(empty($products[$i]['Attachment'][0]['path_small'])){
					//Check to make sure that there's an image associated with the product.
					$removeItem[] = $products[$i]['Product']['id'];
					//unset($products[$i]);
				}else{
					$clean_products[] = $products[$i];
				}
			}
		}
		
		$products = $clean_products;
		//debug(empty($products[11]['Attachment']));
		//debug($removeItem);
		
		for($i=0;$i<count($removeItem);$i++){
			//debug($productList[$removeItem[$i]]);
			unset($productList[$removeItem[$i]]);
		}
		if(empty($productList)){
			$productList[] = ''; //All of the products have been added to the collection. 
		}
		
		//$products = array_values($products); //Reset the array keys after the unset
		$products = array_merge(array(),$products);
		//Try to estimate the width of the scroll content
		$scrollContentWidth = intval(count($products) * (170+10+5));
		//debug($scrollContentWidth);
		//debug($products);
		$jsonProducts = $this->Js->object($products);
	}else{
		$products = '';
	}
?>
<!-- PRODUCT SELECTOR MODAL CONTENT -->
<div id="product-selector-modal-content" style="display:none">
	<h3>Add Existing Products</h3>
	<div class="clear"></div>
	<p>Select products below to add them. Hold down [command] to select multiple options and [option] to remove a selection.</p>
	<div id="model-content-products">
	</div>
</div>
<!-- preload the images -->
<div style='display:none'>
	<?php 
		echo $this->Html->image('/img/modal/x.png',array('alt'=>'Close')); 
		echo $this->Html->image('/img/modal/x_on.png',array('alt'=>'Close')); 
	?>
</div>
<!-- END PRODUCT SELECTOR MODAL CONTENT -->
<script type="text/javascript">
	var local_products = <?php echo $jsonProducts; ?>;
	var local_id = <?php echo "'".$id."'"; ?>;
	var local_scrollContentWidth = <?php echo $scrollContentWidth; ?>;
	var local_model = <?php echo "'".$model."'"; ?>;
	var local_controller = <?php echo "'".$controller."'"; ?>;
	<?php 
		if(!empty($productList)){
			$htmlVal = $this->Form->input('Product',array(
																'label'=>'',
																'type' => 'select', 
																'multiple' => 'multiple',
																'options' => $productList,
																'class'=>'chzn-select',
																'style'=>'width:500px;'
																)
															);
			$htmlVal = str_replace("\n","",$htmlVal);
			$htmlVal = str_replace("\t","",$htmlVal);
			$htmlVal = str_replace("\r","",$htmlVal);
		}else{
			debug('ERROR: You did not set the product list values. Or, all of the products have been added.');
		}
	?>
	var local_productOptions = <?php echo "'".$htmlVal."'"; ?>;
	
	/*
		TODO Build a class for the product selector
	*/
	$(window).load(function() {
		
		// Load dialog on click
		$('.product-selector-modal-button').click(function (e) {
			/*$.modal.defaults = {
				appendTo: 'body',
				focus: true,
				opacity: 50,
				overlayId: 'simplemodal-overlay',
				overlayCss: {},
				containerId: 'simplemodal-container',
				containerCss: {},
				dataId: 'simplemodal-data',
				dataCss: {},
				minHeight: null,
				minWidth: null,
				maxHeight: null,
				maxWidth: null,
				autoResize: false,
				autoPosition: true,
				zIndex: 1000,
				close: true,
				closeHTML: '<a class="modalCloseImg" title="Close"></a>',
				closeClass: 'simplemodal-close',
				escClose: true,
				overlayClose: false,
				position: null,
				persist: false,
				modal: true,
				onOpen: null,
				onShow: null,
				onClose: null
			};*/
			
			$('#product-selector-modal-content').modal({
																		overlayId: 'productselector-overlay',
																		containerId: 'productselector-container',
																		dataId: 'productselector-data',
																		closeClass: 'productselector-close',
																		onShow:function(){
																			if(local_products){
																				setProducts(local_model, local_controller, local_id,local_products,local_productOptions); //Setup the products
																			}else{
																				alert("ERROR: The products haven't been set.")
																			}

																			//Init
																			product_selector_init(local_scrollContentWidth);
																			//resetSelector();
																		}
																	});
			if(!selector_activated){
				//Loads only once, when the modal is opened.
				selector_activated = true;
			}
			return false;
		});
	});
</script>