<?php
App::uses('Documento', 'Model');

/**
 * Documento Test Case
 *
 */
class DocumentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.documento',
		'app.personas_proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.rol',
		'app.control',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
		'app.proyecto',
		'app.item',
		'app.items_estandar',
		'app.entrega',
		'app.estado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Documento = ClassRegistry::init('Documento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Documento);

		parent::tearDown();
	}

}
