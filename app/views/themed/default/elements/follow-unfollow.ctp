<?php
$following = $this->requestAction('/user_followings/isFollowing/'.$user_id);
?>
<?php 
//Only show the follow button if the user is actually followable (not the same user as the one logged in)
if(!empty($authUser)):
	if($authUser['User']['id'] != $user_id): 
?>
		<?php if(empty($following)): ?>
			<div id="follow-user">
			<?php echo $this->Html->link('Follow',"#",
																	array(
																		'class'=>'auth follow',
																		'title'=>'follow',
																		'id'=>'follow-'.$user_id,
																		'onclick'=>'fgm_api.submit_follow("'.$user_id.'"); return false;',
																		));
					echo $this->Html->link('Unfollow',"#",
																	array(
																		'class'=>'auth unfollow',
																		'id'=>'unfollow-'.$user_id,
																		'style'=>'display:none',
																		'title'=>'unfollow',
																		'onclick'=>'fgm_api.submit_unfollow("'.$user_id.'"); return false;',
																		));
			?></div>
		<?php else: ?>
			<div id="follow-user">
			<?php echo $this->Html->link('Unfollow',"#",
																	array(
																		'class'=>'auth unfollow',
																		'id'=>'unfollow-'.$user_id,
																		'title'=>'unfollow',
																		'onclick'=>'fgm_api.submit_unfollow("'.$user_id.'"); return false;',
																		));
					echo $this->Html->link('Follow',"#",
																	array(
																		'class'=>'auth follow',
																		'id'=>'follow-'.$user_id,
																		'style'=>'display:none',
																		'title'=>'follow',
																		'onclick'=>'fgm_api.submit_follow("'.$user_id.'"); return false;',
																		));
				
			?></div>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
<div id="ajax-status-<?php echo $user_id;?>" style="display:none" class="ajax-status-small"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
<?php 
	//echo $this->Html->script('elements/follow-unfollow',array('inline'=>false)); 
	echo $this->Js->writeBuffer(array('inline'=>true));
?>