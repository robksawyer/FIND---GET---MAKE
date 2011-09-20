<?php
/* Comment Fixture generated on: 2011-09-20 03:12:00 : 1316488320 */
class CommentFixture extends CakeTestFixture {
	var $name = 'Comment';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'parent_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'model_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lft' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'approved' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'is_spam' => array('type' => 'string', 'null' => false, 'default' => 'clean', 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'slug' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'body' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'author_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'author_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'author_email' => array('type' => 'string', 'null' => false, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'language' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 6, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'comment_type' => array('type' => 'string', 'null' => false, 'default' => 'comment', 'length' => 32, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'rating' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => '4e780480-6594-491d-a61d-49888bbe252e',
			'parent_id' => 'Lorem ipsum dolor sit amet',
			'model_id' => 1,
			'user_id' => 'Lorem ipsum dolor sit amet',
			'lft' => 1,
			'rght' => 1,
			'model' => 'Lorem ipsum dolor sit amet',
			'approved' => 1,
			'is_spam' => 'Lorem ipsum dolor ',
			'title' => 'Lorem ipsum dolor sit amet',
			'slug' => 'Lorem ipsum dolor sit amet',
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'author_name' => 'Lorem ipsum dolor sit amet',
			'author_url' => 'Lorem ipsum dolor sit amet',
			'author_email' => 'Lorem ipsum dolor sit amet',
			'language' => 'Lore',
			'comment_type' => 'Lorem ipsum dolor sit amet',
			'rating' => 1,
			'created' => '2011-09-20 03:12:00',
			'modified' => '2011-09-20 03:12:00'
		),
	);
}
