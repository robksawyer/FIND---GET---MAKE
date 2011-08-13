<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Attachment Test cases generated on: 2011-07-04 11:34:52 : 1309804492*/
App::import('Model', 'Attachment');

class AttachmentTestCase extends CakeTestCase {
	var $fixtures = array('app.attachment', 'app.contractor', 'app.country', 'app.source', 'app.sources_contractor', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.contractors_attachment', 'app.house', 'app.client', 'app.client_detail', 'app.houses_attachment', 'app.sources_attachment');

	function startTest() {
		$this->Attachment =& ClassRegistry::init('Attachment');
	}

	function endTest() {
		unset($this->Attachment);
		ClassRegistry::flush();
	}

}
