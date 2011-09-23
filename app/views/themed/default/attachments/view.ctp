<div class="attachments view">
	<?php
		echo $this->element('top_actions',array('item'=>$attachment,'model'=>'Attachment','rate'=>false,'cache'=>false));
	?>
	<?php
		if(!empty($attachment['Attachment']['model']) && !empty($attachment['Attachment']['model_id'])){
			$item = $attachment[$attachment['Attachment']['model']];
			$type = strtolower($attachment['Attachment']['model']);
			$controller = Inflector::pluralize(strtolower($attachment['Attachment']['model']));
			$action = "view";
		}
	?>
	<div class="item">
		<?php
		if(empty($item)):
			echo "<h3>This is a random attachment. Now, how'd this get here?</h3>";
		else:
		?>
		<h3>
			<?php 
				echo "You can find more info about this attachment in the $type named ".$this->Html->link($item['name'],array('plugin'=>'','controller'=>$controller,'action'=>$action,$item['id']))."."; 
			?>
		</h3>
		<?php
		endif;
		?>
	</div>
	<div class="attachments box">
		<?php echo $this->Html->image($attachment['Attachment']['path']); ?>
	</div>
	<!-- <a href="#" class="show_hide"><h3>Show Details</h3></a> -->
	<div id="slidingDiv">
		<h3><?php //echo $attachment['Attachment']['name']; ?></h3>
		<?php
			//Related houses
			/*echo $this->element('houses',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related contractors
			echo $this->element('contractors',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related sources
			echo $this->element('sources',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related inspirations
			echo $this->element('clients',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related products
			echo $this->element('products',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));

			//Related inspirations
			echo $this->element('inspirations',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));*/
		?>
	</div>
</div>