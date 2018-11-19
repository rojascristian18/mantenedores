<?php
App::uses('AppController', 'Controller');
class CalificacionesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$calificaciones	= $this->paginate();
		$this->set(compact('calificaciones'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Calificacion->create();
			if ( $this->Calificacion->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$usuarios	= $this->Calificacion->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Calificacion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Calificacion->save($this->request->data) )
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
			$this->request->data	= $this->Calificacion->find('first', array(
				'conditions'	=> array('Calificacion.id' => $id)
			));
		}
		$usuarios	= $this->Calificacion->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	public function admin_delete($id = null)
	{
		$this->Calificacion->id = $id;
		if ( ! $this->Calificacion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Calificacion->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Calificacion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Calificacion->_schema);
		$modelo			= $this->Calificacion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
