<?php
App::uses('AppModel', 'Model');
/**
 * Cuestionario Model
 *
 * @property Pregunta $Pregunta
 * @property Persona $Persona
 */
class Cuestionario extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'cuestionario_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Persona' => array(
			'className' => 'Persona',
			'joinTable' => 'personas_cuestionarios',
			'foreignKey' => 'cuestionario_id',
			'associationForeignKey' => 'persona_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
