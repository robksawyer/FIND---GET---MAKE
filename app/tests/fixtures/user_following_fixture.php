<?php
/* UserFollowing Fixture generated on: 2011-08-14 02:09:10 : 1313287750 */
class UserFollowingFixture extends CakeTestFixture {
	var $name = 'UserFollowing';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'comment' => 'The user ID of the person doing the following.'),
		'follow_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'comment' => 'The user ID of the person being followed'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'follow_user_id' => 1,
			'created' => '2011-08-14 02:09:10',
			'modified' => '2011-08-14 02:09:10'
		),
	);
}
