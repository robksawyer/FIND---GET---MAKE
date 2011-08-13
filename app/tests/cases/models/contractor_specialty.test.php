<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* ContractorSpecialty Test cases generated on: 2011-07-07 23:29:02 : 1310106542*/
App::import('Model', 'ContractorSpecialty');

class ContractorSpecialtyTestCase extends CakeTestCase {
	var $fixtures = array('app.contractor_specialty', 'app.contractor', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.contractors_attachment', 'app.houses_attachment', 'app.source', 'app.sources_attachment', 'app.sources_contractor', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.clients_attachment');

	function startTest() {
		$this->ContractorSpecialty =& ClassRegistry::init('ContractorSpecialty');
	}

	function endTest() {
		unset($this->ContractorSpecialty);
		ClassRegistry::flush();
	}

}
