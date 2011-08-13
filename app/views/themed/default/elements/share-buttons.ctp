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
<div class="button public-share"><?php echo $this->Html->link('Share','javascript:return false;',array('title'=>'Share the public link.')); ?></div>
<div id="share-panel" style="display:none">
		<label for="share-panel-url">Link to this item:</label>
		<input class="share-panel-url" type="text" value="<?php echo $rootURL; ?>">
</div>
<script type="text/javascript">
$('.public-share a').click(function(){
	$("#share-panel").slideToggle('slow',function(){
		//Animation complete
	});
})

$('.share-panel-url').click(function(){ 
	selectAllText($(this));
});

function selectAllText(textbox) {
    textbox.focus();
    textbox.select();
}
</script>
<?php endif; ?>