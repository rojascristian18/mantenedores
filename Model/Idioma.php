<?php 
App::uses('AppModel', 'Model');

Class Idioma extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Idioma';
	public $useTable = 'lang';
	public $primaryKey = 'id_lang';


	/*public $belongsTo = array(
		'ImpuestoIdioma' => array(
			'className'				=> 'ImpuestoIdioma',
			'foreignKey'			=> 'id_lang',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		)
	);*/

	public $hasAndBelongsToMany = array(
		'Impuesto' => array(
			'className'				=> 'Impuesto',
			'joinTable'				=> 'tax_lang',
			'foreignKey'			=> 'id_lang',
			'associationForeignKey'	=> 'id_tax',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'ImpuestoIdioma',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Especificacion' => array(
			'className'				=> 'Especificacion',
			'joinTable'				=> 'feature_lang',
			'foreignKey'			=> 'id_lang',
			'associationForeignKey'	=> 'id_feature',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> '',
			'finderQuery'			=> 'EspecificacionIdioma',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'EspecificacionValor' => array(
			'className'				=> 'EspecificacionValor',
			'joinTable'				=> 'feature_value_lang',
			'foreignKey'			=> 'id_lang',
			'associationForeignKey'	=> 'id_feature_value',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> '',
			'finderQuery'			=> 'EspecificacionValorIdioma',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);

	public $hasMany = array(
		'Tarea' => array(
			'className'				=> 'Tarea',
			'foreignKey'			=> 'idioma_id',
			'dependent'				=> false,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'exclusive'				=> '',
			'finderQuery'			=> '',
			'counterQuery'			=> ''
		)
	);
}