<?php
App::uses('AppController', 'Controller');
class ProductosController extends AppController
{
	public function admin_index()
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor'));

		$this->paginate		= array(
			'recursive'			=> 0
		);
		$productos	= $this->paginate();
		$this->set(compact('productos'));
	}

	public function admin_add()
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor'));

		if ( $this->request->is('post') )
		{	
			$this->Producto->create();
			if ( $this->Producto->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		$tareas	= $this->Producto->Tarea->find('list');
		$grupocaracteristicas	= $this->Producto->Grupocaracteristica->find('list');
		$parentProductos	= $this->Producto->ParentProducto->find('list');
		$palabraclaves	= $this->Producto->Palabraclave->find('list');
		$proveedores = $this->Producto->Proveedor->find('list');
		$fabricantes = $this->Producto->Fabricante->find('list');
		$this->set(compact('tareas', 'grupocaracteristicas', 'parentProductos', 'proveedores', 'fabricantes'));
	}

	public function admin_edit($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor'));

		if ( ! $this->Producto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Producto->save($this->request->data) )
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
			$this->request->data	= $this->Producto->find('first', array(
				'conditions'	=> array('Producto.id' => $id)
			));
		}
		$tareas	= $this->Producto->Tarea->find('list');
		$grupocaracteristicas	= $this->Producto->Grupocaracteristica->find('list');
		$parentProductos	= $this->Producto->ParentProducto->find('list');
		$palabraclaves	= $this->Producto->Palabraclave->find('list');
		$proveedores = $this->Producto->Proveedor->find('list');
		$fabricantes = $this->Producto->Fabricante->find('list');
		$this->set(compact('tareas', 'grupocaracteristicas', 'parentProductos', 'proveedores', 'fabricantes'));
	}

	public function admin_delete($id = null)
	{
		$this->Producto->id = $id;
		if ( ! $this->Producto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Producto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Producto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Producto->_schema);
		$modelo			= $this->Producto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
