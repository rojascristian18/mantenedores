<?php
App::uses('AppController', 'Controller');
class NotificacionesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$notificaciones	= $this->paginate();
		$this->set(compact('notificaciones'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Notificacion->create();
			if ( $this->Notificacion->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$usuarios	= $this->Notificacion->Usuario->find('list');
		$importancias	= $this->Notificacion->Importancia->find('list');
		$tareas	= $this->Notificacion->Tarea->find('list');
		$this->set(compact('usuarios', 'importancias', 'tareas'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Notificacion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Notificacion->save($this->request->data) )
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
			$this->request->data	= $this->Notificacion->find('first', array(
				'conditions'	=> array('Notificacion.id' => $id)
			));
		}
		$usuarios	= $this->Notificacion->Usuario->find('list');
		$importancias	= $this->Notificacion->Importancia->find('list');
		$tareas	= $this->Notificacion->Tarea->find('list');
		$this->set(compact('usuarios', 'importancias', 'tareas'));
	}

	public function admin_delete($id = null)
	{
		$this->Notificacion->id = $id;
		if ( ! $this->Notificacion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Notificacion->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Notificacion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Notificacion->_schema);
		$modelo			= $this->Notificacion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
