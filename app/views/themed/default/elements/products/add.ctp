<div class="products form">
<?php 
	//$sources = $this->requestAction('products/getSources'); 
	//$productCategories = $this->requestAction('products/getProductsCategories');
?>
<?php 
	echo $this->Form->create('Product',array('type'=>'file','url'=>'/products/add'));
?>
	<fieldset>
		<legend><?php __('Add Product'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name');
		echo $this->Form->input('slug',array('type' => 'hidden'));
		?>
		<div class="side-by-side clearfix"><div>
		<?php
		echo $this->Form->input('product_category_id',array(
																			'empty' => '-- Choose a Category --',
																			'after'=>'<a href="/product_categories/add" class="add-specialty">Add a category</a>',
																			'options'=>$productCategoryList,
																			'class'=>'chzn-select',
																			'style'=>'width: 500px;'
																			));
		?>
		</div></div>
		<?php
		echo $this->Form->input('description');
		echo $this->Form->input('designer');
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('source_url',array('label'=>'Source URL','after'=>'<div class="extra">Where did you find this item? Give credit where credit is due.</div>'));
		echo $this->Form->input('purchase_url',array('label'=>'Purchase URL','after'=>'<div class="extra">Where can this item be purchased?</div>'));
		?>
		<div class="side-by-side clearfix"><div>
		<?php
		echo $this->Form->input('source_id',array('empty'=>'--- Choose a Source ---',
																'after'=>'<a href="/sources/add" class="add-specialty" title="Add a New Source">Add a New Source</a>',
																'options'=>array($sourceList),
																'class'=>'chzn-select',
																'style'=>'width: 500px;'
																));
		?>
		</div></div>
		<?php
		echo $this->element('add_tags',array('cache'=>false,'controller'=>'products'));
		
		if(!empty($collection_id)){
			echo $this->Form->input('Collection.Collection.0',array('type'=>'hidden','value'=>$collection_id));
		}else{
			echo $this->Form->input('Collection',array('after'=>'<div class="extra">Select one or more (hold SHIFT) of the collections below to add the product to the collection(s).</div>'));
		}
		echo $this->Form->input('redirect',array('type'=>'hidden','value'=>$redirect));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript"> //$(".chzn-select").chosen(); </script>