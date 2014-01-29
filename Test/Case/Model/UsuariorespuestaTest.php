<?php
App::uses('Usuariorespuesta', 'Model');

/**
 * Usuariorespuesta Test Case
 *
 */
class UsuariorespuestaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuariorespuesta',
		'app.personas_cuestionario',
		'app.persona',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.cuestionario',
		'app.pregunta',
		'app.tipospregunta',
		'app.respuesta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Usuariorespuesta = ClassRegistry::init('Usuariorespuesta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usuariorespuesta);

		parent::tearDown();
	}

}
