<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* InspirationPhotoTag Test cases generated on: 2011-07-17 01:01:43 : 1310889703*/
App::import('Model', 'InspirationPhotoTag');

class InspirationPhotoTagTestCase extends CakeTestCase {
	var $fixtures = array('app.inspiration_photo_tag', 'app.inspiration', 'app.user', 'app.country', 'app.client', 'app.house', 'app.rating', 'app.attachment', 'app.attachment_tag', 'app.contractor', 'app.contractor_specialty', 'app.contractors_attachment', 'app.source', 'app.source_category', 'app.product', 'app.product_category', 'app.collection', 'app.collections_product', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.products_attachment', 'app.inspirations_product', 'app.sources_attachment', 'app.sources_contractor', 'app.inspirations_source', 'app.houses_attachment', 'app.clients_attachment', 'app.inspirations_attachment');

	function startTest() {
		$this->InspirationPhotoTag =& ClassRegistry::init('InspirationPhotoTag');
	}

	function endTest() {
		unset($this->InspirationPhotoTag);
		ClassRegistry::flush();
	}

}
