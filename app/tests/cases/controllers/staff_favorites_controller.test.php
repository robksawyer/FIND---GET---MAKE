<?php
/* StaffFavorites Test cases generated on: 2011-09-05 11:11:30 : 1315221090*/
App::import('Controller', 'StaffFavorites');

class TestStaffFavoritesController extends StaffFavoritesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StaffFavoritesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.staff_favorite', 'app.user', 'app.group', 'app.collection', 'app.rating', 'app.feed', 'app.inspiration', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.attachment_tag', 'app.inspiration_photo_tag', 'app.product', 'app.product_category', 'app.source', 'app.source_category', 'app.vote', 'app.ufo', 'app.flag', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.attachments_source', 'app.contractor', 'app.contractor_specialty', 'app.attachments_contractor', 'app.contractors_source', 'app.inspirations_source', 'app.ownership', 'app.collections_product', 'app.attachments_product', 'app.inspirations_product', 'app.attachments_house', 'app.attachments_client', 'app.attachments_inspiration', 'app.user_following', 'plugin.forum.topic', 'plugin.forum.forum_category', 'plugin.forum.forum', 'plugin.forum.access_level', 'plugin.forum.post', 'plugin.forum.moderator', 'plugin.forum.poll', 'plugin.forum.poll_option', 'plugin.forum.poll_vote', 'plugin.forum.access');

	function startTest() {
		$this->StaffFavorites =& new TestStaffFavoritesController();
		$this->StaffFavorites->constructClasses();
	}

	function endTest() {
		unset($this->StaffFavorites);
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
