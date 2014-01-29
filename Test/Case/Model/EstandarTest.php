<?php
App::uses('Estandar', 'Model');

/**
 * Estandar Test Case
 *
 */
class EstandarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Estandar = ClassRegistry::init('Estandar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Estandar);

		parent::tearDown();
	}

}
