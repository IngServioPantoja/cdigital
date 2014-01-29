<?php
App::uses('Tipospregunta', 'Model');

/**
 * Tipospregunta Test Case
 *
 */
class TipospreguntaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipospregunta',
		'app.pregunta',
		'app.cuestionario',
		'app.persona',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.personas_cuestionario',
		'app.respuesta',
		'app.usuariorespuesta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipospregunta = ClassRegistry::init('Tipospregunta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipospregunta);

		parent::tearDown();
	}

}
