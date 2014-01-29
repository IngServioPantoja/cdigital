<?php
/**
 * UsuariorespuestaFixture
 *
 */
class UsuariorespuestaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'personas_cuestionario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'pregunta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'respuesta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'personas_cuestionario_id' => array('column' => 'personas_cuestionario_id', 'unique' => 0),
			'pregunta_id' => array('column' => 'pregunta_id', 'unique' => 0),
			'respuesta_id' => array('column' => 'respuesta_id', 'unique' => 0)
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
			'personas_cuestionario_id' => 1,
			'pregunta_id' => 1,
			'respuesta_id' => 1
		),
	);

}
