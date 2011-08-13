<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Client Test cases generated on: 2011-07-04 11:36:18 : 1309804578*/
App::import('Model', 'Client');

class ClientTestCase extends CakeTestCase {
	var $fixtures = array('app.client', 'app.country', 'app.client_detail', 'app.house', 'plugin.tags.tag', 'plugin.tags.tagged');

	function startTest() {
		$this->Client =& ClassRegistry::init('Client');
	}

	function endTest() {
		unset($this->Client);
		ClassRegistry::flush();
	}

}
