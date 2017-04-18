<?php 
App::uses('AppModel', 'Model');

Class ImpuestoReglaGrupo extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'ImpuestoReglaGrupo';
	public $useTable = 'tax_rules_group';
	public $primaryKey = 'id_tax_rules_group';

	/**
	 * Use Toolmania Connect
	 */
	public $useDbConfig = 'toolmania';

	public $hasMany = array(
		'ImpuestoRegla' => array(
			'className'				=> 'ImpuestoRegla',
			'foreignKey'			=> 'id_tax_rules_group',
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