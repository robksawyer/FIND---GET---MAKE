<?php 
	/**
	 * ownership_extended_counts
	 * Returns a block that includes the number of haves, wants and hads
	 * @author Rob Sawyer
	 * @param $model The name of the Model (in lowercase form) that is using this element e.g, bike,part.
	 * @param $id The id of the item that ownership is being looked up on
	 * @return 
	 * 
	*/
if(Configure::read('FGM.ownerships') == 1):
	$haveusers = $this->requestAction('/ownerships/getHaveUsers/'.$model.'/'.$model_id);
	$wantusers = $this->requestAction('/ownerships/getWantUsers/'.$model.'/'.$model_id);
	$haveuser_count = $this->requestAction('/ownerships/getHaveCount/'.$model.'/'.$model_id);
	$wantuser_count = $this->requestAction('/ownerships/getWantCount/'.$model.'/'.$model_id);
	
	echo $this->Html->css('elements/ownerships');
?>
<div id="ownership-counts">
	<?php if(!empty($haveusers)): ?>
	<div id="user-haves" class="ownerships-section">
		<h3><?php __('Users That Have This'); ?> (<span class='haveuser-count'><?php echo $haveuser_count; ?></span> total)</h3>
		<?php 
			foreach($haveusers as $user){
				echo "<div class='user-item'>";
				echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$user));
				echo "</div>";
			}
		?>
	</div>
	<div class="clear"></div>
	<?php endif; ?>
	<?php if(!empty($wantusers)): ?>
	<div id="user-wants" class="ownerships-section">
		<h3><?php __('Users That Want This'); ?> (<span class='wantuser-count'><?php echo $wantuser_count; ?></span> total)</h3>
		<?php 
			foreach($wantusers as $user){
				echo "<div class='user-item'>";
				echo $this->element('user-block-with-products',array('cache'=>false,'user'=>$user));
				echo "</div>";
			}
		?>
	</div>
	<div class="clear"></div>
	<?php endif; ?>
</div>
<?php
endif;
?>