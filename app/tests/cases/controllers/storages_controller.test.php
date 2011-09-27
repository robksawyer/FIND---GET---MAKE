<?php
/* Storages Test cases generated on: 2011-09-27 08:15:07 : 1317111307*/
App::import('Controller', 'Storages');

class TestStoragesController extends StoragesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StoragesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.storage', 'app.user', 'app.group', 'app.attachment', 'app.client', 'app.country', 'app.contractor', 'app.contractor_specialty', 'app.rating', 'app.source', 'app.source_category', 'app.product', 'app.product_category', 'app.inspiration_photo_tag', 'app.inspiration', 'app.feed', 'app.collection', 'app.flag', 'app.ufo', 'app.vote', 'app.staff_favorite', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.collections_product', 'app.ownership', 'app.user_following', 'app.inspirations_source', 'app.inspirations_product', 'app.contractors_source', 'app.house', 'app.attachment_tag', 'plugin.forum.topic', 'plugin.forum.forum_category', 'plugin.forum.forum', 'plugin.forum.access_level', 'plugin.forum.post', 'plugin.forum.moderator', 'plugin.forum.poll', 'plugin.forum.poll_option', 'plugin.forum.poll_vote', 'plugin.forum.access');

	function startTest() {
		$this->Storages =& new TestStoragesController();
		$this->Storages->constructClasses();
	}

	function endTest() {
		unset($this->Storages);
		ClassRegistry::flush();
	}

}
