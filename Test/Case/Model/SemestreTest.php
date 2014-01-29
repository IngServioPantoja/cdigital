<?php
App::uses('Semestre', 'Model');

/**
 * Semestre Test Case
 *
 */
class SemestreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.semestre',
		'app.programa',
		'app.facultad',
		'app.personas_programas_semestre',
		'app.persona',
		'app.tiposidentificacion',
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
		$this->Semestre = ClassRegistry::init('Semestre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Semestre);

		parent::tearDown();
	}

}
