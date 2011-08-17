<?php
/* UserFollowing Test cases generated on: 2011-08-14 02:09:10 : 1313287750*/
App::import('Model', 'UserFollowing');

class UserFollowingTestCase extends CakeTestCase {
	var $fixtures = array('app.user_following', 'app.user', 'app.collection', 'app.rating', 'app.product', 'app.product_category', 'app.source', 'app.source_category', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.attachment_tag', 'app.inspiration_photo_tag', 'app.inspiration', 'app.attachments_inspiration', 'app.inspirations_source', 'app.inspirations_product', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.ufo', 'app.contractor', 'app.contractor_specialty', 'app.attachments_contractor', 'app.contractors_source', 'app.attachments_house', 'app.attachments_source', 'app.attachments_client', 'app.attachments_product', 'app.vote', 'app.ownership', 'app.collections_product');

	function startTest() {
		$this->UserFollowing =& ClassRegistry::init('UserFollowing');
	}

	function endTest() {
		unset($this->UserFollowing);
		ClassRegistry::flush();
	}

}
