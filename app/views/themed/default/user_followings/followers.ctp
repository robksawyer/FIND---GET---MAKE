<div class="header red">
<?php 
	__(count($followers).' member(s) are following '.$user['User']['username']);
?>
</div>
<div class="clear"></div>
<div id="follower-following">
	<?php if(!empty($followers)): ?>
		<!-- Start gridded items -->
		<div id="grid-container">
		<?php foreach($followers as $follower): ?>
			<div class="grid-item" style="width:500px !important;">
				<div class="follower">
					<?php echo $this->element('avatar',array('cache'=>false,'user'=>$follower)); ?>
					<ul class="follower-details">
						<li class="username"><?php echo $this->Html->link($follower['User']['username'],array('plugin'=>'','controller'=>'users','action'=>'profile',$follower['User']['username']))?></li>
						<li><?php echo $follower['User']['totalFollowers']." Followers";?></li>
						<li><?php echo $follower['User']['totalProducts']." Products";?></li>
						<li><?php echo $follower['User']['totalSources']." Sources";?></li>
						<li><?php echo $follower['User']['totalCollections']." Collections";?></li>
						<li><?php echo $follower['User']['totalInspirations']." Inspirations";?></li>
					</ul>
					<div class="clear"></div>
					<div class="bottom-detail">
						<span class="date">Joined on <?php echo $this->Time->niceShort($follower['User']['created'],null,null); ?>&nbsp;</span>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<div class="clear"></div>
		<!-- End gridded items -->
	<?php endif; ?>
</div>
<?php
	$this->Html->script('jquery.masonry.min',array('inline'=>false));
?>
<script type="text/javascript">
$(function(){
	var $container = $("#grid-container");
	$container.imagesLoaded(function(){
		$container.masonry({
			//option
			itemSelector: '.grid-item'
		});
	});
});
</script>