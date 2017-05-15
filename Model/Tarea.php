<?php
App::uses('AppModel', 'Model');
class Tarea extends AppModel
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
		'impuesto_default_id' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'idioma_id' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'shop_id' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
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
		/*'descripcion' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),*/
		'precio' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'porcentaje_realizado' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'iniciado' => array(
			'boolean' => array(
				'rule'			=> array('boolean'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'fecha_iniciado' => array(
			'datetime' => array(
				'rule'			=> array('datetime'),
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
		'en_progreso' => array(
			'boolean' => array(
				'rule'			=> array('boolean'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'en_revision' => array(
			'boolean' => array(
				'rule'			=> array('boolean'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'finalizado' => array(
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
		'Usuario' => array(
			'className'				=> 'Usuario',
			'foreignKey'			=> 'usuario_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Usuario')
		),
		'Administrador' => array(
			'className'				=> 'Administrador',
			'foreignKey'			=> 'administrador_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Administrador')
		),
		'ParentTarea' => array(
			'className'				=> 'Tarea',
			'foreignKey'			=> 'parent_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tarea')
		),
		'Categoriatarea' => array(
			'className'				=> 'Categoriatarea',
			'foreignKey'			=> 'categoriatarea_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Categoriatarea')
		),
		'Tienda' => array(
			'className'				=> 'Tienda',
			'foreignKey'			=> 'tienda_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tienda')
		),
		'ImpuestoReglaGrupo' => array(
			'className'				=> 'ImpuestoReglaGrupo',
			'foreignKey'			=> 'impuesto_default_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tienda')
		),
		'Idioma' => array(
			'className'				=> 'Idioma',
			'foreignKey'			=> 'idioma_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tienda')
		),
		'Shop' => array(
			'className'				=> 'Shop',
			'foreignKey'			=> 'shop_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tienda')
		),
	);
	public $hasMany = array(
		'Adjunto' => array(
			'className'				=> 'Adjunto',
			'foreignKey'			=> 'tarea_id',
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
		'Comentario' => array(
			'className'				=> 'Comentario',
			'foreignKey'			=> 'tarea_id',
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
		'Notificacion' => array(
			'className'				=> 'Notificacion',
			'foreignKey'			=> 'tarea_id',
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
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'tarea_id',
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
		'ChildTarea' => array(
			'className'				=> 'Tarea',
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
		'Grupocaracteristica' => array(
			'className'				=> 'Grupocaracteristica',
			'joinTable'				=> 'grupocaracteristicas_tareas',
			'foreignKey'			=> 'tarea_id',
			'associationForeignKey'	=> 'grupocaracteristica_id',
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
		)
	);

	public function beforeSave($options = array()) {
		
		if ( ! isset($this->data['Tarea']['tienda_id'])) {
			$this->data['Tarea']['tienda_id'] = CakeSession::read('Tienda.id');
		}

		if ( isset($this->data['Tarea']['id']) ) {
			# Verificamos si cambió el usuario asignado
			$usuarioActual = $this->find('first', array('conditions' => array('Tarea.id' => $this->data['Tarea']['id']), 'fields' => array('usuario_id')));

			if ( ! empty($usuarioActual['Tarea']['usuario_id']) && isset($this->data['Tarea']['usuario_id']) && $this->data['Tarea']['usuario_id'] != $usuarioActual['Tarea']['usuario_id'] && !isset($this->data['Comentario'])) {
				$this->data['Tarea']['asignada'] = true;
				$this->data['Tarea']['desasignar_a'] = $usuarioActual['Tarea']['usuario_id'];
				
				#  Se reinicia la tarea
				#  
				#  Recordar que tambien se debe calcular el monto de la tarea e ingresarlo en la cuenta del usuario que se le quitó la tarea
				$this->data['Tarea']['iniciado'] = 0;
				$this->data['Tarea']['en_progreso'] = 0;
				$this->data['Tarea']['en_revision'] = 0;
				$this->data['Tarea']['rechazado'] = 0;
				$this->data['Tarea']['finalizado'] = 0;

			}

			if ( isset($this->data['Tarea']['usuario_id']) && !empty($this->data['Tarea']['usuario_id']) && !isset($this->data['Comentario']) && $usuarioActual['Tarea']['usuario_id'] == $this->data['Tarea']['usuario_id'] ) {
				$this->data['Tarea']['modificada'] = true;
			}

			# notificar comentario al mantenedor
			if ( isset($this->data['Comentario']) && ! empty($this->data['Comentario']) && isset($this->data['Tarea']['usuario_id']) && isset($this->data['Comentario'][1]['Comentario']['administrador_id']) && !empty($this->data['Tarea']['usuario_id']) ) {
				$this->data['Tarea']['notificar_comentario_mantenedor'] = true;
			}

			# notificar comentario al administrador
			if ( isset($this->data['Comentario']) && ! empty($this->data['Comentario']) && isset($this->data['Tarea']['administrador_id']) && isset($this->data['Comentario'][1]['Comentario']['usuario_id']) && !empty($this->data['Tarea']['administrador_id']) ) {
				$this->data['Tarea']['notificar_comentario_administrador'] = true;
			}

			# notificar comentario al administrador
			if ( isset($this->data['Tarea']['iniciado']) && $this->data['Tarea']['iniciado'] && isset($this->data['Tarea']['administrador_id']) && !empty($this->data['Tarea']['administrador_id']) ) {
				$this->data['Tarea']['notificar_inicio_tarea_administrador'] = true;
			}

			# notificar tarea a revisión
			if ( isset($this->data['Tarea']['en_revision']) && $this->data['Tarea']['en_revision'] ) {
				$this->data['Tarea']['notificar_tarea_revision_administrador'] = true;
			}

			# Notificar tarea rechazada al mantenedor
			if ( isset($this->data['Tarea']['rechazado']) && $this->data['Tarea']['rechazado'] ) {
				$this->data['Tarea']['notificar_tarea_rechazada_matenedor'] = true;
			}

			if ( isset($this->data['Tarea']['finalizado']) && $this->data['Tarea']['finalizado'] ) {
				$this->data['Tarea']['notificar_tarea_aceptada_matenedor'] = true;

				# Obtenemos Información completa de la tarea
				$tarea = ClassRegistry::init('Tarea')->find('first',
					array(
						'conditions' => array(
							'Tarea.id' => $this->data['Tarea']['id']
							),
						'contain' => array(
							'Usuario' => array('Cuenta'),
							)	 
					)
				);

				if (empty($tarea['Usuario']) || empty($tarea['Usuario']['Cuenta']) ) {
					return false;
				}

				$this->data['Tarea']['tarea_finalizada'] = true;
			}

		}else{
			if ( isset($this->data['Tarea']['usuario_id']) && !empty($this->data['Tarea']['usuario_id']) && !isset($this->data['Comentario']) && empty($usuarioActual) ) {
				$this->data['Tarea']['asignada'] = true;
			}
		}
		
		return true;
	}

	public function calcularMontoPagar($precio = 0, $porcentaje = 0, $productos = 0) {
		if ($productos > 0 && $porcentaje > 0 && $precio > 0) {
			# Cantidad de productos agregados a la tarea
			$productosAgregados = round($productos * $porcentaje / 100);
			# Precio unitario de los productos
			$valorProductoUnitario = $precio / $productos;
			# Total a pagara
			return $valorProductoUnitario * $productosAgregados;
		}else{
			return 0;
		}
	}

	public function afterSave($created, $options = array() ) {
		
		parent::afterSave($created, $options);

		/**
		 * Dispara eventos al guardar la tarea (envio correos y registro de pagos)
		 */
		if ( ! empty($this->data[$this->alias])) {

			/**
			 * 	Registro de tareas a pagar
			 */

			if ( isset($this->data['Tarea']['tarea_finalizada']) && $this->data['Tarea']['tarea_finalizada'] ) {

				# Obtenemos Información completa de la tarea
				$tarea = ClassRegistry::init('Tarea')->find('first',
					array(
						'conditions' => array(
							'Tarea.id' => $this->data['Tarea']['id']
							),
						'contain' => array(
							'Usuario' => array('Cuenta'),
							)	 
					)
				);

				if (empty($tarea['Usuario']) || empty($tarea['Usuario']['Cuenta']) ) {
					return false;
				}
				
				# Creamos el arreglo para guardar la información al pago
				$pago = array(
					'Pago' => array(
						'administrador_id' => $tarea['Tarea']['administrador_id'],
						'usuario_id' => $tarea['Tarea']['usuario_id'],
						'tarea_id' => $tarea['Tarea']['id'],
						'tienda_id' => $tarea['Tarea']['tienda_id'],
						'cuenta_id' => $tarea['Usuario']['Cuenta'][0]['id'],
						'nombre_tarea' => $tarea['Tarea']['nombre'],
						'monto_a_pagar' => $this->calcularMontoPagar($tarea['Tarea']['precio'], $tarea['Tarea']['porcentaje_realizado'], $tarea['Tarea']['cantidad_productos'])
						)
					);

				# Guardamos el pago
				ClassRegistry::init('Pago')->save($pago);

			}


			$evento			= new CakeEvent('Model.Tarea.afterSave', $this, $this->data);
			$this->getEventManager()->dispatch($evento);

		}
	}
}
