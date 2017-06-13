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

	public function admin_review($id = null) {
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));

		if ( ! $this->Producto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->data = $this->Producto->find('first', array(
			'conditions' => array(
				'Producto.id' => $id
				),
			'contain' => array(
				'Especificacion' => array(
					'Idioma'
					),
				'Proveedor',
				'Fabricante',
				'Imagen',
				'Tarea',
				'Grupocaracteristica'
				)
			)
		);

		BreadcrumbComponent::add('Producto #' . $id);
	}


	public function admin_view($id = null) {
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));

		if ( ! $this->Producto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->data = $this->Producto->find('first', array(
			'conditions' => array(
				'Producto.id' => $id
				),
			'contain' => array(
				'Especificacion' => array(
					'Idioma'
					),
				'Proveedor',
				'Fabricante',
				'Imagen',
				'Tarea',
				'Grupocaracteristica'
				)
			)
		);

		BreadcrumbComponent::add('Producto #' . $id);
	}

	public function admin_accept($id = null, $tarea = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));

		if ( ! $this->Producto->exists($id) )
		{
			$this->Session->setFlash('No se encontró el producto.', null, array(), 'danger');
			$this->redirect(array('action' => 'review', $id));
		}

		if ( $this->request->is('post') )
		{	

			// Cambiar a aceptado el producto
			$this->Producto->id = $id;
			if ( $this->Producto->saveField('aceptado', 1) )
			{
				$this->Session->setFlash('Producto validado con éxito', null, array(), 'success');
				$this->redirect(array('controller' => 'tareas', 'action' => 'edit', $tarea));
			}
			else
			{
				$this->Session->setFlash('Error al validar el producto. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}else{
			$this->Session->setFlash('Producto validado con éxito', null, array(), 'success');
			$this->redirect(array('controller' => 'tareas', 'action' => 'edit', $tarea));
		}
	}


	public function admin_refuse($id = null, $tarea = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));

		if ( ! $this->Producto->exists($id) )
		{
			$this->Session->setFlash('No se encontró el producto.', null, array(), 'danger');
			$this->redirect(array('action' => 'review', $id));
		}

		if ( $this->request->is('post') )
		{	

			// Cambiar a rechazado el producto
			$this->Producto->id = $id;
			if ( $this->Producto->saveField('aceptado', 0) )
			{
				$this->Session->setFlash('Producto rechazado con éxito', null, array(), 'success');
				$this->redirect(array('controller' => 'tareas', 'action' => 'edit', $tarea));
			}
			else
			{
				$this->Session->setFlash('Error al rechazar el producto. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}else{
			$this->redirect(array('controller' => 'tareas', 'action' => 'edit', $tarea));
		}
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


	// Métodos para matenedores
	// 
	//
	
	public function validarCampos() {
		if (isset($this->request->data['Producto'])) {
			foreach ($this->request->data as $key => $campo) {
				if (is_array($campo)) {
					foreach ($campo as $k => $v) {
						if (empty($v)) {
							return false;
						}else{
							if (is_array($v)) {
								foreach ($v as $ix => $val) {
									if (empty($val)) {
										return false;
									}
								}
							}
						}
					}
				}
			}
			return true;
		}
	}


	public function validarImagenes() {
		if ( !empty($this->request->data['Imagen']) ) {
			foreach ($this->request->data['Imagen'] as $key => $imagen) {
			 	if ( isset($imagen['imagen']) && $imagen['imagen']['error'] > 0 ) {
			 		return false;
			 	}
			 } 
		}

		return true;
	}

	
	public function limpiarImagenes() {
		if ( !empty($this->request->data['Imagen']) ) {
			foreach ($this->request->data['Imagen'] as $key => $imagen) {
			 	if ( isset($imagen['imagen']) && $imagen['imagen']['error'] > 0 ) {
			 		unset($this->request->data['Imagen'][$key]);
			 	}
			 } 
		}

		return $this->request->data;
	}


	public function maintainers_add($tarea = null) {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));

		if ( $this->request->is('post') )
		{	
			# Validar imagenes y campos
			if( ! $this->validarCampos() || ! $this->validarImagenes()) {
				$this->Session->setFlash('Error al guardar el producto. No completó los campos obligatorios.', null, array(), 'danger');
				$this->redirect(array('action' => 'add', $this->request->data['Producto']['tarea_id']));
			}

			# Quitar puntos a precio
			if (isset($this->request->data['Producto']['precio'])) {
				$this->request->data['Producto']['precio'] = str_replace('.', '', $this->request->data['Producto']['precio']);
			}

			$this->Producto->create();
			if ( $this->Producto->saveAll($this->request->data) )
			{
				$this->Session->setFlash('Producto agregado correctamente.', null, array(), 'success');
				$this->redirect(array('controller' => 'tareas', 'action' => 'work', $this->request->data['Producto']['tarea_id']));
			}
			else
			{	
				$errores = '<ul>';
				foreach ($this->Producto->validationErrors as $key => $error) {
					$errores .= '<li>' . $error[0] . '</li>'; 
				}
				$errores .= '</ul>';
				
				$this->Session->setFlash('Por favor corrija los siguientes errores:' . $errores, null, array(), 'danger');
				$this->redirect(array('controller' => 'tareas', 'action' => 'add', $this->request->data['Producto']['tarea_id']));
			}
		}
		
		# Verificamos existencia y elación de la tarea
		$miTarea = ClassRegistry::init('Tarea')->find('first', array(
			'conditions' => array(
				'Tarea.id' => $tarea,
				'Tarea.usuario_id' => $this->Auth->user('id')
				),
			'contain' => array(
				'Grupocaracteristica',
				'Adjunto'
				)
			));

		if (empty($miTarea)) {
			$this->Session->setFlash('La tarea seleccionada no existe o ya no está asignada a usted.', null, array(), 'danger');
			$this->redirect(array('action' => 'work', $tarea));
		}
		
		# Grupos disponibles en esta tarea padre
		$grupocaracteristicas = $this->Producto->Grupocaracteristica->find('list', array(
			'conditions' => array(
				'Grupocaracteristica.id' => Hash::extract($miTarea['Grupocaracteristica'], '{n}.id')
				)
			));

		$proveedores = $this->Producto->Proveedor->find('list');
		$fabricantes = $this->Producto->Fabricante->find('list');

		BreadcrumbComponent::add(sprintf('Agregar producto a Tarea %s', $miTarea['Tarea']['nombre']));
		
		$this->set(compact('miTarea', 'grupocaracteristicas', 'proveedores', 'fabricantes'));
	}


	public function maintainers_edit($id = null, $tarea = null) {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));

		if ( ! $this->Producto->exists($id) )
		{
			$this->Session->setFlash('Registro no existe.', null, array(), 'danger');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $this->request->data['Producto']['tarea_id']));
		}

		if ( ! $this->esMiProducto($id, $tarea) ) {
			$this->Session->setFlash('Este producto no pertenece a usted.', null, array(), 'danger');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $this->request->data['Producto']['tarea_id']));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	

			# Se eliminan las imagenes
			if ( !empty($this->request->data['Producto']['ElementosEliminados']) ) {
				$this->quitarElementos($this->request->data['Producto']['ElementosEliminados'], 'Imagen');
			}else{
				unset($this->request->data['Producto']['ElementosEliminados']);
			}

			if( ! $this->validarCampos()) {
				$this->Session->setFlash('Error al guardar el producto. No completó los campos obligatorios.', null, array(), 'danger');
				$this->redirect(array('action' => 'edit', $id ,$this->request->data['Producto']['tarea_id']));
			}
		
			// Limpiamos las especificaciones
			$this->Producto->EspecificacionesProducto->deleteAll(array('producto_id' => $id));

			# Limpiar imagenes vacias
			$this->limpiarImagenes();

			# Quitar puntos a precio
			if (isset($this->request->data['Producto']['precio'])) {
				$this->request->data['Producto']['precio'] = str_replace('.', '', $this->request->data['Producto']['precio']);
			}

			if ( $this->Producto->saveAll($this->request->data) )
			{
				$this->Session->setFlash('Producto editado correctamente.', null, array(), 'success');
				$this->redirect(array('controller' => 'tareas', 'action' => 'work', $this->request->data['Producto']['tarea_id']));
			}
			else
			{	
				$errores = '<ul>';
				foreach ($this->Producto->validationErrors as $key => $error) {
					$errores .= '<li>' . $error[0] . '</li>'; 
				}
				$errores .= '</ul>';
				
				$this->Session->setFlash('Por favor corrija los siguientes errores:' . $errores, null, array(), 'danger');
				$this->redirect(array('action' => 'edit', $id ,$this->request->data['Producto']['tarea_id']));
			}
		}else{

			$this->request->data = $this->Producto->find('first', array(
			'conditions' => array(
				'Producto.id' => $id
				),
			'contain' => array(
				'Especificacion' => array(
					'Idioma'
					),
				'Proveedor',
				'Fabricante',
				'Imagen',
				'Tarea',
				'Grupocaracteristica'
				)
			)
		);

		}
		
		# Verificamos existencia y elación de la tarea
		$miTarea = ClassRegistry::init('Tarea')->find('first', array(
			'conditions' => array(
				'Tarea.id' => $tarea,
				'Tarea.usuario_id' => $this->Auth->user('id')
				),
			'contain' => array(
				'Grupocaracteristica',
				'Adjunto'
				)
			));

		if (empty($miTarea)) {
			$this->Session->setFlash('La tarea seleccionada no existe o ya no está asignada a usted.', null, array(), 'danger');
			$this->redirect(array('action' => 'work', $tarea));
		}
		
		# Grupos disponibles en esta tarea padre
		$grupocaracteristicas = $this->Producto->Grupocaracteristica->find('list', array(
			'conditions' => array(
				'Grupocaracteristica.id' => Hash::extract($miTarea['Grupocaracteristica'], '{n}.id')
				)
			));

		$proveedores = $this->Producto->Proveedor->find('list');
		$fabricantes = $this->Producto->Fabricante->find('list');

		BreadcrumbComponent::add(sprintf('Agregar producto a Tarea %s', $miTarea['Tarea']['nombre']));
		
		$this->set(compact('miTarea', 'grupocaracteristicas', 'proveedores', 'fabricantes'));
	}


	public function maintainers_activar( $id = null, $tarea = null ) {
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));
		$this->Producto->id = $id;
		if ( ! $this->Producto->exists() )
		{
			$this->Session->setFlash('Producto no existe.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Producto->saveField('activo', 1) )
		{
			$this->Session->setFlash('Producto activado correctamente.', null, array(), 'success');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
		}
		$this->Session->setFlash('Error al activar el producto. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
	}


	public function maintainers_desactivar( $id = null, $tarea = null ) {
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));
		$this->Producto->id = $id;
		if ( ! $this->Producto->exists() )
		{
			$this->Session->setFlash('Producto no existe.', null, array(), 'danger');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
		}

		if ( $this->Producto->saveField('activo', 0) )
		{
			$this->Session->setFlash('Producto desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
		}
		$this->Session->setFlash('Error al desactivar el producto. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
	}


	public function maintainers_delete($id = null, $tarea = null)
	{	
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));
		$this->Producto->id = $id;
		if ( ! $this->Producto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
		}


		if ( ! $this->esMiProducto($id, $tarea) ) {
			$this->Session->setFlash('Este producto no pertenece a usted.', null, array(), 'danger');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $this->request->data['Producto']['tarea_id']));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Producto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('controller' => 'tareas', 'action' => 'work', $tarea));
	}


	public function maintainers_obtenerEspecificaciones($idGrupo = null, $idProducto = null) {
		if(empty($idGrupo)) {
			echo '<tr><td colspan="2">Seleccione un tipo de producto.</td></tr>';
			exit;
		}

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor', 'Especificacion', 'EspecificacionIdioma', 'Idioma'));

		# Obtenemos el grupo con sus pespecificaciones
		
		$options['conditions'] = array(
			'Grupocaracteristica.id' => $idGrupo
			);

		$options['contain'] = array(
			'Especificacion' => array(
				'Idioma'
				)
			);

		# Si existe un producto buscamos las especificaciones de este para descartarlas de la busqueda
		if (!empty($idProducto)) {
			$producto = $this->Producto->find('first', array(
				'conditions' => array(
					'Producto.id' => $idProducto
					),
				'contain' => array(
					'Especificacion'
					)
				));

			if (!empty($producto)) {

				$options['contain'] = array(
					'Especificacion' => array(
						'Idioma',
						'Producto' => array(
							'conditions' => array(
								'Producto.id' => $producto['Producto']['id']
								),
							'fields' => array('Producto.id')
							)
						)
					);
			}

		}	

		$grupo = ClassRegistry::init('Grupocaracteristica')->find('first', $options);

		# Vemos si tiene especificaciones asociadas
		if (empty($grupo['Especificacion'])) {
			
			exit;
		}
		
		$tabla = '';
		# Armamos tabla de Especificaciones
		foreach ($grupo['Especificacion'] as $key => $value) {

			$tabla .= '<tr>';
			$tabla .= '<td>';
			$tabla .= $value['Idioma'][0]['EspecificacionIdioma']['name'];
			$tabla .= '</td>';
			$tabla .= '<td>';
			$tabla .= '<input type="hidden" name="data[Especificacion][' . $key . '][id_feature]" value="' . $value['id_feature'] . '">';
			if ( isset($value['Producto'][0]['EspecificacionesProducto']) && $value['Producto'][0]['EspecificacionesProducto']['id_feature'] == $value['id_feature']) {
				$tabla .= '<input type="text" class="form-control not-blank" name="data[Especificacion][' . $key . '][valor]" placeholder="Ingrese valor" value="' . $value['Producto'][0]['EspecificacionesProducto']['valor'] . '" required>';
			}else{
				$tabla .= '<input type="text" class="form-control not-blank" name="data[Especificacion][' . $key . '][valor]" placeholder="Ingrese valor" required>';
			}
			$tabla .= '</td>';

		}

		echo $tabla;
		exit;
	}
}
