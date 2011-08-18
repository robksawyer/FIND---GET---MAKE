<?php
	$this->Html->script('jquery.corner',array('inline'=>false));
?>
<div id="join">
	<h4>FIND | GET | MAKE is an open-ended and flexible design tool that assists in management of vendors, products, and inspiration tear sheets.
		<br/>With purchase, you’ll get:</h4>
	<div class="group">
		<div class="plus">
			<div class="header">
				<h1>Plus</h1>
				<h2>(for the business owner)</h2>
			</div>
			<ul>
				<li>your own private site open only to your firm and clients</li>
				<li>24/7 support</li>
				<li>custom design and functionality upgrades</li>
				<li>robust discussion area for recording client’s sign off on purchases</li>
				<li>professional digital design boards</li>
				<li>view-only mode for sharing with clients</li>
				<li>custom URL</li>
				<li>global access with nothing to install</li>
			</ul>
		</div>
		<div class="plus-sign-up">
			<?php //echo $this->Html->link('Sign up for Plus',array('controller'=>'users','action'=>'signup-plus','admin'=>false)); ?>
			<p>FIND | GET | MAKE has been our passion for months. If you give us a call, we’d love to talk about subscription and customization options for your business.<br/><span class="number">ph. 503.974.4867</span><br/>
			</p>
			<span>Meetings will be taken in and around the Portland, OR, metropolitan area.</span>
		</div>
	</div>
	<div class="group">
		<div class="basic">
			<?php //echo $this->Html->image('site/free.png',array('class'=>'free')); ?>
			<div class="header">
				<h1>Basic</h1>
				<h2>(for the amateurs and individuals)</h2>
			</div>
			<ul>
				<li>free to use</li>
				<li>public forum access</li>
				<li>easy tools for collecting and identifying products</li>
				<li>community-added content</li>
			</ul>
		</div>
		<div class="basic-sign-up">
			<?php echo $this->Html->link('Sign up for Basic','/register'); ?>
		</div>
	</div>
	<div class="clear"></div>
	<br/>
	<p class="footer"></p>
</div>
<script type="text/javascript">
	$("#join").corner("10px");
	$(".plus").corner('10px');
	$(".basic").corner('10px');
	$(".basic-sign-up").corner("10px");
	$(".plus-sign-up").corner("10px");
</script>