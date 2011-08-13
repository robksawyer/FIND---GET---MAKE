<div class="products form">
<?php 
	$sources = $this->requestAction('products/getSources'); 
	$productCategories = $this->requestAction('products/getProductsCategories');
?>
<?php 
	echo $this->Form->create('Product',array('type'=>'file','url'=>'/admin/products/add'));
?>
	<fieldset>
		<legend><?php __('Add Product'); ?></legend>
	<?php
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name');
		echo $this->Form->input('slug',array('type' => 'hidden'));
		echo $this->Form->input('product_category_id',array('empty' => '-- Choose a Category --','after'=>'<a href="/admin/product_categories/add" class="add-specialty">Add a category</a>','options'=>$productCategories));
		echo $this->Form->input('description');
		echo $this->Form->input('designer');
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('source_url',array('label'=>'Source URL','after'=>'<div class="extra">Where did you find this item? Give credit where credit is due.</div>'));
		echo $this->Form->input('purchase_url',array('label'=>'Purchase URL','after'=>'<div class="extra">Where can this item be purchased?</div>'));
		echo $this->Form->input('source_id',array('empty'=>'--- Choose a Source ---','after'=>'<a href="/admin/sources/add" class="add-specialty" title="Add a New Source">Add a New Source</a>','options'=>array($sources)));
		echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		
		if(!empty($collection)){
			echo $this->Form->input('Collection.Collection.0',array('type'=>'hidden','value'=>$collection['Collection']['id']));
		}else{
			echo $this->Form->input('Collection',array('after'=>'<div class="extra">Select one or more (hold SHIFT) of the collections below to add the product to the collection(s).</div>'));
		}
		echo $this->Form->input('redirect',array('type'=>'hidden','value'=>$redirect));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>