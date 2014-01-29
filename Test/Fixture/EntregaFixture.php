<?php
/**
 * EntregaFixture
 *
 */
class EntregaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'fecha_entrega' => array('type' => 'date', 'null' => false, 'default' => null),
		'fecha_estado' => array('type' => 'date', 'null' => false, 'default' => null),
		'rol_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'documento_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'estado_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'documento_id' => array('column' => 'documento_id', 'unique' => 0)
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
			'fecha_entrega' => '2013-06-21',
			'fecha_estado' => '2013-06-21',
			'rol_id' => 1,
			'documento_id' => 1,
			'estado_id' => 1
		),
	);

}
