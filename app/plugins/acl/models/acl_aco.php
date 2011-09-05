<?php

/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

class AclAco extends AclAppModel {
	var $useTable = 'acos';
	var $actsAs = array('Tree');
	
	function getStringPath($id) {
		$pieces = $this->getPath($id);
		$path = array();
		foreach ($pieces as $p) {
			if ( !empty($p['AclAco']['alias']) ) {
				$path[] = $p['AclAco']['alias'];
			} else {
				$path[] = $p['AclAco']['model'] . ' - ' . $p['AclAco']['foreign_key'];
			}
		}
		$path = implode(' > ', $path);
		return $path;
	}
	
}

?>
