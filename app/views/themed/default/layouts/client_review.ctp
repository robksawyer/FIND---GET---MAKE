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
<html xmlns="http://www.w3.org/1999/xhtml">
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
				echo $this->Html->css('jquery-ui/ui-lightness/jquery-ui-1.8.2.custom');
			}else{
				echo $this->Html->css('http://yui.yahooapis.com/2.8.0r4/build/reset/reset-min.css');
				echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css');
			}
			
			echo $this->Html->css('screen');
			//Chosen Select Boxes (http://harvesthq.github.com/chosen/)
			echo $this->Html->css('chosen/chosen');
			//Used for the autocomplete tags element
			//echo $this->Html->css('jquery.autocomplete');
			echo $this->Html->css('auto-complete');
			echo $this->Html->css('jquery.tablescroll');
			echo $this->Html->css('/rating/css/rating');
			//Cupcake Forum
			echo $this->Html->css('forum/style.css');
			//Modal windows
			echo $this->Html->css('modal/basic');
			echo '<!-- IE6 "fix" for the close png image -->';
			echo '<!--[if lt IE 7]>';
			echo $this->Html->css('modal/basic_ie');
			echo '<![endif]-->';
			
			if(Configure::read('FGM.local') == true){
				echo $this->Html->script('jquery-1.4.1.min');
				echo $this->Html->script('jquery-ui/jquery-ui-1.8.2.custom.min');
			}else{
				//echo "<!-- Include jquery 1.4.2 via google apis -->";
				//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
				//v1.2.6
				//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js');
				//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js');
				//v1.2.6
				//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js');
				//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js')."\n";
				echo $this->Html->script('https://www.google.com/jsapi?key=ABQIAAAAnmDjwFmPVi_wiEa7kcH4kxRoSg5s9K5GPFZf3sp5WjiQsRDImxRDlMCi9qkG8Qo4zHXzieotWXFWzA')."\n";
				echo '<script language="Javascript" type="text/javascript">'."\n";
				echo '//<![CDATA['."\n";
				echo 'google.load("jquery", "1.6.2");'."\n";
				echo 'google.load("jqueryui", "1.8.4");'."\n";
				echo '//]]>'."\n";
				echo '</script>'."\n";
			}
			
			echo $this->Html->script(array('fgm_api','utils'))."\n";
			echo $this->Html->script('/rating/js/rating_jquery_min');
			echo $this->Html->script('jquery.popupwindow',array('inline'=>false));
			echo $this->Html->script(array('jquery.form','jquery.autocomplete.min','jquery.jeditable.mini','jquery.mousewheel.min'));
			echo "<!-- Chosen Select Boxes (http://harvesthq.github.com/chosen/) -->";
			echo $this->Html->script('chosen/chosen.jquery.min');
			echo "<!-- Include jquery modal window apis -->";
			echo $this->Html->script(array('modal/jquery.simplemodal.1.4.1.min','modal/basic'));
			
			//Cupcake forum
			echo $this->Html->script('/forum/js/script.js');
			if ($this->params['controller'] == 'home') {
				echo $this->Html->meta(__d('forum', 'RSS Feed - Latest Topics', true), array('action' => 'feed', 'ext' => 'rss'), array('type' => 'rss'));
			} else if (isset($feedId) && in_array($this->params['controller'], array('categories', 'topics'))) {
				echo $this->Html->meta(__d('forum', 'RSS Feed - Content Review', true), array('action' => 'feed', $feedId, 'ext' => 'rss'), array('type' => 'rss'));
			}
			
			echo $scripts_for_layout;
		?>
		
		<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
		</script>
		<script type='text/javascript'>
		GS_googleAddAdSenseService("ca-pub-6286199062010551");
		GS_googleEnableAllServices();
		</script>
		<script type='text/javascript'>
		GA_googleAddSlot("ca-pub-6286199062010551", "Index_Box_Unit");
		</script>
		<script type='text/javascript'>
		GA_googleFetchAds();
		</script>
	</head>
	<body>
		<!-- This is for the popup plugin -->
		<div id="popups" style="z-index: 1000;"></div>
		<div id="wrapper_extra">
			<div id="wrapper">
				<div id="header">
					<!-- Navigation -->
					<?php  //User Nav
						if(!empty($authUser)){
							if($authUser['User']['group_id'] == 1){
								echo $this->element('nav-admin',array('cache'=>false));
							}else if($authUser['User']['group_id'] == 2){
								echo $this->element('nav-manager',array('cache'=>false));
							}else{
								echo $this->element('nav-user',array('cache'=>false));
							}
						}else{
							echo $this->element('nav-user',array('cache'=>false));
						}
					?>
					<?php echo $this->element('nav', array('cache' => false)); ?>
					<!-- End Navigation -->
				</div>
				<?php
					if ($this->params['action'] == 'display' || $this->params['action'] == 'moderate') {
						//The competition was here.
					}
				?>
				<?php 
					//debug($this->params['plugin']);
					if ($this->params['plugin'] == 'forum') {
						echo $this->element('navigation',array('plugin' => 'forum')); 
					}
				?>
				<br class="clear"/>
				<?php echo $this->Session->flash();?>
				<?php echo $content_for_layout;?>

			</div>
			<div id="footer">
				<h3>FIND | GET | MAKE is an intricate, multi-layered database for all the resources you could ever want to use in an interior decor project.</h3>
				<?php echo $this->Html->link('Feedback','https://spreadsheets.google.com/spreadsheet/viewform?formkey=dFUtdmpVUkV3Njc1Nmo2d1RzWF9sekE6MQ',array('target'=>'_blank','class'=>'feedback')); ?> Copyright 2011, FIND | GET | MAKE : A Kate Tapia and Rob Sawyer Production 
				<?php echo $this->Html->link('Blog','http://findgetmake.tumblr.com/',array('target'=>'_blank'));?>
				<?php echo $this->Html->link('About','#');?>
				<?php echo $this->Html->link('Privacy Policy','/privacy');?>
				<?php echo $this->Html->link('Terms','/terms');?>
			</div>
			<div id="sub-footer">
			<?php //echo $this->Facebook->like(); ?>
			</div>
		</div>
		<?php 
			echo '<script type="text/javascript" src="/minify/index?g=footer_js&'.date("His").'"></script>'."\n";
			//echo $this->Minify->external($this->__scripts); 
			//echo $minify->js($this->__scripts);
			echo $this->Js->writeBuffer(); // write cached scripts 
		?>
	</body>
</html>