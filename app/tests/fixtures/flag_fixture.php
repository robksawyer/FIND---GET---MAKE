<?php
/* Flag Fixture generated on: 2011-08-23 05:52:31 : 1314078751 */
class FlagFixture extends CakeTestFixture {
	var $name = 'Flag';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'model_id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'reason' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'rating' => array('column' => array('model_id', 'model', 'name'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 'Lorem ipsum dolor sit amet',
			'model_id' => 'Lorem ipsum dolor sit amet',
			'model' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'reason' => 1,
			'created' => '2011-08-23 05:52:31',
			'modified' => '2011-08-23 05:52:31'
		),
	);
}
