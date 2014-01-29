<?php
App::uses('PersonasProyecto', 'Model');

/**
 * PersonasProyecto Test Case
 *
 */
class PersonasProyectoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.personas_proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.documento',
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
		'app.estado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PersonasProyecto = ClassRegistry::init('PersonasProyecto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PersonasProyecto);

		parent::tearDown();
	}

}
