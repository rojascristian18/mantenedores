<?php
App::uses('AppController', 'Controller');
class ConfiguracionesController extends AppController
{
	public function admin_index($id = null)
	{	
		# Seteamos la configuración única
		if (is_null($id)) {
			$id = 1;	
		}
		
		if ( ! $this->Configuracion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('controller' => 'tareas', 'action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Configuracion->save($this->request->data) )
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
			$this->request->data = $this->Configuracion->find('first', array(
				'conditions' => array('Configuracion.id' => $id)
			));
		}

	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Configuracion->create();
			if ( $this->Configuracion->save($this->request->data) )
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
		if ( ! $this->Configuracion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Configuracion->save($this->request->data) )
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
			$this->request->data	= $this->Configuracion->find('first', array(
				'conditions'	=> array('Configuracion.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->Configuracion->id = $id;
		if ( ! $this->Configuracion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Configuracion->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Configuracion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Configuracion->_schema);
		$modelo			= $this->Configuracion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
