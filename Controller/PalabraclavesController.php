<?php
App::uses('AppController', 'Controller');
class PalabraclavesController extends AppController
{
	public function admin_index()
	{	
		$paginate = array(
			'recursive' => 0
			); 
    	$conditions = array();
    	$total = 0;
    	$totalMostrados = 0;

    	$textoBuscar = null;

    	// Filtrado de productos por formulario
		if ( $this->request->is('post') ) {
			if ( empty($this->request->data['Filtro']['palabra']) ) {
				$this->Session->setFlash('Ingrese alguna coincidencia' , null, array(), 'danger');
				$this->redirect(array('action' => 'index'));
			}
			if ( ! empty($this->request->data['Filtro']['palabra']) ) {
				$this->redirect(array('controller' => 'palabraclaves', 'action' => 'index', 'palabra' => $this->request->data['Filtro']['palabra']));
			}
		}

		/**
		* Buscar por
		*/
		if ( ! empty($this->request->params['named']['palabra']) ) {
			$paginate		= array_replace_recursive($paginate, array(
				'conditions'	=> array(
					'Palabraclave.nombre LIKE "%' . trim($this->request->params['named']['palabra']) . '%"'
				)
			));

			// Texto ingresado en el campo buscar
			$textoBuscar = $this->request->params['named']['palabra'];
			
		}else if ( ! empty($this->request->params['named']['palabra'])) {
			$this->Session->setFlash('No se aceptan campos vacios.' ,  null, array(), 'danger');
		}

		$total = $this->Palabraclave->find('count');

		$this->paginate		= $paginate;

		$palabraclaves	= $this->paginate();

		$totalMostrados = count($palabraclaves);

		$this->set(compact('palabraclaves', 'total', 'totalMostrados', 'textoBuscar'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Palabraclave->create();
			if ( $this->Palabraclave->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$productos	= $this->Palabraclave->Producto->find('list');
		//$tareas	= $this->Palabraclave->Tarea->find('list');
		$this->set(compact('productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Palabraclave->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Palabraclave->save($this->request->data) )
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
			$this->request->data	= $this->Palabraclave->find('first', array(
				'conditions'	=> array('Palabraclave.id' => $id)
			));
		}
		$productos	= $this->Palabraclave->Producto->find('list');
		#$tareas	= $this->Palabraclave->Tarea->find('list');
		$this->set(compact('productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Palabraclave->id = $id;
		if ( ! $this->Palabraclave->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Palabraclave->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Palabraclave->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Palabraclave->_schema);
		$modelo			= $this->Palabraclave->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function admin_activar( $id = null ) {
		$this->Palabraclave->id = $id;
		if ( ! $this->Palabraclave->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Palabraclave->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->Palabraclave->id = $id;
		if ( ! $this->Palabraclave->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Palabraclave->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_obtenerPalabraclave ($palabra = '') {
		if (empty($palabra)) {
			echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
		}

		# Armamos las condiciones de la búsqueda base
		$options['conditions'] = array(
				'Palabraclave.nombre LIKE "%' . $palabra . '%"'
			);

		# Buscamos las palabras claves
		$palabraclaves  = $this->Palabraclave->find('all', $options);
		
		$arrayPalabrasClaves = array();
		
		# Creamos la lista de palabras claves
		foreach ($palabraclaves as $indice => $valor) {

			$arrayPalabrasClaves[$indice]['id'] = $valor['Palabraclave']['id'];
			$arrayPalabrasClaves[$indice]['value'] = $valor['Palabraclave']['nombre'];

			# Tabla todo
			$tabla = '<tr>';
	    	$tabla .= '<td><input type="hidden" name="data[Palabraclave][Palabraclave][]" value="[*ID*]" class="js-input-id_plabraclave">[*NOMBRE*]</td>';
	    	$tabla .= '<td><button class="quitar btn btn-danger btn-xs">Quitar</button></td>';
	    	$tabla .= '</tr>';

	    	// Armamos la tabla
			$tabla = str_replace('[*ID*]', $valor['Palabraclave']['id'] , $tabla);
			$tabla = str_replace('[*NOMBRE*]', $valor['Palabraclave']['nombre'] , $tabla);

			$arrayPalabrasClaves[$indice]['todo'] = $tabla;
		}

		echo json_encode($arrayPalabrasClaves);
		exit;
	}
}
