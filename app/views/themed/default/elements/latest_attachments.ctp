<div class="latest">
	<fieldset>
		<legend class="lime">Latest Attachments</legend>
	<div id="attachments-small">
		<?php $attachments = $this->requestAction('attachments/index/sort:created/direction:desc/limit:8'); ?>
		<?php foreach($attachments as $attachment): ?>
		<ul class="wrapper inline-list">
			<?php //debug($attachment); ?>
			<li><?php 
				echo $this->Html->image($attachment['Attachment']['path_small'],array(
																						'alt'=>$attachment['Attachment']['name'],
																						'url'=>'/attachments/view/'.$attachment['Attachment']['id'],
																						'height'=>'100'
																						)
																					); 
				//debug($attachment);
			?></li>
		</ul>
		<?php endforeach; ?>
	</div>
	</fieldset>
</div>