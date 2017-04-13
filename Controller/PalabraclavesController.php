<?php
App::uses('AppController', 'Controller');
class PalabraclavesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$palabraclaves	= $this->paginate();
		$this->set(compact('palabraclaves'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Palabraclave->create();
			if ( $this->Palabraclave->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$productos	= $this->Palabraclave->Producto->find('list');
		$tareas	= $this->Palabraclave->Tarea->find('list');
		$this->set(compact('productos', 'tareas'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Palabraclave->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Palabraclave->save($this->request->data) )
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
			$this->request->data	= $this->Palabraclave->find('first', array(
				'conditions'	=> array('Palabraclave.id' => $id)
			));
		}
		$productos	= $this->Palabraclave->Producto->find('list');
		$tareas	= $this->Palabraclave->Tarea->find('list');
		$this->set(compact('productos', 'tareas'));
	}

	public function admin_delete($id = null)
	{
		$this->Palabraclave->id = $id;
		if ( ! $this->Palabraclave->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Palabraclave->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Palabraclave->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Palabraclave->_schema);
		$modelo			= $this->Palabraclave->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
