<?php
App::uses('AppModel', 'Model');
class Producto extends AppModel
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
		'proveedor_id' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'fabricante_id' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'referencia' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
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
		'nombre_final' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'slug' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		
		'cantidad' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'validado' => array(
			'boolean' => array(
				'rule'			=> array('boolean'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'aceptado' => array(
			'boolean' => array(
				'rule'			=> array('boolean'),
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
		'Tarea' => array(
			'className'				=> 'Tarea',
			'foreignKey'			=> 'tarea_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tarea')
		),
		'Grupocaracteristica' => array(
			'className'				=> 'Grupocaracteristica',
			'foreignKey'			=> 'grupocaracteristica_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Grupocaracteristica')
		),
		'ParentProducto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'parent_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Producto')
		),
		'Proveedor' => array(
			'className'				=> 'Proveedor',
			'foreignKey'			=> 'proveedor_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Grupocaracteristica')
		),
		'Fabricante' => array(
			'className'				=> 'Fabricante',
			'foreignKey'			=> 'fabricante_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Grupocaracteristica')
		)
	);
	public $hasMany = array(
		'Imagen' => array(
			'className'				=> 'Imagen',
			'foreignKey'			=> 'producto_id',
			'dependent'				=> false,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'exclusive'				=> '',
			'finderQuery'			=> '',
			'counterQuery'			=> ''
		),
		'ChildProducto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'parent_id',
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
		'Palabraclave' => array(
			'className'				=> 'Palabraclave',
			'joinTable'				=> 'palabraclaves_productos',
			'foreignKey'			=> 'producto_id',
			'associationForeignKey'	=> 'palabraclave_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Especificacion' => array(
			'className'				=> 'Especificacion',
			'joinTable'				=> 'especificaciones_productos',
			'foreignKey'			=> 'producto_id',
			'associationForeignKey'	=> 'id_feature',
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

	
	public function beforeSave($options = array()) {
		# Se agrega el nombre final y el slug
		if ( ! empty($this->data[$this->alias]['nombre']) && ! empty($this->data[$this->alias]['grupocaracteristica_id']) && ! empty($this->data[$this->alias]['fabricante_id']) ) {

			# Slug
			$this->data[$this->alias]['slug'] = Inflector::slug(strtolower($this->data[$this->alias]['nombre_final']));

			# cantidad de productos default
			$this->data[$this->alias]['cantidad'] = 5;

			# meta titulo
			$this->data[$this->alias]['meta_titulo'] = $this->data[$this->alias]['nombre_final'];

			# meta descripción
			$this->data[$this->alias]['meta_descripcion'] = CakeText::truncate($this->data[$this->alias]['descripcion_corta'], 155);
		}

		# Comrpobamos que no se ingresen más productos de los permitidos en la tarea
		if ( !empty($this->data[$this->alias]['tarea_id']) ) {
			$cantPermitida = ClassRegistry::init('Tarea')->find('first', array(
				'conditions' => array(
					'Tarea.id' => $this->data[$this->alias]['tarea_id']
					),
				'contain' => array(
					'Producto'
					),
				'fields' => array(
					'Tarea.cantidad_productos'
					)
				));
			
			if ( empty($cantPermitida)) {
				return false;
			}
			
			if ( count($cantPermitida['Producto']) > $cantPermitida['Tarea']['cantidad_productos'] ) {
				return false;
			}

		}
		
	}

	public function calcularPorcentajeTarea($cantPermitidos = 0, $cantProductos = 0) {
		return round(( $cantProductos * 100 ) / $cantPermitidos );
	}

	public function afterSave($created, $options = array()) {
		parent::afterSave($created);

		if (isset($this->data[$this->alias]['tarea_id'])) {
			# actualizamos el porcentaje de la tarea
			$tarea = ClassRegistry::init('Tarea')->find('first', array(
				'conditions' => array(
					'Tarea.id' => $this->data[$this->alias]['tarea_id']
					),
				'contain' => array(
					'Producto' => array(
						'conditions' => array(
							'Producto.activo' => 1
							)
						)
					)
				));

			$cantProductos = count($tarea['Producto']);

			
			if ($cantProductos > 0 && $tarea['Tarea']['cantidad_productos'] > 0) {


				# Cambiar datasource
				$this->cambiarDatasourceModelo(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

				ClassRegistry::init('Tarea')->id = $tarea['Tarea']['id'];
				ClassRegistry::init('Tarea')->saveField('porcentaje_realizado', $this->calcularPorcentajeTarea($tarea['Tarea']['cantidad_productos'], $cantProductos) , array('callbacks' => false));
			}
		}
	}
}
