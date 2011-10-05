<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php header('Content-type: text/html; charset=UTF-8') ;?>
<?php echo $this->Html->docType('xhtml-trans'); ?> 
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<?php echo $this->Facebook->html(); ?>
	<head>
		<?php echo $this->Html->charset('utf-8'); ?>
		<title>
			<?php echo 'FIND | GET | MAKE : '.$title_for_layout; ?>
			<?php //echo $this->Cupcake->settings['site_name']; ?>
			<?php //echo $title_for_layout; ?>
		</title>
		<meta name="google-site-verification" content="JUU-wqSQy7ywn1-Z9ZPwW-zU2KlQC1zyYLFU8_JAQQ0" />
		<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
		<?php 
			echo "<!-- A simple css reset from yahoo -->";
			if(Configure::read('FGM.local') == true){
				echo $this->Html->css('reset-min.css');
			}else{
				echo $this->Html->css('http://yui.yahooapis.com/2.8.0r4/build/reset/reset-min.css');
			}
			
			echo $this->Html->css('screen');
			echo $this->Html->css('landing');
			//Minify the css
			echo $this->Minify->css($this->__scripts);
			
			if(Configure::read('FGM.local') == true){
				
			}else{
				
			}
			echo '<script type="text/javascript" src="/min/g=dependencies_js"></script>'."\n";
			echo '<script type="text/javascript" src="/min/g=base_js"></script>'."\n";
			//echo '<script type="text/javascript" src="/min/g=forum_js"></script>'."\n";
			
			echo $this->Html->script('http://partner.googleadservices.com/gampad/google_service.js')."\n";
			//echo $scripts_for_layout;
		?>
	</head>
	<body class="landing-page">
		<!-- This is for the popup plugin -->
		<div id="popups" style="z-index: 1000;"></div>
		<div id="wrapper_extra">
			<div id="wrapper">
				<div id="header"></div>
				<?php echo $this->Session->flash();?>
				
				<?php echo $content_for_layout;?>

			</div>
			<div id="footer">
				&copy; Copyright 2011, FIND | GET | MAKE : A Kate Tapia and Rob Sawyer Production 
				<?php echo $this->Html->link('Blog','http://findgetmake.tumblr.com/',array('target'=>'_blank'));?>
				<?php echo $this->Html->link('About','#');?>
				<?php echo $this->Html->link('Privacy Policy','/privacy');?>
				<?php echo $this->Html->link('Terms','/terms');?>
			</div>
		</div>
		<div id="outer-container">
			
		</div>
		<?php echo $this->Js->writeBuffer(); // write cached scripts ?>
	</body>
	<?php 
		echo $this->Html->script('footer')."\n";
		echo $this->Minify->external($this->__scripts); 
		echo $this->Minify->js($this->__scripts);
		echo $this->Facebook->init(); 
	?>
</html>