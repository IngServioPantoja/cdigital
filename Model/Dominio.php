<?php
App::uses('AppModel', 'Model');
/**
 * Dominio Model
 *
 * @property Competencia $Competencia
 * @property Pregunta $Pregunta
 */
class Dominio extends AppModel {

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
		'Competencia' => array(
			'className' => 'Competencia',
			'foreignKey' => 'competencia_id',
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
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'dominio_id',
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
