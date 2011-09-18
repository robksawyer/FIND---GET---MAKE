<?php
	if(empty($height)){ $height = 32; }
	//If the avatar isn't passed along, try to get it.
	if(empty($avatar)) $avatar = $this->requestAction('/users/getAvatar/'.$user['User']['id']);
?>
<?php
if(empty($avatar['Attachment']['path_small'])){
	// Gravatar
	if ($this->Cupcake->settings['enable_gravatar'] == 1) {
		if ($avatar = $this->Cupcake->gravatar($user['User']['email'])) {
			echo "<div style='position: relative;margin-right:5px;vertical-align: baseline;padding: 0 5px 0 0;float: left;'>";
			//$absoluteImgPath = Router::url($avatar,true);
			echo $this->Html->link($avatar,Router::url(array('ajax'=>false,
																			'admin'=>false,
																			'plugin'=>'',
																			'controller'=>'users',
																			'action'=>'profile',$user['User']['username']),true),
																		array(
																			'title'=>$user['User']['username'],
																			'escape'=>false
																		));
			echo "</div>";
		}else{
			echo "<div style='position: relative;margin-right:5px;vertical-align: baseline;padding: 0 5px 0 0;float: left;'>";
			$absoluteImgPath = Router::url('/theme/default/img/no_gravatar.jpg',true);
			echo $this->Html->image($absoluteImgPath,array(
																		'url'=>Router::url(array('ajax'=>false,'admin'=>false,'plugin'=>'','controller'=>'users',
																							'action'=>'profile',$user['User']['username']),true),
																		'title'=>$user['User']['username'],
																		'height'=>$height,
																		'style'=>'width: auto;vertical-align: baseline;display: inline-block;'
																	));
			echo "</div>";
		} 
	}
}else{
	//Show the local avatar
	echo "<div style='position: relative;margin-right:5px;vertical-align: baseline;padding: 0 5px 0 0;float: left;'>";
	$absoluteImgPath = Router::url($avatar['Attachment']['path_small'],true);
	echo $this->Html->image($absoluteImgPath,array(
																		'alt'=>'Avatar image',
																		'url'=>Router::url(array(
																									'ajax'=>false,
																									'admin'=>false,
																									'plugin'=>'',
																									'controller'=>'users',
																									'action'=>'profile',
																									$user['User']['username']
																							),true),
																		'title'=>$user['User']['username'],
																		'height'=>$height,
																		'style'=>'width: auto;vertical-align: baseline;display: inline-block;'
																		));
	echo "</div>";
}
?>