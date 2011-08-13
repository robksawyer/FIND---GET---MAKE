<?php
$cTitle = $session->read('Competition.title');
$cSlug = $session->read('Competition.slug');
$deactivated = $session->read('Competition.deactivated');
//debug($deactivated);
if(!empty($cTitle) && !empty($cSlug) && empty($deactivated)){
?>
	<div id="competition">
		<div class="competition">
<?php
	if(!empty($authUser)):
?>
	<a href='javascript:hideCompetition();' class='competition-hide-link'>
<?php 
	echo $this->Html->image('/img/icons/delete.gif',array('alt'=>'Hide',
																		'title'=>'Hide this competition.',
																		'class'=>'competition-hide'
																		)); 
?>
	</a>
<?php
	endif;
	echo $this->Html->link(__($cTitle,true),array('plugin'=>'forum','controller'=>'topics','action'=>'view',$cSlug),array('title'=>$cTitle,'class'=>'topic-link')); 
?>
	</div>
	<div class='clear'></div>
	<div class="competition-details">
		<p>Competitions are a way to explore your favorite products and sources. There aren't winners or losers in these competitions. Play with patterns and test out ideas before they see the light of day.</p>
	</div>
</div>
<?php
}else{
	//echo '<div id="competition"></div>';
}
?>
<script type="text/javascript">
/*$("#competition").hover(function(event){
	$('a.topic-link').css('color','#ffffff');
},function(){
	$('a.topic-link').css('color','#232323');
});*/

function hideCompetition(){
	$.ajax({
		type: "post",
		url: "/admin/app/hide_competition",
		//data: data,
		//dataType: "json",
		success: function(response, status) {
			//
			$("#competition").fadeOut();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//
		}
	});
	return false;
}
</script>