<?php
App::uses('AppController', 'Controller');
class GrupocaracteristicasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$grupocaracteristicas	= $this->paginate();
		$this->set(compact('grupocaracteristicas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Grupocaracteristica->create();
			if ( $this->Grupocaracteristica->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$tiendas	= $this->Grupocaracteristica->Tienda->find('list');
		$this->set(compact('tiendas'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Grupocaracteristica->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Grupocaracteristica->save($this->request->data) )
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
			$this->request->data	= $this->Grupocaracteristica->find('first', array(
				'conditions'	=> array('Grupocaracteristica.id' => $id)
			));
		}
		$tiendas	= $this->Grupocaracteristica->Tienda->find('list');
		$this->set(compact('tiendas'));
	}

	public function admin_delete($id = null)
	{
		$this->Grupocaracteristica->id = $id;
		if ( ! $this->Grupocaracteristica->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Grupocaracteristica->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Grupocaracteristica->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Grupocaracteristica->_schema);
		$modelo			= $this->Grupocaracteristica->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
