<?php
	//debug($attachment['AttachmentTag']);
?>
<script type="text/javascript">
/* 
Title: Photo Tagging
Author: Neill Horsman
URL: http://www.neillh.com.au
Credits: jQuery, imgAreaSelect 
*/

$(window).load(function() {
	
	//$("#AttachmentTagAddForm").hide();

  //Set up imgAreaSelect
	$('.start-tagging').click(function() {
		$('.start-tagging').addClass("hide");
		$('.finish-tagging').removeClass("hide");
		//load imgAreaSelect (#imageid must equal the id or class of your image.
		//$('img#imageid').imgAreaSelect({ handles: true, onSelectChange: selectChange, keys: { arrows: 15, shift: 5 }, aspectRatio: '4:3', maxWidth: 150, maxHeight: 100 });
		$('img#imageid').imgAreaSelect({
			disable: false, //enable/disable tagging
			handles: true, //grab handels when selecting the area
			keys: { arrows: 15, shift: 5 }, //keyboard support
			//aspectRatio: '1:1',
			//maxWidth: 62, //adjust the max tag width
			//maxHeight: 62, //adjust the max tag height
			fadeSpeed: 200,
			onSelectEnd: function(img, selection){ //after you have selected an area, show the form and insert tag location values into a form
				//get the position of the placeholder element
				var pos = $('.imgareaselect-selection').offset(); 
				var width = selection.width;
				/*$("#AttachmentTagAddForm").show();
				$("#AttachmentTagAddForm").offset({left:(pos.left), top:pos.top+width});*/
				$('input#x1').val(selection.x1);
				$('input#y1').val(selection.y1);
				$('input#x2').val(selection.x2);
				$('input#y2').val(selection.y2);
				$('input#width').val(selection.width);
				$('input#height').val(selection.height);
				$('#title_container').css('left', (pos.left));
				$('#title_container').css('top', (pos.top+selection.height));
				$('#title_container').removeClass("hide");
				if (selection.width == 0 && selection.height == 0) { 
					$('#title_container').addClass("hide"); 
				} //if there is no selection, hide the form
			},
			onSelectStart: function(img, selection){
				$('#title_container').addClass("hide"); //if reselecting, hide the form
			},
		});
	});
	$('.finish-tagging').click(function(){
		//$("#AttachmentTagAddForm").hide(); //Hide the form
		$('.start-tagging').removeClass("hide");
		$('.finish-tagging').addClass("hide");
		$('#title_container').addClass("hide");
		$('img#imageid').imgAreaSelect({ 
									disable: true, 
									hide: true 
									}); //disable imgareaselect, this along with start/finish-tagging can be removed if needed
	});

  //Tag list hovers ( when hovering the list of tags show the titles.
  $('#titles a.title').hover(function() {
	 $('.map li').find('a.' + $(this).attr('id')).addClass('hover');
	 $('.map li').find('a.' + $(this).attr('id')).find('div').show().addClass('selected');
  }, function() {
	 $('.map li').find('a.' + $(this).attr('id')).removeClass('hover');
	 $('.map li').find('a.' + $(this).attr('id')).find('div').hide().removeClass('selected');
  });

  //when hovering the tagged areas show the title
  $('.map li a').hover(function() {
	 $(this).find('div').show();
  }, function() {
	 $(this).find('div').hide();	 
  });

	//Close the error box for form pages
	$('a#error-link').click(function() {
		$('#error-box').slideUp('slow');
		return false;
	});
	$('a#warning-link').click(function() {
		$('#warning-box').slideUp('slow');
		return false;
	});
	
	setupTags();
});

function setupTags(){
	var img = $('img#imageid'); 
	//or however you get a handle to the IMG
	var offset = img.offset();
	//alert(offset.left);
	
	//Position the tags in the relative area of the image.
	$('ul.map').css({position:'absolute',left:offset.left,top:offset.top});
	
}
	
</script>
<style type="text/css">
<?php 
if(!empty($attachment['AttachmentTag'])):
foreach($attachment['AttachmentTag'] as $tag):
?>
ul.map li a.tag_<?php echo $tag['id']; ?>{
	/*background: url(/img/tag_hotspot_62x62.png) top left no-repeat !important;*/
	position: absolute;
	top:<?php echo $tag['y1']."px;\n"; ?>
	left:<?php echo $tag['x1']."px;\n"; ?>
	width:<?php echo $tag['width']."px;\n"; ?>
	height:<?php echo $tag['height']."px;\n"; ?>
}

ul.map li a.tag_<?php echo $tag['id']; ?>:hover div{
	position:relative;
	/*Add a width in here to control your comment hover*/
	left:0px;
	top:<?php echo (intval($tag['height']))."px;\n"; ?>
}
<?php	
endforeach;
endif;
?>	
</style>
<div class="attachments view">
	<div class="on-off">
		<div class="start-tagging">Click here to start tagging</div>
		<div class="finish-tagging hide">Click here to cancel tagging</div>
	</div>
	<?php
		echo $this->element('top_actions',array('item'=>$attachment,'model'=>'Attachment','rate'=>false,'cache'=>false));
	?>
	<div class="image">
		<div id="title_container" class="hide">
		<?php
			// If user has submitted a tag, insert into database
			//Grab the X/Y/Width/Height
			echo $this->Form->create('AttachmentTag',array('action'=>'add'));
				echo $this->Form->input('attachment_id',array('type'=>'hidden','value'=>$attachment['Attachment']['id']));
				echo $this->Form->input('x1',array('type'=>'hidden','id'=>'x1'));
				echo $this->Form->input('y1',array('type'=>'hidden','id'=>'y1'));
				echo $this->Form->input('x2',array('type'=>'hidden','id'=>'x2'));
				echo $this->Form->input('y2',array('type'=>'hidden','id'=>'y2'));
				echo $this->Form->input('width',array('type'=>'hidden','id'=>'width'));
				echo $this->Form->input('height',array('type'=>'hidden','id'=>'height'));
				echo $this->Form->input('name',array('size'=>'30','type'=>'text','class'=>'name','label'=>'Tag Name'));
			echo $this->Form->end(__('Submit', true),array('class'=>'send'));
		?>
		</div>
		<div class="attachments box">
			<?php echo $this->Html->image($attachment['Attachment']['path'],array('id'=>'imageid')); ?>
		</div>
		<!-- create a CSS class with the title name from our tag -->
		<!-- 	#map a. { top:px; left:px; width:px; height:px; } --><!-- create a UL with the CSS class -->
		<?php 
			if(!empty($attachment['AttachmentTag'])):
				echo '<ul class="map">';
				foreach($attachment['AttachmentTag'] as $tag):
					echo "<li>";
					echo $this->Html->link('<div>'.$tag['name'].'</div>',"#",array('class'=>'tag_'.$tag['id'],'title'=>$tag['name'],'escape'=>false)); 
					echo "</li>";
				endforeach;
				echo "</ul>";
			endif;
		?>
	</div> <!-- image -->
	<div class="tag_titles">
		<h2 class="tagtitles">In this photo:</h2>
		<?php if(!empty($attachment['AttachmentTag'])): ?>
			<ul id="titles">
			<?php foreach($attachment['AttachmentTag'] as $tag): ?>
		      <li>
					<a href="#" class="title" id="tag_<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></a> (<?php echo $this->Html->link('Delete',array('controller'=>'attachment_tags','action'=>'delete',$tag['id'],$tag['attachment_id'])); ?>)
				</li>  
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<h3><a href="#" class="show_hide">Show/Hide Details</a></h3>
</div>
<div class="slidingDiv">
	<h3><?php echo $attachment['Attachment']['name']; ?></h3>
	<?php
		//Related houses
		echo $this->element('houses',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));
	
		//Related contractors
		echo $this->element('contractors',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));
	
		//Related sources
		echo $this->element('sources',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));
	
		//Related inspirations
		echo $this->element('clients',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));
	
		//Related inspirations
		echo $this->element('inspirations',array('item'=>$attachment,'model'=>'Attachment','cache'=>false));
	?>
</div>
