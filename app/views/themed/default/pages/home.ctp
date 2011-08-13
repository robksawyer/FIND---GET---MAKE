<div id="inner-container" class="home">	
	<h3><?php __('Welcome') ?></h3>
	<p class="description">FIND | GET | MAKE is an intricate, multi-layered database for all the resources you could ever want to use in an interior decor project.</p>
	<div class="clear"></div>
	<div class="favorite-stuff">
	<?php 
		//ADD FAVORITES
	?>
	</div>
	<div class="left-container">
		<div class="latest-stuff">
		<?php 
			//LATEST SOURCES
			echo $this->element('latest_sources',array('cache'=>false));
			
			//LATEST PRODUCTS
			echo $this->element('latest_products',array('cache'=>false));
			
			//LATEST ATTACHMENTS
			//echo $this->element('latest_attachments',array('cache'=>false)); 

			//LATEST HOUSES
			//echo $this->element('latest_houses',array('cache'=>false));

		?>
		</div>
	</div>
	<div class="right-container">
		<div id="comments" class="dsq-widget">
			<script type="text/javascript" src="http://theinteriorsource.disqus.com/combination_widget.js?num_items=5&hide_mods=0&color=grey&default_tab=people&excerpt_length=200"></script>
		</div>
		<?php
			//Challenge
			echo $this->element('challenge',array('cache'=>false));
		?>
	</div>
</div>