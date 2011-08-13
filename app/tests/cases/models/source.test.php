<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Source Test cases generated on: 2011-07-04 11:38:17 : 1309804697*/
App::import('Model', 'Source');

class SourceTestCase extends CakeTestCase {
	var $fixtures = array('app.source', 'app.country', 'app.attachment', 'app.contractor', 'app.contractors_attachment', 'app.sources_contractor', 'app.house', 'app.client', 'app.client_detail', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.houses_attachment', 'app.sources_attachment');

	function startTest() {
		$this->Source =& ClassRegistry::init('Source');
	}

	function endTest() {
		unset($this->Source);
		ClassRegistry::flush();
	}

	function testFindByTag() {

	}

}
