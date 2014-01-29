<?php
App::uses('Respuesta', 'Model');

/**
 * Respuesta Test Case
 *
 */
class RespuestaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.respuesta',
		'app.pregunta',
		'app.tipospregunta',
		'app.cuestionario',
		'app.persona',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.personas_cuestionario',
		'app.usuariorespuesta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Respuesta = ClassRegistry::init('Respuesta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Respuesta);

		parent::tearDown();
	}

}
