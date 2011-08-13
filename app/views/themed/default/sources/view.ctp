<div class="sources view">
<?php
	echo $this->element('top_actions',array('item'=>$source,'model'=>'Source','rate'=>true,'cache'=>false));
?>
<h2><?php 
			__($source['Source']['name']);
			if(!empty($source['SourceCategory']['name'])){
				echo "<span class='light-grey'> &mdash;".$this->Html->link($source['SourceCategory']['name'],array('controller'=>'source_categories','action'=>'view',$source['SourceCategory']['id']))."</span>";
			}
			if(!empty($source['Source']['url'])):
				echo "<br/>&#x21B3;"."<span class='link'>".$this->Html->link($source['Source']['url'],$source['Source']['url'],array('target'=>'_blank'))."</span>";
			endif;
		?></h2>
	<?php if(!empty($source['Source']['description'])): ?>
	<dl class="description">
		<?php echo "<span class='light-grey'>".$source['Source']['description']."</span>"; ?>
	</dl>
	<div class="clear"></div>
	<?php endif; ?>
	<?php echo $this->element('tags',array('model'=>$source,'cache'=>false)); ?>
	<dl>
		<h3 class="lime"><?php echo __('Address',true); ?></h3>
		<div class="border lime"></div>
		<dt><?php __('Address1'); ?></dt>
		<dd>
			<?php echo $source['Source']['address1']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($source['Source']['address2'])): ?>
		<dt><?php __('Address2'); ?></dt>
		<dd>
			<?php echo $source['Source']['address2']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php __('City'); ?></dt>
		<dd>
			<?php echo $source['Source']['city']; ?>
			&nbsp;
		</dd>
		<dt><?php __('State'); ?></dt>
		<dd>
			<?php echo $source['Source']['state']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Zip'); ?></dt>
		<dd>
			<?php echo $source['Source']['zip']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($source['Country']['name'], array('controller' => 'countries', 'action' => 'view', $source['Country']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
	<dl>
		<h3 class="teal"><?php echo __('Contact',true); ?></h3>
		<div class="border teal"></div>
		<dt><?php __('Phone'); ?></dt>
		<dd>
			<?php echo $source['Source']['phone']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($source['Source']['fax'])): ?>
		<dt><?php __('Fax'); ?></dt>
		<dd>
			<?php echo $source['Source']['fax']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php __('Email'); ?></dt>
		<dd>
			<?php echo $this->Html->link($source['Source']['email'],'mailto:'.$source['Source']['email']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="clear"></div>
	<?php 
		echo $this->element('share-buttons',array('controller'=>'sources',
																'keycode'=>$source['Source']['keycode'],
																'cache'=>false
																));
		echo $this->element('social-buttons',array(
																'controller'=>'sources',
																'keycode'=>$source['Source']['keycode'],
																'cache'=>false
																));
	?>
</div>
<?php 
	//Related products
	if(!empty($source['Product'])){
		echo $this->element('products',array('item'=>$source,'model'=>'Source','cache'=>false));
	}
	//Related inspirations
	echo $this->element('inspirations',array('item'=>$source,'model'=>'Source','cache'=>false));
	
	if(PRIVATE_SOLUTION){
		//CONTRACTORS
		echo $this->element('contractors',array('item'=>$source,'model'=>'Source','cache'=>false));
	}
	
	//ATTACHMENTS
	echo $this->element('attachments',array('item'=>$source,'model'=>'Source','controller'=>'sources','cache'=>false));
?>
<?php //debug($source); ?>
<div class="clear"></div>
<?php echo $this->element('comments',array('cache'=>false,'disable'=>false)); ?>