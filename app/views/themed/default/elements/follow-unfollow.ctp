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
			<?php echo $this->Js->link('Follow',array(
																	'plugin'=>'',
																	'admin'=>false,
																	'controller'=>'user_followings',
																	'action'=>'followUserID',$user_id
																	),
																	array(
																		'class'=>'auth follow',
																		'title'=>'follow',
																		'id'=>'follow-'.$user_id,
																		'beforeSend'=>'showLoader('.$user_id.');',
																		'success'=>'updateFollowUnfollow(data);'
																		));
					echo $this->Js->link('Unfollow',array(
																	'plugin'=>'',
																	'admin'=>false,
																	'controller'=>'user_followings',
																	'action'=>'unfollowUserID',$user_id
																	),
																	array(
																		'class'=>'auth unfollow',
																		'id'=>'unfollow-'.$user_id,
																		'style'=>'display:none',
																		'title'=>'unfollow',
																		'beforeSend'=>'showLoader('.$user_id.');',
																		'success'=>'updateFollowUnfollow(data);'
																		));
			?></div>
		<?php else: ?>
			<div id="follow-user">
			<?php echo $this->Js->link('Unfollow',array(
																	'plugin'=>'',
																	'admin'=>false,
																	'controller'=>'user_followings',
																	'action'=>'unfollowUserID',$user_id
																	),
																	array(
																		'class'=>'auth unfollow',
																		'id'=>'unfollow-'.$user_id,
																		'title'=>'unfollow',
																		'beforeSend'=>'showLoader('.$user_id.');',
																		'success'=>'updateFollowUnfollow(data);'
																		));
					echo $this->Js->link('Follow',array(
																	'plugin'=>'',
																	'admin'=>false,
																	'controller'=>'user_followings',
																	'action'=>'followUserID',$user_id
																	),
																	array(
																		'class'=>'auth follow',
																		'id'=>'follow-'.$user_id,
																		'style'=>'display:none',
																		'title'=>'follow',
																		'beforeSend'=>'showLoader('.$user_id.');',
																		'success'=>'updateFollowUnfollow(data);'
																		));
				
			?></div>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
<div id="ajax-status-<?php echo $user_id;?>" style="display:none" class="ajax-status-small"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
<?php 
	$this->Html->script('elements/follow-unfollow',array('inline'=>false)); 
?>