<?php
App::uses('AppModel', 'Model');
class Producto extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $displayField	= 'nombre';
	public $tarea_identificador = null;

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
				'message'		=> 'Campo proveedor es obligatorio.',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'fabricante_id' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				'message'		=> 'Campo marca es obligatorio.',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'referencia' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Campo referencia es obligatorio',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'nombre' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Campo carácteristicas para el nombre es obligatorio.',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
			'between' => array(
                'rule' => array('lengthBetween', 5, 50),
                'message' => 'Campo caracteristicas debe tener un largo entre 5 y 60 carácteres.'
            )
		),
		'nombre_final' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Campo nombre final es obligatorio',
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
		'descripcion_corta' => array(
			'between' => array(
                'rule' => array('lengthBetween', 50, 800),
                'message' => 'La descripción corta debe tener un largo entre 50 y 800 carácteres.'
            )
		),
		/*'precio' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				'message'		=> 'Precio debe contener solo números',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),*/
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
		'Usuario' => array(
			'className'				=> 'Usuario',
			'foreignKey'			=> 'usuario_id',
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
		),
		'Marca' => array(
			'className'				=> 'Marca',
			'foreignKey'			=> 'marca_id',
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
			$this->data[$this->alias]['cantidad'] = configuracion('stock_minimo');

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


	public function validarTamanoImagenes($data = array())
	{	
		$errores = array();
		# Procesamos imágenes
		if (isset($data['Imagen']) && count($data['Imagen']) > 0 ) {
			
			# Verificamos que las medidas de la imagen esten dentro del rango configurado
			foreach ($data['Imagen'] as $k => $imagen) {
				if (isset($imagen['imagen'])) {
					# Información de la imagen
					list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen['imagen']['tmp_name']);

					# Verificamos que el tamaño esté dentro de la configuración
					if ( $ancho < configuracion('imagen_ancho_min') 
						|| $ancho > configuracion('imagen_ancho_max')
						|| $alto < configuracion('imagen_alto_min')
						|| $alto > configuracion('imagen_alto_max') ) {

						$errores[$k] = 'La imagen ' . $imagen['imagen']['name'] . ' no tiene las dimensiones correctas. <br>';
						$errores[$k] .= 'Dimensión de la imagen:';
						$errores[$k] .= '<ul><li>Ancho: ' . $ancho . 'px</li><li>Alto: ' . $alto . 'px</li></ul><br/>';
					}	
				}
			}

		}

		return $errores;
	}

	public function calcularPorcentajeTarea($cantPermitidos = 0, $cantProductos = 0) {
		return round(( $cantProductos * 100 ) / $cantPermitidos );
	}

	public function guardarPorcentajeTarea($id_tarea = null)
	{
		# Obtenemos la información de la tarea del producto
		$tarea = ClassRegistry::init('Tarea')->find('first', array(
			'conditions' => array(
				'Tarea.id' => $id_tarea
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
		
		if ($tarea['Tarea']['cantidad_productos'] > 0) {
			# Cambiar datasource
			$this->cambiarDatasourceModelo(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

			ClassRegistry::init('Tarea')->id = $tarea['Tarea']['id'];
			ClassRegistry::init('Tarea')->saveField('porcentaje_realizado', $this->calcularPorcentajeTarea($tarea['Tarea']['cantidad_productos'], $cantProductos) , array('callbacks' => false));
		}
	}

	public function afterSave($created, $options = array()) {
		parent::afterSave($created);

		if (isset($this->data[$this->alias]['tarea_id'])) {
			# Actualizar porcentaje de tarea
			$this->guardarPorcentajeTarea($this->data[$this->alias]['tarea_id']);
		}
	}

	public function beforeDelete($cascade = true)
	{
		$producto = $this->find('first', array('conditions' => array('id' => $this->id)));

		if (!empty($producto)) {
			$this->tarea_identificador = $producto['Producto']['tarea_id'];
		}
	}


	public function afterDelete()
	{	
		# Actualizar porcentaje de tarea
		$this->guardarPorcentajeTarea($this->tarea_identificador);
	}
}
