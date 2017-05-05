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
			if ( ! empty($this->request->data['Tarea']['usuario_id'])) {
				$this->request->data['Tarea']['asignada'] = true;
			}

			$this->Tarea->create();
			if ( $this->Tarea->saveAll($this->request->data) )
			{
				$this->Session->setFlash('Nueva tarea agregada y notificada con éxito.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		$usuarios	= $this->Tarea->Usuario->find('list', array('conditions' => array('activo' => 1)));
		$grupocaracteristicas	= $this->Tarea->Grupocaracteristica->find('list', array('conditions' => array('activo' => 1)));
		$idiomas = $this->Tarea->Idioma->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$shops = $this->Tarea->Shop->find('list');
		
		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops','grupocaracteristicas'));
	}

	public function admin_edit($id = null)
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Impuesto', 'ImpuestoIdioma', 'Idioma', 'Shop'));
		

		if ( ! $this->Tarea->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			# Se eliminan los adjuntos
			$this->quitarAdjuntos($this->request->data['Tarea']['ElementosEliminados']);
			
			# Eliminar rel palabras claves
			$this->Tarea->GrupocaracteristicaTarea->deleteAll(array('GrupocaracteristicaTarea.tarea_id' => $id));
			#$this->Tarea->PalabraclaveTarea->deleteAll(array('PalabraclaveTarea.tarea_id' => $id));
			
			if ( $this->Tarea->saveAll($this->request->data) )
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
			$this->request->data	= $this->Tarea->find('first', array(
				'conditions'	=> array('Tarea.id' => $id),
				'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'ParentTarea', 'Grupocaracteristica', 'Adjunto', 'Comentario')
			));
			
		}

		$usuarios	= $this->Tarea->Usuario->find('list');
		$parentTareas	= $this->Tarea->ParentTarea->find('list');
		$grupocaracteristicas	= $this->Tarea->Grupocaracteristica->find('list', array('conditions' => array('activo' => 1)));
		$idiomas = $this->Tarea->Idioma->find('list');
		$impuestos = $this->obtenerImpuestoTarea();
		$shops = $this->Tarea->Shop->find('list');
		$revisiones = $this->obtenerRevisiones();
		
		$this->set(compact('usuarios', 'impuestos', 'idiomas', 'shops', 'parentTareas', 'tiendas', 'grupocaracteristicas', 'revisiones'));
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
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_activar( $id = null ) {
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
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
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
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
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
			$this->Session->setFlash('No se puedo cambiar el estado del registro. Intente nuevamente', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Estado cambiado con éxito', null, array(), 'success');
			$this->redirect(array('action' => 'review', $id));
		}
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
			'order' => 'Tarea.fecha_entrega ASC'
			);

		$paginate['conditions'] = array(
			'Tarea.parent_id' => null,
			'Tarea.usuario_id' => $this->Session->read('Auth.Mantenedor.id')
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

			$this->request->data	= $this->Tarea->find('first', array(
				'conditions'	=> array('Tarea.id' => $id),
				'contain' => array('Usuario', 'ImpuestoReglaGrupo', 'Idioma', 'Shop', 'Grupocaracteristica', 'Adjunto', 'Producto' => array('Fabricante', 'Proveedor', 'Grupocaracteristica'), 'Comentario' => array('Importancia', 'Usuario', 'Administrador'))
			));

			$importancias = ClassRegistry::init('Importancia')->find('list', array('conditions' => array('Importancia.activo' => 1)));

			$this->set(compact('importancias'));
		}

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
}
