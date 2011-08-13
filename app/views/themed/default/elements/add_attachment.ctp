<script type="text/javascript">
$(document).ready(function(){
	//Hide the add image by url field on load
	$('#attach-url').hide();
	$('#attach-url').parent().hide(); //Hide the label
	$('img.cancel-url').hide();
	
});

function uploadViaUrl(){
	$('#attach-url').css({width:'95%',float:'left'});
	$('img.cancel-url').show();
	$('#attach-local').hide();
	$('#attach-local').parent().hide(); //Hide the label
	
	$('.use-url').hide();
	$('#attach-url').val(''); //Clear the url
	$('#attach-url').show();
	$('#attach-url').parent().show(); //Show the label
	
	marker = $('<span />').insertBefore('#attach-url');
	$('#attach-url').detach().attr('type', 'text').insertAfter(marker);
	marker.remove();
}

function uploadViaLocal(){
	$('img.cancel-url').hide();
	$('#attach-url').val(''); //Clear the url
	$('.use-url').show();
	$('#attach-local').show();
	$('#attach-local').parent().show(); //Hide the label
	
	$('#attach-url').hide();
	$('#attach-url').parent().hide(); //Hide the label
}
</script>
<fieldset>
	<legend>Upload Image</legend>
<?php
echo $this->Form->input('Attachment.file', array('type'=>'file','id'=>'attach-local','after'=>'<a href="javascript:return false;" onclick="uploadViaUrl();" class="use-url">Use a URL instead</a>','label'=>'Upload file'));
echo $this->Form->input('Attachment.url', array('type'=>'text','id'=>'attach-url','label'=>'Upload via URL'));
echo $this->Html->image('/img/icons/delete.gif',array('alt'=>'Cancel','url'=>'javascript:uploadViaLocal(); return false;','class'=>'cancel-url','title'=>'Cancel and add a local file.'));
echo $this->Form->input('Attachment.title',array('label'=>'Image Title','after'=>'<div class="extra">Note: This shows up when you hover over the image.</div>'));
echo $this->Form->input('Attachment.source_url',array('label'=>'Image Source URL','after'=>'<div class="extra">Where did you find this item? Give credit where credit is due.</div>'));
?>
</fieldset>