<?php
App::uses('Niveles', 'Model');

/**
 * Niveles Test Case
 *
 */
class NivelesTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Niveles = ClassRegistry::init('Niveles');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Niveles);

		parent::tearDown();
	}

}
