<?php 
App::uses('AppModel', 'Model');

Class Impuesto extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Impuesto';
	public $useTable = 'tax';
	public $primaryKey = 'id_tax';

	/**
	 * Use Toolmania Connect
	 */
	public $useDbConfig = 'toolmania';

	public $hasMany = array(
		'ImpuestoRegla' => array(
			'className'				=> 'ImpuestoRegla',
			'foreignKey'			=> 'id_tax',
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
			'joinTable'				=> 'tax_lang',
			'foreignKey'			=> 'id_tax',
			'associationForeignKey'	=> 'id_lang',
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
		)
	);

}