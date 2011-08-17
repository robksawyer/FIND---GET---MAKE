<?php
/* Feed Fixture generated on: 2011-08-15 13:54:49 : 1313416489 */
class FeedFixture extends CakeTestFixture {
	var $name = 'Feed';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'model_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 100),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'model_id' => 1,
			'model' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-08-15 13:54:49',
			'modified' => '2011-08-15 13:54:49'
		),
	);
}
