<?php
App::uses('PersonasProgramasSemestre', 'Model');

/**
 * PersonasProgramasSemestre Test Case
 *
 */
class PersonasProgramasSemestreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.personas_programas_semestre',
		'app.personas',
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
		'app.personas_cuestionario',
		'app.semestre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PersonasProgramasSemestre = ClassRegistry::init('PersonasProgramasSemestre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PersonasProgramasSemestre);

		parent::tearDown();
	}

}
