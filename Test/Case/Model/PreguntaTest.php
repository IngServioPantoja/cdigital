<?php
App::uses('Pregunta', 'Model');

/**
 * Pregunta Test Case
 *
 */
class PreguntaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pregunta',
		'app.dominio',
		'app.competencia',
		'app.cuestionario',
		'app.persona',
		'app.tiposidentificacion',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.personas_cuestionario',
		'app.semestre',
		'app.personas_programas_semestre',
		'app.programa',
		'app.facultad',
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
		$this->Pregunta = ClassRegistry::init('Pregunta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pregunta);

		parent::tearDown();
	}

}
