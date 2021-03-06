<?php echo $this->Html->docType('xhtml-trans'); ?> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title>
	<?php __d('forum', 'FIND | GET | MAKE | forum Administration'); ?> -
	<?php echo $title_for_layout; ?>
</title>

<?php
echo $this->Html->css('cake.generic');
echo $this->Html->css('basic');
echo $this->Html->css('forum/style.css');
echo $this->Html->css('elements/nav.css');
echo $this->Html->script('/forum/js/jquery-1.5.min.js');
echo $scripts_for_layout; ?>
</head>

<body>
<div id="wrapper">  
	<div id="header">
		<!--<h1><?php //echo $this->Html->link(__d('forum', 'FIND | GET | MAKE | forum Administration', true), $this->Cupcake->settings['site_main_url']); ?></h1>-->
		<div id="logo-container">
			<div class="app-name"><?php echo $this->Html->image('site/logo-forum.png',array('alt'=>'FIND | GET | MAKE','url'=>$this->Cupcake->settings['site_main_url'],'style'=>'position: relative; float: none; margin: 0px 0px 20px 0px; padding: 0px;','title'=>'FIND | GET | MAKE')); ?></div>
		</div>
		<div class="clear"></div>
		
		<div id="navbar">
			<div class="nav-main">
				<ul id="nav-one" class="nav">
					<li<?php if ($menuTab == 'home') echo ' class="active"'; ?>><?php echo $this->Html->link(__d('forum', 'Home', true), array('controller' => 'home', 'action' => 'index', 'admin' => true)); ?></li>
					<li<?php if ($menuTab == 'settings') echo ' class="active"'; ?>><?php echo $this->Html->link(__d('forum', 'Settings', true), array('controller' => 'home', 'action' => 'settings', 'admin' => true)); ?></li>
					<li<?php if ($menuTab == 'forums') echo ' class="active"'; ?>><?php echo $this->Html->link(__d('forum', 'Forums', true), array('controller' => 'categories', 'action' => 'index', 'admin' => true)); ?></li>
					<li<?php if ($menuTab == 'staff') echo ' class="active"'; ?>><?php echo $this->Html->link(__d('forum', 'Staff', true), array('controller' => 'staff', 'action' => 'index', 'admin' => true)); ?></li>
					<li<?php if ($menuTab == 'reports') echo ' class="active"'; ?>><?php echo $this->Html->link(__d('forum', 'Reported', true), array('controller' => 'reports', 'action' => 'index', 'admin' => true)); ?></li>
					<li<?php if ($menuTab == 'users') echo ' class="active"'; ?>><?php echo $this->Html->link(__d('forum', 'Users', true), array('controller' => 'users', 'action' => 'index', 'admin' => true)); ?></li>
					<li><?php echo $this->Html->link(__d('forum', 'Return to Forum', true), array('controller' => 'home', 'action' => 'index', 'admin' => false)); ?></li>
				</ul>
			</div>
			<div class="clear"><!-- --></div>
	</div>
	
    <div id="content">
    	<?php echo $this->element('navigation'); ?>
        
		<?php echo $content_for_layout; ?>
 	</div>
    	<div id="footer">
			Copyright &copy; 2011 FIND | GET | MAKE : A Kate Tapia and Rob Sawyer Production 
			<?php 
				// Would love it if you kept this in all the pages :]
				echo $this->element('copyright');
				?>
		</div>
    
</div>    
</body>
</html>