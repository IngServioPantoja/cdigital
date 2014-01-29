<?php
App::uses('Cuestionario', 'Model');

/**
 * Cuestionario Test Case
 *
 */
class CuestionarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuestionario',
		'app.pregunta',
		'app.tipospregunta',
		'app.respuesta',
		'app.usuariorespuesta',
		'app.personas_cuestionario',
		'app.persona',
		'app.tiposidentificacion',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.semestre',
		'app.personas_programas_semestre',
		'app.programa',
		'app.facultad'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuestionario = ClassRegistry::init('Cuestionario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuestionario);

		parent::tearDown();
	}

}
