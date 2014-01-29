<?php
/**
 * ControleFixture
 *
 */
class ControleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null),
		'rol_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'estandar_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'fecha' => '2013-06-20',
			'rol_id' => 1,
			'estandar_id' => 1
		),
	);

}
