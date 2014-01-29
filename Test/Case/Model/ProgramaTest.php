<?php
App::uses('Programa', 'Model');

/**
 * Programa Test Case
 *
 */
class ProgramaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.programa',
		'app.facultad',
		'app.persona',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.cuestionario',
		'app.pregunta',
		'app.tipospregunta',
		'app.respuesta',
		'app.usuariorespuesta',
		'app.personas_cuestionario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Programa = ClassRegistry::init('Programa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Programa);

		parent::tearDown();
	}

}
