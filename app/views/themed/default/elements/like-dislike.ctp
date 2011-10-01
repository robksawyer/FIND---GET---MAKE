<?php

if(Configure::read('FGM.likes') == 1):

	//Count the likes and dislikes
	$likes = $this->requestAction('/votes/getLikes/'.$model.'/'.$model_id);
	$dislikes = $this->requestAction('/votes/getDislikes/'.$model.'/'.$model_id);
	$user_likes = $this->requestAction('/votes/getUserLikes/'.$model.'/'.$model_id);
	$user_dislikes = $this->requestAction('/votes/getUserDislikes/'.$model.'/'.$model_id);
	
	echo $this->Html->css('elements/like-dislike');
?>
<div id="vote_block" class="voteblock votedirup">
	<ul class="like_dislike">
	<li class="upvote_amt_block number">
		<span class="vote-val-like"><?php echo $likes; ?></span>&nbsp;<?php echo 'like it'; ?>
	</li>
	<?php if(empty($authUser)): ?>
	<li class="logged-out action">
		<?php
			echo $this->Html->link('like','#', array(
																'onclick'=>'return false;',
																'class'=>'btn auth vote dup like disabled',
																'title'=>'You have to login to like items.',
																'disabled'=>'disabled'
																)
																);
		?>
	</li>
	<?php else: ?>
	<li class="action">
		<?php
			if($user_likes < 1){
				echo $this->Js->link('like', array('ajax'=>true,'controller'=>'votes','action'=>'vote_up',$model,$model_id), 
													array(
														'class'=>'btn auth vote dup like',
														'title'=>'like',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'
														));
				echo $this->Js->link('liked', array('ajax'=>true,'controller'=>'votes','action'=>'remove_vote',$model,$model_id), 
													array(
														'class'=>'btn auth vote dup liked',
														'style'=>'display:none;',
														'id'=>'like',
														'title'=>'liked',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'
														));
			}else{
				echo $this->Js->link('like', array('ajax'=>true,'controller'=>'votes','action'=>'vote_up',$model,$model_id), 
												array(
														'class'=>'btn auth vote dup like',
														'style'=>'display:none;',
														'title'=>'like',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'
														));
				echo $this->Js->link('liked', array('ajax'=>true,'controller'=>'votes','action'=>'remove_vote',$model,$model_id), 
													array(
														'class'=>'btn auth vote dup liked',
														'title'=>'liked',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'
														));
			}
		?>
	</li>
	<?php endif; ?>
	<div class="clear"></div>
	<li class="downvote_amt_block number">
		<span class="vote-val-dislike"><?php echo $dislikes; ?></span>&nbsp;<?php echo 'dislike it'; ?>
	</li>
	<?php if(empty($authUser)): ?>
	<li class="logged-out action">
		<?php
			echo $this->Html->link('dislike','#', array(
																'onclick'=>'return false;',
																'class'=>'btn auth vote ddown dislike disabled',
																'title'=>'You have to login to dislike items.',
																'disabled'=>'disabled'
																)
																);
		?>
	</li>
	<?php else: ?>
	<li class="action">
		<?php
			if($user_dislikes < 1){
				echo $this->Js->link('dislike', array('ajax'=>true,'controller'=>'votes','action'=>'vote_down',$model,$model_id), 
													array(
														'class'=>'btn auth vote ddown dislike',
														'title'=>'dislike',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'	
														));
				echo $this->Js->link('disliked', array('ajax'=>true,'controller'=>'votes','action'=>'remove_vote',$model,$model_id), 
													array(
														'class'=>'btn auth vote ddown disliked',
														'style'=>'display:none;',
														'title'=>'disliked',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'
														));
			}else{
				echo $this->Js->link('dislike', array('ajax'=>true,'controller'=>'votes','action'=>'vote_down',$model,$model_id), 
													array(
														'class'=>'btn auth vote ddown dislike',
														'style'=>'display:none;',
														'title'=>'dislike',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'
														));
				echo $this->Js->link('disliked', array('ajax'=>true,'controller'=>'votes','action'=>'remove_vote',$model,$model_id), 
													array(
														'class'=>'btn auth vote ddown disliked',
														'title'=>'disliked',
														'beforeSend'=>'fgm_api.showLoader();',
														'success'=>'fgm_api.updateLikeDislike(data);'
														));
			}
		?>
	</li>
	<?php endif; ?>
	</ul>
	<div class="clear"></div>
	<div id="ajax-status" style="display:none"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
</div>
<div class="clear"></div>
<?php 
	//echo $this->Html->script('elements/like-dislike');
	echo $this->Js->writeBuffer();
	
endif; //Make sure likes are enabled
?>