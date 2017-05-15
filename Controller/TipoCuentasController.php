<?php
App::uses('AppController', 'Controller');
class TipoCuentasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$tipoCuentas	= $this->paginate();
		$this->set(compact('tipoCuentas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->TipoCuenta->create();
			if ( $this->TipoCuenta->save($this->request->data) )
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
		if ( ! $this->TipoCuenta->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->TipoCuenta->save($this->request->data) )
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
			$this->request->data	= $this->TipoCuenta->find('first', array(
				'conditions'	=> array('TipoCuenta.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->TipoCuenta->id = $id;
		if ( ! $this->TipoCuenta->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->TipoCuenta->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->TipoCuenta->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->TipoCuenta->_schema);
		$modelo			= $this->TipoCuenta->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
