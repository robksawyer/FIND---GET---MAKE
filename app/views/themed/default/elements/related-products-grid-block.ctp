<ul class="gridded_item_set">
<?php
$addBreak = 1;
$counter = 0;
foreach($items as $item):
	if(!empty($item['Attachment'][0])):
?>
<li id="grid_product_<?php echo $item['Product']['id']; ?>" class="item">
	<?php
	echo $this->Html->image($item['Attachment'][0]['path_med'],array(
																						'url'=>array('controller'=>'products',
																										'action'=>'view',$item['Product']['id'],
																										),
																						'title'=>$item['Product']['name']
																						));

	?>
</li>
<div id="tooltip_data_container_<?php echo $counter; ?>" style="display:none">
	<div id="tooltip_container_<?php echo $counter; ?>" class="tooltip_data">
		<ul class="grid_context_menu" id="context_menu_<?php echo $item['Product']['id']; ?>">
			<li class="dot">
				<?php
					echo $this->Html->link('Add',array('ajax'=>true,'controller'=>'dots','action'=>'toggle','products',$item['Product']['id']));
				?>
			</li>
			<li>
			<?php if(!empty($item['Product']['price'])): ?>
				<?php echo "<strong>".$item['Product']['price']."</strong>"; ?>
			<?php endif; ?>
				<span>
					<?php
						echo $this->Html->link($this->Text->truncate($item['Source']['name'],50),array('controller'=>'sources','action'=>'view',$item['Source']['id']))."&mdash; ".$this->Html->link($this->Text->truncate($item['Product']['name'],50),array('controller'=>'products','action'=>'view',$item['Product']['id']));
					?>
				</span>
			</li>
		</ul>
		<ul class="details" style="display:none">
			<li>
				<?php echo "Found by ".$this->Html->link($item['User']['username'],array('controller'=>'users','action'=>'profile',$item['User']['username'])); ?>
			</li>
		</ul>
	</div>
</div>
<?php if($addBreak > 2) {
	$addBreak = 0;
	echo "<br />";
}?>
<?php
	$addBreak++;
	endif;
	$counter++;
endforeach;
?>
<ul>
<script type="text/javascript">
	/*$(document).ready(function(){
		
		$('.item').each(function(index,element){
			//$('body').append($('#tooltip_data_container_'+index).html());
			//$('.gridded_item_set #tooltip_data_container_'+index).remove();
			//$('#tooltip_container_'+index).hide();
			
			$('.item img').simpletip({
				content: $('#tooltip_data_container_'+index),
				fixed: false
			});
		});
	});*/
</script>