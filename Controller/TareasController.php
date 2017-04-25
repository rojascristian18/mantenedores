<?php
App::uses('AppController', 'Controller');
class TareasController extends AppController
{
	public function admin_index()
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

		$paginate = array();

		// Opciones de paginación
		$paginate = array_replace_recursive(array(
			'limit' => 10,
			//'fields' => array(),
			//'joins' => array(),
			//'contain' => array(),
			'conditions' => array(
					'Tarea.tienda_id' => $this->Session->read('Tienda.id'),
					'Tarea.parent_id' => null
				),
			'recursive'	=> 0,
			'order' => 'Tarea.id DESC'
		));



		$this->paginate		= $paginate;
		$tareas	= $this->paginate();

		$this->set(compact('tareas'));
	}

	public function admin_add()
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

		if ( $this->request->is('post') )
		{
			$this->Tarea->create();
			if ( $this->Tarea->saveAll($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		$usuarios	= $this->Tarea->Usuario->find('list');
		$palabraclaves	= $this->Tarea->Palabraclave->find('list');
		$idiomas = $this->Tarea->Idioma->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$shops = $this->Tarea->Shop->find('list');
		
		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops','palabraclaves'));
	}

	public function admin_edit($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			# Se eliminan los adjuntos
			$this->quitarAdjuntos($this->request->data['Tarea']['ElementosEliminados']);
			
			# Eliminar rel palabras claves
			$this->Tarea->PalabraclaveTarea->deleteAll(array('PalabraclaveTarea.tarea_id' => $id));
			
			if ( $this->Tarea->saveAll($this->request->data) )
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
			$this->request->data	= $this->Tarea->find('first', array(
				'conditions'	=> array('Tarea.id' => $id),
				'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'ParentTarea', 'Palabraclave', 'Adjunto')
			));
		}

		$usuarios	= $this->Tarea->Usuario->find('list');
		$parentTareas	= $this->Tarea->ParentTarea->find('list');
		$palabraclaves	= $this->Tarea->Palabraclave->find('list');
		$idiomas = $this->Tarea->Idioma->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$shops = $this->Tarea->Shop->find('list');
		$revisiones = $this->obtenerRevisiones();
		
		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops', 'parentTareas', 'tiendas', 'palabraclaves', 'revisiones'));
	}


	public function admin_review($id = null)
	{
		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			prx($this->request->data);
		}
		else
		{	
			# Cambiamos el datasource de los modelos que necesitamos externos
			$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

			$this->request->data	= $this->Tarea->find('first', array(
				'conditions'	=> array('Tarea.id' => $id),
				'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'ParentTarea', 'Palabraclave', 'Adjunto')
			));
		}

		prx($this->request->data);
	}

	public function admin_delete($id = null)
	{
		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Tarea->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_activar( $id = null ) {
		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Tarea->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Tarea->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Tarea->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Tarea->_schema);
		$modelo			= $this->Tarea->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function guardarRevision() {

		
	}

	public function obtenerRevisiones() {
		$revisiones =  $this->Tarea->find('all', array(
			'conditions' => array(
				'Tarea.parent_id' => $this->request->data['Tarea']['id']
				),
			'fields' => array(
				'Tarea.id', 'Tarea.nombre', 'Tarea.created' 
				),
			'order' => array(
				'Tarea.created' => 'DESC'
				)
			));

		if (empty($revisiones)) {
			return array('0' => 'Sin revisiones');
		}else{
			return $revisiones;
		}
	}
}
