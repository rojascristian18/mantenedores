<?php 
App::uses('AppModel', 'Model');

Class Especificacion extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Especificacion';
	public $useTable = 'feature';
	public $primaryKey = 'id_feature';


	/*public $belongsTo = array(
		'ImpuestoIdioma' => array(
			'className'				=> 'ImpuestoIdioma',
			'foreignKey'			=> 'id_lang',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		)
	);*/

	public $hasMany = array(
		'EspecificacionValor' => array(
			'className'				=> 'EspecificacionValor',
			'foreignKey'			=> 'id_feature',
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
			'joinTable'				=> 'feature_lang',
			'foreignKey'			=> 'id_feature',
			'associationForeignKey'	=> 'id_lang',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'EspecificacionIdioma',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Grupocaracteristica' => array(
			'className'				=> 'Grupocaracteristica',
			'joinTable'				=> 'grupocaracteristicas_especificaciones',
			'foreignKey'			=> 'id_feature',
			'associationForeignKey'	=> 'grupocaracteristica_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'GrupocaracteristicaEspecificacion',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Producto' => array(
			'className'				=> 'Producto',
			'joinTable'				=> 'especificaciones_productos',
			'foreignKey'			=> 'id_feature',
			'associationForeignKey'	=> 'producto_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'EspecificacionesProducto',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);
}