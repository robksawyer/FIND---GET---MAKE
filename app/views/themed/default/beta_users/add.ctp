<style type="text/css">
.wrapper{
	position: relative; 
	display: block;
	margin: 20px auto;
	width: 550px !important;
	height: 250px;
	background: #262626;
}
.app-name {
	width: auto;
	text-align: center;
}

.betaUsers{
	position: relative; 
	margin: 25px auto;
	padding: 20px;
}

.betaUsers label{
	color: #999999;
}
.betaUsers .input{
	font-size: 11px;
	font-style: italic;
	width: 80%;
	float: left;
	padding: 20px 0 20px 20px;
	margin-right: 10px;
}
input {
	color: #999999;
}
form div.submit{
	clear: none;
	float: left;
}
.submit{
	position: relative;
	top: 25px;
	display: block;
	clear: none;
}
</style>
<div class="wrapper">
	<div class="betaUsers form">
		<div class="app-name"><?php echo $this->Html->image('/img/logo.png',array('alt'=>'FIND | GET | MAKE','url'=>'/','title'=>'FIND | GET | MAKE')); ?></div>
	<?php echo $this->Form->create('BetaUser');?>
		<?php
			echo $this->Form->input('email',array('label'=>'Launching soon. Enter your email address to join our invite list:','value'=>'email@address.com'));
			echo $this->Form->end(__('Go', true));
		?>
	</div>
	<div class="clear"></div>
</div>
<?php
	echo $this->Html->script('jquery.corner',array('inline'=>false));
?>
<script type="text/javascript">
$('.wrapper').corner("5px");
$('#BetaUserEmail').focus(function(){
	$(this).css('color','#000000').val('');
});

$('#BetaUserEmail').blur(function(){
	if($(this).val() == ''){
		$(this).val('email@address.com').css('color','#999999');
	}
});
</script>