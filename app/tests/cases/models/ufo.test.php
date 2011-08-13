<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/test.ctp on line 22
/* Ufo Test cases generated on: 2011-07-17 22:07:10 : 1310965630*/
App::import('Model', 'Ufo');

class UfoTestCase extends CakeTestCase {
	var $fixtures = array('app.ufo', 'app.attachment', 'app.user', 'app.country', 'app.client', 'app.house', 'app.rating', 'app.attachments_house', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.attachments_client', 'app.contractor', 'app.contractor_specialty', 'app.attachments_contractor', 'app.source', 'app.source_category', 'app.product', 'app.product_category', 'app.collection', 'app.collections_product', 'app.attachments_product', 'app.inspiration', 'app.inspiration_photo_tag', 'app.attachments_inspiration', 'app.inspirations_source', 'app.inspirations_product', 'app.attachments_source', 'app.contractors_source', 'app.attachment_tag');

	function startTest() {
		$this->Ufo =& ClassRegistry::init('Ufo');
	}

	function endTest() {
		unset($this->Ufo);
		ClassRegistry::flush();
	}

}
