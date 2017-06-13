<?php
App::uses('AppController', 'Controller');
class GrupocaracteristicasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0,
			'order' => array('Grupocaracteristica.modified' => 'DESC'),
			'conditions' => array('Grupocaracteristica.tienda_id' => $this->Session->read('Tienda.id')) 
		);
		$grupocaracteristicas	= $this->paginate();
		$this->set(compact('grupocaracteristicas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{	
			if ( empty($this->request->data['Especificacion']) ) {
				$this->request->data['Grupocaracteristica']['count_caracteristicas'] = 0;
			}
			
			if ( empty($this->request->data['Categoria']) ) {
				$this->request->data['Grupocaracteristica']['count_categorias'] = 0;
			}

			if ( empty($this->request->data['Palabraclave'])) {
				$this->request->data['Grupocaracteristica']['count_palabras_claves'] = 0;
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
		$this->cambiarDatasource(array('Especificacion', 'EspecificacionIdioma', 'Idioma', 'Categoria', 'CategoriaIdioma'));

		if ( ! $this->Grupocaracteristica->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{		
			if ( ! empty($this->request->data['Especificacion']) ) {
				# Limpiamos las especificaciones
				$this->request->data['Especificacion'] = $this->limpiarEspecificaciones($this->request->data['Especificacion']);
			}else {
				$this->request->data['Grupocaracteristica']['count_caracteristicas'] = 0;
			}
			
			if ( ! empty($this->request->data['Categoria']) ) {
				# Limpiamos las categorias
				$this->request->data['Categoria'] = $this->limpiarCategorias($this->request->data['Categoria']);
			}else{
				$this->request->data['Grupocaracteristica']['count_categorias'] = 0;
			}
			
			if ( ! empty($this->request->data['Palabraclave'])) {
				# Limpiamos las categorias
				$this->request->data['Palabraclave'] = $this->limpiarPalabraclaves($this->request->data['Palabraclave']);
			}else{
				$this->request->data['Grupocaracteristica']['count_palabras_claves'] = 0;
			}
			#prx($this->request->data);
			# Eliminar caracteristicas anteriores Con callbacks
			$this->Grupocaracteristica->GrupocaracteristicaEspecificacion->deleteAll(array('GrupocaracteristicaEspecificacion.grupocaracteristica_id' => $id));
			# Eliminar categorias anteriores Con callbacks
			$this->Grupocaracteristica->GrupocaracteristicaCategoria->deleteAll(array('GrupocaracteristicaCategoria.grupocaracteristica_id' => $id));
			# Eliminar categorias anteriores Con callbacks
			$this->Grupocaracteristica->GrupocaracteristicaPalabraclave->deleteAll(array('GrupocaracteristicaPalabraclave.grupocaracteristica_id' => $id));

					
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
				'conditions'	=> array('Grupocaracteristica.id' => $id),
				'contain' => array('Palabraclave')
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


			# Buscamos las categorias del grupo
			# Se obtiene el listado de categorias que tiene este registro
			$categorias = $this->Grupocaracteristica->GrupocaracteristicaCategoria->find('all', array(
				'conditions' => array(
					'GrupocaracteristicaCategoria.grupocaracteristica_id' => $id
					),
				'fields' => array('id_category')
				));

			# Declaramos el indice Categoria como un arreglo vacio
			$this->request->data['Categoria'] = array();
			$categoriasGrupo = array();

			# Sí no viene vacia buscamos
			if ( ! empty($categorias) ) {

				$listaIdCategorias = Hash::extract($categorias, '{n}.GrupocaracteristicaCategoria.id_category');

				$optionsCat['conditions'] = array(
					'Categoria.id_category' => $listaIdCategorias
				);

				$optionsCat['contain'] = array(
					'Idioma'
				);

				if ( count($listaIdCategorias) == 1 ) {
					$optionsCat['conditions'] = array(
						'Categoria.id_category' => $listaIdCategorias
						);
				}


				$categoriasGrupo = $this->Grupocaracteristica->Categoria->find('all', $optionsCat);
				
				$this->request->data['Categoria'] = $categoriasGrupo;

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

	private function limpiarCategorias ($categorias =  array()) {
		if ( !empty($categorias) ) {
			foreach ($categorias as $indice => $categoria) {
				if ($categoria['id_category'] == 0) {
					unset($categorias[$indice]);
				}
			}
		}

		return $categorias;
	}


	private function limpiarPalabraclaves ($palabraclaves =  array()) {
		if ( empty($palabraclaves['Palabraclave']) ) {
			return '';
		}

		return $palabraclaves;
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


	public function admin_buscarCategorias($palabra = '', $idGrupo = '') {
		if (empty($palabra)) {
			echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
		}

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Categoria', 'CategoriaIdioma', 'Idioma'));

		# Se obtiene el listado de categorias que tiene este grupo
		$categoriasDelGrupo = $this->Grupocaracteristica->GrupocaracteristicaCategoria->find('all', array(
			'conditions' => array(
				'GrupocaracteristicaCategoria.grupocaracteristica_id' => $idGrupo
				),
			'fields' => array(
				'GrupocaracteristicaCategoria.id_category'
				)
			));

		# Armamos las condiciones de la búsqueda base
		$options['conditions'] = array(
			'OR' => array(
				'CategoriaIdioma.name LIKE "%' . $palabra . '%"',
				'CategoriaIdioma.id_category LIKE "%' . $palabra . '%"' 
				)
			);

		# Consulta con grupo de categoria definido
		if ( ! empty($categoriasDelGrupo) ) {
			$options['conditions'] = array_replace_recursive($options['conditions'], array(
				'OR' => array(
					'CategoriaIdioma.name LIKE "%' . $palabra . '%"',
					'CategoriaIdioma.id_category LIKE "%' . $palabra . '%"' 
					),
				'AND' => array(
					'CategoriaIdioma.id_category !=' => Hash::extract($categoriasDelGrupo, '{n}.GrupocaracteristicaCategoria.id_category')
					)
				));
		}

		# Buscamos las categorias que no este asociados a este grupo
		$categorias  = $this->Grupocaracteristica->Categoria->CategoriaIdioma->find('all', $options);
		
		$arrayCategorias = array();
		
		# Creamos la lista de atributos
		foreach ($categorias as $indice => $valor) {

			$arrayCategorias[$indice]['id'] = $valor['CategoriaIdioma']['id_category'];
			$arrayCategorias[$indice]['value'] = sprintf('%s - %s', $valor['CategoriaIdioma']['id_category'], $valor['CategoriaIdioma']['name']);

			# Tabla todo
			$tabla = '<tr>';
	    	$tabla .= '<td><input type="hidden" name="data[Categoria][[*ID*]][id_category]" value="[*ID*]" class="js-input-id_category">[*ID*]</td>';
	    	$tabla .= '<td>[*NOMBRE*]</td>';
	    	$tabla .= '<td><button class="quitar btn btn-danger">Quitar</button></td>';
	    	$tabla .= '</tr>';

	    	// Armamos la tabla
			$tabla = str_replace('[*ID*]', $valor['CategoriaIdioma']['id_category'] , $tabla);
			$tabla = str_replace('[*NOMBRE*]', $valor['CategoriaIdioma']['name'] , $tabla);

			$arrayCategorias[$indice]['todo'] = $tabla;
		}

		echo json_encode($arrayCategorias);
		exit;

	}

	public function admin_buscarPalabraclaves($palabra = '', $idGrupo = '') {
		if (empty($palabra)) {
			echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
		}

		# Se obtiene el listado de categorias que tiene este grupo
		$palabraclavesDelGrupo = $this->Grupocaracteristica->GrupocaracteristicaPalabraclave->find('all', array(
			'conditions' => array(
				'GrupocaracteristicaPalabraclave.grupocaracteristica_id' => $idGrupo
				),
			'fields' => array(
				'GrupocaracteristicaPalabraclave.palabraclave_id'
				)
			));

		# Armamos las condiciones de la búsqueda base
		$options['conditions'] = array(
			'OR' => array(
				'Palabraclave.nombre LIKE "%' . $palabra . '%"',
				'Palabraclave.id LIKE "%' . $palabra . '%"' 
				)
			);

		# Consulta con grupo de categoria definido
		if ( ! empty($palabraclavesDelGrupo) ) {
			$options['conditions'] = array_replace_recursive($options['conditions'], array(
				'OR' => array(
					'Palabraclave.nombre LIKE "%' . $palabra . '%"',
					'Palabraclave.id LIKE "%' . $palabra . '%"' 
					),
				'AND' => array(
					'Palabraclave.id !=' => Hash::extract($palabraclavesDelGrupo, '{n}.GrupocaracteristicaPalabraclave.palabraclave_id')
					)
				));
		}

		# Buscamos las categorias que no este asociados a este grupo
		$palabraclaves  = $this->Grupocaracteristica->Palabraclave->find('all', $options);

		if (empty($palabraclaves)) {
			echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
		}
		
		$arrayPalabraclaves = array();
		
		# Creamos la lista de atributos
		foreach ($palabraclaves as $indice => $valor) {

			$arrayPalabraclaves[$indice]['id'] = $valor['Palabraclave']['id'];
			$arrayPalabraclaves[$indice]['value'] = sprintf('%s - %s', $valor['Palabraclave']['id'], $valor['Palabraclave']['nombre']);

			# Tabla todo
			$tabla = '<tr>';
	    	$tabla .= '<td><input type="hidden" name="data[Palabraclave][Palabraclave][[*ID*]]" value="[*ID*]" class="js-input-id_palabraclave">[*ID*]</td>';
	    	$tabla .= '<td>[*NOMBRE*]</td>';
	    	$tabla .= '<td><button class="quitar btn btn-danger">Quitar</button></td>';
	    	$tabla .= '</tr>';

	    	// Armamos la tabla
			$tabla = str_replace('[*ID*]', $valor['Palabraclave']['id'] , $tabla);
			$tabla = str_replace('[*NOMBRE*]', $valor['Palabraclave']['nombre'] , $tabla);

			$arrayPalabraclaves[$indice]['todo'] = $tabla;
		}

		echo json_encode($arrayPalabraclaves);
		exit;

	}


	public function admin_obtenerGrupo($palabra = '', $idGrupo = '') {
		if (empty($palabra)) {
			echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
		}

		# Armamos las condiciones de la búsqueda base
		$options['conditions'] = array(
			'OR' => array(
				'Grupocaracteristica.nombre LIKE "%' . $palabra . '%"',
				'Grupocaracteristica.id LIKE "%' . $palabra . '%"' 
				),
			'AND' => array(
				'Grupocaracteristica.tienda_id' => $this->Session->read('Tienda.id')
				)
			);

		# Buscamos las categorias que no este asociados a este grupo
		$grupos  = $this->Grupocaracteristica->find('all', $options);

		if (empty($grupos)) {
			echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
		}
		
		$arrayGrupos = array();
		
		# Creamos la lista de atributos
		foreach ($grupos as $indice => $valor) {

			$arrayGrupos[$indice]['id'] = $valor['Grupocaracteristica']['id'];
			$arrayGrupos[$indice]['value'] = sprintf('%s - %s', $valor['Grupocaracteristica']['id'], $valor['Grupocaracteristica']['nombre']);

			# Tabla todo
			$tabla = '<tr>';
	    	$tabla .= '<td><input type="hidden" name="data[Grupocaracteristica][Grupocaracteristica][[*ID*]]" value="[*ID*]" class="js-input-id_palabraclave">[*NOMBRE*]</td>';
	    	$tabla .= '<td><button class="quitar btn btn-xs btn-danger">Quitar</button></td>';
	    	$tabla .= '</tr>';

	    	// Armamos la tabla
			$tabla = str_replace('[*ID*]', $valor['Grupocaracteristica']['id'] , $tabla);
			$tabla = str_replace('[*NOMBRE*]', $valor['Grupocaracteristica']['nombre'] , $tabla);

			$arrayGrupos[$indice]['todo'] = $tabla;
		}

		echo json_encode($arrayGrupos);
		exit;

	}
}
