<?php
App::uses('AppController', 'Controller');
class CodigopaisesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$codigopaises	= $this->paginate();
		$this->set(compact('codigopaises'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Codigopaise->create();
			if ( $this->Codigopaise->save($this->request->data) )
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
		if ( ! $this->Codigopaise->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Codigopaise->save($this->request->data) )
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
			$this->request->data	= $this->Codigopaise->find('first', array(
				'conditions'	=> array('Codigopaise.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->Codigopaise->id = $id;
		if ( ! $this->Codigopaise->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Codigopaise->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Codigopaise->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Codigopaise->_schema);
		$modelo			= $this->Codigopaise->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
