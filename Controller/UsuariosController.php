<?php
App::uses('AppController', 'Controller');
class UsuariosController extends AppController
{	
	/**
	 *  Métodos para administrador
	 */
	public function admin_login()
	{
		if ( $this->request->is('post') )
		{
			if ( $this->Auth->login() )
			{
				$this->redirect($this->Auth->redirectUrl());
			}
			else
			{
				$this->Session->setFlash('Nombre de usuario y/o clave incorrectos.', null, array(), 'danger');
			}
		}
		$this->layout	= 'login';
	}

	public function admin_logout()
	{
		$this->redirect($this->Auth->logout());
	}

	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0,
			'contain' => array(
				'Calificacion'
				)
		);
		$usuarios	= $this->paginate();
		$this->set(compact('usuarios'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Usuario->create();
			if ( $this->Usuario->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$tareas	= $this->Usuario->Tarea->find('list');
		$codigopaises	= $this->Usuario->Codigopaise->find('list', array('conditions' => array('activo' => 1)));
		$this->set(compact('tareas', 'codigopaises'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Usuario->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Usuario->save($this->request->data) )
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
			$this->request->data	= $this->Usuario->find('first', array(
				'conditions'	=> array('Usuario.id' => $id)
			));
		}
		$tareas	= $this->Usuario->Tarea->find('list');
		$this->set(compact('tareas'));
	}

	public function admin_delete($id = null)
	{
		$this->Usuario->id = $id;
		if ( ! $this->Usuario->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Usuario->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Usuario->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Usuario->_schema);
		$modelo			= $this->Usuario->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function admin_activar( $id = null ) {
		$this->Usuario->id = $id;
		if ( ! $this->Usuario->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Usuario->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->Usuario->id = $id;
		if ( ! $this->Usuario->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Usuario->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}


	/**
	 * Métodos para Mantenedores
	 */

	public function maintainers_login()
	{
		if ( $this->request->is('post') )
		{
			if ( $this->Auth->login() )
			{
				$this->redirect($this->Auth->redirectUrl());
			}
			else
			{
				$this->Session->setFlash('Nombre de usuario y/o clave incorrectos.', null, array(), 'danger');
			}
		}
		$this->layout	= 'login';
	}

	public function maintainers_logout()
	{
		$this->redirect($this->Auth->logout());
	}

	public function maintainers_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$usuarios	= $this->paginate();
		$this->set(compact('usuarios'));
	}

	public function maintainers_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Usuario->create();
			if ( $this->Usuario->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$tareas	= $this->Usuario->Tarea->find('list');
		$this->set(compact('tareas'));
	}

	public function maintainers_edit($id = null)
	{
		if ( ! $this->Usuario->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Usuario->save($this->request->data) )
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
			$this->request->data	= $this->Usuario->find('first', array(
				'conditions'	=> array('Usuario.id' => $id)
			));
		}
		$tareas	= $this->Usuario->Tarea->find('list');
		$this->set(compact('tareas'));
	}

	public function maintainers_delete($id = null)
	{
		$this->Usuario->id = $id;
		if ( ! $this->Usuario->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Usuario->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function maintainers_exportar()
	{
		$datos			= $this->Usuario->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Usuario->_schema);
		$modelo			= $this->Usuario->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
