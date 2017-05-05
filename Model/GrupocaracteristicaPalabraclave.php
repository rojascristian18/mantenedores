<?php
App::uses('AppModel', 'Model');
class GrupocaracteristicaPalabraclave extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	
	/**
	 * Set Cake config DB
	 */
	public $name = 'GrupocaracteristicaPalabraclave';
	public $useTable = 'grupocaracteristicas_palabraclaves';
	public $primaryKey = 'id';

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
	public function afterSave($created = true, $options = array()) {
		parent::afterSave($created, $options);

		if ( ! empty($this->data[$this->alias]) ) {
			
			#Buscamos al grupo
			$palabrasclaves = ClassRegistry::init('GrupocaracteristicaPalabraclave')->find('count', array(
				'conditions' => array(
					'GrupocaracteristicaPalabraclave.grupocaracteristica_id' => $this->data[$this->alias]['grupocaracteristica_id']
					)
				));
			
			# actualizamos el campo contador al grupo
			ClassRegistry::init('Grupocaracteristica')->id = $this->data[$this->alias]['grupocaracteristica_id'];
			ClassRegistry::init('Grupocaracteristica')->saveField('count_palabras_claves', $palabrasclaves);

		}		
	}
}