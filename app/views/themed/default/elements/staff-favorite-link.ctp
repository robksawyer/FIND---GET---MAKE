<?php 
	if(empty($staff_favorite)){
		echo $this->Js->link('Staff favorite',array(
																'plugin'=>'',
																'admin'=>false,
																'controller'=>'staff_favorites',
																'action'=>'add',$model,$item[$model]['id']
															),
															array(
																'class'=>'staff-favorite',
																'id'=>'staff-fav-'.$model.'-'.$item[$model]['id'],
																'title'=>'Add this item to the staff favorites.',
																'beforeSend'=>'showStaffFavoriteLoader("'.$model.'-'.$item[$model]['id'].'");',
																'success'=>'updateStaffFavoriteLink(data);'
															));
?>
		<div id="ajax-status-<?php echo $model.'-'.$item[$model]['id']; ?>" style="display:none" class="ajax-status-small"><?php echo $this->Html->image('ajax-loader.gif',array('Loading...')); ?></div>
<?php
	}else{
		echo '<span class="staff-favorite" style="text-decoration: line-through;" title="You\'ve already added this item to the staff favorites.">Staff favorite</span>';
	}
	echo $this->Html->script('elements/staff-favorites');
?>