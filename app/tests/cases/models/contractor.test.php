<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Contractor Test cases generated on: 2011-07-04 11:37:12 : 1309804632*/
App::import('Model', 'Contractor');

class ContractorTestCase extends CakeTestCase {
	var $fixtures = array('app.contractor', 'app.country', 'app.attachment', 'app.contractors_attachment', 'app.house', 'app.client', 'app.client_detail', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.houses_attachment', 'app.source', 'app.sources_contractor', 'app.sources_attachment');

	function startTest() {
		$this->Contractor =& ClassRegistry::init('Contractor');
	}

	function endTest() {
		unset($this->Contractor);
		ClassRegistry::flush();
	}

}
