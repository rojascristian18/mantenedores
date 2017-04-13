<?php
App::uses('AppController', 'Controller');
class CategoriatareasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$categoriatareas	= $this->paginate();
		$this->set(compact('categoriatareas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Categoriatarea->create();
			if ( $this->Categoriatarea->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$parentCategoriatareas	= $this->Categoriatarea->ParentCategoriatarea->find('list');
		$this->set(compact('parentCategoriatareas'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Categoriatarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Categoriatarea->save($this->request->data) )
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
			$this->request->data	= $this->Categoriatarea->find('first', array(
				'conditions'	=> array('Categoriatarea.id' => $id)
			));
		}
		$parentCategoriatareas	= $this->Categoriatarea->ParentCategoriatarea->find('list');
		$this->set(compact('parentCategoriatareas'));
	}

	public function admin_delete($id = null)
	{
		$this->Categoriatarea->id = $id;
		if ( ! $this->Categoriatarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Categoriatarea->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Categoriatarea->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Categoriatarea->_schema);
		$modelo			= $this->Categoriatarea->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
