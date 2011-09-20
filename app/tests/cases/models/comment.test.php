<?php
/* Comment Test cases generated on: 2011-09-20 03:12:00 : 1316488320*/
App::import('Model', 'Comment');

class CommentTestCase extends CakeTestCase {
	var $fixtures = array('app.comment', 'app.user', 'app.group', 'app.collection', 'app.rating', 'app.feed', 'app.inspiration', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.attachment_tag', 'app.inspiration_photo_tag', 'app.product', 'app.product_category', 'app.source', 'app.source_category', 'app.vote', 'app.ufo', 'app.flag', 'app.staff_favorite', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.attachments_source', 'app.contractor', 'app.contractor_specialty', 'app.attachments_contractor', 'app.contractors_source', 'app.inspirations_source', 'app.ownership', 'app.collections_product', 'app.attachments_product', 'app.inspirations_product', 'app.attachments_house', 'app.attachments_client', 'app.attachments_inspiration', 'app.user_following', 'plugin.forum.topic', 'plugin.forum.forum_category', 'plugin.forum.forum', 'plugin.forum.access_level', 'plugin.forum.post', 'plugin.forum.moderator', 'plugin.forum.poll', 'plugin.forum.poll_option', 'plugin.forum.poll_vote', 'plugin.forum.access');

	function startTest() {
		$this->Comment =& ClassRegistry::init('Comment');
	}

	function endTest() {
		unset($this->Comment);
		ClassRegistry::flush();
	}

}
