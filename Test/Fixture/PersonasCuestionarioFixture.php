<?php
/**
 * PersonasCuestionarioFixture
 *
 */
class PersonasCuestionarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'fecha realizacion' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'persona_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'cuestionario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'cuestionario_id' => array('column' => 'cuestionario_id', 'unique' => 0),
			'persona_id' => array('column' => 'persona_id', 'unique' => 0)
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
			'fecha realizacion' => '2013-07-18 18:16:06',
			'persona_id' => 1,
			'cuestionario_id' => 1
		),
	);

}
