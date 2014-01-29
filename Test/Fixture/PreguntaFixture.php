<?php
/**
 * PreguntaFixture
 *
 */
class PreguntaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'orden' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'key' => 'unique'),
		'titulo' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'tipospregunta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'cuestionario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'orden' => array('column' => 'orden', 'unique' => 1),
			'cuestionario_id' => array('column' => 'cuestionario_id', 'unique' => 0),
			'tipospregunta_id' => array('column' => 'tipospregunta_id', 'unique' => 0)
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
			'orden' => 1,
			'titulo' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'tipospregunta_id' => 1,
			'cuestionario_id' => 1
		),
	);

}
