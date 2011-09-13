<style type="text/css">

#container{
	position: relative;
	display: block;
	box-shadow: -5px 12px 5px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: -5px 12px 5px rgba(0, 0, 0, 0.5);
	-webkit-box-shadow: -5px 12px 5px rgba(0, 0, 0, 0.5);
	z-index: 3;
}


#container a.top-button{
	background: #000000;
	padding: 10px 15px;
	color: #ffffff;
	border: 1px solid #999999;
	float: right;
	margin: 10px;
	text-decoration: none;
}

#container a.top-button:hover{
	border-color: #ef3f23;
}

#inner-container{
	position: relative;
	margin-top: 125px;
}

#inner-container #login_form_container{
	width: 575px;
	margin: 0 auto;
	background: none;
}

#inner-container #sign_up_form_container{
	width: 850px;
	margin: 0 auto;
	background: none;
}

#inner-container form{
	text-align: left;
	width: auto;
	margin: 0 auto;
}

#inner-container form .input_wrapper{
	/*background: url(https://secure.assets.tumblr.com/images/register_login/input.png) no-repeat 0px 11px;*/
	position: relative;
	border-width: 0px;
	float: left;
	width: 219px;
	margin: 0 20px 0 0;
	clear: none;
}

#inner-container form .input_wrapper label{
	position: absolute;
	color: #d5d5d5;
	font-size: 20px;
	top: 0px;
	left: 0px;
	line-height: 40px;
	margin: 5px 0 0 14px;
	padding: 0;
	width: 176px;
	z-index: 1;
	font-weight: normal;
	text-align: left;
	display: inline;
}

#inner-container form .input_wrapper input{
	display: inline;
	clear: none;
	font-size: 20px;
	color: #000000;
	padding: 5px;
	z-index: 20;
	float: left;
}

#inner-container .submit{
	display: block;
	position: relative;
	margin-top: 5px;
	float: left;
	clear: none;
	vertical-align: middle;
	border: 1px solid #e7e7e7;
	background: #000000;
}
#inner-container .submit:hover{
	opacity:0.75;
	filter:alpha(opacity=75); /* For IE8 and earlier */
	border-color: #ef3f23;
}

#inner-container .submit input[type="submit"]{
	padding: 5px;
	border-radius: 0px;
	-moz-border-radius: 0px;
	background: none;
}

#inner-container a.after{
	position: relative;
	clear: both;
	display: block;
	text-align: left;
	padding: 0 0 0 8px;
	color: #ffffff;
	width: auto;
	float: left;
}

#outer-container{
	padding-bottom: 75px;
}

#outer-container #see-why{
	position:relative;
	width: 1024px;
	margin: 0 auto;
}

#outer-container #see-why ul{
	position:relative;
	background: #ffffff;
	-moz-border-radius: 15px;
	border-radius: 15px;
	-webkit-border-radius: 15px;
	color: #000000;
	padding: 25px;
	margin: 0 auto;
	text-align: center;
}

#outer-container #see-why ul li{
	position: relative;
	background: none;
	border: none;
	width: 400px;
	display: inline-block;
	clear: none;
	text-align: left;
}

#outer-container #see-why ul li.border{
	padding-right: 10px;
	padding-left: 10px;
	border-right: 1px solid #e7e7e7;
	border-left: 1px solid #e7e7e7;
	background: none;
}

#outer-container #see-why #see-why-title{
	position: relative;
	margin: 0 0 75px 0;
	font-size: 48px;
	text-shadow: 1px 1px #999999;
	color: #ffffff;
	padding: 25px 0 25px 0;
	cursor: pointer;
}


#footer{
	position: absolute;
	width: 100%;
	height: 25px;
	background: none;
	padding: 0;
	margin: 0 auto;
}

#footer a:link,
#footer a:visited,
#footer a:active{
	background: none;
	color: #C7CED6;
	font-family: 'Lucida Grande', Arial;
	text-shadow: #999999 0px -1px -1px;
}
</style>
<div id="link-button">
	<?php 
		echo $this->Html->link('Sign up','#signup',array('class'=>'top-button','id'=>'sign-up-button'));
		echo $this->Html->link('Log in','#login',array('class'=>'top-button','id'=>'log-in-button','style'=>'display:none')); 
	?>
</div>
<div id="inner-container" class="home">
	<div id="logo-container">
		<div class="app-name"><?php echo $this->Html->image('/img/logo.png',array('alt'=>'FIND | GET | MAKE','url'=>'/','style'=>'position: relative; float: none; margin: 0px 0px 2px 0px; padding: 0px;','title'=>'FIND | GET | MAKE')); ?></div>
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
</div>
<div class="clear"></div>
<?php echo $this->Html->script('jquery.infieldlabel.min'); ?>
<script type="text/javascript">
var signup = false;
var login = true;

$(document).ready(function(){
	$("label").inFieldLabels();

	applyPositions();
	
	//$('container').height(resizeElementHeight($('container')));
	/*$( window ).resize(function() {
		applyPositions();
	});*/
	
	$("#sign-up-button").click(function(){
		signup = true;
		login = false;
		applyPositions(150);
		if($("#sign_up_form_container").is(":hidden")){
			$("#sign_up_form_container").slideDown("slow",function(){
				$("#SignupUserUsername").focus();
				$("#see-why").slideDown('slow');
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
		applyPositions(0);
		if($("#login_form_container").is(":hidden")){
			$("#sign_up_form_container").slideUp("slow");
			$("#login_form_container").slideDown('slow',function(){
				$("#UserUsername").focus();
				$("#see-why").slideUp('slow');
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

// Window load event used just in case window height is dependant upon images
/*$(window).bind("load", function() { 
	var footerHeight = 0, footerTop = 0, $footer = $("#footer");
	//positionFooter();
	
	function positionFooter() {
		footerHeight = $footer.height();
		footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";
		//$("#footer").css('top',footerTop);
		//alert($(document.body).height()+footerHeight +" < "+ $(window).height());
		if (($(document.body).height()+footerHeight) < $(window).height()) {
			$footer.css({
				  position: "absolute"
			}).animate({
				  top: footerTop
			})
		} else {
			$footer.css({
				  position: "static"
			})
		}
	}
	
	$(window).scroll(positionFooter).resize(positionFooter);
});*/

$(window).scroll(applyPositions).resize(applyPositions);


function applyPositions(offset){
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
}

function resizeElementHeight(element) {
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
}
</script>