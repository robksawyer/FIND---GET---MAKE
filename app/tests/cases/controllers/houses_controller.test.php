<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Houses Test cases generated on: 2011-07-03 14:45:30 : 1309729530*/
App::import('Controller', 'Houses');

class TestHousesController extends HousesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class HousesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.house', 'app.client', 'app.country', 'app.client_detail', 'app.image', 'app.clients_image', 'app.tag', 'app.clients_tag', 'app.contractor', 'app.contractors_tag', 'app.source', 'app.sources_contractor', 'app.sources_image', 'app.sources_tag', 'app.houses_tag', 'app.houses_image');

	function startTest() {
		$this->Houses =& new TestHousesController();
		$this->Houses->constructClasses();
	}

	function endTest() {
		unset($this->Houses);
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
