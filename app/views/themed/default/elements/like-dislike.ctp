<?php
	//Count the likes and dislikes
	$likes = $this->requestAction('/votes/getLikes/'.$model.'/'.$data['id']);
	$dislikes = $this->requestAction('/votes/getDislikes/'.$model.'/'.$data['id']);
	$user_likes = $this->requestAction('/votes/getUserLikes/'.$model.'/'.$data['id']);
	$user_dislikes = $this->requestAction('/votes/getUserDislikes/'.$model.'/'.$data['id']);
	
	echo $this->Html->css('elements/like-dislike');
	echo $this->Html->css("/popup/css/default_theme");
?>
<div id="vote_block" class="voteblock votedirup">
	<ul class="like_dislike">
	<li class="upvote_amt_block number">
		<span class="vote-val-like"><?php echo $likes; ?></span>&nbsp;<?php echo $this->Html->link('like it','javascript:void(0);',array('onclick'=>'return false;','class'=>'users-like','title'=>'See users who like this '.strtolower($model))); ?>
	</li>
	<?php if(empty($authUser)): ?>
	<li class="logged-out action">
		<?php
			echo $this->Popup->link('like', array(
												'class'=>'btn auth vote dup like',
												'title'=>'like',
												'element'=>'login'
												));
			/*echo $this->Popup->link('liked', array(
												'class'=>'btn auth vote dup like hidden',
												'title'=>'liked',
												'element' => 'login'
												));*/
		?>
	</li>
	<?php else: ?>
	<li class="action">
		<?php
			if($user_likes < 1){
				echo $this->Js->link('like', array('controller'=>'votes','action'=>'vote_up',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote dup like',
														'title'=>'like',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'
														));
				echo $this->Js->link('liked', array('controller'=>'votes','action'=>'remove_vote',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote dup liked',
														'style'=>'display:none;',
														'id'=>'like',
														'title'=>'liked',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'
														));
			}else{
				echo $this->Js->link('like', array('controller'=>'votes','action'=>'vote_up',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote dup like',
														'style'=>'display:none;',
														'title'=>'like',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'
														));
				echo $this->Js->link('liked', array('controller'=>'votes','action'=>'remove_vote',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote dup liked',
														'title'=>'liked',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'
														));
			}
		?>
	</li>
	<?php endif; ?>
	<div class="clear"></div>
	<li class="downvote_amt_block number">
		<span class="vote-val-dislike"><?php echo $dislikes; ?></span>&nbsp;<?php echo $this->Html->link('dislike it','javascript:void(0);',array('onclick'=>'return false;','class'=>'users-dislike','title'=>'See users who dislike this '.strtolower($model))); ?>
	</li>
	<?php if(empty($authUser)): ?>
	<li class="logged-out action">
		<?php
			echo $this->Popup->link('dislike', array(
												'class'=>'btn auth vote dup dislike',
												'title'=>'dislike',
												'element'=>'login'
												));
			/*echo $this->Popup->link('disliked', array(
												'class'=>'btn auth vote dup dislike hidden',
												'title'=>'disliked',
												'element' => 'login'
												));*/
		?>
	</li>
	<?php else: ?>
	<li class="action">
		<?php
			if($user_dislikes < 1){
				echo $this->Js->link('dislike', array('controller'=>'votes','action'=>'vote_down',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote ddown dislike',
														'title'=>'dislike',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'	
														));
				echo $this->Js->link('disliked', array('controller'=>'votes','action'=>'remove_vote',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote ddown disliked',
														'style'=>'display:none;',
														'title'=>'disliked',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'
														));
			}else{
				echo $this->Js->link('dislike', array('controller'=>'votes','action'=>'vote_down',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote ddown dislike',
														'style'=>'display:none;',
														'title'=>'dislike',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'
														));
				echo $this->Js->link('disliked', array('controller'=>'votes','action'=>'remove_vote',$model,$data['id']), array(
														//'onclick'=>'return false;',
														'class'=>'btn auth vote ddown disliked',
														'title'=>'disliked',
														'beforeSend'=>'showLoader();',
														'success'=>'updateLikeDislike(data);'
														));
			}
		?>
	</li>
	<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div>
<div id="ajax-status" style="display:none"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
<div class="clear"></div>
<?php echo $this->Html->script('elements/like-dislike'); ?>