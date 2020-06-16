<?php 
App::uses('AppModel', 'Model');

Class Proveedor extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Proveedor';
	public $useTable = 'supplier';
	public $primaryKey = 'id_supplier';


	public $hasMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'proveedor_id',
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