<?php
App::uses('Control', 'Model');

/**
 * Control Test Case
 *
 */
class ControlTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.control',
		'app.rol',
		'app.entrega',
		'app.estado',
		'app.personas_proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.documento',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
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
		$this->Control = ClassRegistry::init('Control');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Control);

		parent::tearDown();
	}

}
