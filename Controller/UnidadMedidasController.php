<?php
App::uses('AppController', 'Controller');
class UnidadMedidasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$unidadMedidas	= $this->paginate();
		$this->set(compact('unidadMedidas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->UnidadMedida->create();
			if ( $this->UnidadMedida->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('controller' => 'unidadMedidas', 'action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
				$this->redirect(array('controller' => 'unidadMedidas', 'action' => 'index'));
			}
		}

		$this->redirect(array('controller' => 'unidadMedidas', 'action' => 'index'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->UnidadMedida->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->UnidadMedida->save($this->request->data) )
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
			$this->request->data	= $this->UnidadMedida->find('first', array(
				'conditions'	=> array('UnidadMedida.id' => $id)
			));
		}

		//$especiales = explode('||', $this->request->data['UnidadMedida']['permitidos']);
		
	}

	public function admin_delete($id = null)
	{
		$this->UnidadMedida->id = $id;
		if ( ! $this->UnidadMedida->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->UnidadMedida->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->UnidadMedida->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->UnidadMedida->_schema);
		$modelo			= $this->UnidadMedida->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function admin_activar( $id = null ) {
		$this->UnidadMedida->id = $id;
		if ( ! $this->UnidadMedida->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->UnidadMedida->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->UnidadMedida->id = $id;
		if ( ! $this->UnidadMedida->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->UnidadMedida->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}
}
