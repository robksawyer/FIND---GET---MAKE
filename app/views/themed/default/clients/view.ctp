<div class="clients view">
	<?php
		echo $this->element('top_actions',array('item'=>$client,'model'=>'Client','rate'=>true,'cache'=>false));
	?>
<h2><?php  __($client['Client']['name']);?></h2>
	<?php if(!empty($client['Client']['description'])): ?>
	<dl class="description">
			<?php echo "<span class='light-grey'>".$client['Client']['description']."</span>"; ?>
			&nbsp;
	</dl>
	<div class="clear"></div>
	<?php endif; ?>
	<dl>
		<h3 class="lime"><?php echo __('Address',true); ?></h3>
		<div class="border lime"></div>
		<dt><?php __('Address1'); ?></dt>
		<dd>
			<?php echo $client['Client']['address1']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($client['Client']['address2'])): ?>
		<dt><?php __('Address2'); ?></dt>
		<dd>
			<?php echo $client['Client']['address2']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php __('City'); ?></dt>
		<dd>
			<?php echo $client['Client']['city']; ?>
			&nbsp;
		</dd>
		<dt><?php __('State'); ?></dt>
		<dd>
			<?php echo $client['Client']['state']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Zip'); ?></dt>
		<dd>
			<?php echo $client['Client']['zip']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($client['Country']['name'], array('controller' => 'countries', 'action' => 'view', $client['Country']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
	<dl>
		<h3 class="teal"><?php echo __('Contact',true); ?></h3>
		<div class="border teal"></div>
		<dt><?php __('Phone'); ?></dt>
		<dd>
			<?php echo $client['Client']['phone']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($client['Client']['fax'])): ?>
		<dt><?php __('Fax'); ?></dt>
		<dd>
			<?php echo $client['Client']['fax']; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php __('Url'); ?></dt>
		<dd>
			<?php echo $client['Client']['url']; ?>
			&nbsp;
		</dd>
	</dl>
	<div class="clear"></div>
	<dl>
		<h3 class="orange"><?php echo __('Other Details',true); ?></h3>
		<div class="border orange"></div>
		<dt><?php __('Job Title'); ?></dt>
		<dd>
			<?php echo $client['Client']['job_title']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Total Children'); ?></dt>
		<dd>
			<?php echo $client['Client']['total_children']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Style Description'); ?></dt>
		<dd>
			<?php echo $client['Client']['style_description']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Personal Description'); ?></dt>
		<dd>
			<?php echo $client['Client']['personal_description']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Favorite Colors'); ?></dt>
		<dd>
			<?php echo $client['Client']['favorite_colors']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Favorite Patterns'); ?></dt>
		<dd>
			<?php echo $client['Client']['favorite_patterns']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Favorite Designers'); ?></dt>
		<dd>
			<?php echo $client['Client']['favorite_designers']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Created'); ?></dt>
		<dd>
			<?php echo $this->Time->niceShort($client['Client']['created'],null,''); ?>
			&nbsp;
		</dd>
		<dt><?php __('Modified'); ?></dt>
		<dd>
			<?php echo $this->Time->niceShort($client['Client']['modified'],null,''); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="clear"></div>
<?php echo $this->element('tags',array('model'=>$client,'cache'=>false)); ?>
<div class="clear"></div>
<?php 
	//ATTACHMENTS
	echo $this->element('attachments',array('item'=>$client,'model'=>'Client','controller'=>'clients','cache'=>false)); 
	
	//HOUSES
	echo $this->element('houses',array('item'=>$client,'model'=>'Client','cache'=>false));
?>