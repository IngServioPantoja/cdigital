<?php
/**
 * MenusNiveleFixture
 *
 */
class MenusNiveleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'menu_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'nivel_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'estado' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'menu_id' => 1,
			'nivel_id' => 1,
			'estado' => 1
		),
	);

}
