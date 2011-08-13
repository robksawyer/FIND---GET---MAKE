<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Attachments Test cases generated on: 2011-07-05 15:53:50 : 1309906430*/
App::import('Controller', 'Attachments');

class TestAttachmentsController extends AttachmentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AttachmentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.attachment', 'app.contractor', 'app.country', 'app.contractors_attachment', 'app.source', 'app.sources_contractor', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.house', 'app.client', 'app.client_detail', 'app.houses_attachment', 'app.sources_attachment');

	function startTest() {
		$this->Attachments =& new TestAttachmentsController();
		$this->Attachments->constructClasses();
	}

	function endTest() {
		unset($this->Attachments);
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
