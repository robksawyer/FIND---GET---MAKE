<style type="text/css">
	#search-results-container .query{
		font-weight: bold;
		font-style: italic;
	}
</style>
<div id="left-panel-index">
	<?php 
		if(empty($facebookConnectURL)) $facebookConnectURL = "";
		echo $this->element('find-people-nav',array('cache'=>false,'selected'=>'staff_favorites','facebookConnectURL'=>$facebookConnectURL)); 
	?>
</div>
<div id="right-panel">
	<div class="find-people">
		<h3><b>Follow people on FIND|GET|MAKE</b> to discover new products</h3>
		<div id="staff-favorites">
			<?php 
				echo $this->element('staff-favorites',array('cache'=>false,'user_ids'=>$user_ids,'favorites'=>$staff_favorites_details)); 
			?>
		</div
		<div id="search-results-container">
			<div id="search-results" style="display:none"></div>
			<div id="search-results-twitter" style="display:none"></div>
			<div id="search-results-facebook" style="display:none"></div>
		</div>
		<div id="find-user-loader" style="display:none"><?php //echo $this->Html->image('ajax-loader.gif',array('alt'=>'Loading...')); ?></div>
	</div>
</div>
<?php
//echo $this->Html->script('elements/follow-unfollow',array('inline'=>false)); //This isn't getting loadded during the ajax call
//echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
//echo $this->Html->script('elements/find-users');
echo $this->Js->writeBuffer();
?>
<script type="text/javascript">
//<![CDATA[
<?php 
	if(!empty($this->params['pass'][0])){
		echo "var local_passedParams = '".$this->params['pass'][0]."';";
	}
?>
window.addEventListener("FGM_API.INITIALIZED", function(){ fgm_api.init_find_users(local_passedParams); },false);
//]]>
</script>