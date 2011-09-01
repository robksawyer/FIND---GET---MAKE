<?php
	$menu_items = array('account','password','notifications','profile','forum','applications');
?>
<ul class="settings-nav">
<?php
	foreach($menu_items as $item){
		if($this->params['action'] == $item) $active = 'active'; else $active = '';
		echo "<li>".$this->Html->link(__(strtoupper($item),true),array('controller'=>'settings','admin'=>false,'action'=>$item),array('class'=>$active))."</li>";
	}
?>
</ul>