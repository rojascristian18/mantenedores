<?php 
App::uses('AppModel', 'Model');

Class ImpuestoRegla extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'ImpuestoRegla';
	public $useTable = 'tax_rule';
	public $primaryKey = 'id_tax_rule';

	public $belongsTo = array(
		'TaxRulesGroup' => array(
			'className'				=> 'TaxRulesGroup',
			'foreignKey'			=> 'id_tax_rules_group',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		),
		'Impuesto' => array(
			'className'				=> 'Impuesto',
			'foreignKey'			=> 'id_tax',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Impuesto')
		)
	);
}