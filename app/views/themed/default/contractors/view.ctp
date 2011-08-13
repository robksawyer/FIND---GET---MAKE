<div class="contractors view">
	<?php
		echo $this->element('top_actions',array('item'=>$contractor,'model'=>'Contractor','rate'=>true,'cache'=>false));
	?>
<h2><?php  __($contractor['Contractor']['name']);?></h2>
	<?php if(!empty($contractor['Contractor']['description'])): ?>
	<dl class="description">
		<?php echo "<span class='light-grey'>".$contractor['Contractor']['description']."</span>"; ?>
		&nbsp;
	</dl>
	<div class="clear"></div>
	<?php endif; ?>
	<dl>
		<h3 class="lime"><?php echo __('Address',true); ?></h3>
		<div class="border lime"></div>
		<dt><?php __('Address1'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['address1']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Address2'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['address2']; ?>
			&nbsp;
		</dd>
		<dt><?php __('City'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['city']; ?>
			&nbsp;
		</dd>
		<dt><?php __('State'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['state']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Zip'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['zip']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contractor['Country']['name'], array('controller' => 'countries', 'action' => 'view', $contractor['Country']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
	<dl>
		<h3 class="teal"><?php echo __('Contact',true); ?></h3>
		<div class="border teal"></div>
		<dt><?php __('Phone'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['phone']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Fax'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['fax']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Url'); ?></dt>
		<dd>
			<?php echo $contractor['Contractor']['url']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Created'); ?></dt>
		<dd>
			<?php echo $this->Time->niceShort($contractor['Contractor']['created'],null,''); ?>
			&nbsp;
		</dd>
		<dt><?php __('Modified'); ?></dt>
		<dd>
			<?php echo $this->Time->niceShort($contractor['Contractor']['modified'],null,''); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="clear"></div>
	<?php echo $this->element('tags',array('model'=>$contractor,'cache'=>false)); ?>
</div>
<?php 
	//ATTACHMENTS
	echo $this->element('attachments',array('item'=>$contractor,'model'=>'Contractor','controller'=>'contractors','cache'=>false)); 
?>
<div class="related">
	<h3><?php __('Related Sources');?></h3>
	<?php if (!empty($contractor['Source'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($contractor['Source'] as $source):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($source['name'],array('controller'=>'sources','action'=>'view',$source['id']));?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions" style="display: none">
		<ul>
			<li><?php echo $this->Html->link(__('New Source', true), array('controller' => 'sources', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="clear"></div>
<div id="comments">
	<div id="disqus_thread"></div>
	<script type="text/javascript">
	    var disqus_shortname = 'theinteriorsource'; // required: replace example with your forum shortname

	    // The following are highly recommended additional parameters. Remove the slashes in front to use.
	    // var disqus_identifier = 'unique_dynamic_id_1234';
	    // var disqus_url = 'http://example.com/permalink-to-page.html';

	    /* * * DON'T EDIT BELOW THIS LINE * * */
	    (function() {
	        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
	        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	    })();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
</div>
