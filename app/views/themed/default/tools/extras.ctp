<style type="text/css">	
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
</style>
<div id="bookmarklet-generate-container">
	<div class="extra">
		<h1>"Want It" Browser Button</h1>
		<ul>
			<li class="safari step" style="">1) In your browser, Safari, go to <strong>View</strong> and check <strong>Show Bookmarks Bar</strong></li>
			<li class="chrome step" style="display: none;">1) In your browser, Chrome, go to <strong>View</strong> and check <strong>Always Show Bookmarks Bar</strong></li>
			<li class="firefox step" style="display: none;">1) In your browser, Firefox, go to <strong>View</strong>, then select <strong>Toolbars</strong>, and check <strong>Bookmarks Toolbar</strong></li>
			<li class="generic step" style="display: none;">1) In your browser, go to <strong>View</strong> and check <strong>Show Bookmarks Bar</strong></li>
			<li class="step">2) Click and drag this button into your bookmarks bar: <a href="javascript:void((function(){var%20fgm=document.createElement('script');fgm.setAttribute('src','<?php echo $user_bookmarklet_path; ?>?<?php echo rand(1000,9999999); ?>');fgm.setAttribute('type','text/javascript');document.getElementsByTagName('head')[0].appendChild(fgm);})());" class="get_it">Want It</a></li>
			<li class="step">3) Now, press the <strong>Want It</strong> whenever you see something you want.</li>
		</ul>
		<span class="footnote">
			
		</span>
	</div>
</div>
<script type="text/javascript">

</script>