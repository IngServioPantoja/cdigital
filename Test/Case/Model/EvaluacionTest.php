<?php
App::uses('Evaluacion', 'Model');

/**
 * Evaluacion Test Case
 *
 */
class EvaluacionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.evaluacion',
		'app.itemestandar',
		'app.concepto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Evaluacion = ClassRegistry::init('Evaluacion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Evaluacion);

		parent::tearDown();
	}

}
