<?php
$cTitle = $session->read('Challenge.title');
$cSlug = $session->read('Challenge.slug');
$deactivated = $session->read('Challenge.deactivated');
//debug($deactivated);
if(!empty($cTitle) && !empty($cSlug) && empty($deactivated)){
?>
	<div id="challenge">
		<div class="challenge">
<?php
	if(!empty($authUser)):
?>
	<a href='javascript:hideChallenge();' class='challenge-hide-link'>
<?php 
	echo $this->Html->image('/img/icons/delete.gif',array('alt'=>'Hide',
																		'title'=>'Hide this challenge.',
																		'class'=>'challenge-hide'
																		)); 
?>
	</a>
<?php
	endif;
	echo $this->Html->link(__($cTitle,true),array('plugin'=>'forum','controller'=>'topics','action'=>'view',$cSlug),array('title'=>$cTitle,'class'=>'topic-link')); 
?>
	</div>
	<div class='clear'></div>
	<div class="challenge-details">
		<p>Challenges are open-ended questions posed for the purpose of dreaming, playing, and exploring the multitude of options available.</p>
	</div>
</div>
<?php
}else{
	//echo '<div id="challenge"></div>';
}
?>
<script type="text/javascript">
/*$("#challenge").hover(function(event){
	$('a.topic-link').css('color','#ffffff');
},function(){
	$('a.topic-link').css('color','#232323');
});*/

function hideChallenge(){
	$.ajax({
		type: "post",
		url: "/ajax/challenges/hide_challenge",
		//data: data,
		//dataType: "json",
		success: function(response, status) {
			//
			$("#challenge").fadeOut();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//
		}
	});
	return false;
}
</script>