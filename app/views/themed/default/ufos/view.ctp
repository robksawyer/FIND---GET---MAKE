<?php
 //debug($ufo);
?>
<div class="ufos view">
	<?php
		echo $this->element('top_actions',array('item'=>$ufo,'model'=>'Ufo','rate'=>true,'cache'=>false));
	?>
	<div class="attachments box">
		<?php if(!empty($ufo['Ufo']['name'])): ?>
		<h2><?php __($ufo['Ufo']['name']); ?></h2>
		<?php endif; ?>
		<?php
			if(!empty($ufo['Attachment']['source_url'])){
				$source_url = $ufo['Attachment']['source_url'];
			}else{
				$source_url = '';
			}
			if(!empty($ufo['Attachment']['title'])){
				$title = $ufo['Attachment']['title'];
			}else{
				if(!empty($ufo['Ufo']['name'])){
					$title = $ufo['Ufo']['name'];
				}else{
					$title = '';
				}
			}
		?>
		<?php echo $this->Html->image($ufo['Attachment']['path'],array('alt'=>$title,'url'=>$source_url,'title'=>$title)); ?>
	</div>
</div>
<div class="clear"></div>
<?php if(!empty($source_url)): ?>
<div class="source">
	<?php echo "Source: ".$this->Html->link($source_url, $source_url,array('target'=>'_blank')); ?>
</div>
<?php endif; ?>
<br/>
<?php if(!empty($ufo['Ufo']['description'])): ?>
<div class="description">
	<?php echo "<span class='light-grey'>".$ufo['Ufo']['description']."</span>"; ?>
</div>
<div class="clear"></div>
<?php endif; ?>
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
