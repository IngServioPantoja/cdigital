<?php
App::uses('AppModel', 'Model');
/**
 * Respuesta Model
 *
 * @property Pregunta $Pregunta
 * @property Usuariorespuesta $Usuariorespuesta
 */
class Respuesta extends AppModel {

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
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'pregunta_id',
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
		'Usuariorespuesta' => array(
			'className' => 'Usuariorespuesta',
			'foreignKey' => 'respuesta_id',
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
