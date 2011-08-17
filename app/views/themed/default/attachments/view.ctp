<div class="attachments view">
	<?php
		echo $this->element('top_actions',array('item'=>$attachment,'model'=>'Attachment','rate'=>false,'cache'=>false));
	?>
	<?php
		//debug($attachment);
		if(!empty($attachment['Ufo'])){
			$item = $attachment['Ufo'];
			$type = "ufo";
			$controller = "ufos";
			$action = "view";
		}
		if(!empty($attachment['Product'])){
			$item = $attachment['Product'];
			$type = "product";
			$controller = "products";
			$action = "view";
		}
		if(!empty($attachment['Source'])){
			$item = $attachment['Source'];
			$type = "source";
			$controller = "sources";
			$action = "view";
		}
		if(!empty($attachment['Inspiration'])){
			$item = $attachment['Inspiration'];
			$type = "inspiration";
			$controller = "inspirations";
			$action = "view";
		}
		if(Configure::read('FGM.private_solution') == 1){
			if(!empty($attachment['Client'])){
				$item = $attachment['Client'];
				$type = "client";
				$controller = "clients";
				$action = "view";
			}
			if(!empty($attachment['House'])){
				$item = $attachment['House'];
				$type = "house";
				$controller = "houses";
				$action = "view";
			}
			if(!empty($attachment['Contractor'])){
				$item = $attachment['Contractor'];
				$type = "contractor";
				$controller = "contractors";
				$action = "view";
			}
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
				echo "You can find more info about this attachment in the $type named ".$this->Html->link($item[0]['name'],array('plugin'=>'','controller'=>$controller,'action'=>$action,$item[0]['id']))."."; 
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