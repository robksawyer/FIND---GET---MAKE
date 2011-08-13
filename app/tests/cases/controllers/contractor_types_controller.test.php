<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* ContractorTypes Test cases generated on: 2011-07-07 23:22:06 : 1310106126*/
App::import('Controller', 'ContractorTypes');

class TestContractorTypesController extends ContractorTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContractorTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.contractor_type', 'app.contractor', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.contractors_attachment', 'app.houses_attachment', 'app.source', 'app.sources_attachment', 'app.sources_contractor', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.clients_attachment');

	function startTest() {
		$this->ContractorTypes =& new TestContractorTypesController();
		$this->ContractorTypes->constructClasses();
	}

	function endTest() {
		unset($this->ContractorTypes);
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
