<?php
App::uses('MenusNivele', 'Model');

/**
 * MenusNivele Test Case
 *
 */
class MenusNiveleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menus_nivele',
		'app.menu',
		'app.nivele',
		'app.nivel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenusNivele = ClassRegistry::init('MenusNivele');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenusNivele);

		parent::tearDown();
	}

}
