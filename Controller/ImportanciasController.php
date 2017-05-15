<?php
App::uses('AppController', 'Controller');
class ImportanciasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$importancias	= $this->paginate();
		$this->set(compact('importancias'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Importancia->create();
			if ( $this->Importancia->save($this->request->data) )
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
		if ( ! $this->Importancia->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Importancia->save($this->request->data) )
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
			$this->request->data	= $this->Importancia->find('first', array(
				'conditions'	=> array('Importancia.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->Importancia->id = $id;
		if ( ! $this->Importancia->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Importancia->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Importancia->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Importancia->_schema);
		$modelo			= $this->Importancia->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
