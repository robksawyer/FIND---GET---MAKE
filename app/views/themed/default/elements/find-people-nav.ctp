<style type="text/css">
	#facebook-loader{
		position: relative;
		top: -15px;
		float: right;
		clear: none;
		display: block;
		
	}
	#twitter-loader{
		position: relative;
		top: -15px;
		float: right;
		clear: none;
		display: block;
	}
</style>
<ul class="find-people">
	<?php
	$class = " class='selected' ";
	?>
	<li<?php if($selected == "staff_favorites") echo $class; ?>><?php echo $this->Html->link('Staff favorites',array('admin'=>false,'controller'=>'users','action'=>'find','staff-favorites'),array('class'=>'staff-favorites')); ?></li>
	<li<?php if($selected == "facebook") echo $class; ?>>
	<?php
		if(empty($authUser)){
			echo $this->Html->link('Facebook',array('controller'=>'users','action'=>'login'),array('class'=>'facebook'));
		}else{
			$facebook_session_token = $session->check('FB.Token');
			if(empty($facebook_session_token)){
				echo $this->Html->link('Facebook','javascript:doFacebookCheck()',array('class'=>'facebook'));
			}else{
				echo $this->Js->link('Facebook',array(
															'ajax'=>true,
															'controller'=>'users',
															'action' => 'find_facebook_users'
															),
															array(
																'before'=>'startSocialSearch("facebook");',
																'update'=>'#search-results-facebook',
																'complete'=>'socialSearchComplete("facebook");',
																'success'=>'socialSearchSuccess(data,textStatus);',
																'id'=>'get-facebook-friends',
																'type'=>'json',
																'class'=>'facebook'
															));
			}
		}
		
	?>
	<div id="facebook-loader" style="display:none"><?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'...')); ?></div>
	</li>
	<li<?php if($selected == "twitter") echo $class; ?>>
	<?php
		if(empty($authUser)){
			echo $this->Html->link('Twitter',array('controller'=>'users','action'=>'login'),array('class'=>'twitter'));
		}else{
			$twitter_session_token = $session->check('Twitter');
			if(empty($twitter_session_token)){
				echo $this->Js->link('Twitter',"#",
															array(
																'id'=>'twitter-allow'
															));
			}else{
				echo $this->Js->link('Twitter',array(
															'ajax'=>true,
															'controller'=>'users',
															'action' => 'find_twitter_users'
															),
															array(
																'before'=>'startSocialSearch("twitter");',
																'update'=>'#search-results-twitter',
																'complete'=>'socialSearchComplete("twitter");',
																'success'=>'socialSearchSuccess(data,textStatus);',
																'type'=>'json',
																'id'=>'get-twitter-friends',
																'class'=>'twitter'
															));
			}
		}
	?>
	<div id="twitter-loader" style="display:none"><?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'...')); ?></div>
	</li>
</ul>
<div id="searchbox">
	<?php
		echo $this->Form->create('Search', array(
																'url' => array_merge(array(
																									'ajax'=>true,
																									'controller'=>'users',
																									'action' => 'find_users'
																									), 
																									$this->params['pass']
																							)
															));
		echo $this->Form->input('User.search', array('div' => false,'label'=>'','value'=>'Find people','style'=>'color:#999','id'=>'SearchQuery'));
		echo $this->Js->get('#SearchQuery')->event('keypress','checkKeyPress(event);',array('stop'=>false));
		echo $this->Js->submit('Submit',array('div'=>false,
															'id'=>'SearchSubmit',
															'style'=>'display:none',
															'url'=>'/ajax/users/find_users',
															'before'=>'startSearch()',
															'complete'=>'searchComplete(XMLHttpRequest,textStatus)',
															'success'=>'searchSuccess(data,textStatus);',
															'update'=>'#search-results',
															'type'=>'html'
															));
	?>
	<div id="search-loader" style="display:none"><?php echo $this->Html->image('search-loader.gif',array('alt'=>'...')); ?></div>
</div>
