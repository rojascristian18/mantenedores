<?php 
App::uses('AppModel', 'Model');

Class Categoria extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Categoria';
	public $useTable = 'category';
	public $primaryKey = 'id_category';


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

	public $hasMany = array(
		'CategoriaIdioma' => array(
			'className'				=> 'CategoriaIdioma',
			'foreignKey'			=> 'id_category',
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

	public $hasAndBelongsToMany = array(
		'Idioma' => array(
			'className'				=> 'Idioma',
			'joinTable'				=> 'category_lang',
			'foreignKey'			=> 'id_category',
			'associationForeignKey'	=> 'id_lang',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'CategoriaIdioma',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Grupocaracteristica' => array(
			'className'				=> 'Grupocaracteristica',
			'joinTable'				=> 'grupocaracteristicas_categorias',
			'foreignKey'			=> 'id_category',
			'associationForeignKey'	=> 'grupocaracteristica_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'GrupocaracteristicaCategoria',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);
}