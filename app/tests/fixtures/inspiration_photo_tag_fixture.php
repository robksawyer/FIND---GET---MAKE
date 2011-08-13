<?php
/* InspirationPhotoTag Fixture generated on: 
Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/fixture.ctp on line 24
2011-07-17 01:01:43 : 1310889703 */
class InspirationPhotoTagFixture extends CakeTestFixture {
	var $name = 'InspirationPhotoTag';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 255, 'key' => 'primary'),
		'inspiration_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'x1' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'y1' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'x2' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'y2' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'width' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'height' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'inspiration_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'x1' => 1,
			'y1' => 1,
			'x2' => 1,
			'y2' => 1,
			'width' => 1,
			'height' => 1
		),
	);
}
