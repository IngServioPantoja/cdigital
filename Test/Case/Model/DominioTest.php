<?php
App::uses('Dominio', 'Model');

/**
 * Dominio Test Case
 *
 */
class DominioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.pregunta',
		'app.tipospregunta',
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
		$this->Dominio = ClassRegistry::init('Dominio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Dominio);

		parent::tearDown();
	}

}
