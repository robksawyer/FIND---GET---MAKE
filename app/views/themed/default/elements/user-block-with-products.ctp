<div class="user-block">
	<?php echo $this->element('avatar',array('cache'=>false,'user'=>$user,'height'=>64,'follow'=>false)); ?>
	<ul class="user-details">
		<li class="username"><?php echo $this->Html->link($user['User']['username'],array(
																												'admin'=>false,
																												'ajax'=>false,
																												'plugin'=>'',
																												'controller'=>'users',
																												'action'=>'profile',
																												$user['User']['username']
																												))?></li>
		<li><?php 
			echo $user['User']['totalFollowers']." Followers";
		?></li>
		<li><?php 
			echo $user['User']['totalProducts']." Products <br/>";
			//echo $user['User']['totalSources']." Sources <br/>";
		?></li>
		<li><?php 
			echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$user['User']['id']));
			//echo $user['User']['totalCollections']." Collections<br/>";
			//echo $user['User']['totalInspirations']." Inspirations<br/>";
		?></li>
	</ul>
	<?php 
		if(!empty($user['Product'])){
			$productData = $user['Product'];
		}else if(!empty($user['User']['Product'])){
			$productData = $user['User']['Product'];
		}else{
			//debug("An error occured.");
		}
		if(!empty($productData)):
	?>
	<ul class="item-details">
		<?php 
		foreach($productData as $item): ?>
		<li>
			<?php 
				if(!empty($item['Attachment'][0]['title'])) $image_title = $item['Attachment'][0]['title']; else $image_title = "image";
				echo $this->Html->image($item['Attachment'][0]['path_small'],array('alt'=>$image_title,
																												'url'=>array(
																															'admin'=>false,
																															'ajax'=>false,
																															'controller'=>'products',
																															'action'=>'view',
																															$item['id']
																												)
																											)); 
			?>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	<div class="clear"></div>
	<div class="bottom-detail">
		<?php 
		if(!empty($showJoin)){ ?>
				<span class="date">Joined on <?php echo $this->Time->niceShort($user['User']['created'],null,null); ?>&nbsp;</span>
		<?php 
		} 
		?>
		<div class="clear"></div>
	</div>
</div>
<?php 
	echo $this->Js->writeBuffer(); // write cached scripts 
?>