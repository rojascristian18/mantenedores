<?php
App::uses('AppController', 'Controller');
class CuentasController extends AppController
{
	public function maintainers_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$cuentas	= $this->paginate();
		$this->set(compact('cuentas'));
	}

	public function maintainers_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Cuenta->create();
			if ( $this->Cuenta->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$usuarios	= $this->Cuenta->Usuario->find('list');
		$bancos	= $this->Cuenta->Banco->find('list');
		$tipoCuentas	= $this->Cuenta->TipoCuenta->find('list');
		$this->set(compact('usuarios', 'bancos', 'tipoCuentas'));
	}

	public function maintainers_edit($id = null)
	{
		if ( ! $this->Cuenta->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Cuenta->save($this->request->data) )
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
			$this->request->data	= $this->Cuenta->find('first', array(
				'conditions'	=> array('Cuenta.id' => $id)
			));
		}
		$usuarios	= $this->Cuenta->Usuario->find('list');
		$bancos	= $this->Cuenta->Banco->find('list');
		$tipoCuentas	= $this->Cuenta->TipoCuenta->find('list');
		$this->set(compact('usuarios', 'bancos', 'tipoCuentas'));
	}

	public function maintainers_delete($id = null)
	{
		$this->Cuenta->id = $id;
		if ( ! $this->Cuenta->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Cuenta->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function maintainers_exportar()
	{
		$datos			= $this->Cuenta->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Cuenta->_schema);
		$modelo			= $this->Cuenta->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
