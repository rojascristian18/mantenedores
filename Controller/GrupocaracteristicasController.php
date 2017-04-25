<?php
App::uses('AppController', 'Controller');
class GrupocaracteristicasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0,
			'order' => array('Grupocaracteristica.modified' => 'DESC')
		);
		$grupocaracteristicas	= $this->paginate();
		$this->set(compact('grupocaracteristicas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{	
			# Limpiamos las especificaciones
			$this->request->data['Especificacion'] = $this->limpiarEspecificaciones($this->request->data['Especificacion']);

			if (empty($this->request->data['Especificacion'])) {
				$this->request->data['Grupocaracteristica']['count_caracteristicas'] = 0;
			}


			$this->Grupocaracteristica->create();
			if ( $this->Grupocaracteristica->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Especificacion', 'EspecificacionIdioma', 'Idioma'));
		
		$atributos  = $this->Grupocaracteristica->Especificacion->find('all', array(
			'contain' => array(
				'Idioma',
				)
			));

		$atributosList = array();
		
		# Creamos la lista de atributos
		foreach ($atributos as $indice => $valor) {
			# Agregamos el índice 0 para obtener el primer idioma del sitio externo
			if( isset($valor['Idioma'][0]['EspecificacionIdioma']) ) {
				$atributosList[$valor['Especificacion']['id_feature']] = sprintf('%d - %s', $valor['Especificacion']['id_feature'], $valor['Idioma'][0]['EspecificacionIdioma']['name']);
			}
		}
		# Total de atributos disponibles
		$totalAtributos = count($atributosList);

		$this->set(compact('atributosList', 'totalAtributos'));
	}

	public function admin_edit($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Especificacion', 'EspecificacionIdioma', 'Idioma'));

		if ( ! $this->Grupocaracteristica->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	

			# Limpiamos las especificaciones
			$this->request->data['Especificacion'] = $this->limpiarEspecificaciones($this->request->data['Especificacion']);

			if (empty($this->request->data['Especificacion'])) {
				$this->request->data['Grupocaracteristica']['count_caracteristicas'] = 0;
			}

			# Eliminar caracteristicas anteriores Con callbacks
			$this->Grupocaracteristica->GrupocaracteristicaEspecificacion->deleteAll(array('GrupocaracteristicaEspecificacion.grupocaracteristica_id' => $id));

			if ( $this->Grupocaracteristica->save($this->request->data) )
			{
				$this->Session->setFlash('Registro editado correctamente', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		else
		{
			$this->request->data	= $this->Grupocaracteristica->find('first', array(
				'conditions'	=> array('Grupocaracteristica.id' => $id)
			));

			# Se obtiene el listado de caracteristicas que tiene este registro
			$caracteristicas = $this->Grupocaracteristica->GrupocaracteristicaEspecificacion->find('all', array(
				'conditions' => array(
					'GrupocaracteristicaEspecificacion.grupocaracteristica_id' => $id
					),
				'fields' => array('id_feature')
				));

			# Declaramos el indice Especificacion como un arreglo vacio
			$this->request->data['Especificacion'] = array();
			$caracteristicasGrupo = array();

			# Sí no viene vacia buscamos
			if ( ! empty($caracteristicas) ) {

				$listaIdCaracteristicas = Hash::extract($caracteristicas, '{n}.GrupocaracteristicaEspecificacion.id_feature');

				$options['conditions'] = array(
					'Especificacion.id_feature IN' => $listaIdCaracteristicas
				);

				$options['contain'] = array(
					'Idioma'
				);

				if ( count($listaIdCaracteristicas) == 1 ) {
					$options['conditions'] = array(
						'Especificacion.id_feature' => $listaIdCaracteristicas
						);
				}


				$caracteristicasGrupo = $this->Grupocaracteristica->Especificacion->find('all', $options);
				
				$this->request->data['Especificacion'] = $caracteristicasGrupo;

			}
		}
		
		# Total de atributos disponibles
		$totalAtributos = $this->Grupocaracteristica->Especificacion->find('count');
		
		$this->set(compact('totalAtributos'));
	}

	public function admin_delete($id = null)
	{
		$this->Grupocaracteristica->id = $id;
		if ( ! $this->Grupocaracteristica->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Grupocaracteristica->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Grupocaracteristica->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Grupocaracteristica->_schema);
		$modelo			= $this->Grupocaracteristica->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	public function admin_activar( $id = null ) {
		$this->Grupocaracteristica->id = $id;
		if ( ! $this->Grupocaracteristica->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Grupocaracteristica->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->Grupocaracteristica->id = $id;
		if ( ! $this->Grupocaracteristica->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Grupocaracteristica->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	private function limpiarEspecificaciones ($especificaciones =  array()) {
		if ( !empty($especificaciones) ) {
			foreach ($especificaciones as $indice => $especificacion) {
				if ($especificacion['id_feature'] == 0) {
					unset($especificaciones[$indice]);
				}
			}
		}

		return $especificaciones;
	}

	public function admin_buscarCaracteristicas($palabra = '', $idGrupo = '') {
		if (empty($palabra)) {
			echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
		}

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Especificacion', 'EspecificacionIdioma', 'Idioma'));

		# Se obtiene el listado de caracteristicas que tiene este grupo
		$caracteristicasDelGrupo = $this->Grupocaracteristica->GrupocaracteristicaEspecificacion->find('all', array(
			'conditions' => array(
				'GrupocaracteristicaEspecificacion.grupocaracteristica_id' => $idGrupo
				),
			'fields' => array(
				'GrupocaracteristicaEspecificacion.id_feature'
				)
			));

		# Armamos las condiciones de la búsqueda base
		$options['conditions'] = array(
			'OR' => array(
				'EspecificacionIdioma.name LIKE "%' . $palabra . '%"',
				'EspecificacionIdioma.id_feature LIKE "%' . $palabra . '%"' 
				)
			);

		# Consulta con grupo de características definido
		if ( ! empty($caracteristicasDelGrupo) ) {
			$options['conditions'] = array_replace_recursive($options['conditions'], array(
				'OR' => array(
					'EspecificacionIdioma.name LIKE "%' . $palabra . '%"',
					'EspecificacionIdioma.id_feature LIKE "%' . $palabra . '%"' 
					),
				'AND' => array(
					'EspecificacionIdioma.id_feature !=' => Hash::extract($caracteristicasDelGrupo, '{n}.GrupocaracteristicaEspecificacion.id_feature')
					)
				));
		}

		# Buscamos los atributos que no este asociados a este grupo
		$atributos  = $this->Grupocaracteristica->Especificacion->EspecificacionIdioma->find('all', $options);
		
		$arrayAtributos = array();
		
		# Creamos la lista de atributos
		foreach ($atributos as $indice => $valor) {

			$arrayAtributos[$indice]['id'] = $valor['EspecificacionIdioma']['id_feature'];
			$arrayAtributos[$indice]['value'] = sprintf('%s - %s', $valor['EspecificacionIdioma']['id_feature'], $valor['EspecificacionIdioma']['name']);

			# Tabla todo
			$tabla = '<tr>';
	    	$tabla .= '<td><input type="hidden" name="data[Especificacion][[*ID*]][id_feature]" value="[*ID*]" class="js-input-id_feature">[*ID*]</td>';
	    	$tabla .= '<td>[*NOMBRE*]</td>';
	    	$tabla .= '<td><button class="quitar btn btn-danger">Quitar</button></td>';
	    	$tabla .= '</tr>';

	    	// Armamos la tabla
			$tabla = str_replace('[*ID*]', $valor['EspecificacionIdioma']['id_feature'] , $tabla);
			$tabla = str_replace('[*NOMBRE*]', $valor['EspecificacionIdioma']['name'] , $tabla);

			$arrayAtributos[$indice]['todo'] = $tabla;
		}

		echo json_encode($arrayAtributos);
		exit;

	}
}
