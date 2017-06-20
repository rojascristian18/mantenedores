<?php
App::uses('AppController', 'Controller');
class TareasController extends AppController
{	
	public function admin_index()
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

		$paginate = array(
			'recursive' => 0,
			'order' => 'Tarea.id DESC',
			'limit' => 10
			);

		$paginate['conditions'] = array(
			'Tarea.tienda_id' => $this->Session->read('Tienda.id'),
			'Tarea.parent_id' => null,
			'Tarea.administrador_id' => $this->Session->read('Auth.Administrador.id')
			);

    	$total = 0;
    	$totalMostrados = 0;

    	$textoBuscar = null;

    	// Filtrado por formulario
		if ( $this->request->is('post') ) {

			if ( empty($this->request->data['Filtro']['mantenedor']) && empty($this->request->data['Filtro']['estado']) && empty($this->request->data['Filtro']['f_inicio']) && empty($this->request->data['Filtro']['f_final'])) {
				$this->Session->setFlash('Seleccione criterio para filtrar' ,  null, array(), 'danger');
			}

			# Por mantenedor
			if ( ! empty($this->request->data['Filtro']['mantenedor']) && empty($this->request->data['Filtro']['estado']) && empty($this->request->data['Filtro']['f_inicio']) && empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'mantenedor' => $this->request->data['Filtro']['mantenedor']));
			}

			# Por mantenedor y estado
			if ( ! empty($this->request->data['Filtro']['mantenedor']) && ! empty($this->request->data['Filtro']['estado']) && empty($this->request->data['Filtro']['f_inicio']) && empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'mantenedor' => $this->request->data['Filtro']['mantenedor'], 'estado' => $this->request->data['Filtro']['estado']));
			}

			# Por mantenedor, estado y rango 
			if ( ! empty($this->request->data['Filtro']['mantenedor']) && ! empty($this->request->data['Filtro']['estado']) && ! empty($this->request->data['Filtro']['f_inicio']) && ! empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'mantenedor' => $this->request->data['Filtro']['mantenedor'], 'estado' => $this->request->data['Filtro']['estado'], 'f_inicio' => $this->request->data['Filtro']['f_inicio'], 'f_final' => $this->request->data['Filtro']['f_final']));
			}

			# Por estado
			if ( empty($this->request->data['Filtro']['mantenedor']) && ! empty($this->request->data['Filtro']['estado']) && empty($this->request->data['Filtro']['f_inicio']) && empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'estado' => $this->request->data['Filtro']['estado']));
			}

			# Por estado y rango
			if ( empty($this->request->data['Filtro']['mantenedor']) && ! empty($this->request->data['Filtro']['estado']) && ! empty($this->request->data['Filtro']['f_inicio']) && ! empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'estado' => $this->request->data['Filtro']['estado'], 'f_inicio' => $this->request->data['Filtro']['f_inicio'], 'f_final' => $this->request->data['Filtro']['f_final']));
			}

			# Por rango
			if ( empty($this->request->data['Filtro']['mantenedor']) && empty($this->request->data['Filtro']['estado']) && ! empty($this->request->data['Filtro']['f_inicio']) && ! empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'f_inicio' => $this->request->data['Filtro']['f_inicio'], 'f_final' => $this->request->data['Filtro']['f_final']));
			}

			# Por rango y mantenedor
			if ( ! empty($this->request->data['Filtro']['mantenedor']) && empty($this->request->data['Filtro']['estado']) && ! empty($this->request->data['Filtro']['f_inicio']) && ! empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'mantenedor' => $this->request->data['Filtro']['mantenedor'], 'f_inicio' => $this->request->data['Filtro']['f_inicio'], 'f_final' => $this->request->data['Filtro']['f_final']));
			}

		}

		/**
		* Buscar por
		*/
	
		# Por mantenedor
		if ( ! empty($this->request->params['named']['mantenedor']) && empty($this->request->params['named']['estado']) && empty($this->request->params['named']['f_inicio']) && empty($this->request->params['named']['f_final']) ) {
			$paginate['conditions']['Tarea.usuario_id'] = $this->request->params['named']['mantenedor'];
		}

		# Por mantenedor y estado
		if ( ! empty($this->request->params['named']['mantenedor']) && ! empty($this->request->params['named']['estado']) && empty($this->request->params['named']['f_inicio']) && empty($this->request->params['named']['f_final']) ) {
			$paginate['conditions']['Tarea.usuario_id'] = $this->request->params['named']['mantenedor'];
			
			switch ($this->request->params['named']['estado']) {
				case 'en_progreso':
					$paginate['conditions']['Tarea.en_progreso'] = 1;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'en_revision':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 1;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'rechazado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 1;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'finalizado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 1;
					break;
			}
		}

		# Por mantenedor, estado y rango 
		if ( ! empty($this->request->params['named']['mantenedor']) && ! empty($this->request->params['named']['estado']) && ! empty($this->request->params['named']['f_inicio']) && ! empty($this->request->params['named']['f_final']) ) {
			$paginate['conditions']['Tarea.usuario_id'] = $this->request->params['named']['mantenedor'];
			
			switch ($this->request->params['named']['estado']) {
				case 'en_progreso':
					$paginate['conditions']['Tarea.en_progreso'] = 1;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'en_revision':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 1;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'rechazado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 1;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'finalizado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 1;
					break;
			}

			$paginate['conditions']['Tarea.created BETWEEN ? AND ?'] = array($this->request->params['named']['f_inicio'], $this->request->params['named']['f_final']);
		}

		# Por estado
		if ( empty($this->request->params['named']['mantenedor']) && ! empty($this->request->params['named']['estado']) && empty($this->request->params['named']['f_inicio']) && empty($this->request->params['named']['f_final']) ) {
			switch ($this->request->params['named']['estado']) {
				case 'en_progreso':
					$paginate['conditions']['Tarea.en_progreso'] = 1;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'en_revision':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 1;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'rechazado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 1;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'finalizado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 1;
					break;
			}
		}

		# Por estado y rango
		if ( empty($this->request->params['named']['mantenedor']) && ! empty($this->request->params['named']['estado']) && ! empty($this->request->params['named']['f_inicio']) && ! empty($this->request->params['named']['f_final']) ) {
			switch ($this->request->params['named']['estado']) {
				case 'en_progreso':
					$paginate['conditions']['Tarea.en_progreso'] = 1;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'en_revision':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 1;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'rechazado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 1;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'finalizado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 1;
					break;
			}

			$paginate['conditions']['Tarea.created BETWEEN ? AND ?'] = array($this->request->params['named']['f_inicio'], $this->request->params['named']['f_final']);
		}

		# Por rango
		if ( empty($this->request->params['named']['mantenedor']) && empty($this->request->params['named']['estado']) && ! empty($this->request->params['named']['f_inicio']) && ! empty($this->request->params['named']['f_final']) ) {
			$paginate['conditions']['Tarea.created BETWEEN ? AND ?'] = array($this->request->params['named']['f_inicio'], $this->request->params['named']['f_final']);
		}

		# Por rango y mantenedor
		if ( ! empty($this->request->params['named']['mantenedor']) && empty($this->request->params['named']['estado']) && ! empty($this->request->params['named']['f_inicio']) && ! empty($this->request->params['named']['f_final']) ) {
			$paginate['conditions']['Tarea.usuario_id'] = $this->request->params['named']['mantenedor'];
			$paginate['conditions']['Tarea.created BETWEEN ? AND ?'] = array($this->request->params['named']['f_inicio'], $this->request->params['named']['f_final']);
		}


		$mantenedores = $this->Tarea->Usuario->find('list', array('conditions' => array('Usuario.activo' => 1)));
		$estados = array(
			'en_progreso' => 'En progreso',
			'en_revision' => 'En revisión',
			'rechazado'	=> 'Rechazado',
			'finalizado' => 'Finalizado'
			);

		$this->paginate		= $paginate;
		$tareas	= $this->paginate();
		
		$this->set(compact('tareas', 'mantenedores', 'estados'));
	}

	public function admin_add()
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

		if ( $this->request->is('post') )
		{	
			# Bit que controla la notificación al mantenedor
			$this->request->data['Tarea']['asignada'] = false;
			if ( ! empty($this->request->data['Tarea']['usuario_id']) ) {
				$this->request->data['Tarea']['asignada'] = true;
			}

			# Quitamos los puntos del precio
			if (isset($this->request->data['Tarea']['precio'])) {
				$this->request->data['Tarea']['precio'] = str_replace('.', '', $this->request->data['Tarea']['precio']);
			}

			$this->Tarea->create();
			if ( $this->Tarea->saveAll($this->request->data) )
			{
				$this->Session->setFlash('Nueva tarea agregada y notificada con éxito.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar la tarea. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		$usuarios	= $this->Tarea->Usuario->find('list', array('conditions' => array('activo' => 1)));
		$grupocaracteristicas	= $this->Tarea->Grupocaracteristica->find('list', array('conditions' => array('activo' => 1)));
		$idiomas = $this->Tarea->Idioma->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$shops = $this->Tarea->Shop->find('list');
		
		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops','grupocaracteristicas'));
	}

	public function admin_reabrir($id = null)
	{	
		if ( empty($id) ) {
			$this->Session->setFlash('Identificador no válido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

		$tarea = $this->Tarea->find('first', array(
			'conditions' => array(
				'Tarea.id' => $id
				)
			));

		if ( empty($tarea) ) {
			$this->Session->setFlash('Tarea no encontrada.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$tarea['Tarea']['reabierta'] = true;
		$tarea['Tarea']['en_revision'] = 0;
		$tarea['Tarea']['iniciado'] = 0;
		$tarea['Tarea']['en_progreso'] = 0;
		$tarea['Tarea']['rechazado'] = 0;
		$tarea['Tarea']['finalizado'] = 0;

		if ( $this->Tarea->save($tarea) ) {
			$this->Session->setFlash('Tarea abierta y notificada al mantenedor.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Ocurrió un error al intentar abrir esta tarea.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function admin_edit($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));
		

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			// Si no es una comentario se procede con la eliminación de archivos y datos
			if ( ! isset($this->request->data['Comentario']) ) {
				# Se eliminan los adjuntos
				$this->quitarElementos($this->request->data['Tarea']['ElementosEliminados'], 'Adjunto');
			
				# Eliminar rel palabras claves
				$this->Tarea->GrupocaracteristicaTarea->deleteAll(array('GrupocaracteristicaTarea.tarea_id' => $id));
				#$this->Tarea->PalabraclaveTarea->deleteAll(array('PalabraclaveTarea.tarea_id' => $id));
			}

			# Quitamos los puntos del precio
			if (isset($this->request->data['Tarea']['precio'])) {
				$this->request->data['Tarea']['precio'] = str_replace('.', '', $this->request->data['Tarea']['precio']);
			}
			
			if ( $this->Tarea->saveAll($this->request->data) )
			{	
				if ( isset($this->request->data['Comentario']) ) {
					$this->Session->setFlash('Comentario agregado.', null, array(), 'success');
					$this->redirect(array('action' => 'edit', $id));
				}else{
					$this->Session->setFlash('Tarea editada correctamente', null, array(), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
			else
			{	
				if ( isset($this->request->data['Comentario']) ) {
					$this->Session->setFlash('Error al guardar el comentario. Por favor intenta nuevamente.', null, array(), 'danger');
				}else{
					$this->Session->setFlash('Error al guardar la tarea. Por favor intenta nuevamente.', null, array(), 'danger');
				}
				
			}
		}
		else
		{	
			# Actualizamos los comentarios no visualizados a visualizado
			$this->visualizarComentarios($id);
			
			$this->request->data	= $this->Tarea->find('first', array(
				'conditions'	=> array('Tarea.id' => $id),
				'contain' => array(
					'Usuario', 
					'ImpuestoReglaGrupo', 
					'Idioma', 
					'Shop', 
					'Grupocaracteristica', 
					'Adjunto', 
					'Producto' => array('Fabricante', 'Proveedor', 'Grupocaracteristica', 'Marca', 'conditions' => array('Producto.activo' => 1)), 
					'Comentario' => array('Importancia', 'Usuario', 'Administrador'))
			));

			$pNoAceptados = 0;

			# Verificamos que todos los productos esten aceptados para poder aceptar y finalizar la tarea
			if ( !empty($this->request->data['Producto'])) {
				foreach ($this->request->data['Producto'] as $key => $value) {
					if ($value['aceptado'] == 0) {
						$pNoAceptados++;
					}
				}
			}
		}

		$usuarios	= $this->Tarea->Usuario->find('list');
		$parentTareas	= $this->Tarea->ParentTarea->find('list');
		$grupocaracteristicas	= $this->Tarea->Grupocaracteristica->find('list', array('conditions' => array('activo' => 1)));
		$idiomas = $this->Tarea->Idioma->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$shops = $this->Tarea->Shop->find('list');
		$revisiones = $this->obtenerRevisiones();
		
		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops', 'parentTareas', 'tiendas', 'grupocaracteristicas', 'revisiones', 'pNoAceptados'));
	}


	public function admin_review($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			if (!empty($this->request->data['Comentario'])) {
					
				if ( $this->Tarea->saveAssociated($this->request->data) ) {
					$this->Session->setFlash('Comentario agregado con éxito', null, array(), 'success');
					$this->redirect(array('action' => 'review', $id));
				}else{
					$this->Session->setFlash('Error al guardar el comentario', null, array(), 'danger');
					$this->redirect(array('action' => 'review', $id));
				}
			}
		}
		else
		{	
			# Actualizamos los comentarios no visualizados a visualizado
			$this->visualizarComentarios($id);

			$this->request->data	= $this->Tarea->find('first', array(
				'conditions'	=> array('Tarea.id' => $id),
				'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'Grupocaracteristica', 'Adjunto', 'Producto' => array('Fabricante', 'Proveedor', 'Grupocaracteristica'), 'Comentario' => array('Importancia', 'Usuario', 'Administrador'))
			));

			$importancias = ClassRegistry::init('Importancia')->find('list', array('conditions' => array('Importancia.activo' => 1)));

			$this->set(compact('importancias'));
		}

	}


	public function admin_view($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->data	= $this->Tarea->find('first', array(
			'conditions'	=> array('Tarea.id' => $id),
			'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'Grupocaracteristica', 'Adjunto', 'Producto' => array('Fabricante', 'Proveedor', 'Grupocaracteristica', 'Marca'), 'Comentario' => array('Importancia', 'Usuario', 'Administrador'))
		));

		$importancias = ClassRegistry::init('Importancia')->find('list', array('conditions' => array('Importancia.activo' => 1)));

		$this->set(compact('importancias'));

	}

	public function admin_delete($id = null)
	{	# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));
		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Tarea->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar la tarea. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_activar( $id = null ) {
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));
		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Tarea->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar la tarea. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));
		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Tarea->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar la tarea. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}


	public function admin_accept() {

		if ( $this->request->is('post') )
		{
			# Cambiamos el datasource de los modelos que necesitamos externos
			$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

			$this->Tarea->id = $this->request->data['Tarea']['id'];
			if ( ! $this->Tarea->exists() )
			{
				$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
				$this->redirect(array('action' => 'index'));
			}

			# Estados de cierre de tarea
			$estados = array(
				'Tarea' => array(
					'id' => $this->request->data['Tarea']['id'],
					'en_revision' => 0,
					'en_progreso' => 0,
					'rechazado' => 0,
					'finalizado' => 1,
					'fecha_finalizado' => date('Y-m-d H:i:s')
					)
				);

			# Calificación
			$calificacion = array(
				'usuario_id' => $this->request->data['Tarea']['id_usuario'],
				'calificacion' => $this->request->data['Tarea']['calificacion_media'],
				'mensaje' => $this->request->data['Tarea']['mensaje']
			);
			
			if ( ClassRegistry::init('Calificacion')->save($calificacion) && $this->Tarea->save($estados) )
			{	
				$this->Session->setFlash('Tarea aceptada y finalizada.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('Error al aceptar la tarea. Por favor intenta nuevamente.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}
	}


	public function admin_refuse( $id = null ) {
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));
		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$estados = array(
			'Tarea' => array(
				'id' => $id,
				'en_revision' => 0,
				'en_progreso' => 0,
				'rechazado' => 1,
				'finalizado' => 0
				)
			);

		if ( $this->Tarea->save($estados) )
		{
			$this->Session->setFlash('Tarea rechazada con éxito.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al rechazar la tarea. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Tarea->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Tarea->_schema);
		$modelo			= $this->Tarea->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	/**
	 * Función que permite cambiar el estado de una tarea.
	 * 
	 * Los posibles estados son:
	 * 		en_progreso  	El mantenedor está trabajando actualemnte en la tarea.
	 * 		en_revision  	El administrador está revisando la tarea.
	 * 		rechazado 		El administrador rechaó la tarea y vuelve al mantenedor.
	 * 		finalizado   	El mantenedor y el administrador dieron por finalizada la tarea.
	 * 		
	 * @param  		int 		$id     	Identofocador de la tarea
	 * @param  		string 		$estado 	Uno de los estados descritos arriba
	 * @return 		void 					si se actualiza con exito, de los contrario redirecciona al index mostrando un mensaje de error.
	 */
	public function admin_cambiarEstado($id = null, $estado = '') {
		# Cambiar estado de una tarea
		if ( ! $this->cambiarEstadoTarea($id, $estado)) {
			$this->Session->setFlash('No se puedo cambiar el estado dla tarea. Intente nuevamente', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Estado cambiado con éxito', null, array(), 'success');
			$this->redirect(array('action' => 'review', $id));
		}
	}


	public function getExcelExportFormat($version = '')
	{
		if (empty($version)) {
			return false;
		}

		$_schemaExcel = array();

		switch ($version) {
			case '1.6.1.11':
				$_schemaExcel = array(
					'ID' => '',
					'Active (0/1)' => 0,
					'Name *' => '',
					'Categories (x,y,z...)' => '',
					'Price tax excluded or Price tax included' => '',
					'Tax rules ID' => '',
					'Wholesale price' => '',
					'On sale (0/1)' => '',
					'Discount amount' => '',
					'Discount percent' => '',
					'Discount from (yyyy-mm-dd)' => '',
					'Discount to (yyyy-mm-dd)' => '',
					'Reference #' => '',
					'Supplier reference #' => '',
					'Supplier' => '',
					'Manufacturer' => '',
					'EAN13' => '',
					'UPC' => '',
					'Ecotax' => '',
					'Width' => '',
					'Height' => '',
					'Depth' => '',
					'Weight' => '',
					'Quantity' => '',
					'Minimal quantity' => '',
					'Visibility' => '',
					'Additional shipping cost' => '',
					'Unity' => '',
					'Unit price' => '',
					'Short description' => '',
					'Description' => '',
					'Tags (x,y,z...)' => '',
					'Meta title' => '',
					'Meta keywords' => '',
					'Meta description' => '',
					'URL rewritten' => '',
					'Text when in stock' => '',
					'Text when backorder allowed' => '',
					'Available for order (0 = No, 1 = Yes)' => '',
					'Product available date' => '',
					'Product creation date' => '',
					'Show price (0 = No, 1 = Yes)' => '',
					'Image URLs (x,y,z...)' => '',
					'Delete existing images (0 = No, 1 = Yes)' => 0,
					'Feature(Name:Value:Position)' => '',
					'Available online only (0 = No, 1 = Yes)' => 0,
					'Condition' => '',
					'Customizable (0 = No, 1 = Yes)' => '',
					'Uploadable files (0 = No, 1 = Yes)' => '',
					'Text fields (0 = No, 1 = Yes)' => '',
					'Out of stock' => '',
					'ID / Name of shop' => '',
					'Advanced stock management' => '',
					'Depends On Stock' => '',
					'Warehouse' => ''
					);
				break;
			case '1.6.0.8' :
				$_schemaExcel = array(
					'ID' => '',
					'Active (0/1)' => 0,
					'Name *' => '',
					'Categories (x,y,z...)' => '',
					'Price tax excluded or Price tax included' => '',
					'Tax rules ID' => '',
					'Wholesale price' => '',
					'On sale (0/1)' => '',
					'Discount amount' => '',
					'Discount percent' => '',
					'Discount from (yyyy-mm-dd)' => '',
					'Discount to (yyyy-mm-dd)' => '',
					'Reference #' => '',
					'Supplier reference #' => '',
					'Supplier' => '',
					'Manufacturer' => '',
					'EAN13' => '',
					'UPC' => '',
					'Ecotax' => '',
					'Width' => '',
					'Height' => '',
					'Depth' => '',
					'Weight' => '',
					'Quantity' => '',
					'Minimal quantity' => '',
					'Visibility' => '',
					'Additional shipping cost' => '',
					'Unity' => '',
					'Unit price' => '',
					'Short description' => '',
					'Description' => '',
					'Tags (x,y,z...)' => '',
					'Meta title' => '',
					'Meta keywords' => '',
					'Meta description' => '',
					'URL rewritten' => '',
					'Text when in stock' => '',
					'Text when backorder allowed' => '',
					'Available for order (0 = No, 1 = Yes)' => '',
					'Product available date' => '',
					'Product creation date' => '',
					'Show price (0 = No, 1 = Yes)' => '',
					'Image URLs (x,y,z...)' => '',
					'Delete existing images (0 = No, 1 = Yes)' => 0,
					'Feature(Name:Value:Position)' => '',
					'Available online only (0 = No, 1 = Yes)' => 0,
					'Condition' => '',
					'Customizable (0 = No, 1 = Yes)' => '',
					'Uploadable files (0 = No, 1 = Yes)' => '',
					'Text fields (0 = No, 1 = Yes)' => '',
					'Out of stock' => '',
					'ID / Name of shop' => '',
					'Advanced stock management' => '',
					'Depends On Stock' => '',
					'Warehouse' => ''
					);
			break;
			
			default:
				$_schemaExcel = array(
					'ID' => '',
					'Active (0/1)' => 0,
					'Name *' => '',
					'Categories (x,y,z...)' => '',
					'Price tax excluded or Price tax included' => '',
					'Tax rules ID' => '',
					'Wholesale price' => '',
					'On sale (0/1)' => '',
					'Discount amount' => '',
					'Discount percent' => '',
					'Discount from (yyyy-mm-dd)' => '',
					'Discount to (yyyy-mm-dd)' => '',
					'Reference #' => '',
					'Supplier reference #' => '',
					'Supplier' => '',
					'Manufacturer' => '',
					'EAN13' => '',
					'UPC' => '',
					'Ecotax' => '',
					'Width' => '',
					'Height' => '',
					'Depth' => '',
					'Weight' => '',
					'Quantity' => '',
					'Minimal quantity' => '',
					'Visibility' => '',
					'Additional shipping cost' => '',
					'Unity' => '',
					'Unit price' => '',
					'Short description' => '',
					'Description' => '',
					'Tags (x,y,z...)' => '',
					'Meta title' => '',
					'Meta keywords' => '',
					'Meta description' => '',
					'URL rewritten' => '',
					'Text when in stock' => '',
					'Text when backorder allowed' => '',
					'Available for order (0 = No, 1 = Yes)' => '',
					'Product available date' => '',
					'Product creation date' => '',
					'Show price (0 = No, 1 = Yes)' => '',
					'Image URLs (x,y,z...)' => '',
					'Delete existing images (0 = No, 1 = Yes)' => 0,
					'Feature(Name:Value:Position)' => '',
					'Available online only (0 = No, 1 = Yes)' => 0,
					'Condition' => '',
					'Customizable (0 = No, 1 = Yes)' => '',
					'Uploadable files (0 = No, 1 = Yes)' => '',
					'Text fields (0 = No, 1 = Yes)' => '',
					'Out of stock' => '',
					'ID / Name of shop' => '',
					'Advanced stock management' => '',
					'Depends On Stock' => '',
					'Warehouse' => ''
					);
			break;
		}

		return $_schemaExcel;
	}


	public function admin_exportar_productos( $id = null) {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoRegla', 'ImpuestoReglaGrupo', 'Especificacion', 'EspecificacionIdioma' ,'ImpuestoIdioma', 'Categoria', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));

		$this->Tarea->id = $id;
		if ( ! $this->Tarea->exists() )
		{
			$this->Session->setFlash('No existe la tarea.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$datos			= $this->Tarea->find('first', array(
			'conditions' => array(
				'Tarea.id' => $id
				),
			'contain' => array(
				'Producto' => array(
					'Proveedor',
					'Fabricante',
					'Marca',
					'Grupocaracteristica' => array(
						'Palabraclave',
						'Categoria',
						'UnidadMedida'
						),
					'Especificacion' => array(
						'Idioma'
						),
					'Imagen'
					),
				'ImpuestoReglaGrupo' => array(
					'ImpuestoRegla'
					),
				'Idioma',
				'Shop'
				)
		));
		
		/**
		* Para armar el excell necesitamos
		* Nombre
		* Categorias (x,y,z...) ids
		* Precio con IVA
		* Impuesto regla (id)
		* Referencia
		* Referencia de proveedor
		* Proveedor (nombre)
		* Fabricante (nombre)
		* Largo, Alto, Profundidad, Peso (cm con 1 decimal)
		* Cantidad
		* Descripcion corta
		* Descripcion
		* Meta titulo
		* Meta palabras claves
		* Meta descrión
		* Slug
		* Urls imagenes separadas por (,)
		* Especificaciones, nombre:valor:posición
		* ID SHOP
		* 
		*/
		# $this->getPrestahopExportFormat($this->request->data['Tarea']['version']);
		
		# Variable que almacenará los productos con el formato elegido
		$dataProducto =  array();

		App::uses('CakeText', 'Utility');
		
		foreach ($datos['Producto'] as $key => $producto) {

			$dataProducto[$key]['Producto'] = $this->getExcelExportFormat($this->request->data['Tarea']['version']);
			
			# Nombre
			if (isset($producto['nombre_final'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Name *' => $producto['nombre_final']));
			}

			# Categorias
			if (isset($producto['Grupocaracteristica']['Categoria']))
			{
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array(
					'Categories (x,y,z...)' => implode(',', Hash::extract($producto['Grupocaracteristica']['Categoria'], '{n}.id_category'))));
			}

			# Precio
			if (isset($producto['precio'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Price tax excluded or Price tax included' => $producto['precio']));
			}

			# Referencia
			if (isset($producto['referencia'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Reference #' => $producto['referencia']));
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Supplier reference #' => $producto['referencia']));
			}

			# Proveedor
			if (isset($producto['proveedor_id'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Supplier' => $producto['Proveedor']['name']));
			}

			# Fabricante
			if (isset($producto['fabricante_id'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Manufacturer' => $producto['Fabricante']['name']));
			}

			# Largo
			if (isset($producto['largo'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Width' => $producto['largo']));
			}

			# Alto
			if (isset($producto['alto'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Height' => $producto['alto']));
			}

			# Profundidad
			if (isset($producto['profundidad'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Depth' => $producto['profundidad']));
			}

			# Peso
			if (isset($producto['peso'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Weight' => $producto['peso']));
			}

			# Stock inicial
			if (isset($producto['cantidad'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Quantity' => $producto['cantidad']));
			}

			# Descripción corta
			if (isset($producto['descripcion_corta'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Short description' => $producto['descripcion_corta'] ));
			}

			# Descripción
			if (isset($producto['descripcion'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Description' => $producto['descripcion'] ));
			}

			# Meta titulo
			if (isset($producto['meta_titulo'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Meta title' => $producto['meta_titulo'] ));
			}

			# Meta Keywords
			if (isset($producto['Grupocaracteristica']['Palabraclave'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array(
					'Meta keywords' => implode(',', Hash::extract($producto['Grupocaracteristica']['Palabraclave'], '{n}.nombre'))));
			}

			# Meta descripcion
			if (isset($producto['meta_descripcion'])) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('Meta description' => strip_tags($producto['meta_descripcion']) ));
			}

			# Imágenes
			if (isset($producto['Imagen'])) {
				$imagenes =  array();
				
				foreach ($producto['Imagen'] as $i => $imagen) {
					$imagenes[$i] = sprintf('%s%swebroot/img/Imagen/%d/%s', Router::fullBaseUrl(), $this->webroot, $imagen['id'], $imagen['imagen']);
				}

				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array(
					'Image URLs (x,y,z...)' => implode(',', $imagenes) ) );
			}

			# Características
			if ( isset($producto['Especificacion']) ) {
				$especificaciones = array();
				foreach ($producto['Especificacion'] as $ix => $especificacion) {
					foreach ($especificacion['Idioma'] as $ln => $idioma) {
						if ($idioma['id_lang'] == $datos['Tarea']['idioma_id'] && !empty($especificacion['EspecificacionesProducto']['valor'])) {

							if ( isset($producto['Grupocaracteristica']['UnidadMedida'][0]) 
							&& $producto['Grupocaracteristica']['id'] == $producto['Grupocaracteristica']['UnidadMedida'][0]['GrupocaracteristicaEspecificacion']['grupocaracteristica_id'] 
							&&  $especificacion['id_feature'] == $producto['Grupocaracteristica']['UnidadMedida'][0]['GrupocaracteristicaEspecificacion']['id_feature']) {
								$especificaciones[$ix] = sprintf('%s:%s %s:%d', $idioma['EspecificacionIdioma']['name'], $especificacion['EspecificacionesProducto']['valor'], $producto['Grupocaracteristica']['UnidadMedida'][0]['nombre'], $especificacion['EspecificacionesProducto']['id']);	
							}else{
								$especificaciones[$ix] = sprintf('%s:%s:%d', $idioma['EspecificacionIdioma']['name'], $especificacion['EspecificacionesProducto']['valor'], $especificacion['EspecificacionesProducto']['id']);
							}		
						}else{
							$this->Session->setFlash('Error al generar el excel. La tarea no tiene configurado el idioma o existe un problema de idiomas en el comercio.', null, array(), 'danger');
							$this->redirect(array('action' => 'view', $id));
						}
					}
				}

				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array(
					'Feature(Name:Value:Position)' => implode(',', $especificaciones) ) );

			}

			# Shop id
			if ( isset($datos['Tarea']['shop_id']) ) {
				$dataProducto[$key]['Producto'] = array_replace_recursive($dataProducto[$key]['Producto'], array('ID / Name of shop' => $datos['Tarea']['shop_id'] ));
			}
			
		}
		
		$campos			= array_keys($this->getExcelExportFormat($this->request->data['Tarea']['version']));
		$modelo			= $this->Tarea->alias;

		$this->set(compact('dataProducto', 'campos', 'modelo'));
	}


	public function guardarRevision() {

		
	}

	public function obtenerRevisiones() {
		$revisiones =  $this->Tarea->find('all', array(
			'conditions' => array(
				'Tarea.parent_id' => $this->request->data['Tarea']['id']
				),
			'fields' => array(
				'Tarea.id', 'Tarea.nombre', 'Tarea.created' 
				),
			'order' => array(
				'Tarea.created' => 'DESC'
				)
			));

		if (empty($revisiones)) {
			return array('0' => 'Sin revisiones');
		}else{
			return $revisiones;
		}
	}


	/**
	 * Métodos para Mantenedores
	 */
	
	public function maintainers_index()
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));

		$paginate = array(
			'recursive' => 0,
			'order' => 'Tarea.id DESC'
			);

		$paginate['conditions'] = array(
			'Tarea.parent_id' => null,
			'Tarea.usuario_id' => $this->Session->read('Auth.Mantenedor.id'),
			'Tarea.tienda_id' => $this->Session->read('Tienda.id')
			);

    	$total = 0;
    	$totalMostrados = 0;

    	$textoBuscar = null;

    	// Filtrado por formulario
		if ( $this->request->is('post') ) {

			if ( empty($this->request->data['Filtro']['estado']) && empty($this->request->data['Filtro']['f_inicio']) && empty($this->request->data['Filtro']['f_final'])) {
				$this->Session->setFlash('Seleccione criterio para filtrar' ,  null, array(), 'danger');
			}

			# Por estado
			if ( ! empty($this->request->data['Filtro']['estado']) && empty($this->request->data['Filtro']['f_inicio']) && empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'estado' => $this->request->data['Filtro']['estado']));
			}

			# Por estado y rango 
			if ( ! empty($this->request->data['Filtro']['estado']) && ! empty($this->request->data['Filtro']['f_inicio']) && ! empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'estado' => $this->request->data['Filtro']['estado'], 'f_inicio' => $this->request->data['Filtro']['f_inicio'], 'f_final' => $this->request->data['Filtro']['f_final']));
			}

			# Por rango
			if ( empty($this->request->data['Filtro']['estado']) && ! empty($this->request->data['Filtro']['f_inicio']) && ! empty($this->request->data['Filtro']['f_final']) ) {
				$this->redirect(array('controller' => 'tareas', 'action' => 'index', 'f_inicio' => $this->request->data['Filtro']['f_inicio'], 'f_final' => $this->request->data['Filtro']['f_final']));
			}
		}

		/**
		* Buscar por
		*/
	
		# Por estado
		if ( empty($this->request->params['named']['mantenedor']) && ! empty($this->request->params['named']['estado']) && empty($this->request->params['named']['f_inicio']) && empty($this->request->params['named']['f_final']) ) {
			switch ($this->request->params['named']['estado']) {
				case 'en_progreso':
					$paginate['conditions']['Tarea.en_progreso'] = 1;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'en_revision':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 1;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'rechazado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 1;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'finalizado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 1;
					break;
			}
		}

		# Por estado y rango
		if ( empty($this->request->params['named']['mantenedor']) && ! empty($this->request->params['named']['estado']) && ! empty($this->request->params['named']['f_inicio']) && ! empty($this->request->params['named']['f_final']) ) {
			switch ($this->request->params['named']['estado']) {
				case 'en_progreso':
					$paginate['conditions']['Tarea.en_progreso'] = 1;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'en_revision':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 1;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'rechazado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 1;
					$paginate['conditions']['Tarea.finalizado'] = 0;
					break;
				case 'finalizado':
					$paginate['conditions']['Tarea.en_progreso'] = 0;
					$paginate['conditions']['Tarea.en_revision'] = 0;
					$paginate['conditions']['Tarea.rechazado'] = 0;
					$paginate['conditions']['Tarea.finalizado'] = 1;
					break;
			}

			$paginate['conditions']['Tarea.created BETWEEN ? AND ?'] = array($this->request->params['named']['f_inicio'], $this->request->params['named']['f_final']);
		}

		# Por rango
		if ( empty($this->request->params['named']['mantenedor']) && empty($this->request->params['named']['estado']) && ! empty($this->request->params['named']['f_inicio']) && ! empty($this->request->params['named']['f_final']) ) {
			$paginate['conditions']['Tarea.created BETWEEN ? AND ?'] = array($this->request->params['named']['f_inicio'], $this->request->params['named']['f_final']);
		}


		$mantenedores = $this->Tarea->Usuario->find('list', array('conditions' => array('Usuario.activo' => 1)));
		$estados = array(
			'en_progreso' => 'En progreso',
			'en_revision' => 'En revisión',
			'rechazado'	=> 'Rechazado',
			'finalizado' => 'Finalizado'
			);

		$this->paginate		= $paginate;
		$tareas	= $this->paginate();

		BreadcrumbComponent::add('Mis tareas ');

		$this->set(compact('tareas', 'mantenedores', 'estados'));
	}

	public function maintainers_work($id = null) 
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( ! $this->esMiTarea($id) ) {
			$this->Session->setFlash('Esta tarea ya no se encuentra disponible.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			if (!empty($this->request->data['Comentario'])) {
					
				if ( $this->Tarea->saveAssociated($this->request->data) ) {
					$this->Session->setFlash('Comentario agregado con éxito', null, array(), 'success');
					$this->redirect(array('action' => 'work', $id));
				}else{
					$this->Session->setFlash('Error al guardar el comentario', null, array(), 'danger');
					$this->redirect(array('action' => 'work', $id));
				}
			}
		}
		else
		{	
			# Actualizamos los comentarios no visualizados a visualizado
			$this->visualizarComentarios($id);

			# Cambiamos el estado a en prgreso
			if ( ! $this->cambiarEstadoTarea($id, 'en_progreso') ) {
				$this->Session->setFlash('Error al ingresar a la tarea', null, array(), 'danger');
				$this->redirect(array('action' => 'index'));
			}

			$this->request->data	= $this->Tarea->find('first', array(
				'conditions'	=> array('Tarea.id' => $id),
				'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'Grupocaracteristica', 'Adjunto', 'Producto' => array('Fabricante', 'Proveedor', 'Grupocaracteristica', 'Marca'), 'Comentario' => array('Importancia', 'Usuario', 'Administrador'))
			));

			$importancias = ClassRegistry::init('Importancia')->find('list', array('conditions' => array('Importancia.activo' => 1)));

			$this->set(compact('importancias'));
		}

		BreadcrumbComponent::add(sprintf('Trabajando en %s', $this->request->data['Tarea']['nombre']));

	}


	public function maintainers_view($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$tarea = $this->esMiTareaFinalizada($id);

		if ( ! $tarea ) {
			$this->Session->setFlash('Esta tarea ya no se encuentra disponible.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->data	= $this->Tarea->find('first', array(
			'conditions'	=> array('Tarea.id' => $id),
			'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'Grupocaracteristica', 'Adjunto', 'Producto' => array('Fabricante', 'Proveedor', 'Grupocaracteristica', 'Marca'), 'Comentario' => array('Importancia', 'Usuario', 'Administrador'))
		));

		$importancias = ClassRegistry::init('Importancia')->find('list', array('conditions' => array('Importancia.activo' => 1)));

		BreadcrumbComponent::add( $this->request->data['Tarea']['nombre'] );

		$this->set(compact('importancias'));
		
	}

	public function maintainers_start($id = null) {
		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('No existe la tarea.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$tarea = $this->esMiTarea($id);

		if ( ! $tarea ) {
			$this->Session->setFlash('Esta tarea ya no se encuentra disponible.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		# Iniciamos la tarea
		$tarea =  array_replace_recursive(array(
			'Tarea' => array(
				'porcentaje_realizado' => 1,
				'iniciado' => 1,
				'fecha_iniciado' => date('Y-m-d H:i:s'),
				'en_progreso' => 1
				)
			), $tarea);
		
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));

	 	if ($this->Tarea->save($tarea) ) {
	 		$this->redirect(array('action' => 'work', $id));
	 	}else{
	 		$this->Session->setFlash('Error al iniciar la tarea, intente nuevamente.', null, array(), 'danger');
	 		$this->redirect(array('action' => 'index'));
	 	}
	}

	/**
	 * Función que permite cambiar el estado de una tarea.
	 * 
	 * Los posibles estados son:
	 * 		en_progreso  	El mantenedor está trabajando actualemnte en la tarea.
	 * 		en_revision  	El administrador está revisando la tarea.
	 * 		rechazado 		El administrador rechaó la tarea y vuelve al mantenedor.
	 * 		finalizado   	El mantenedor y el administrador dieron por finalizada la tarea.
	 * 		
	 * @param  		int 		$id     	Identofocador de la tarea
	 * @param  		string 		$estado 	Uno de los estados descritos arriba
	 * @return 		void 					si se actualiza con exito, de los contrario redirecciona al index mostrando un mensaje de error.
	 */
	public function maintainers_enviar_a_revision($id = null) {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop', 'Proveedor', 'Fabricante'));

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('No existe la tarea.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$tarea = $this->esMiTarea($id);

		if ( ! $tarea ) {
			$this->Session->setFlash('Esta tarea ya no se encuentra disponible.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			# Cambiar estado de una tarea
			if ( ! $this->cambiarEstadoTarea($id, 'en_revision')) {
				$this->Session->setFlash('No se puedo enviar a revisión la tarea. Intente nuevamente', null, array(), 'danger');
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('La tarea fue enviada al administrador con éxito.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}
