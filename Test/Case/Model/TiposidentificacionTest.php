<?php
App::uses('Tiposidentificacion', 'Model');

/**
 * Tiposidentificacion Test Case
 *
 */
class TiposidentificacionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tiposidentificacion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tiposidentificacion = ClassRegistry::init('Tiposidentificacion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tiposidentificacion);

		parent::tearDown();
	}

}
