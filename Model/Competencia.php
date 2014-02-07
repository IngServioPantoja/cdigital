<?php
App::uses('AppModel', 'Model');
/**
 * Competencia Model
 *
 * @property Cuestionario $Cuestionario
 * @property Dominio $Dominio
 */
class Competencia extends AppModel {

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
		'Dominio' => array(
			'className' => 'Dominio',
			'foreignKey' => 'competencia_id',
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
