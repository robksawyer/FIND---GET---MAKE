<style type="text/css">
#follow-all-ajax-status{
	position: relative;
	text-align: right;
	clear: both;
}
</style>
<div id="follow-all-btn">
<?php 
	if(empty($user_ids)) $user_ids = null;
	//Check to see if the user is following all of the users
	if(!empty($authUser)){
		//Only show if the user is logged in.
		if(empty($user_ids['unfollowed_user_ids'])){
			echo $this->Html->link('Unfollow all','#',
															array(
																	'title'=>'Unfollow all',
																	'id'=>'unfollow-all',
																	'onclick'=>'fgm_api.submit_unfollow_all(); return false;'
																	));
			echo $this->Html->link('Follow all','#',
															array(
																	'title'=>'Follow all',
																	'id'=>'follow-all',
																	'onclick'=>'fgm_api.submit_follow_all(); return false;',
																	'style'=>'display:none'
																	));
		}else{
			echo $this->Html->link('Follow all','#',
															array(
																	'title'=>'Follow all',
																	'id'=>'follow-all',
																	'onclick'=>'fgm_api.submit_follow_all(); return false;'
																	));
			echo $this->Html->link('Unfollow all','#',
															array(
																	'title'=>'Unfollow all',
																	'id'=>'unfollow-all',
																	'onclick'=>'fgm_api.submit_unfollow_all(); return false;',
																	'style'=>'display:none'
																	));
		}
	}
	
?>
</div>
<div id="follow-all-ajax-status" style="display:none" class="ajax-status-small"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
<div class="clear"></div>
<script type="text/javascript">
	fgm_api.setFollowAllUserIDs(<?php echo json_encode($user_ids); ?>);
</script>
<?php 
	echo $this->Js->writeBuffer(array('inline'=>true));
?>