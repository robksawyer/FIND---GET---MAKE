<?php
/* User Fixture generated on: 
Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/Los_Angeles' for 'PDT/-7.0/DST' instead in /Users/robsa/Documents/Dropbox/htdocs/sawyer_tapia/cake/console/templates/default/classes/fixture.ctp on line 24
2011-07-13 22:17:29 : 1310620649 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'remember_me' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 65, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'salutation' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 12, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'firstname' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'initials' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'lastname' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'suffix' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 12, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'birthday' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'about' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'country_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'postal_code' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 25),
		'active' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'last_login' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'slug' => array('column' => 'slug', 'unique' => 1), 'email' => array('column' => 'email', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'remember_me' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'salutation' => 'Lorem ipsu',
			'firstname' => 'Lorem ipsum dolor sit amet',
			'initials' => 'Lor',
			'lastname' => 'Lorem ipsum dolor sit amet',
			'suffix' => 'Lorem ipsu',
			'birthday' => '2011-07-13',
			'url' => 'Lorem ipsum dolor sit amet',
			'about' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'country_id' => 'Lorem ipsum dolor sit amet',
			'postal_code' => 1,
			'active' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'slug' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-07-13 22:17:29',
			'modified' => '2011-07-13 22:17:29',
			'last_login' => '2011-07-13 22:17:29'
		),
	);
}
