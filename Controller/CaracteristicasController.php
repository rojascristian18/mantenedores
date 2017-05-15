<?php
App::uses('AppController', 'Controller');
class CaracteristicasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$caracteristicas	= $this->paginate();
		$this->set(compact('caracteristicas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Caracteristica->create();
			if ( $this->Caracteristica->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$productos	= $this->Caracteristica->Producto->find('list');
		$especificaciones	= $this->Caracteristica->Especificacion->find('list');
		$this->set(compact('productos', 'especificaciones'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Caracteristica->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Caracteristica->save($this->request->data) )
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
			$this->request->data	= $this->Caracteristica->find('first', array(
				'conditions'	=> array('Caracteristica.id' => $id)
			));
		}
		
		$productos	= $this->Caracteristica->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Caracteristica->id = $id;
		if ( ! $this->Caracteristica->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Caracteristica->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Caracteristica->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Caracteristica->_schema);
		$modelo			= $this->Caracteristica->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
