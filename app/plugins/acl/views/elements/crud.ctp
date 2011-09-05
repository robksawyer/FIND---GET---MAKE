<?php
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

foreach(array_keys($aro_aco) as $key) {
	if (substr($key,0,1) == '_') {
		$nice = substr($key,1);
		$checked = $aro_aco[$key] == 1 ? 'checked=checked' : '';
		echo '<span>';
		echo '<label for="crud' . $key . '">' . $nice . '</label>';
		echo '<input type="checkbox" id="crud' . $key . '" name="crud' . $key . '" ' . $checked .' />'; 
		echo '</span>';
	}
}

?>
