<?php
/**
* @package database installation file for Like Dislike
* @version 2.0.5
* @author rebirthtobi (Tobi Taiwo) (http://github.com/rebirthtobi)
* @copyright Copyright (c) 2014, Tobi Taiwo
* @license https://www.gnu.org/licenses/gpl-3.0.html
*
**/

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');

elseif (!defined('SMF'))
	exit('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');

global $smcFunc, $db_prefix, $sourcedir;

if (!array_key_exists('db_add_column', $smcFunc))
	db_extend('packages');

// Table structure for like posts
db_extend('packages');

$smcFunc['db_add_column']('{db_prefix}messages',
    array(
        'name' => 'likes',
        'type' => 'int',
        'size' => 10,
        'null' => false,
        'default' => '0',
    )
);
$smcFunc['db_add_column']('{db_prefix}messages',
    array(
        'name' => 'dislikes',
        'type' => 'int',
        'size' => 10,
        'null' => false,
        'default' => '0',
    )
);
$tables = array(
	'like_dislike' => array (
		'columns' => array (
			array(
				'name' => 'id_like',
				'type' => 'int',
				'size' => 10,
				'unsigned' => true,
				'auto' => true,
			),
            array(
                'name' => 'id_topic',
                'type' => 'int',
                'size' => 10,
                'unsigned' => true,
                'default' => '0',
            ),
            array(
                'name' => 'id_status',
                'type' => 'tinyint',
                'size' => 2,
                'comment' => 'true or 1 for like, false or 0 for dislike',
            ),
			array(
				'name' => 'id_msg',
				'type' => 'int',
				'size' => 10,
				'unsigned' => true,
				'default' => '0',
			),
			array(
				'name' => 'id_member_gave',
				'type' => 'mediumint',
				'size' => 8,
				'unsigned' => true,
				'default' => '0',
			),
			array(
				'name' => 'liked_timestamp',
				'type' => 'int',
				'size' => 10,
				'unsigned' => true,
				'default' => '0',
			),
		),
		'indexes' => array(
			array(
				'type' => 'primary',
				'columns' => array('id_like', 'id_msg', 'id_topic'),
			),
		),
	),
);

// create the tables if not created
foreach ($tables as $table => $data) {
	$smcFunc['db_create_table']('{db_prefix}' . $table, $data['columns'], $data['indexes']);
}

if (SMF == 'SSI')
echo 'Database adaptation successful!';

?>
