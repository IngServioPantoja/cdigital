<?php
App::uses('Tiposestandar', 'Model');

/**
 * Tiposestandar Test Case
 *
 */
class TiposestandarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tiposestandar',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.control',
		'app.rol',
		'app.entrega',
		'app.estado',
		'app.personas_proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.documento',
		'app.proyecto',
		'app.item',
		'app.items_estandar'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tiposestandar = ClassRegistry::init('Tiposestandar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tiposestandar);

		parent::tearDown();
	}

}
