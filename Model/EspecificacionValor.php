<?php 
App::uses('AppModel', 'Model');

Class EspecificacionValor extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'EspecificacionValor';
	public $useTable = 'feature_value';
	public $primaryKey = 'id_feature_value';


	public $belongsTo = array(
		'Especificacion' => array(
			'className'				=> 'Especificacion',
			'foreignKey'			=> 'id_feature',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		)
	);

	public $hasAndBelongsToMany = array(
		'Idioma' => array(
			'className'				=> 'Idioma',
			'joinTable'				=> 'feature_value_lang',
			'foreignKey'			=> 'id_feature_value',
			'associationForeignKey'	=> 'id_lang',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '', 
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'EspecificacionValorIdioma',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);
}