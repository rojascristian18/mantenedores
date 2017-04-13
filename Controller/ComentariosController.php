<?php
App::uses('AppController', 'Controller');
class ComentariosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$comentarios	= $this->paginate();
		$this->set(compact('comentarios'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Comentario->create();
			if ( $this->Comentario->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$parentComentarios	= $this->Comentario->ParentComentario->find('list');
		$tareas	= $this->Comentario->Tarea->find('list');
		$importancias	= $this->Comentario->Importancia->find('list');
		$this->set(compact('parentComentarios', 'tareas', 'importancias'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Comentario->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Comentario->save($this->request->data) )
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
			$this->request->data	= $this->Comentario->find('first', array(
				'conditions'	=> array('Comentario.id' => $id)
			));
		}
		$parentComentarios	= $this->Comentario->ParentComentario->find('list');
		$tareas	= $this->Comentario->Tarea->find('list');
		$importancias	= $this->Comentario->Importancia->find('list');
		$this->set(compact('parentComentarios', 'tareas', 'importancias'));
	}

	public function admin_delete($id = null)
	{
		$this->Comentario->id = $id;
		if ( ! $this->Comentario->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Comentario->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Comentario->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Comentario->_schema);
		$modelo			= $this->Comentario->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
