<?php
App::uses('AppModel', 'Model');
/**
 * PersonasCuestionario Model
 *
 * @property Persona $Persona
 * @property Cuestionario $Cuestionario
 * @property Usuariorespuesta $Usuariorespuesta
 */
class PersonasCuestionario extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'fecha realizacion';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id',
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
		'Usuariorespuesta' => array(
			'className' => 'Usuariorespuesta',
			'foreignKey' => 'personas_cuestionario_id',
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
