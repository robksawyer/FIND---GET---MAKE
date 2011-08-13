<style type="text/css">
/** LIKE & DISLIKE **/
#vote_block{
	clear:both;
	width: 175px;
	color:#333;
	text-align:left;
	font-family:arial,sans-serif;
	font-size:12px;
	font-style:normal;
	font-variant:normal;
	font-weight:normal;
	line-height:16px;
	margin:0;
	padding:0;
}
#vote_block a:hover{
	border: none !important;
}
#like_dislike .voteblock{margin-bottom:8px;}
#like_dislike ul,
#like_dislike menu,
#like_dislike dir{
	list-style-type:none;
}
#like_dislike .number,
#popularity_rating .number{
	float:left;
	background:whiteSmoke;
	height:16px;
	width:90px;
	font-size:12px;
	border-right: 2px solid #fff;
	color:#333;
	line-height:16px;
	padding: 5px;
}

#like_dislike li:first-child,
#popularity_rating li:first-child{
	border-bottom: 1px solid #fff;
}

#like_dislike li,
#popularity_rating li{
	float:left;
	font-size:12px;
	list-style:none;
	text-align: left;
}
#like_dislike .action a.liked,
#like_dislike .action a.disliked{ background-color:#999;}
#like_dislike .action a.like,
#like_dislike .action a.dislike,
#like_dislike .action a.liked,
#like_dislike .action a.disliked{
	background: black url('/img/icons/thumbs-up-down.png') no-repeat 6px 7px;
}
#like_dislike .action a.dislike,
#like_dislike .action a.disliked{background-position:6px -19px;}
#like_dislike .action a{
	color:white;
	display:block;
	font-weight:bold;
	padding:5px 0px 5px 23px;
	width:50px;
	text-decoration:none;
}
#like_dislike .action a.like:hover,
#like_dislike .action a.dislike:hover{background-color:#C00;}
#like_dislike .action a.liked, #like_dislike .action a.disliked{ background-color: #999;}
/** END LIKE & DISLIKE **/
</style>
<?php
	if(empty($model)) $model = 'Product';
?>
<div id="vote_block" class="voteblock votedirup">
	<ul id="like_dislike">
		<li class="upvote_amt_block number"><span class="vote-val-like">2</span>&nbsp;<a href="javascript:void(0);" onclick="return false;" class="users-like" title="See users who like this <?php echo strtolower($model);?>">like it</a></li>
		<li class="logged-out action"><a href="#" onclick="$('#popup_0').show(); return false;" class="btn auth vote dup like" title="like">like</a></li>
		<div class="clear"></div>
		<li class="downvote_amt_block number"><span class="vote-val-dislike">0</span>&nbsp;<a href="javascript:void(0);" onclick="return false;" class="users-dislike" title="See users who dislike this <?php echo strtolower($model);?>">dislike it</a></li>
		<li class="logged-out action"><a href="#" onclick="$('#popup_1').show(); return false;" class="btn auth vote dup dislike" title="dislike">dislike</a></li>
	</ul>
	<div class="clear"></div>
</div>
<div id="ajax-status"></div>
<div class="clear"></div>
<?php echo $this->Html->script('elements/like-dislike',array('inline'=>false)); ?>