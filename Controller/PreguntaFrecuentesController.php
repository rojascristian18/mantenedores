<?php
App::uses('AppController', 'Controller');
class PreguntaFrecuentesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0,
			'order' => array('orden' => 'ASC')
		);
		$preguntaFrecuentes	= $this->paginate();
		$this->set(compact('preguntaFrecuentes'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->PreguntaFrecuente->create();
			if ( $this->PreguntaFrecuente->save($this->request->data) )
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
		if ( ! $this->PreguntaFrecuente->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->PreguntaFrecuente->save($this->request->data) )
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
			$this->request->data	= $this->PreguntaFrecuente->find('first', array(
				'conditions'	=> array('PreguntaFrecuente.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->PreguntaFrecuente->id = $id;
		if ( ! $this->PreguntaFrecuente->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		#$this->request->onlyAllow('post', 'delete');
		if ( $this->PreguntaFrecuente->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->PreguntaFrecuente->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->PreguntaFrecuente->_schema);
		$modelo			= $this->PreguntaFrecuente->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function admin_activar( $id = null ) {
		$this->PreguntaFrecuente->id = $id;
		if ( ! $this->PreguntaFrecuente->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->PreguntaFrecuente->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->PreguntaFrecuente->id = $id;
		if ( ! $this->PreguntaFrecuente->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->PreguntaFrecuente->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}


	public function admin_ordenar() {
		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if (!empty($this->request->data['PreguntaFrecuente'])) {
				
				if ($this->PreguntaFrecuente->saveMany($this->request->data['PreguntaFrecuente'])) {
					echo "Orden guardado";
					exit;
				}else{
					prx($this->PreguntaFrecuente->validationErrors);
					exit;
				}

			}
		}
		exit;
	}



	/**
	* Mantanedores
	*/

	public function maintainers_index()
	{
		$preguntaFrecuentes = $this->PreguntaFrecuente->find('all', array(
			'conditions' => array(
				'PreguntaFrecuente.respuesta !=' => null,
				'PreguntaFrecuente.activo' => 1
				),
			'order' => array('PreguntaFrecuente.orden' => 'ASC')
			));

		BreadcrumbComponent::add('Preguntas Frecuentes ');

		$this->set(compact('preguntaFrecuentes'));
	}
}
