<?php 
App::uses('AppModel', 'Model');

Class ImpuestoIdioma extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'ImpuestoIdioma';
	public $useTable = 'tax_lang';
	public $primaryKey = 'id_lang';
	

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
}