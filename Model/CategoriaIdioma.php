<?php 
App::uses('AppModel', 'Model');

Class CategoriaIdioma extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'CategoriaIdioma';
	public $useTable = 'category_lang';
	//public $primaryKey = 'id_category';
	

	/*public $hasMany = array(
		'Idioma' => array(
			'className'				=> 'Idioma',
			'foreignKey'			=> 'id_lang',
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
	);*/
	public $belongsTo = array(
		'Categoria' => array(
			'className'				=> 'Categoria',
			'foreignKey'			=> 'id_category',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Categoriatarea')
		)
	);
}