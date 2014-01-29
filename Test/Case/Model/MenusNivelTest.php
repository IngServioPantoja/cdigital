<?php
App::uses('MenusNivel', 'Model');

/**
 * MenusNivel Test Case
 *
 */
class MenusNivelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menus_nivel',
		'app.menu',
		'app.nivel',
		'app.user',
		'app.persona'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenusNivel = ClassRegistry::init('MenusNivel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenusNivel);

		parent::tearDown();
	}

}
