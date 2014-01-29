<?php
/**
 * EstandarFixture
 *
 */
class EstandarFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 70, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'programa_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'tiposestandar_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'tiposestandar_id' => array('column' => 'tiposestandar_id', 'unique' => 0)
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
			'nombre' => 'Lorem ipsum dolor sit amet',
			'programa_id' => 1,
			'tiposestandar_id' => 1
		),
	);

}
