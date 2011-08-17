<?php
	/**
	 * SETTINGS
	 * @param disableMainActions The main edit, delete actions.
	 * @param disableRating Disables the rating system
	 * @param disableOwnership Disables the setting of ownership (have it, want it)
	 * @param disableOwnershipCount Disables the ownership counts (i.e. How many people want the product.)
	 * @param disableLiking Disables the liking system
	 * @param disableCategoryLink Disables the link to the category index view
	 * @param disableAttachmentDeleting Disable deleting of attachments
	 * @param disableAttachmentAdding Disable adding of attachments
	 * @param disableCollectionAdding Disables the ability to add a new collection
	 * @param disableSourceAdding Disable adding of sources
	*/
	$disableMainActions = true;
	$enableRating = true;
	$hideTags = true;
	$disableOwnership = true;
	$disableOwnershipCounts = true;
	$disableLiking = true;
	$disableCategoryLink = true;
	$disableProductAdding = true;
	$disableProductDeleting = true;
	$disableAttachmentDeleting = true;
	$disableAttachmentAdding = true;
	$disableSourceAdding = true;
	$disableCollectionAdding = true;
	$disableInspirationAdding = true;
	$disableComments = false;
?>
<div class="sources view">
<?php
	if(!empty($disableMainActions)){
		$removeDelete = true;
		$removeEdit = true;
	}
	echo $this->element('top_actions',array(
														'item'=>$source,
														'model'=>'Source',
														'rate'=>$enableRating,
														'removeDelete'=>$removeDelete,
														'removeEdit'=>$removeEdit,
														'cache'=>false
														));
?>
<h2><?php 
			__($source['Source']['name']);
			if(!empty($source['SourceCategory']['name'])){
				if(empty($disableCategoryLink)){
					echo "<span class='light-grey'> &mdash;".$this->Html->link($source['SourceCategory']['name'],array('controller'=>'source_categories','action'=>'view',$source['SourceCategory']['id']))."</span>";
				}else{
					echo "<span class='light-grey'> &mdash;".$source['SourceCategory']['name']."</span>";
				}
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
	<?php 
		if(empty($hideTags)){
			echo $this->element('tags',array('model'=>$source,'cache'=>false)); 
		}
	?>
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
	<?php if(!empty($source['User']['username'])): ?>
		<div class="added-by"><?php echo "Found by ".$source['User']['username']; ?></div>
	<?php else: ?>
		<div class="added-by"><?php echo "Found by unknown"; ?></div>
	<?php endif; ?>
	<?php echo $this->element('social-buttons',array('cache'=>false)); ?>
</div>
<div class="clear"></div>
<?php 
	//Related products
	if(!empty($source['Product'])){
		echo $this->element('products',array(
														'item'=>$source,
														'model'=>'Source',
														'client'=>true,
														'disableDeleting'=>$disableProductDeleting,
														'disableAdding'=>$disableProductAdding,
														'cache'=>false
														));
	}
	//Related inspirations
	echo $this->element('inspirations',array(
														'item'=>$source,
														'model'=>'Source',
														'client'=>true,
														'disableAdding'=>$disableInspirationAdding,
														'cache'=>false
														));
	
	//CONTRACTORS
	/*echo $this->element('contractors',array(
														'item'=>$source,
														'model'=>'Source',
														'cache'=>false
														));*/
	
	//ATTACHMENTS
	echo $this->element('attachments',array(
														'item'=>$source,
														'model'=>'Source',
														'controller'=>'sources',
														'client'=>true,
														'disableAdding'=>$disableAttachmentAdding,
														'disableDeleting'=>$disableAttachmentDeleting,
														'cache'=>false
														));
?>
<?php //debug($source); ?>
<div class="clear"></div>
<?php 
	if(empty($disableComments)){
		echo $this->element('comments',array('cache'=>false,'disable'=>false)); 
	}
?>