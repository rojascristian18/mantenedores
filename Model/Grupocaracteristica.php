<?php
App::uses('AppModel', 'Model');
class Grupocaracteristica extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $displayField	= 'nombre';

	/**
	 * BEHAVIORS
	 */
	var $actsAs			= array(
		/**
		 * IMAGE UPLOAD
		 */
		/*
		'Image'		=> array(
			'fields'	=> array(
				'imagen'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						)
					)
				)
			)
		)
		*/
	);

	/**
	 * VALIDACIONES
	 */
	public $validate = array(
		'nombre' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'desripcion' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'activo' => array(
			'boolean' => array(
				'rule'			=> array('boolean'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
	);

	/**
	 * ASOCIACIONES
	 */
	public $belongsTo = array(
		'Tienda' => array(
			'className'				=> 'Tienda',
			'foreignKey'			=> 'tienda_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tienda')
		)
	);
	public $hasMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'grupocaracteristica_id',
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
		'Especificacion' => array(
			'className'				=> 'Especificacion',
			'joinTable'				=> 'grupocaracteristicas_especificaciones',
			'foreignKey'			=> 'grupocaracteristica_id',
			'associationForeignKey'	=> 'id_feature',
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
		'UnidadMedida' => array(
			'className'				=> 'UnidadMedida',
			'joinTable'				=> 'grupocaracteristicas_especificaciones',
			'foreignKey'			=> 'grupocaracteristica_id',
			'associationForeignKey'	=> 'unidad_medida_id',
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
		'Categoria' => array(
			'className'				=> 'Categoria',
			'joinTable'				=> 'grupocaracteristicas_categorias',
			'foreignKey'			=> 'grupocaracteristica_id',
			'associationForeignKey'	=> 'id_category',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'GrupocaracteristicaCategoria',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Palabraclave' => array(
			'className'				=> 'Palabraclave',
			'joinTable'				=> 'grupocaracteristicas_palabraclaves',
			'foreignKey'			=> 'grupocaracteristica_id',
			'associationForeignKey'	=> 'palabraclave_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'GrupocaracteristicaPalabraclave',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Tarea' => array(
			'className'				=> 'Tarea',
			'joinTable'				=> 'grupocaracteristicas_tareas',
			'foreignKey'			=> 'grupocaracteristica_id',
			'associationForeignKey'	=> 'tarea_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'GrupocaracteristicaTarea',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Competidor' => array(
			'className'				=> 'Competidor',
			'joinTable'				=> 'grupocaracteristicas_competidores',
			'foreignKey'			=> 'grupocaracteristica_id',
			'associationForeignKey'	=> 'competidor_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'GrupocaracteristicaCompetidor',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);

}
