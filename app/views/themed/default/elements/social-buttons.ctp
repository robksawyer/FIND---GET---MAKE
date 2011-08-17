<?php
if(!empty($controller) && !empty($keycode)){
	$rootURL = "http://".$_SERVER['SERVER_NAME']."/".$controller."/key/".$keycode;
}else{
	$rootURL = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}
if(Configure::read('FGM.social_sharing') == 1): 
?>
<div class="social">
	<span class="fbsend"><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:send href="<?php echo $rootURL; ?>" font="arial"></fb:send></span>
	<!--<span class="gplus"><g:plusone size="small"></g:plusone></span>-->
</div>
<div class="clear"></div>
<!-- SOCIAL PLUGIN CODE -->

<!-- Google +1 -->
<!-- <script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script> -->
<!-- End Google +1 -->

<!-- END SOCIAL PLUGIN CODE -->
<?php endif; ?>