<?php
App::uses('ItemsEstandar', 'Model');

/**
 * ItemsEstandar Test Case
 *
 */
class ItemsEstandarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.items_estandar',
		'app.item',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
		'app.control',
		'app.rol',
		'app.entrega',
		'app.estado',
		'app.personas_proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.documento',
		'app.proyecto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemsEstandar = ClassRegistry::init('ItemsEstandar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemsEstandar);

		parent::tearDown();
	}

}
