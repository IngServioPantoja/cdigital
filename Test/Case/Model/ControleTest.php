<?php
App::uses('Controle', 'Model');

/**
 * Controle Test Case
 *
 */
class ControleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.controle',
		'app.rol',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
		'app.item',
		'app.items_estandar'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Controle = ClassRegistry::init('Controle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Controle);

		parent::tearDown();
	}

}
