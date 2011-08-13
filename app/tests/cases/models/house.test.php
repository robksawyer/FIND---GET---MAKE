<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* House Test cases generated on: 2011-07-04 11:39:14 : 1309804754*/
App::import('Model', 'House');

class HouseTestCase extends CakeTestCase {
	var $fixtures = array('app.house', 'app.client', 'app.country', 'app.client_detail', 'plugin.tags.tag', 'plugin.tags.tagged');

	function startTest() {
		$this->House =& ClassRegistry::init('House');
	}

	function endTest() {
		unset($this->House);
		ClassRegistry::flush();
	}

}
