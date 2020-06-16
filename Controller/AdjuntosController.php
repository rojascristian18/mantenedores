<?php
App::uses('AppController', 'Controller');
class AdjuntosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$adjuntos	= $this->paginate();
		$this->set(compact('adjuntos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Adjunto->create();
			if ( $this->Adjunto->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$tareas	= $this->Adjunto->Tarea->find('list');
		$this->set(compact('tareas'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Adjunto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Adjunto->save($this->request->data) )
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
			$this->request->data	= $this->Adjunto->find('first', array(
				'conditions'	=> array('Adjunto.id' => $id)
			));
		}
		$tareas	= $this->Adjunto->Tarea->find('list');
		$this->set(compact('tareas'));
	}

	public function admin_delete($id = null)
	{
		$this->Adjunto->id = $id;
		if ( ! $this->Adjunto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Adjunto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Adjunto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Adjunto->_schema);
		$modelo			= $this->Adjunto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
