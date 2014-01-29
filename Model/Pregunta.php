<?php
App::uses('AppModel', 'Model');
/**
 * Pregunta Model
 *
 * @property Tipospregunta $Tipospregunta
 * @property Cuestionario $Cuestionario
 * @property Respuesta $Respuesta
 * @property Usuariorespuesta $Usuariorespuesta
 */
class Pregunta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tipospregunta' => array(
			'className' => 'Tipospregunta',
			'foreignKey' => 'tipospregunta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cuestionario' => array(
			'className' => 'Cuestionario',
			'foreignKey' => 'cuestionario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Respuesta' => array(
			'className' => 'Respuesta',
			'foreignKey' => 'pregunta_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Usuariorespuesta' => array(
			'className' => 'Usuariorespuesta',
			'foreignKey' => 'pregunta_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
