<?php
/* Feed Test cases generated on: 2011-08-15 13:54:50 : 1313416490*/
App::import('Model', 'Feed');

class FeedTestCase extends CakeTestCase {
	var $fixtures = array('app.feed', 'app.user', 'app.collection', 'app.rating', 'app.product', 'app.product_category', 'app.source', 'app.source_category', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.attachment_tag', 'app.inspiration_photo_tag', 'app.inspiration', 'app.attachments_inspiration', 'app.inspirations_source', 'app.inspirations_product', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.ufo', 'app.contractor', 'app.contractor_specialty', 'app.attachments_contractor', 'app.contractors_source', 'app.attachments_house', 'app.attachments_source', 'app.attachments_client', 'app.attachments_product', 'app.vote', 'app.ownership', 'app.collections_product', 'app.user_following');

	function startTest() {
		$this->Feed =& ClassRegistry::init('Feed');
	}

	function endTest() {
		unset($this->Feed);
		ClassRegistry::flush();
	}

}
