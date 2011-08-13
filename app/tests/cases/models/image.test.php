<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Image Test cases generated on: 2011-07-03 16:57:07 : 1309737427*/
App::import('Model', 'Image');

class ImageTestCase extends CakeTestCase {
	var $fixtures = array('app.image', 'app.client', 'app.country', 'app.client_detail', 'app.house', 'app.houses_image', 'app.tag', 'app.tagged', 'app.clients_tag', 'app.contractor', 'app.contractors_tag', 'app.source', 'app.sources_contractor', 'app.sources_image', 'app.sources_tag', 'app.houses_tag', 'app.clients_image');

	function startTest() {
		$this->Image =& ClassRegistry::init('Image');
	}

	function endTest() {
		unset($this->Image);
		ClassRegistry::flush();
	}

}
