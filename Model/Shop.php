<?php 
App::uses('AppModel', 'Model');

Class Shop extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Shop';
	public $useTable = 'shop';
	public $primaryKey = 'id_shop';

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