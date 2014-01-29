<?php
/**
 * MenusNivelFixture
 *
 */
class MenusNivelFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'menu_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'nivel_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'estado' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'menu_id' => array('column' => 'menu_id', 'unique' => 0),
			'nivel_id' => array('column' => 'nivel_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
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
