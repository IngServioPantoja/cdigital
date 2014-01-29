<?php
App::uses('Proyecto', 'Model');

/**
 * Proyecto Test Case
 *
 */
class ProyectoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proyecto',
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
		$this->Proyecto = ClassRegistry::init('Proyecto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proyecto);

		parent::tearDown();
	}

}
