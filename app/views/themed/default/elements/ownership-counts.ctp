<?php 
	/**
	 * ownership-counts
	 * Returns a block that includes the number of haves, wants and hads
	 * @author Rob Sawyer
	 * @param $item The name of the Model (in lowercase form) that is using this element e.g, bike,part.
	 * @param $id The id of the item that ownership is being looked up on
	 * @return 
	 * 
	*/
if(Configure::read('FGM.ownerships') == 1):
	$haveuser_count = $this->requestAction('/ownerships/getHaveCount/'.$model.'/'.$model_id);
	//debug($haveuser_count);
	$wantuser_count = $this->requestAction('/ownerships/getWantCount/'.$model.'/'.$model_id);
	//debug($wantuser_count);
	
	//$haduser_count = $this->requestAction('/ownerships/getHadCount/'.$item.'/'.$id);
	//debug($haduser_count);
	
	echo $this->Html->css('elements/ownerships');
?>
<div id="ownership-element">
	<ul class="ownership-counts">
		<li>
			<?php 
				$title_have = '"See users who have this '.strtolower($model).'"'; 
				$title_want = '"See users who want this '.strtolower($model).'"'; 
				//$title_had = '"See users who had this '.strtolower($model).'"'; 
			?>
			<a href="#user-haves" class="number users-have" title=<?php echo $title_have; ?>>
				<span class="haveuser-count"><?php echo $haveuser_count; ?></span>
			</a>
			<a href="#user-haves" class="users-have" title=<?php echo $title_have; ?>>have it</a>
		</li>
		<li class="last">
			<a href="#user-wants" class="number users_want" title=<?php echo $title_want; ?>>
				<span class="wantuser-count"><?php echo $wantuser_count; ?></span>
			</a>
			<a href="#user-wants" class="users_want" title=<?php echo $title_want; ?>>want it</a>
		</li>
		<!--<li class="last">
			<a href="#user-hads" class="number users_had" title="See users who had this <?php //echo strlower($model); ?>">
				<span class="haduser-count"><?php //echo $haduser_count; ?></span>
			</a>
			<a href="#user-hads" class="users_had" title="See users who had this <?php //echo strlower($model); ?>">had it</a>
		</li>-->
		<div class="clear"></div>
	</ul>
</div>
<div class="clear"></div>
<?php
endif;
?>