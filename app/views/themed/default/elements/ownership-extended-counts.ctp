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
	$haveusers = $this->requestAction('/ownerships/getHaveUsers/'.$model.'/'.$model_id);
	//debug($haveusers);
	$wantusers = $this->requestAction('/ownerships/getWantUsers/'.$model.'/'.$model_id);
	//debug($wantusers);
	//$hadusers = $this->requestAction('/ownerships/getHadUsers/'.$model.'/'.$model_id);
	//debug($hadusers);
	$haveuser_count = $this->requestAction('/ownerships/getHaveCount/'.$model.'/'.$model_id);
	//debug($haveuser_count);
	$wantuser_count = $this->requestAction('/ownerships/getWantCount/'.$model.'/'.$model_id);
	//debug($wantuser_count);
	//$haduser_count = $this->requestAction('/ownerships/getHadCount/'.$model.'/'.$model_id);
	//debug($haduser_count);
	
	echo $this->Html->css('elements/ownerships');
?>
<div id="ownership-counts">
	<?php if(!empty($haveusers)): ?>
	<div id="user-haves" class="ownerships-section">
		<h3><?php __('Users That Have This'); ?> (<span class='haveuser-count'><?php echo $haveuser_count; ?></span> total)</h3>
		<?php 
			foreach($haveusers as $user){
				echo "<div class='ownership-item'>";
				echo $this->element('avatar',array('cache'=>false,'user'=>$user,'height'=>'64'));
				echo $this->Html->link(__($user['User']['username'],true),array('controller'=>'users','action'=>'view',$user['User']['slug']));
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
			//debug($wantusers); 
			foreach($wantusers as $user){
				echo "<div class='ownership-item'>";
				echo $this->element('avatar',array('cache'=>false,'user'=>$user,'height'=>'64'));
				echo $this->Html->link(__($user['User']['username'],true),array('controller'=>'users','action'=>'profile','plugin'=>'forum',$user['User']['id']));
				echo "</div>";
			}
		?>
	</div>
	<div class="clear"></div>
	<?php endif; ?>
	<div id="user-hads" class="ownerships-section" style="display:none">
		<!--<h3>Users who had this <?php //echo $model; ?> (<span class='haduser-count'><?php //echo $haduser_count; ?></span>)</h3>-->
		<?php 
			//debug($hadusers); 
			/*foreach($hadusers as $user){
				echo "<div class='ownership-item'>";
				echo $this->Html->link(__($user['User']['username'],true),array('controller'=>'users','action'=>'view',$user['User']['slug']));
				echo "</div>";
			}*/
		?>
	</div>
</div>