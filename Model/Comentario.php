<?php
App::uses('AppModel', 'Model');
class Comentario extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */

	/**
	 * BEHAVIORS
	 */
	var $actsAs			= array(
		/**
		 * IMAGE UPLOAD
		 */
		'Image'		=> array(
			'fields'	=> array(
				'adjunto'	=> array(
				)
			)
		)
	);

	/**
	 * VALIDACIONES
	 */
	public $validate = array(
		'comentario' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'visualizado' => array(
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
		'ParentComentario' => array(
			'className'				=> 'Comentario',
			'foreignKey'			=> 'parent_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Comentario')
		),
		'Tarea' => array(
			'className'				=> 'Tarea',
			'foreignKey'			=> 'tarea_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Tarea')
		),
		'Importancia' => array(
			'className'				=> 'Importancia',
			'foreignKey'			=> 'importancia_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Importancia')
		),
		'Administrador' => array(
			'className'				=> 'Administrador',
			'foreignKey'			=> 'administrador_id',
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
		)
	);
	public $hasMany = array(
		'ChildComentario' => array(
			'className'				=> 'Comentario',
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

	public function beforeSave($options = array()) {
		
		$this->data[$this->alias]['guardar_email'] = false;

		if (isset($this->data['Comentario']['tarea_id'])) {

			// notificar comentario al administrador
			if ( isset($this->data['Comentario']['notificar_comentario_administrador']) ) {
				$this->data['Comentario']['notificar_comentario_administrador'] = true;
				$this->data[$this->alias]['guardar_email'] = true;
			}

			// notificar comentario al mantenedor
			if ( isset($this->data['Comentario']['notificar_comentario_mantenedor']) ) {
				$this->data['Comentario']['notificar_comentario_mantenedor'] = true;
				$this->data[$this->alias]['guardar_email'] = true;
			}
		}
	}

	public function afterSave($created, $options = array() ) {
		
		parent::afterSave($created, $options);

		/**
		 * Dispara eventos al guardar email (envio correos)
		 */
		if ( !empty($this->data[$this->alias]) && $this->data[$this->alias]['guardar_email'] ) {

			$evento			= new CakeEvent('Model.Comentario.afterSave', $this, $this->data);

			$this->getEventManager()->dispatch($evento);

		}
	}
}
