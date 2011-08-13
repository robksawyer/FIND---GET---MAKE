<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Sources Test cases generated on: 2011-07-03 14:46:14 : 1309729574*/
App::import('Controller', 'Sources');

class TestSourcesController extends SourcesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SourcesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.source', 'app.contractor', 'app.country', 'app.tag', 'app.client', 'app.client_detail', 'app.house', 'app.image', 'app.houses_image', 'app.houses_tag', 'app.clients_image', 'app.clients_tag', 'app.contractors_tag', 'app.sources_tag', 'app.sources_contractor', 'app.sources_image');

	function startTest() {
		$this->Sources =& new TestSourcesController();
		$this->Sources->constructClasses();
	}

	function endTest() {
		unset($this->Sources);
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
