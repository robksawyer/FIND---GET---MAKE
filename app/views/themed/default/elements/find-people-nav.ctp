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
																									'controller'=>'users',
																									'action' => 'find_users'
																									), 
																									$this->params['pass']
																							)
															));
		echo $this->Form->input('query', array('div' => false,'label'=>'','value'=>'Find people','style'=>'color:#999'));
		echo "</form>";
		//echo $this->Form->submit('Submit',array('div'=>false,'type'=>'hidden'));
	?>
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
$('#searchbox input').bind('keypress', function(e) {
	//Bind the event to the return key and show an ajax loader in the search magnify graphic area on submit.
	var code = (e.keyCode ? e.keyCode : e.which);
	if(code == 13) { //Enter keycode
		//Do something
		//alert("Sending the search...");
		$.ajax({
				data:$("#searchbox").closest("form").serialize(), 
				dataType:"html", 
				success:function(data) {
					console.log(data);
					//Build the results page
					//$("#update-zone-phone").html(data);
				}, 
				type:"post", 
				url:"\/users\/find_users"
			}); 
			$("#SearchFindForm")[0].reset();
	}
});
</script>
