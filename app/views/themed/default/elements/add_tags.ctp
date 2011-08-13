<?php
	//Get all of the tags in the system
	$tags = $this->requestAction("$controller/getTags");
	$json = $this->Js->object($tags); //Convert the array to JSON
?>
<script type="text/javascript">
	//var controller = <?php echo '"'.$controller.'"'; ?>;
	$(document).ready(function(){
		setupTagAutocomplete();
	});
	
	function setupTagAutocomplete(){
		var options = { 
							//serviceUrl:'service/autocomplete.ashx' 
							minChars:2, 
							delimiter: /(,|;)\s*/, // regex or character
							zIndex: 9999,
							deferRequestBy: 0, //miliseconds
							noCache: false, //default is false, set to true to disable caching
							// callback function:
							//onSelect: createTag,
							lookup: <?php echo $json; ?> //local lookup values
						};
		var autoC = $('#autoComplete').autocomplete(options);
	}
</script>
<?php
	echo $this->Form->input('tags',array('type'=>'text','label'=>'Keywords','after'=>'<div class="extra">Separate each keyword with a comma e.g., modern, red, furniture.</div>','id'=>'autoComplete'));
?>