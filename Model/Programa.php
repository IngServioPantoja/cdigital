<?php
App::uses('AppModel', 'Model');
/**
 * Programa Model
 *
 * @property Facultad $Facultad
 */
class Programa extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Facultad' => array(
			'className' => 'Facultad',
			'foreignKey' => 'facultad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Semestre' => array(
			'className' => 'Semestre',
			'joinTable' => 'personas_programas_semestres',
			'foreignKey' => 'programa_id',
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
		'Persona' => array(
			'className' => 'Persona',
			'joinTable' => 'personas_programas_semestres',
			'foreignKey' => 'programa_id',
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
