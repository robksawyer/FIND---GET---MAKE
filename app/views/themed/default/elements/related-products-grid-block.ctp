<ul class="gridded_item_set">
<?php
$addBreak = 1;
foreach($items as $item){
	if(!empty($item['Attachment'][0])){
?>
<li id="grid_product_<?php echo $item['Product']['id']; ?>" class="item">
	<?php
	echo $this->Html->image($item['Attachment'][0]['path_med'],array(
																						'url'=>array('controller'=>'products',
																										'action'=>'view',$item['Product']['id'],
																										),
																						'title'=>$item['Product']['name'],
																						'onmouseover'=>'showContextMenu('.$item['Product']['id'].')',
																						'onmouseout'=>'hideContextMenu('.$item['Product']['id'].')'
																						));

	?>
	<ul class="grid_context_menu" id="context_menu_<?php echo $item['Product']['id']; ?>" style="display: none;">
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
</li>
<?php if($addBreak > 2) {
	$addBreak = 0;
	echo "<br />";
}?>
<?php
	$addBreak++;
	}
}
?>
<ul>
<script type="text/javascript">
function showContextMenu(id){
	$('#context_menu_'+id).show();
}
function hideContextMenu(id){
	$('#context_menu_'+id).hide();
}
</script>