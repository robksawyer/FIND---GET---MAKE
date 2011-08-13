<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* ContractorSpecialties Test cases generated on: 2011-07-07 23:29:26 : 1310106566*/
App::import('Controller', 'ContractorSpecialties');

class TestContractorSpecialtiesController extends ContractorSpecialtiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContractorSpecialtiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.contractor_specialty', 'app.contractor', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.contractors_attachment', 'app.houses_attachment', 'app.source', 'app.sources_attachment', 'app.sources_contractor', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.clients_attachment');

	function startTest() {
		$this->ContractorSpecialties =& new TestContractorSpecialtiesController();
		$this->ContractorSpecialties->constructClasses();
	}

	function endTest() {
		unset($this->ContractorSpecialties);
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
