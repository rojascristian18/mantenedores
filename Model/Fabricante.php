<?php 
App::uses('AppModel', 'Model');

Class Fabricante extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Fabricante';
	public $useTable = 'manufacturer';
	public $primaryKey = 'id_manufacturer';


	public $hasMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'fabricante_id',
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