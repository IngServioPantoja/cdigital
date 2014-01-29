<?php
App::uses('AppModel', 'Model');
/**
 * Persona Model
 *
 * @property User $User
 * @property Cuestionario $Cuestionario
 */
class Persona extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'persona_id',
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
		'Cuestionario' => array(
			'className' => 'Cuestionario',
			'joinTable' => 'personas_cuestionarios',
			'foreignKey' => 'persona_id',
			'associationForeignKey' => 'cuestionario_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Semestre' => array(
			'className' => 'Semestre',
			'joinTable' => 'personas_programas_semestres',
			'foreignKey' => 'persona_id',
			'associationForeignKey' => 'semestre_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Programa' => array(
			'className' => 'Programa',
			'joinTable' => 'personas_programas_semestres',
			'foreignKey' => 'persona_id',
			'associationForeignKey' => 'programa_id',
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

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tiposidentificacion' => array(
			'className' => 'Tiposidentificacion',
			'foreignKey' => 'tiposidentificacion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
