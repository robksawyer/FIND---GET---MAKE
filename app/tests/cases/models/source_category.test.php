<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* SourceCategory Test cases generated on: 2011-07-10 01:55:24 : 1310288124*/
App::import('Model', 'SourceCategory');

class SourceCategoryTestCase extends CakeTestCase {
	var $fixtures = array('app.source_category', 'app.source', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.contractor', 'app.contractor_specialty', 'app.contractors_attachment', 'app.sources_contractor', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.houses_attachment', 'app.sources_attachment', 'app.clients_attachment', 'app.inspiration', 'app.inspirations_attachment', 'app.inspirations_source');

	function startTest() {
		$this->SourceCategory =& ClassRegistry::init('SourceCategory');
	}

	function endTest() {
		unset($this->SourceCategory);
		ClassRegistry::flush();
	}

}
