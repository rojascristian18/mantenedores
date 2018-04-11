<?php 
App::uses('AppModel', 'Model');

Class Productotienda extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Productotienda';
	public $useTable = 'product';
	public $primaryKey = 'id_product';


	/**
	* Config
	*/
	public $displayField	= 'reference';

	
	/**
	* CAllbacks
	*/

	public function beforeSave($options = array()) {
		parent::beforeSave();
	}

	public function afterSave($created = null, $options = Array()) {
		parent::afterSave();
	}

	public $hasMany = array(
		'PrecioEspecifico' => array(
			'className'				=> 'PrecioEspecifico',
			'foreignKey'			=> 'id_product',
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
	
?>