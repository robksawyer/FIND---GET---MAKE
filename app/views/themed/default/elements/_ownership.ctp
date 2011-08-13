<style type="text/css">
.ownership-form{position:relative;margin:0;padding:0 0 15px 0;width:400px;float:left;}
.ownership-form fieldset{padding:0;margin:0;border:none;}
.ownership-form form{padding:0;margin:0;}
.ownership-form form .checkbox{padding:0;margin:0;width:100px;display:block;float:left;}
.ok-button{display:block;cursor:pointer;padding:5px 10px !important;background-color:black;margin:0px;width:auto;float:left;}
.ok-button:hover{cursor:pointer;background-color:red;}
.ok-button a{text-decoration:none;color:#ffffff !important;}
.ok-button a:hover{color:#ffffff !important;text-decoration:none;}
.ownership-button-selected .ownership-form-button{display:block;float:left;cursor:pointer;padding:10px 15px;width:auto;clear:both;background-color:#777777;}
.ownership-button-selected .ownership-form-button:hover{cursor:pointer;background-color:red;}
.ownership-button-selected a{color:#ffffff;text-decoration:none;}
.ownership-button-selected a:hover{text-decoration:none;color:#ffffff;}
.ownership-button .ownership-form-button{display:block;float:left;cursor:pointer;padding:10px 15px;background-color:black;width:auto;clear:both;}
.ownership-button .ownership-form-button:hover{cursor:pointer;background-color:red;}
.ownership-button a{color:#ffffff;text-decoration:none;}
.ownership-button a:hover{text-decoration:none;color:#ffffff;}
.ownerships-section{position:relative;margin-top:25px;margin-left:0px;padding:0;}
.ownerships-section .ownership-item{}
#user-wants,
#user-hads,
#user-haves{}
#ownership-element{
	background: transparent;
	color:#333;
	display:block;
	font-family:arial,sans-serif;
	font-size:12px;
	font-style:normal;
	font-variant:normal;
	font-weight:normal;
	height:auto;
	line-height:16px;
	margin:10px auto;
	padding: 10px;
	clear: both;
	text-align:center;
}
#ownership-element a:hover{
	border: none !important;
}
#ownership-element .ownership-counts{
	list-style-type:none;
	text-decoration:none;
	background: red;
}
#ownership-element .ownership-counts li{
	border-right:1px solid #CCC;
	float:left;
	list-style:none;
	padding:0;
	width:60px;
	display:list-item;
	text-align: center;
}
#ownership-element .ownership-counts li:last-child{border-right:none;}
#ownership-element .ownership-counts li a{
	color:#333;
	display: block;
	clear: both;
	font-size:1.15em;
	font-weight:bold;
	padding-bottom:2px;
	text-decoration:none;
}
</style>
<?php
	if(empty($model)) $model = 'Product';
?>
<div id="ownership-element">
	<ul class="ownership-counts">
		<li>
			<a href="#user-haves" class="number users-have" title="See users who have this <?php echo strtolower($model); ?>">
				<span class="haveuser-count">0</span>
			</a>
			<a href="#user-haves" class="users-have" title="See users who have this <?php echo strtolower($model); ?>">have it</a>
		</li>
		<li>
			<a href="#user-wants" class="number users_want" title="See users who want this <?php echo strtolower($model); ?>">
				<span class="wantuser-count">0</span>
			</a>
			<a href="#user-wants" class="users_want" title="See users who want this <?php echo strtolower($model); ?>">want it</a>
		</li>
		<!--<li class="last">
			<a href="#user-hads" class="number bike_users_had" title="See users who had this bike">
				<span class="haduser-count">0</span>
			</a>
			<a href="#user-hads" class="bike_users_had" title="See users who had this bike">had it</a>
		</li>-->
	</ul>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<!-- OWNERSHIP FORM -->
<div class="ownership-form" id="ownership-form">
	<div class="ownership-button-selected">
		<a href="#" class="ownership-form-button" id="ownership-form-button" onclick="return false;">+ you had it</a>
	</div>
	<div class="clear"></div>
	<!-- TODO: Add in the have it, want it, had it ownership feature -->
	<div class="messagepop pop" style="display: none; ">
		<p class="close"><a href="javascript:void(0)" onclick="return false;" title="close">close</a></p> 
		<fieldset class="form-type">
			<p><strong>Add this to:</strong></p>
			<form id="OwnershipSetOwnershipForm" method="post" action="/ownerships/set_ownership" accept-charset="utf-8">
				<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
				<input type="radio" name="data[Ownership][ownership]" id="OwnershipOwnershipHaveIt" value="have_it">
				<label for="OwnershipOwnershipHaveIt">Have list</label>
				<input type="radio" name="data[Ownership][ownership]" id="OwnershipOwnershipWantIt" value="want_it">
				<label for="OwnershipOwnershipWantIt">Want list</label>
				<!--<input type="radio" name="data[Ownership][ownership]" id="OwnershipOwnershipHadIt" value="had_it" checked="checked">
				<label for="OwnershipOwnershipHadIt">Had list</label>-->
				<input type="hidden" name="data[<?php echo $model; ?>][id]" value="8" id="<?php echo $model; ?>Id">
				<div class="ownership-submit">
					<div class="submit">
					<input type="submit" value="Submit">
					</div>
				</div>
			</form>
		</fieldset>
		<fieldset class="return-type" style="display: none; "></fieldset>
		<div class="clear"></div>
	</div>
</div>
<!-- END OWNERSHIP FORM -->
<?php echo $this->Html->script('elements/ownership',array('inline'=>false)); ?>

<!--<div id="ownership-counts">
	<div id="user-haves" class="ownerships-section">
		<h3>Users who have this bike (<span class="haveuser-count">0</span>)</h3>
			</div>
	<div id="user-hads" class="ownerships-section">
		<h3>Users who had this bike (<span class="haduser-count">1</span>)</h3>
		<div class="ownership-item"><a href="/users/view/rob-sawyer">robksawyer</a></div>	</div>
	<div id="user-wants" class="ownerships-section">
		<h3>Users who want this bike (<span class="wantuser-count">1</span>)</h3>
		<div class="ownership-item"><a href="/users/view/mickey-slater">veryMickey</a></div>	</div>
</div>-->