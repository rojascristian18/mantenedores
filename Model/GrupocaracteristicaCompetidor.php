<?php
App::uses('AppModel', 'Model');
class GrupocaracteristicaCompetidor extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	
	/**
	 * Set Cake config DB
	 */
	public $name = 'GrupocaracteristicaCompetidor';
	public $useTable = 'grupocaracteristicas_competidores';
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
			$competidores = ClassRegistry::init('GrupocaracteristicaCompetidor')->find('count', array(
				'conditions' => array(
					'GrupocaracteristicaCompetidor.grupocaracteristica_id' => $this->data[$this->alias]['grupocaracteristica_id']
					)
				));
			
			# actualizamos el campo contador al grupo
			ClassRegistry::init('Grupocaracteristica')->id = $this->data[$this->alias]['grupocaracteristica_id'];
			ClassRegistry::init('Grupocaracteristica')->saveField('count_competidores', $competidores);

		}		
	}
}