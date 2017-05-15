<?php
App::uses('AppController', 'Controller');
class ProductosCaracteristicasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$productosCaracteristicas	= $this->paginate();
		$this->set(compact('productosCaracteristicas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->ProductosCaracteristica->create();
			if ( $this->ProductosCaracteristica->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->ProductosCaracteristica->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->ProductosCaracteristica->save($this->request->data) )
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
			$this->request->data	= $this->ProductosCaracteristica->find('first', array(
				'conditions'	=> array('ProductosCaracteristica.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->ProductosCaracteristica->id = $id;
		if ( ! $this->ProductosCaracteristica->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->ProductosCaracteristica->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->ProductosCaracteristica->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->ProductosCaracteristica->_schema);
		$modelo			= $this->ProductosCaracteristica->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
