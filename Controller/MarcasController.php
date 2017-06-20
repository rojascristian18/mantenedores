<?php
App::uses('AppController', 'Controller');
class MarcasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0,
			'conditions' => array(
				'Marca.tienda_id' => $this->Session->read('Tienda.id')
				)
		);
		$marcas	= $this->paginate();
		$this->set(compact('marcas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Marca->create();
			if ( $this->Marca->save($this->request->data) )
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
		if ( ! $this->Marca->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Marca->save($this->request->data) )
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
			$this->request->data	= $this->Marca->find('first', array(
				'conditions'	=> array('Marca.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->Marca->id = $id;
		if ( ! $this->Marca->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Marca->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Marca->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Marca->_schema);
		$modelo			= $this->Marca->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function admin_activar( $id = null ) {
		$this->Marca->id = $id;
		if ( ! $this->Marca->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Marca->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->Marca->id = $id;
		if ( ! $this->Marca->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Marca->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}
}
