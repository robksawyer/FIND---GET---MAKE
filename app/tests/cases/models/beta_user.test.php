<?php
/* BetaUser Test cases generated on: 2011-08-19 01:47:32 : 1313718452*/
App::import('Model', 'BetaUser');

class BetaUserTestCase extends CakeTestCase {
	var $fixtures = array('app.beta_user');

	function startTest() {
		$this->BetaUser =& ClassRegistry::init('BetaUser');
	}

	function endTest() {
		unset($this->BetaUser);
		ClassRegistry::flush();
	}

}
