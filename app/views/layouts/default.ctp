<?php
/* SVN FILE: $Id$ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="keywords" content="brands,culture,brandname,brandnames,tool,track,users,friends,analytics,style,fashion" />
	<title>
		<?php __('Sawyer/Tapia : '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('cake.basic');
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
		//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js');
		//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js');
		echo $this->Html->script('jquery.dropshadow');
		echo $this->Html->script('jquery.validation.min');
		echo $this->Html->script('thickbox-compressed');
		echo $this->Html->script('jquery.corner');
		echo $this->Html->script('jquery.bgiframe.min');
		echo $this->Html->script('jquery.autocomplete');
		echo $this->Html->script('jquery.ajaxQueue');
		echo $this->Html->script('jquery.alerts');
		echo $scripts_for_layout;
		/*if (is_file(WWW_ROOT."css".DS.$this->params["controller"].".css")) {
			echo $this->Html->css($this->params["controller"]);
		}
		if (is_file(WWW_ROOT."css".DS.$this->params["controller"].DS.$this->params["action"].".css")) {
			echo $this->Html->css($this->params["controller"]."/".$this->params["action"]);
		}*/
		
	?>
</head>
<script type="text/javascript">
$(document).ready(function() {
	$("img").hover(
		function(){
			this.src = this.src.replace("_off", "_on");
		},
		function(){
			this.src = this.src.replace("_on", "_off");
		}
	);
	
	//Add external links icon
	$('a[target="_blank"]').filter(function() {
		return this.hostname && this.hostname !== location.hostname;
	}).after(<?php echo "' ".$html->image("icons/external.png", array("alt" => "external link"))."'"; ?>);
});
</script>
	
<body>
	<div id="container">
		<div id="header">
			<!--<h1><?php //echo $html->link(__('Just A Na.me', true), '/'); ?></h1>-->
			<?php
				/*echo $html->link(
							$html->image("justaname_logo_off.png", array("alt" => "justana.me","title" => "justana.me")),
							'/',
							array('escape'=>false)
					);*/
					echo $html->link(
								'Sawyer/Tapia',
								'/',
								array('escape'=>false)
						);
			?>
		</div>
		<div id="content">

			<?php $this->Session->flash();?>

			<?php echo $content_for_layout;?>

		</div>
		<div id="footer">
			&copy; 2009 Copyright Sawyer/<i>Tapia</i>. All Rights Reserved. This is a <a href="http://blog.robksawyer.com" target="_blank">Rob Sawyer</a> production. :: <?php echo $html->link(__('About', true), array('controller'=>'pages','action' => 'about')); ?> :: <?php echo $html->link(__('@justana_me', true), 'http://www.twitter.com/sawyer_tapia',array('target'=>'blank','title'=>'Yep, we\'re on Twitter.')); ?> :: <a href="#" onclick="UserVoice.Popin.show(uservoiceOptions); return false;" title="Request a feature, or a bug.">Feedback</a>
		</div>
	</div>
</body>
</html>