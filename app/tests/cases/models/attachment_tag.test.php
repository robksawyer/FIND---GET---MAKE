<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* AttachmentTag Test cases generated on: 2011-07-16 16:08:27 : 1310857707*/
App::import('Model', 'AttachmentTag');

class AttachmentTagTestCase extends CakeTestCase {
	var $fixtures = array('app.attachment_tag', 'app.attachment', 'app.user', 'app.country', 'app.client', 'app.house', 'app.rating', 'app.houses_attachment', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.clients_attachment', 'app.contractor', 'app.contractor_specialty', 'app.contractors_attachment', 'app.source', 'app.source_category', 'app.product', 'app.product_category', 'app.collection', 'app.collections_product', 'app.products_attachment', 'app.inspiration', 'app.inspirations_attachment', 'app.inspirations_source', 'app.inspirations_product', 'app.sources_attachment', 'app.sources_contractor');

	function startTest() {
		$this->AttachmentTag =& ClassRegistry::init('AttachmentTag');
	}

	function endTest() {
		unset($this->AttachmentTag);
		ClassRegistry::flush();
	}

}
