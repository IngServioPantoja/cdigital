<?php
App::uses('Rol', 'Model');

/**
 * Rol Test Case
 *
 */
class RolTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rol',
		'app.control',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
		'app.proyecto',
		'app.item',
		'app.items_estandar',
		'app.entrega',
		'app.estado',
		'app.personas_proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.documento'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rol = ClassRegistry::init('Rol');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rol);

		parent::tearDown();
	}

}
