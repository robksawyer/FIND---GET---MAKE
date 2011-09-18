<div class="products form">
<?php 
	if(!empty($model) && !empty($item)){
		echo $this->Form->create('Product',array('type' => 'file','action'=>'add/model:'.$model.'/id:'.$item[$model]['id']));
		$back_path = "/$plural_model/view/".$item[$model]['id'];
		echo $this->Form->input('redirect',array('value'=>$back_path,'type'=>'hidden'));
	}else{
		echo $this->Form->create('Product',array('type' => 'file'));
	}
?>
	<fieldset>
		<legend><?php __('Add Product'); ?></legend>
	<?php
		//The user is trying to attach a product to a inspiration
		if(!empty($model) && !empty($item)){
			echo $this->Form->input("$model.0",array('type'=>'hidden','value'=>$item[$model]['id']));
		}
		if(!empty($authUser)){
			echo $this->Form->input('user_id',array('value'=>$authUser['User']['id'],'type'=>'hidden'));
		}
		echo $this->Form->input('name');
		echo $this->Form->input('slug',array('type' => 'hidden'));
		echo '<div class="side-by-side clearfix"><div>';
		echo $this->Form->input('product_category_id',array('class'=>'chzn-select','empty' => '-- Choose a Category --','style'=>'width:250px;'));
		//echo '<a href="/admin/product_categories/add" class="add-specialty" style="float: left;">Add a category</a>';
		echo '</div></div>';
		
		echo $this->Form->input('description');
		echo '<div id="charlimitinfo">You have 300 characters left.</div>';
		echo $this->Form->input('designer');
		echo $this->Form->input('price',array('label'=>'Price/Price Range','after'=>'<div class="extra">Ex. $134 or £40-£60</div>'));
		echo $this->element('add_attachment',array('cache'=>false));
		echo $this->Form->input('source_url',array('label'=>'Source URL','after'=>'<div class="extra">Where did you find this item? Give credit where credit is due.</div>'));
		echo $this->Form->input('purchase_url',array('label'=>'Purchase URL','after'=>'<div class="extra">Where can this item be purchased?</div>'));
		echo '<div class="side-by-side clearfix"><div>';
		echo $this->Form->input('source_id',array('empty'=>'--- Choose a Source ---','class'=>'chzn-select','style'=>'width: 500px;'));
		//echo '<a href="/sources/add" class="add-specialty" title="Add a New Source">Add a New Source</a>';
		echo '</div></div>';
		//echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>'));
		echo $this->element('add_tags',array('cache'=>false,'controller'=>'products'));
		
		if(!empty($collection)){
			//echo $this->Form->input('Collection.0',array('type'=>'hidden','value'=>$collection['Collection']['id']));
		}else{
			//echo $this->Form->input('Collection',array('after'=>'<div class="extra">Select one or more (hold SHIFT) of the collections below to add the product to the collection(s). Hold COMMAND and click to remove a selection.</div>'));
			?>
			<!--<div class="side-by-side clearfix"><div>
				<fieldset class="checkboxes">
					<legend>Collections</legend>
					<?php
						/*echo $this->Form->input('Collection',array(
																			'label'=>'',
																			'type' => 'select', 
																			'multiple' => 'multiple',
																			'options' => $collections,
																			'class' => 'chzn-select'
																			)
																		);*/
					?>
				</fieldset>
			</div></div>-->
			<?php
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
$(".chzn-select").chosen();

$('#ProductDescription').keyup(function(){
	limitChars('ProductDescription', 300, 'charlimitinfo');
})

function limitChars(textid, limit, infodiv) {
	var text = $('#'+textid).val(); 
	var textlength = text.length;
	if(textlength > limit) {
		$('#' + infodiv).html('You cannot write more then '+limit+' characters!');
		$('#'+textid).val(text.substr(0,limit));
		return false;
	} else {
		$('#' + infodiv).html('You have '+ (limit - textlength) +' characters left.');
		return true;
	}
}
</script>