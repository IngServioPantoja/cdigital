<?php
App::uses('Nivel', 'Model');

/**
 * Nivel Test Case
 *
 */
class NivelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nivel',
		'app.user',
		'app.persona',
		'app.menu',
		'app.menus_nivel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nivel = ClassRegistry::init('Nivel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nivel);

		parent::tearDown();
	}

}
