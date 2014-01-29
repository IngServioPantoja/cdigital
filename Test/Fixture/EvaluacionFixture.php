<?php
/**
 * EvaluacionFixture
 *
 */
class EvaluacionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'itemestandar_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'concepto_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'comentarios' => array('type' => 'integer', 'null' => false, 'default' => null),
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
			'itemestandar_id' => 1,
			'concepto_id' => 1,
			'comentarios' => 1
		),
	);

}
