<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Object Test cases generated on: 2011-07-11 15:00:00 : 1310421600*/
App::import('Model', 'Object');

class ObjectTestCase extends CakeTestCase {
	function startTest() {
		$this->Object =& ClassRegistry::init('Object');
	}

	function endTest() {
		unset($this->Object);
		ClassRegistry::flush();
	}

}
