<?php
App::uses('AppModel', 'Model');
/**
 * PersonasProgramasSemestre Model
 *
 * @property Persona $Persona
 * @property Programa $Programa
 * @property Semestre $Semestre
 */
class PersonasProgramasSemestre extends AppModel {

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
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Programa' => array(
			'className' => 'Programa',
			'foreignKey' => 'programa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Semestre' => array(
			'className' => 'Semestre',
			'foreignKey' => 'semestre_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
