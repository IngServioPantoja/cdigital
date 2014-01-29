<?php
App::uses('AppModel', 'Model');
/**
 * Usuariorespuesta Model
 *
 * @property PersonasCuestionario $PersonasCuestionario
 * @property Pregunta $Pregunta
 * @property Respuesta $Respuesta
 */
class Usuariorespuesta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PersonasCuestionario' => array(
			'className' => 'PersonasCuestionario',
			'foreignKey' => 'personas_cuestionario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'pregunta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Respuesta' => array(
			'className' => 'Respuesta',
			'foreignKey' => 'respuesta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
