<?php
/**
 * PersonaFixture
 *
 */
class PersonaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'tiposidentificacion_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 50, 'key' => 'index'),
		'identificacion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'apellido' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha de nacimiento' => array('type' => 'date', 'null' => false, 'default' => null),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'email' => array('column' => 'email', 'unique' => 1),
			'tiposidentificacion_id' => array('column' => 'tiposidentificacion_id', 'unique' => 0)
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
			'tiposidentificacion_id' => 1,
			'identificacion' => 'Lorem ipsum d',
			'nombre' => 'Lorem ipsum dolor ',
			'apellido' => 'Lorem ipsum dolor ',
			'fecha de nacimiento' => '2013-07-29',
			'email' => 'Lorem ipsum dolor sit amet'
		),
	);

}
