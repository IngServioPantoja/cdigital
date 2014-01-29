<?php
App::uses('Item', 'Model');

/**
 * Item Test Case
 *
 */
class ItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
		'app.control',
		'app.rol',
		'app.entrega',
		'app.estado',
		'app.personas_proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.documento',
		'app.proyecto',
		'app.items_estandar'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Item = ClassRegistry::init('Item');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Item);

		parent::tearDown();
	}

}
