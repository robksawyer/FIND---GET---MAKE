<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Inspirations Test cases generated on: 2011-07-08 23:57:45 : 1310194665*/
App::import('Controller', 'Inspirations');

class TestInspirationsController extends InspirationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class InspirationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.inspiration', 'app.attachment', 'app.contractor', 'app.contractor_specialty', 'app.country', 'app.client', 'app.house', 'app.houses_attachment', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.clients_attachment', 'app.source', 'app.sources_attachment', 'app.sources_contractor', 'app.contractors_attachment', 'app.inspirations_attachment', 'app.inspirations_source');

	function startTest() {
		$this->Inspirations =& new TestInspirationsController();
		$this->Inspirations->constructClasses();
	}

	function endTest() {
		unset($this->Inspirations);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
