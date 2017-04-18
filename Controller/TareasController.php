<?php
App::uses('AppController', 'Controller');
class TareasController extends AppController
{
	public function admin_index()
	{	

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
		if ( $this->request->is('post') )
		{
			$this->Tarea->create();
			if ( $this->Tarea->save($this->request->data) )
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
		$administradores	= $this->Tarea->Administrador->find('list');
		$parentTareas	= $this->Tarea->ParentTarea->find('list');
		$categoriatareas	= $this->Tarea->Categoriatarea->find('list');
		$tiendas	= $this->Tarea->Tienda->find('list');
		$palabraclaves	= $this->Tarea->Palabraclave->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$idiomas = $this->obtenerIdiomaTarea();
		$shops = $this->obtenerShopTarea();

		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops','administradores', 'parentTareas', 'categoriatareas', 'tiendas', 'palabraclaves'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			# Guardar Revisión
			$this->guardarRevision();
			
			if ( $this->Tarea->save($this->request->data) )
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
				'conditions'	=> array('Tarea.id' => $id)
			));
		}
		$usuarios	= $this->Tarea->Usuario->find('list');
		$administradores	= $this->Tarea->Administrador->find('list');
		$parentTareas	= $this->Tarea->ParentTarea->find('list');
		$categoriatareas	= $this->Tarea->Categoriatarea->find('list');
		$tiendas	= $this->Tarea->Tienda->find('list');
		$palabraclaves	= $this->Tarea->Palabraclave->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$idiomas = $this->obtenerIdiomaTarea();
		$shops = $this->obtenerShopTarea();

		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops','administradores', 'parentTareas', 'categoriatareas', 'tiendas', 'palabraclaves'));
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

		$revision = $this->request->data;
		$revision['Tarea']['parent_id'] = $revision['Tarea']['id'];
		unset($revision['Tarea']['id']);

		$this->Tarea->create();
		if ( $this->Tarea->save($revision) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
