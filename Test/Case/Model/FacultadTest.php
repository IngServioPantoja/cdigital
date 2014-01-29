<?php
App::uses('Facultad', 'Model');

/**
 * Facultad Test Case
 *
 */
class FacultadTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.facultad',
		'app.programa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Facultad = ClassRegistry::init('Facultad');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Facultad);

		parent::tearDown();
	}

}
