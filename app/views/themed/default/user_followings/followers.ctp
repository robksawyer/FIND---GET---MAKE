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
					<?php // Gravatar
					if ($this->Cupcake->settings['enable_gravatar'] == 1) {
						if ($avatar = $this->Cupcake->gravatar($follower['User']['email'])) {
							echo "<div class='avatar'>".$avatar;
							echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$follower['User']['id']));
							echo '<div class="clear"></div>';
							echo "</div>";
						}else{
							echo "<div class='avatar'>";
							echo $this->Html->image('no_gravatar.jpg')."<br/>";
							echo $this->element('follow-unfollow',array('cache'=>false,'user_id'=>$follower['User']['id']));
							echo '<div class="clear"></div>';
							echo "</div>";
						}
					}
					?>
					<ul class="follower-details">
						<li class="username"><?php echo $this->Html->link($follower['User']['username'],array('plugin'=>'','controller'=>'users','action'=>'profile',$follower['User']['username']))?></li>
						<li>Total products: <?php echo $follower['User']['totalProducts'];?></li>
						<li>Total sources: <?php echo $follower['User']['totalSources'];?></li>
						<li>Total collections: <?php echo $follower['User']['totalCollections'];?></li>
						<li>Total inspirations: <?php echo $follower['User']['totalInspirations'];?></li>
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