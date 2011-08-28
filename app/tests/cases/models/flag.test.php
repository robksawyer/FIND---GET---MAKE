<?php
/* Flag Test cases generated on: 2011-08-23 05:52:32 : 1314078752*/
App::import('Model', 'Flag');

class FlagTestCase extends CakeTestCase {
	var $fixtures = array('app.flag', 'app.user', 'app.collection', 'app.rating', 'app.feed', 'app.inspiration', 'app.country', 'app.client', 'app.house', 'app.attachment', 'app.attachment_tag', 'app.inspiration_photo_tag', 'app.product', 'app.product_category', 'app.source', 'app.source_category', 'app.attachments_source', 'app.contractor', 'app.contractor_specialty', 'app.attachments_contractor', 'app.contractors_source', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.inspirations_source', 'app.vote', 'app.ownership', 'app.collections_product', 'app.attachments_product', 'app.inspirations_product', 'app.ufo', 'app.attachments_house', 'app.attachments_client', 'app.attachments_inspiration', 'app.user_following');

	function startTest() {
		$this->Flag =& ClassRegistry::init('Flag');
	}

	function endTest() {
		unset($this->Flag);
		ClassRegistry::flush();
	}

}
