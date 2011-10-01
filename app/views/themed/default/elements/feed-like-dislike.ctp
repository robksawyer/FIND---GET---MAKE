<?php
	$likes = $this->requestAction('/votes/getLikes/'.$model.'/'.$model_id);
	//$dislikes = $this->requestAction('/votes/getDislikes/'.$model.'/'.$model_id);
	$user_likes = $this->requestAction('/votes/getUserLikes/'.$model.'/'.$model_id);
	//$user_dislikes = $this->requestAction('/votes/getUserDislikes/'.$model.'/'.$model_id);
?>
<div id="vote_block" class="voteblock votedirup">
	<ul class="like_dislike">
		<?php if(!empty($authUser)): ?>
		<li class="likes"><?php echo "<div class='vote-val-like-".$model_id."'>".$likes."</div> likes"; ?></li>
		<li class="action">
			<?php
				if($user_likes < 1){
					echo $this->Html->link('like', '#', 
														array(
															'onclick'=>'fgm_api.submit_like("'.$model.'","'.$model_id.'"); return false;',
															'id'=>"vote-".strtolower($model)."-up-".$model_id,
															'class'=>'vote dup like vote-'.$model_id,
															'title'=>'like'
															));
					echo $this->Html->link('dislike', '#', 
														array(
															'onclick'=>'fgm_api.submit_dislike("'.$model.'","'.$model_id.'"); return false;',
															'id'=>"vote-".strtolower($model)."-down-".$model_id,
															'class'=>'vote ddown dislike vote-'.$model_id,
															'title'=>'dislike',
															'style'=>'display:none'
															));
				}else{
					echo $this->Html->link('dislike', '#', 
														array(
															'onclick'=>'fgm_api.submit_dislike("'.$model.'","'.$model_id.'"); return false;',
															'id'=>"vote-".strtolower($model)."-down-".$model_id,
															'class'=>'vote ddown dislike vote-'.$model_id,
															'title'=>'dislike'
															));
					echo $this->Html->link('like', '#', 
														array(
															'onclick'=>'fgm_api.submit_like("'.$model.'","'.$model_id.'"); return false;',
															'id'=>"vote-".strtolower($model)."-up-".$model_id,
															'class'=>'vote dup like vote-'.$model_id,
															'title'=>'like',
															'style'=>'display:none'
															));
				}
			?>
		</li>
		<?php endif; ?>
		<div id="ajax-status-<?php echo $model_id; ?>" style="display:none" class="ajax-status-small"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
	</ul>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?php
//echo $this->Html->script('elements/feed-like-dislike', array('inline'=>false));
echo $this->Js->writeBuffer(array('inline'=>true));
?>