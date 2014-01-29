<?php
App::uses('Tiposusuario', 'Model');

/**
 * Tiposusuario Test Case
 *
 */
class TiposusuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tiposusuario',
		'app.persona',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tiposusuario = ClassRegistry::init('Tiposusuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tiposusuario);

		parent::tearDown();
	}

}
