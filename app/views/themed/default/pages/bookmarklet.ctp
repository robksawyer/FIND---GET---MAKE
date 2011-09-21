<style type="text/css">
	#image-container{
		position: relative;
		float: left;
	}
	#main-description {
		float: left;
		margin: 0px 0px 0px 25px;
	}
	#smaller-images ul{
		list-style-type: none;
		margin: 5px 0;
		padding: 0;
	}
	#smaller-images ul li{
		list-style-type: none;
		display: inline;
		margin: 0 2px;
		padding: 0;
	}
	
	#bookmarklet-generate-container {
		position: relative;
		margin: 25px 0;
	}
	#bookmarklet-generate-container .get_it{
		background-image: linear-gradient(bottom, #BDBDBD 7%, #DBDBDB 61%, #D6D6D6 79%);
		background-image: -o-linear-gradient(bottom, #BDBDBD 7%, #DBDBDB 61%, #D6D6D6 79%);
		background-image: -moz-linear-gradient(bottom, #BDBDBD 7%, #DBDBDB 61%, #D6D6D6 79%);
		background-image: -webkit-linear-gradient(bottom, #BDBDBD 7%, #DBDBDB 61%, #D6D6D6 79%);
		background-image: -ms-linear-gradient(bottom, #BDBDBD 7%, #DBDBDB 61%, #D6D6D6 79%);

		background-image: -webkit-gradient(
			linear,
			left bottom,
			left top,
			color-stop(0.07, #BDBDBD),
			color-stop(0.61, #DBDBDB),
			color-stop(0.79, #D6D6D6)
		);
		padding: 3px 15px;
		color: #262626;
		text-decoration: none;
		border-radius: 8px;
		-moz-border-radius: 8px;
		-webkit-border-radius: 8px;
		font-size: 12px;
		border: 1px solid #888888;
	}
	#bookmarklet-generate-container .get_it:hover{
		background-image: linear-gradient(bottom, #D1D1D1 7%, #F0F0F0 61%, #E0E0E0 79%);
		background-image: -o-linear-gradient(bottom, #D1D1D1 7%, #F0F0F0 61%, #E0E0E0 79%);
		background-image: -moz-linear-gradient(bottom, #D1D1D1 7%, #F0F0F0 61%, #E0E0E0 79%);
		background-image: -webkit-linear-gradient(bottom, #D1D1D1 7%, #F0F0F0 61%, #E0E0E0 79%);
		background-image: -ms-linear-gradient(bottom, #D1D1D1 7%, #F0F0F0 61%, #E0E0E0 79%);

		background-image: -webkit-gradient(
			linear,
			left bottom,
			left top,
			color-stop(0.07, #D1D1D1),
			color-stop(0.61, #F0F0F0),
			color-stop(0.79, #E0E0E0)
		);
		color: #262626;
		border: 1px solid #999999;
	}
	#bookmarklet-generate-container .step{
		font-size: 14px;
		margin: 0 0 25px;
	}
	
	/****** FGM FINDER ******/
	/*div.separator{
		background: lightGrey;
		height: 1px;
		margin: 20px 0px;
	}
	.fgm_clear{
		clear: both;
		margin: 0px;
		padding: 0px;
	}
	#fgm_finder_container *{
		border: 0px;
		font-family: inherit;
		font-size: 100%;
		font-style: inherit;
		font-weight: inherit;
		line-height: 100%;
		list-style: none;
		margin: 0px;
		outline: 0px;
		padding: 0px;
		text-transform: none;
		vertical-align: baseline;
	}
	
	#fgm_finder_container .fgm_finder_overlay{
		font-family: Arial, Helvetica, sans-serif;
		position: absolute;
		padding: 0px;
		margin: 0;
		font-size: 14px;
		font-weight: bold;
		border: 10px solid #ff5237;
		cursor: pointer;
		left: -10px;
		top: -10px;
		z-index: 5e+06;
	}
	#fgm_finder_container .fgm_finder_overlay:hover{
		border: 10px solid #ef3f23;
	}
	#fgm_finder_container .fgm_finder_overlay div{
		background: #ff5237;
		color: black;
		padding: 10px;
		text-align: center;
	}
	#fgm_finder_container .fgm_finder_overlay div:hover{
		background: #ef3f23;
	}
	
	.fgm_finder{
		display: block;
		background: black;
		font-family: Arial, sans-serif;
		padding: 30px;
		position: absolute;
		width: 600px;
		z-index: 5e+06;
	}
	.fgm_header div{
		color: #777;
		cursor: pointer;
		float: right;
		font-size: 11px;
		text-align: left;
	}
	.fgm_header div:hover{
		color: #999;
	}
	.fgm_header span{ color: lightGrey; }
	#fgm_flash{ 
		border-top: 1px solid white;
		color: white;
		display: none;
		margin-bottom: 10px;
		margin-top: 20px;
		text-align: left;
	}*/
	/****** END FGM FINDER ******/
</style>
<div id="bookmarklet-test">
	<div id="image-container">
		<div id="main-image">
			<?php echo $this->Html->image('http://fpoimg.com/500x550',array('alt' => 'Main image')); ?>
		</div>
		<div id="smaller-images">
			<ul>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
				<li><?php echo $this->Html->image('http://fpoimg.com/48x48',array('alt' => 'thumb')); ?></li>
			</ul>
		</div>
	</div>
	<div id="main-description">
		<h4><?php echo $this->Html->link('Allen Edmonds','#',array()); ?></h4>
		<h1>Allen Edmonds Men's Mora Double Monk Strap</h1>
		<p class="rating">5.0 out of 5 stars  See all reviews (1 customer review) | Like (0)</p>
		<p>
			Currently unavailable.
			We don't know when or if this item will be back in stock.
		</p>
		<ul>
			<li>leather</li>
			<li>Leather sole</li>
			<li>Welted construction for outstanding support and durability</li>
		</ul>
		<?php echo $this->Html->link('Show more','#',array()); ?>
	</div>
</div>
<div class="clear"></div>
<div id="bookmarklet-generate-container">
	<?php 
		//echo $userPublicKey = $this->requestAction('//'); 
		//fgmpk_5eeeca1a0b2ed4c29df34327bf8e0ffe
	?>
	<div class="extra">
		<h1>"Get It" Browser Button</h1>
		<ul>
			<li class="safari step" style="">1) In your browser, Safari, go to <strong>View</strong> and check <strong>Show Bookmarks Bar</strong></li>
			<li class="chrome step" style="display: none;">1) In your browser, Chrome, go to <strong>View</strong> and check <strong>Always Show Bookmarks Bar</strong></li>
			<li class="firefox step" style="display: none;">1) In your browser, Firefox, go to <strong>View</strong>, then select <strong>Toolbars</strong>, and check <strong>Bookmarks Toolbar</strong></li>
			<li class="generic step" style="display: none;">1) In your browser, go to <strong>View</strong> and check <strong>Show Bookmarks Bar</strong></li>
			<li class="step">2) Click and drag this button into your bookmarks bar: <a href="javascript:void((function(){var%20fgm=document.createElement('script');fgm.setAttribute('src','http://dev.find-get-make.com/theme/default/js/bookmarklet/fgm_bookmarklet.js?<?php echo rand(1000,9999999); ?>');fgm.setAttribute('type','text/javascript');document.getElementsByTagName('head')[0].appendChild(fgm);})());" class="get_it">Get It</a></li>
			<li class="step">3) Now, press the <strong>Get It</strong> whenever you see something you want.</li>
		</ul>
		<span class="footnote">
			
		</span>
	</div>
</div>
<script type="text/javascript">

</script>