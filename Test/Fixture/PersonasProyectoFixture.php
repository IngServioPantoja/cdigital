<?php
/**
 * PersonasProyectoFixture
 *
 */
class PersonasProyectoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'personas_proyecto';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'persona_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'documento_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'rol_id' => array('type' => 'integer', 'null' => false, 'default' => null),
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
			'persona_id' => 1,
			'documento_id' => 1,
			'rol_id' => 1
		),
	);

}
