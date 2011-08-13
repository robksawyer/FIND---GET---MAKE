<!-- create a CSS class with the title name from our tag -->
<style type="text/css">
<?php 
if(!empty($inspiration['InspirationPhotoTag'])):
	//Traverse through the tags and add the css styling for each of them
	foreach($inspiration['InspirationPhotoTag'] as $tag):
?>
		ul.map li a.tag_<?php echo $tag['id']; ?>{
			position: absolute;
			left:<?php echo (intval($tag['x1'])-5)."px;\n"; ?>
			top:<?php echo (($tag['y1'])-5)."px;\n"; ?>
			width:<?php echo $tag['width']."px;\n"; ?>
			height:<?php echo $tag['height']."px;\n"; ?>
		}
		
		/*ul.map li a.tag_<?php echo $tag['id']; ?>:hover div{
			position:relative;
			left:0px;
			top:<?php echo (intval($tag['height']))."px;\n"; ?>
		}*/
<?php	
	endforeach;
endif;
?>	
</style>
<?php 
	if(empty($inspiration['InspirationPhotoTag'])){
		echo '<ul class="map" style="display:none;">';
	}else{
		$width = $inspiration['Attachment'][0]['width'];
		$height = $inspiration['Attachment'][0]['height'];
		echo '<ul class="map">';
		//Render all of the tags 
		foreach($inspiration['InspirationPhotoTag'] as $tag):
			echo "<li>";
				echo $this->Html->link('<div>'.$tag['name'].'</div>',"#",array('class'=>'tag_'.$tag['id'],'title'=>$tag['name'],'escape'=>false)); 
			echo "</li>";
		endforeach;
	}	
	echo "</ul>";
?>