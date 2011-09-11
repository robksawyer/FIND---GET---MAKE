<ul class="find-people">
	<?php
	$class = " class='selected' ";
	?>
	<li<?php if($selected == "staff_favorites") echo $class; ?>><?php echo $this->Html->link('Staff favorites',array('admin'=>false,'controller'=>'users','action'=>'find','staff-favorites')); ?></li>
	<li<?php if($selected == "facebook") echo $class; ?>>Facebook</li>
	<li<?php if($selected == "twitter") echo $class; ?>>Twitter</li>
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
															'before'=>'startSearch();',
															'complete'=>'searchComplete(event);',
															'success'=>'searchSuccess(data);',
															'update'=>'#search-results',
															'type'=>'json'
															));
	?>
	<div id="search-loader" style="display:none"><?php echo $this->Html->image('search-loader.gif',array('alt'=>'...')); ?></div>
</div>
<script type="text/javascript">
$('#searchbox #SearchQuery').focus(function(){
	if($(this).val() == 'Find people') {
		$(this).val('');
		$(this).css('color','#000');
	}
});
$('#searchbox #SearchQuery').blur(function(){
	if($(this).val() == '') {
		$(this).val('Find people');
		$(this).css('color','#999');
	}
});

/**
 * 
 * @param 
 * @return 
 * 
*/
function checkKeyPress(e){
	var code = (e.keyCode ? e.keyCode : e.which);
	if(code == 13) { //Enter keycode
		$('#SearchSubmit').click();
		e.preventDefault();
		//return true;
	}else{
		return false;
	}
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function startSearch(){
	//Show the ajax loader
	$('#search-loader').show();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function searchComplete(event){
	//Hide the loader
	$('#search-loader').hide();
}

/**
 * 
 * @param 
 * @return 
 * 
*/
function searchSuccess(event){
	//Build the results
	$("#staff-favorites").fadeOut();
	$("#search-results").fadeIn();
}


</script>
