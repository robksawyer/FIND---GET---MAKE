<h2>Product Search</h2>
<div id="search-form">
<?php
	echo $this->Form->create('Product', array(
		'url' => array_merge(array('action' => 'find'), $this->params['pass'])
		));
	echo $this->Form->input('name', array('div' => true));
	echo '<div class="side-by-side clearfix"><div>';
	echo $this->Form->input('product_category_id',array('class'=>'chzn-select','empty' => '-- Choose a Category --','style'=>'width:250px;'));
	echo '</div></div>';
	echo $this->Form->input('designer', array('div' => true));
	echo $this->Form->input('description', array('div' => true));
	echo $this->Form->input('source_url', array('div' => true));
	echo $this->Form->input('tags', array('div' => true));
	echo $this->Form->submit(__('Search', true), array('div' => true));
	echo $this->Form->end();
?>
</div>

<?php
	if(!empty($products)){
?>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th style="display:none"><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('product_category_id');?></th>
				<th><?php echo $this->Paginator->sort('designer');?></th>
				<th><?php echo $this->Paginator->sort('description');?></th>
				<th><?php echo $this->Paginator->sort('source url');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($products as $product):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class; ?>>
			<td style="display:none"><?php echo $product['Product']['id']; ?>&nbsp;</td>
			<td width="40%"><?php echo $this->Html->link(__($product['Product']['name'], true), array('action' => 'view', $product['Product']['id']),array('title'=>$product['Product']['description'])); ?>&nbsp;</td>
			<td><?php echo $product['ProductCategory']['name'] ?></td>
			<td><?php echo $product['Product']['designer'] ?></td>
			<td><?php echo $string->truncate($product['Product']['description'],100); ?></td>
			<td><?php echo $this->Html->link($string->truncate($product['Product']['source_url']),$product['Product']['source_url'],array('target'=>'_blank')); ?></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>	</p>
		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
<?php 
		}else{
?>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th></th>
				</tr>
				<tr>
					<td><h3>No results found.</h3></td>
				</tr>
			</table>
<?php
		} 
?>
<script type="text/javascript"> $(".chzn-select").chosen(); </script>