<?php
App::uses('PersonasCuestionario', 'Model');

/**
 * PersonasCuestionario Test Case
 *
 */
class PersonasCuestionarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.personas_cuestionario',
		'app.persona',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.cuestionario',
		'app.pregunta',
		'app.usuariorespuesta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PersonasCuestionario = ClassRegistry::init('PersonasCuestionario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PersonasCuestionario);

		parent::tearDown();
	}

}
