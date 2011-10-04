<div id="link-button">
	<?php 
		echo $this->Html->link('Sign up','#signup',array('class'=>'top-button','id'=>'sign-up-button'));
		echo $this->Html->link('Log in','#login',array('class'=>'top-button','id'=>'log-in-button','style'=>'display:none')); 
	?>
</div>
<div id="inner-container" class="home">
	<div id="logo-container">
		<div class="app-name"><?php echo $this->Html->image('/img/logo_dark.png',array('alt'=>'FIND | GET | MAKE','url'=>'/','style'=>'position: relative; float: none; margin: 0px 0px 2px 0px; padding: 0px;','title'=>'FIND | GET | MAKE')); ?></div>
	</div>
	<div class="clear"></div>
	<div id="results">
		<?php echo $this->Session->flash(); ?>
	</div>
	<div id="login_form_container" style="">
		<div id="login">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
				<div class="input_wrapper">
				<?php echo $this->Form->input('username', array('label' =>'Username','div'=>false)); ?>
				</div>
				<div class="input_wrapper">
				<?php echo $this->Form->input('password', array('label' => 'Password', 'type' => 'password','div'=>false)); ?>
				</div>
				<?php echo $this->Form->end(__('Log in', true)); ?>
				<?php //echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => __('Remember Me?', true))); ?>
				<?php echo $this->Html->link('Forgot your password?',array('admin'=>false,'controller'=>'users','action'=>'forgot'),array('class'=>'after'))?>
				<div class="clear"></div>
		</div>
	</div>
	<div id="sign_up_form_container" style="display:none">
		<div id="sign-up-form">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'signup'))); ?>
				<div class="input_wrapper">
				<?php echo $this->Form->input('username', array('label' =>'Username','div'=>false,'id'=>'SignupUserUsername')); ?>
				</div>
				<div class="input_wrapper">
				<?php echo $this->Form->input('email', array('label' => 'Email address','div'=>false,'id'=>'SignupUserEmail')); ?>
				</div>
				<div class="input_wrapper">
				<?php echo $this->Form->input('password', array('label' => 'Password', 'type' => 'password','div'=>false,'id'=>'SignupUserPassword')); ?>
				</div>
				<?php echo $this->Form->end(__('Sign up', true)); ?>
				<?php echo $this->Html->link('More options',array('admin'=>false,'controller'=>'users','action'=>'register'),array('class'=>'after'))?>
				<div class="clear"></div>
		</div>
	</div>
	<div class="mdash">&mdash;</div>
	<div id="site-feed">
		<div id="block_1">
			<h3><?php __('what\'s happening on the inside'); ?></h3>
			<?php
			echo $this->element('site-feed',array('cache'=>false,'limit'=>$limit,'feed'=>$feed,'num_items'=>$num_items));
			?>
		</div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
var signup = false;
var login = true;

$(document).ready(function(){
	$("label").inFieldLabels();

	//applyPositions();
	
	//$('container').height(resizeElementHeight($('container')));
	/*$( window ).resize(function() {
		applyPositions();
	});*/
	
	$("#sign-up-button").click(function(){
		signup = true;
		login = false;
		//applyPositions(150);
		if($("#sign_up_form_container").is(":hidden")){
			$("#sign_up_form_container").slideDown("slow",function(){
				$("#SignupUserUsername").focus();
				//$("#see-why").slideDown('slow');
				//document.location.replace("#signup", "signup");
			});
			$("#login_form_container").slideUp('slow');
		}else{
			$("#sign_up_form_container").slideDown("slow");
			$("#login_form_container").slideUp('slow',function(){
				$("#UserUsername").focus();
			});
		}
		$("#sign-up-button").hide();
		$("#log-in-button").show();
	});
	
	$("#log-in-button").click(function(){
		signup = false;
		login = true;
		//applyPositions(0);
		if($("#login_form_container").is(":hidden")){
			$("#sign_up_form_container").slideUp("slow");
			$("#login_form_container").slideDown('slow',function(){
				$("#UserUsername").focus();
				//$("#see-why").slideUp('slow');
				//document.location.replace("#login", "login");
			});
		}else{
			$("#sign_up_form_container").slideDown("slow",function(){
				$("#SignupUserUsername").focus();
			});
			$("#login_form_container").slideUp('slow');
		}
		$("#sign-up-button").show();
		$("#log-in-button").hide();
	});
	
	/*$("#see-why-title").click(function(){
		var winH = $(window).height();
		$("#inner-container").animate({top:-$("#inner-container").height()+'px'},100,'linear');
		var footerOffset = $("#footer").offset();
		var newContainerHeight = $("#sign_up_form_container").height() + $("#logo-container").height() + $("#footer").height();
		$('#container').animate({height:newContainerHeight},100,'linear');
		//applyPositions(500);
	});*/
});

//$(window).scroll(applyPositions).resize(applyPositions);


/*function applyPositions(offset){
	if(!offset) offset = 0;
	var winW = $(window).width();
	var winH = $(window).height() - offset;
	if($('#container').height() != winH){
		$('#container').animate({height:winH},100,'linear',function(){
			var containerHeight = $('#container').height();
			var containerOffset = $('#container').offset();
			var footerOffset = $('#footer').offset();
			var footerHeight = $("#footer").height();
			var footerPos = Math.round(containerHeight - (footerOffset.top + footerHeight));
			$('#footer').animate({top:Math.round(containerHeight-footerHeight)},100,'linear');
		});
	}
	
	//alert(footerPos);
	//alert(Math.round(containerHeight-footerHeight));
}*/

/*function resizeElementHeight(element) {
	var height = 0;
	var body = window.document.body;
	if (window.innerHeight) {
		height = window.innerHeight;
	} else if (body.parentElement.clientHeight) {
		height = body.parentElement.clientHeight;
	} else if (body && body.clientHeight) {
		height = body.clientHeight;
	}
	return ((height - element.offsetTop));
}*/
</script>