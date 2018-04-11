<?php 
App::uses('AppModel', 'Model');

Class PrecioEspecifico extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'PrecioEspecifico';
	public $useTable = 'specific_price';
	public $primaryKey = 'id_specific_price';


	/**
	* Config
	*/
	public $displayField	= 'id_specific_price';

	
	/**
	* CAllbacks
	*/

	public function beforeSave($options = array()) {
		parent::beforeSave();
	}

	public function afterSave($created = null, $options = Array()) {
		parent::afterSave();
	}

	public $belongsTo = array(
		'Productotienda' => array(
			'className'				=> 'Productotienda',
			'foreignKey'			=> 'id_product',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		)
	);

}
	
?>