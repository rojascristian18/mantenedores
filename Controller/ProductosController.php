<?php
App::uses('AppController', 'Controller');
class ProductosController extends AppController
{
	public function admin_index()
	{	
		$this->redirect(array('controller' => 'tareas', 'action' => 'index'));

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
				'Marca',
				'Grupocaracteristica',
				'Competidor'
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
				'Marca',
				'Tarea',
				'Grupocaracteristica',
				'Competidor'
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


	/**
	 * Método que valida un arreglo de imágenes según la configuración del sistema
	 * @param $data 		array 	Arreglo de imágenes
	 * @return $errores 	array 	Arreglo con la información del error si es que existe
	 */
	public function validarTamanoImagenes($set = null)
	{	
		$errores = array();
		# Procesamos imágenes
		if (isset($this->request->data['Imagen']) && count($this->request->data['Imagen']) > 0 ) {
			
			# Verificamos que las medidas de la imagen esten dentro del rango configurado
			foreach ($this->request->data['Imagen'] as $k => $imagen) {
				if (isset($imagen['imagen'])) {
					# Información de la imagen
					list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen['imagen']['tmp_name']);
					
					$errores[$k] = '';

					# Verificamos que el tamaño esté dentro de la configuración
					if ( $ancho < configuracion('imagen_ancho_min') 
						|| $ancho > configuracion('imagen_ancho_max')
						|| $alto < configuracion('imagen_alto_min')
						|| $alto > configuracion('imagen_alto_max') ) {

						$errores[$k] .= 'La imagen ' . $imagen['imagen']['name'] . ' no tiene las dimensiones correctas. <br>';
						$errores[$k] .= 'Dimensión de la imagen:';
						$errores[$k] .= '<ul><li>Ancho: ' . $ancho . 'px</li><li>Alto: ' . $alto . 'px</li></ul><br/>';
					}

					# Verificamos el peso de la imagen
					if ( $imagen['imagen']['size'] > $this->Producto->MBToKB(configuracion('imagen_peso') ) )
					{
						$errores[$k] .= 'El peso de la imagen supera el permitido. La imagen pesa <b>' . $this->Producto->KBToMB($imagen['imagen']['size']) . ' MB</b>.';		
					}	
				}

				# eliminamos de arreglo la imagen solo cuando necesitemos
				if (!empty($errores) && !empty($set)) {
					unset($this->request->data['Imagen'][$k]);
				}
			}
		}
		
		if (empty($errores['999'])) {
			$errores = array();
		}

		return $errores;
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
			$errorValidacion = array();

			# Validar campos
			if( ! $this->validarCampos()) {
				$errorValidacion[] = 'Debe completar todos los campos.';
			}

			# Validar imágenes
			if ( ! $this->validarImagenes() ) {
				$this->limpiarImagenes();
			}

			# Quitar puntos a precio
			if (isset($this->request->data['Producto']['precio'])) {
				$this->request->data['Producto']['precio'] = str_replace('.', '', $this->request->data['Producto']['precio']);
			}

			# Comprimimos imágenes si está activada la configuración
			if (configuracion('comprimir_imagenes') && !empty(configuracion('tiny_api_key'))) {
				$this->request->data['Imagen'] = $this->Tiny->comprimir_imagen($this->request->data['Imagen']);
			}
			
			# Validar tamaño de imagenes
			if ( !empty($this->request->data['Imagen']) && !empty($this->validarTamanoImagenes()) ) {
				$errorValidacion[] = implode(' ', $this->validarTamanoImagenes('set'));
			}


			$this->Producto->create();
			if ( $this->Producto->saveAll($this->request->data) )
			{	
				$this->Session->setFlash('Producto agregado correctamente.', null, array(), 'success');

				# si existen errores actualizamos el producto y direccionamos a su misma edición, para que corrija los errores.
				if (!empty($errorValidacion)) {

					$errores = '<ul>';
					foreach ($errorValidacion as $key => $error) {
						$errores .= '<li>' . $error . '</li>'; 
					}
					$errores .= '</ul>';

					# Obtenemos el id del producto recien agregado
					$ultimoRegistro = $this->Producto->find('first', array('order' => array('created' => 'DESC'), 'fields' => array('id')));

					#Mensaje de errores
					$this->Session->setFlash('Por favor corrija los siguientes errores:' . $errores, null, array(), 'danger');

					# Redireccionamos a la edición del producto
					$this->redirect(array('action' => 'edit', $ultimoRegistro['Producto']['id'], $this->request->data['Producto']['tarea_id']));
				}

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
				$this->redirect(array('action' => 'add', $this->request->data['Producto']['tarea_id']));
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
		$marcas = $this->Producto->Marca->find('list', array('conditions' => array(
			'activo' => 1, 
			'tienda_id' => $miTarea['Tarea']['tienda_id']
			)));

		BreadcrumbComponent::add(sprintf('Agregar producto a Tarea %s', $miTarea['Tarea']['nombre']));
		
		$this->set(compact('miTarea', 'grupocaracteristicas', 'proveedores', 'fabricantes', 'marcas'));
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

			$errorValidacion = array();

			# Validar campos
			if( ! $this->validarCampos()) {
				$errorValidacion[] = 'Debe completar todos los campos.';
			}

			# Validar imágenes
			if ( ! $this->validarImagenes() ) {
				$this->limpiarImagenes();
			}

			# Quitar puntos a precio
			if (isset($this->request->data['Producto']['precio'])) {
				$this->request->data['Producto']['precio'] = str_replace('.', '', $this->request->data['Producto']['precio']);
			}

			# Comprimimos imágenes si está activada la configuración
			if (configuracion('comprimir_imagenes') && !empty(configuracion('tiny_api_key'))) {
				$this->request->data['Imagen'] = $this->Tiny->comprimir_imagen($this->request->data['Imagen']);
			}
			
			# Validar tamaño de imagenes
			if ( !empty($this->request->data['Imagen']) && !empty($this->validarTamanoImagenes()) ) {
				$errorValidacion[] = implode(' ', $this->validarTamanoImagenes('set'));
			}
			
			// Limpiamos las especificaciones
			$this->Producto->EspecificacionesProducto->deleteAll(array('producto_id' => $id));

			// Limpiamos los competidores
			$this->Producto->CompetidoresProducto->deleteAll(array('producto_id' => $id));

			# Quitar puntos a precio
			if (isset($this->request->data['Producto']['precio'])) {
				$this->request->data['Producto']['precio'] = str_replace('.', '', $this->request->data['Producto']['precio']);
			}

			if ( $this->Producto->saveAll($this->request->data) )
			{	
				# si existen errores actualizamos el producto y direccionamos a su misma edición, para que corrija los errores.
				if (!empty($errorValidacion)) {

					$errores = '<ul>';
					foreach ($errorValidacion as $key => $error) {
						$errores .= '<li>' . $error . '</li>'; 
					}
					$errores .= '</ul>';
					
					# Mensaje de error
					$this->Session->setFlash('Producto editado con errores. <br>Por favor corrija los siguientes errores:' . $errores, null, array(), 'danger');

					# redireccionamos a editar el producto
					$this->redirect(array('action' => 'edit', $id, $this->request->data['Producto']['tarea_id']));
				}else{
					$this->Session->setFlash('Producto editado correctamente.', null, array(), 'success');
				}
				
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
				'Grupocaracteristica',
				'Marca'
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
		$marcas = $this->Producto->Marca->find('list', array('conditions' => array(
			'activo' => 1, 
			'tienda_id' => $miTarea['Tarea']['tienda_id']
			)));

		BreadcrumbComponent::add(sprintf('Agregar producto a Tarea %s', $miTarea['Tarea']['nombre']));
		
		$this->set(compact('miTarea', 'grupocaracteristicas', 'proveedores', 'fabricantes', 'marcas'));
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


	private function normalizarExpR($values = array()) {
		foreach ($values as $k => $v) {
    		$values[$k] = str_replace('/', '\/', $v);
    	}
    	return $values;
	}


	public function maintainers_obtenerCompetidores($idGrupo = null, $idProducto = null) {
		if(empty($idGrupo)) {
			echo '<tr><td colspan="2">Seleccione un tipo de producto.</td></tr>';
			exit;
		}

		# Obtenemos el grupo con sus pespecificaciones
		
		$options['conditions'] = array(
			'Grupocaracteristica.id' => $idGrupo
			);

		$options['contain'] = array(
			'Competidor'
			);

		# Si existe un producto buscamos los competidores de este para descartarlas de la busqueda
		if (!empty($idProducto)) {
			$producto = $this->Producto->find('first', array(
				'conditions' => array(
					'Producto.id' => $idProducto
					),
				'contain' => array(
					'Competidor'
					)
				));

			if (!empty($producto)) {

				$options['contain'] = array(
					'Competidor' => array(
						'Producto' => array(
							'conditions' => array(
								'Producto.id' => $producto['Producto']['id']
								),
							
							)
						)
					);
			}

		}	

		$grupo = ClassRegistry::init('Grupocaracteristica')->find('first', $options);
		
		# Vemos si tiene especificaciones asociadas
		if (empty($grupo['Competidor'])) {
			
			exit;
		}
		
		$tabla = '';
		# Armamos tabla de Competidores
		foreach ($grupo['Competidor'] as $key => $value) {

			$tabla .= '<tr>';
			$tabla .= '<td>';
			$tabla .= $value['nombre'];
			$tabla .= '</td>';
			$tabla .= '<td>';
			$tabla .= '<input type="hidden" name="data[Competidor][' . $key . '][competidor_id]" value="' . $value['id'] . '">';

			if ( isset($value['Producto'][0]['CompetidoresProducto']) && $value['Producto'][0]['CompetidoresProducto']['competidor_id'] == $value['id']) {
				$tabla .= '<input url="url" type="text"  class="form-control js-url not-blank" name="data[Competidor][' . $key . '][url]" value="' . $value['Producto'][0]['CompetidoresProducto']['url'] . '" placeholder="Agregue url de la competencia">';
			}else{
				$tabla .= '<input url="url" type="text"  class="form-control js-url not-blank" name="data[Competidor][' . $key . '][url]" placeholder="Agregue url de la competencia" required>';
			}

			
			$tabla .= '</td>';
			$tabla .= '<td>';
			if (!empty($value['url'])) {
				
				$tabla .= '<button type="button" class="btn btn-info popover-dismiss" title="Ayuda" data-content="' . $value['url'] . '"><i class="fa fa-info"></i> Ayuda</button>';
				
			}
			$tabla .= '</td>';
			/*$tabla .= '<td>';
			if (!empty($value['ejemplo'])) {
				
				$tabla .= '<p>' . $value['ejemplo'] . '</p>';
				
			}
			$tabla .= '</td>';*/
			$tabla .= '</tr>';

		}

		echo $tabla;
		exit;
	}



	/**
	 * Función que permite obtener el html de las especificaciones de un producto.
	 *
	 * @param 	$idGrupo 	int 	Identificador del grupo al que corresponde el producto agregado
	 * @param 	$idProducto int 	Identificador del producto (opcional)
	 * @return 	$tabla 		string 	Filas de tabla con las especificacion/caracteristicas permitidas para el producto.
	 */
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
				'Idioma',
				'UnidadMedida'
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
						'UnidadMedida',
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
				$tabla .= '<div class="input-group">';
                $tabla .= '<span class="input-group-addon">';
                $tabla .= ($value['Producto'][0]['EspecificacionesProducto']['no_aplica']) ? '<input type="checkbox" class="js-no-aplica" name="data[Especificacion][' . $key . '][no_aplica]" checked> <small>No aplica</small>' : '<input type="checkbox" class="js-no-aplica" name="data[Especificacion][' . $key . '][no_aplica]"> <small>No aplica</small>' ;
                $tabla .= '</span>';
                if (!empty($value['UnidadMedida'])) {
					$pattern = '';
					foreach ($value['UnidadMedida'] as $k => $v) {
						if ($v['GrupocaracteristicaEspecificacion']['grupocaracteristica_id'] == $value['GrupocaracteristicaEspecificacion']['grupocaracteristica_id']) {
							
							/**
		                     * Se agrega la validación por patrón para los campos de solo números
		                     * añadiendole símbolos adicionales que aceptará el campo
		                     */
		                    if (!empty($v['permitidos'])) {

		                    	$caracteresPermitidos = $this->normalizarExpR(explode(',', $v['permitidos']));

		                    	if ($v['tipo_campo'] == 'number') {
		                    		$pattern = "^[0-9.,". implode('', $caracteresPermitidos) ."]+$";
		                    	}

		                    }else{
		                    	if ($v['tipo_campo'] == 'number') {
		                    		$pattern = "^[0-9.,]+$";
		                    	}
		                    }

						}
					}

                    $tabla .= '<input type="text" pattern="'.$pattern.'" class="form-control not-blank" name="data[Especificacion][' . $key . '][valor]" placeholder="Ingrese valor" value="' . $value['Producto'][0]['EspecificacionesProducto']['valor'] . '" required>';
                                         
				}else{
					$tabla .= '<input type="text" class="form-control not-blank" name="data[Especificacion][' . $key . '][valor]" placeholder="Ingrese valor" value="' . $value['Producto'][0]['EspecificacionesProducto']['valor'] . '" required>';
				}
                
                $tabla .= '</div>';
				
			}else{
				$tabla .= '<div class="input-group">';
                $tabla .= '<span class="input-group-addon">';
                $tabla .= '<input type="checkbox" class="js-no-aplica" name="data[Especificacion][' . $key . '][no_aplica]"> <small>No aplica</small>';
                $tabla .= '</span>';
                if (!empty($value['UnidadMedida'])) {
					$pattern = '';
					foreach ($value['UnidadMedida'] as $k => $v) {
						if ($v['GrupocaracteristicaEspecificacion']['grupocaracteristica_id'] == $value['GrupocaracteristicaEspecificacion']['grupocaracteristica_id']) {
							
							 /**
		                     * Se agrega la validación por patrón para los campos de solo números
		                     * añadiendole símbolos adicionales que aceptará el campo
		                     */
		                    if (!empty($v['permitidos'])) {

		                    	$caracteresPermitidos = $this->normalizarExpR(explode(',', $v['permitidos']));

		                    	if ($v['tipo_campo'] == 'number') {
		                    		$pattern = "^[0-9.,". implode('', $caracteresPermitidos) ."]+$";
		                    	}

		                    }else{
		                    	if ($v['tipo_campo'] == 'number') {
		                    		$pattern = "^[0-9.,]+$";
		                    	}
		                    }
						}
					}

                    $tabla .= '<input type="text" pattern="'.$pattern.'" class="form-control not-blank" name="data[Especificacion][' . $key . '][valor]" placeholder="Ingrese valor" required>';
                                         
				}else{
					$tabla .= '<input type="text" class="form-control not-blank" name="data[Especificacion][' . $key . '][valor]" placeholder="Ingrese valor" required>';
				}
			}
			$tabla .= '</td>';
			$tabla .= '<td>';
			
			if (!empty($value['UnidadMedida'])) {
				foreach ($value['UnidadMedida'] as $k => $v) {
					if ($v['GrupocaracteristicaEspecificacion']['grupocaracteristica_id'] == $value['GrupocaracteristicaEspecificacion']['grupocaracteristica_id']) {
						
						$tabla .= '<label class="label-form label label-info">' . $v['nombre'] . '</label>';
					}
				}	
			}else{
				$tabla .= '<label class="label-form label label-info">Texto libre</label>';
			}

			$tabla .= '</td>';
			$tabla .= '<td>';
			if (!empty($value['UnidadMedida'])) {
				foreach ($value['UnidadMedida'] as $k => $v) {
					if ($v['GrupocaracteristicaEspecificacion']['grupocaracteristica_id'] == $value['GrupocaracteristicaEspecificacion']['grupocaracteristica_id']) {
						
						$tabla .= $v['ejemplo'];	
					}
				}
				
			}else{
				$tabla .= '9-3/8 PULGADAS';
			}
			$tabla .= '</td>';

		}

		echo $tabla;
		exit;
	}
}
