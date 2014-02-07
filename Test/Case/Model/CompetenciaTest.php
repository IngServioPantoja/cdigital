<?php
App::uses('Competencia', 'Model');

/**
 * Competencia Test Case
 *
 */
class CompetenciaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.dominio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Competencia = ClassRegistry::init('Competencia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Competencia);

		parent::tearDown();
	}

}
