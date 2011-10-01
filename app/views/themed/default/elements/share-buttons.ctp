<?php 
if(!empty($controller) && !empty($keycode)){
	$rootURL = "http://".$_SERVER['SERVER_NAME']."/".$controller."/key/".$keycode;
}else{
	$urlData = preg_split("/\//",$_SERVER['REQUEST_URI']);
	$lastItemInUrlData = count($urlData) - 1;
	$rootURL = "http://".$_SERVER['SERVER_NAME']."/".$controller."/generateKeycode/".$urlData[$lastItemInUrlData];
}
//debug($rootURL);
if(empty($disable_sharing)):
?>
<div class="button public-share"><?php echo $this->Html->link('Share','#',array('title'=>'Share the public link.','class'=>'share-link-btn')); ?></div>
<div id="share-panel" style="display:none">
	<input class="share-panel-url" type="text" value="<?php echo $rootURL; ?>">
</div>
<script type="text/javascript">
$('.public-share a').click(function(){
	event.preventDefault();
	if($('a.share-link-btn').text() == "Share"){
		$('a.share-link-btn').text('Share link:');
	}else{
		$('a.share-link-btn').text('Share');
	}
	$("#share-panel").slideToggle('slow',function(){
		//Animation complete
	});
})
$('.share-panel-url').click(function(event){
	selectAllText($(this));
});

function selectAllText(textbox) {
    textbox.focus();
    textbox.select();
}
</script>
<?php endif; ?>