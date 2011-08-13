<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Tag Test cases generated on: 2011-07-03 14:44:36 : 1309729476*/
App::import('Model', 'Tag');

class TagTestCase extends CakeTestCase {
	var $fixtures = array('app.tag', 'app.client', 'app.country', 'app.client_detail', 'app.house', 'app.image', 'app.houses_image', 'app.houses_tag', 'app.clients_image', 'app.clients_tag', 'app.contractor', 'app.contractors_tag', 'app.source', 'app.sources_contractor', 'app.sources_image', 'app.sources_tag');

	function startTest() {
		$this->Tag =& ClassRegistry::init('Tag');
	}

	function endTest() {
		unset($this->Tag);
		ClassRegistry::flush();
	}

}
