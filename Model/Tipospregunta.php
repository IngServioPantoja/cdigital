<?php
App::uses('AppModel', 'Model');
/**
 * Tipospregunta Model
 *
 * @property Pregunta $Pregunta
 */
class Tipospregunta extends AppModel {

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
			'foreignKey' => 'tipospregunta_id',
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
