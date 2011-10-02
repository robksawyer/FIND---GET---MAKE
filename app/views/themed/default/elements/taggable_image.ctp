<?php 

//Styles for tagging
echo $this->Html->css('phototagging','stylesheet',array('inline'=>false));
//Styles for the jquery plugin from http://odyniec.net/projects/imgareaselect/ not supported by neillh.com.au
echo $this->Html->css('imgareaselect-animated','stylesheet',array('inline'=>false));

echo "<!-- The jquery plugin from http://odyniec.net/projects/imgareaselect/ not supported by neillh.com.au -->";
echo $this->Html->script('jquery.imgareaselect.min',array('inline'=>false));
echo "<!-- Phototagging Load js -->";
echo $this->Html->script('jquery.phototagging',array('inline'=>false));
?>
<?php
	$testing = false;
	//Load the options list with sources and products
	/*foreach($inspiration['Source'] as $source){
		$source_options["source_".$source['id']."_".$source['name']] = $source['name'];
	}*/
	
	foreach($inspiration['Product'] as $product){
		$product_options["product_".$product['id']."_".$product['name']] = $product['name'];
	}
?>
<div class="image">
	<?php if(!empty($authUser) && empty($disableTagging)): ?>
	<div id="title_container" class="hide">
	<?php
		// If user has submitted a tag, insert into database
		//Grab the X/Y/Width/Height
		if(!empty($testing)){
			$form_options = array(
										'type' => 'post',
										'url' => '/ajax/inspiration_photo_tags/add/'.$inspiration['Inspiration']['id']
									);
		}else{
			$form_options = array(
										'type' => 'post',
										'default' => false
									);
		}
		
		echo $this->Form->create('InspirationPhotoTag',$form_options);
			echo $this->Form->input('inspiration_id',array('type'=>'hidden','value'=>$inspiration['Inspiration']['id']));
			echo $this->Form->input('attachment_id',array('type'=>'hidden','value'=>$inspiration['Attachment'][0]['id'])); //The user should be tagging the first image in the set.
			echo $this->Form->input('x1',array('type'=>'hidden','id'=>'x1'));
			echo $this->Form->input('y1',array('type'=>'hidden','id'=>'y1'));
			echo $this->Form->input('x2',array('type'=>'hidden','id'=>'x2'));
			echo $this->Form->input('y2',array('type'=>'hidden','id'=>'y2'));
			echo $this->Form->input('width',array('type'=>'hidden','id'=>'width'));
			echo $this->Form->input('height',array('type'=>'hidden','id'=>'height'));
			//echo $this->Form->input('name',array('size'=>'30','type'=>'text','class'=>'name','label'=>'Tag Name'));
		
			if(!empty($product_options) || !empty($source_options)){
				if(empty($source_options)) $source_options = array();
				if(empty($product_options)) $product_options = array();
				echo $this->Form->select('name',
												array(
														//'Sources'=>$source_options,
														'Products'=>$product_options
												),
												array('class'=>'name','label'=>'Tag Name')
												);
				if(empty($testing)){
					echo $this->Form->submit('Submit',array('onClick'=>"doSubmit(".$inspiration['Inspiration']['id'].");"));
				}else{
					echo $this->Form->end('Submit');
				}
				echo $this->Js->writeBuffer(array('inline' => 'true')); //I'm not sure why this is added here.
			}else{
				echo "<p style='font-size: 13px; color:#ffffff; width: 300px;'>You have to add sources or products before you can tag an inspiration image.</p>";
			}
			
	?>
	</div>
	<?php endif; ?>
	<?php if (!empty($inspiration['Attachment'][0])):?>
		<div class="inspiration-image">
		<?php 
				echo $this->Html->image($inspiration['Attachment'][0]['path'],
													array(
														'alt'=>$inspiration['Inspiration']['name'],
														'id'=>'imageid',
														'width'=>$inspiration['Attachment'][0]['width']
														)
													);
		?>
		</div>
		<div class="clear"></div>
	<?php endif; ?>
	<div id="photo-tag-map">
		<?php echo $this->element('taggable_image_map',array('inspiration'=>$inspiration)); ?>
	</div>
	<?php 
	if(!empty($authUser) && empty($disableTagging)): 
		if(!empty($source_options) || !empty($product_options)):
	?>
	<div class="on-off">
		<div class="start-tagging" title="Tag the image with products or sources.">Tag image</div>
		<div class="finish-tagging hide">Cancel tagging</div>
	</div>
	<?php
		endif;
	endif; 
	?>
</div> <!-- image -->
<!-- PHOTO TAG TITLES -->
<?php
 	if(empty($inspiration['InspirationPhotoTag'])){
		$style = "display:none";
	}
?>
<div class="tag_titles" <?php if(!empty($style)) echo "style='".$style."'"; ?>>
	<!--<h2 class="tagtitles">In this photo:</h2>-->
	<ul id="titles">
	<?php 
		if(empty($style)):
		foreach($inspiration['InspirationPhotoTag'] as $tag): ?>
      <li>
			<?php if(!empty($authUser) && empty($disableTagging)): ?>
			<a href="#" class="title" id="tag_<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></a> (<?php echo $this->Html->link('Delete','javascript:doDelete('.$tag['id'].','.$tag['inspiration_id'].')'); ?>)
			<?php else: ?>
			<a href="#" class="title" id="tag_<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></a>
			<?php endif; ?>
		</li>  
	<?php 
		endforeach; 
		endif;
	?>
	</ul>
</div>
<!-- END PHOTO TAG TITLES -->
<div class="clear"></div>
<?php if (!empty($inspiration['Attachment'][0])): ?>
<script type="text/javascript">
	//Set the image width for the title tags. Otherwise, they'll stretch into the description area.
	$('.image').css('width',<?php echo $inspiration['Attachment'][0]['width']; ?>);
</script>
<?php endif; ?>