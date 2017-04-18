<?php
App::uses('AppModel', 'Model');
class Calificacion extends AppModel
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
		'calificacion' => array(
			'numeric' => array(
				'rule'			=> array('numeric'),
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
		'Usuario' => array(
			'className'				=> 'Usuario',
			'foreignKey'			=> 'usuario_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Usuario')
		)
	);


	public function afterSave($created = true, $options = array()) {
		parent::afterSave($created, $options);

		if ( ! empty($this->data[$this->alias]) ) {
			#Buscamos al usuario que se calificó
			$usuario = ClassRegistry::init('Usuario')->find('first', array(
				'conditions' => array(
					'Usuario.id' => $this->data[$this->alias]['usuario_id']
					),
				'contain' => array(
					sprintf('%s', $this->alias)
					)
				));

			$media = 0;
			$cantidad = 0;
			# Calculamos la media de las calificaciones
			foreach ($usuario[$this->alias] as $indice => $calificacion) {
				$media = $media + $calificacion['calificacion'];
				$cantidad++;
			}

			$mediaCalificaciones = round($media / $cantidad);


			$usuario['Usuario']['calificacion_media'] = $mediaCalificaciones;

			# actualizamos el campo al usuario
			ClassRegistry::init('Usuario')->save($usuario);


		}		
	}
}
