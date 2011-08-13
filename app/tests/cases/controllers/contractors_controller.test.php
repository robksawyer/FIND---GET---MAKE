<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Contractors Test cases generated on: 2011-07-03 14:45:43 : 1309729543*/
App::import('Controller', 'Contractors');

class TestContractorsController extends ContractorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContractorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.contractor', 'app.country', 'app.tag', 'app.client', 'app.client_detail', 'app.house', 'app.image', 'app.houses_image', 'app.houses_tag', 'app.clients_image', 'app.clients_tag', 'app.contractors_tag', 'app.source', 'app.sources_contractor', 'app.sources_image', 'app.sources_tag');

	function startTest() {
		$this->Contractors =& new TestContractorsController();
		$this->Contractors->constructClasses();
	}

	function endTest() {
		unset($this->Contractors);
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
