<?php
App::uses('Controller', 'Controller');
//App::uses('FB', 'Facebook.Lib');
class AppController extends Controller
{	
	public $usarBreadCrumbs;
	public $helpers		= array(
		'Session', 'Html', 'Form', 'PhpExcel'
		//, 'Facebook.Facebook'
	);

	public $components	= array(
		'Session',
		'Cookie',
		'Auth'		=> array(
			'Form'				=> array(
				'fields' => array(
					'username'	=> 'email',
					'password'	=> 'clave'
				)
			)
		),
		'Google'		=> array(
			'applicationName'		=> 'Nodriza',
			'developerKey'			=> 'cristian.rojas@nodriza.cl',
			'clientId'				=> '1376469050-578ce8n9fd7sgu3iq5nvod8q5iqa9jan.apps.googleusercontent.com',
			'clientSecret'			=> 'gkd8jEpmxF9s3qsZRgU1y1mu',
			//'redirectUri'			=> Router::url(array('controller' => 'administradores', 'action' => 'google', 'admin' => false), true)),
			'approvalPrompt'		=> 'auto',
			'accessType'			=> null,//'offline',
			'scopes'				=> array('profile', 'email')
		),
		'DebugKit.Toolbar',
		'TinyPng.Tiny',
		'Prisync',
		'Breadcrumb' => array(
			'crumbs'		=> array(
				array('Inicio', ''),
			)
		)
		//'Facebook.Connect'	=> array('model' => 'Usuario'),
		//'Facebook'
	);

	public function beforeFilter()
	{	
		/*$errors = array();
		$productos = array();
		try {
			$productos = $this->Prisync->obtenerProductos();
		} catch (Exception $e) {
			$errors['Productos'][] = $e->getMessage();
		}

		if (isset($productos['results'])) {
			foreach ($productos['results'] as $ip => $producto) {
	
				$productoDetalle = $this->Prisync->obtenerProductoPorId($producto['id']);
				$urls = array();
				if (!empty($productoDetalle['urls'])){
					foreach ($productoDetalle['urls'] as $ipu => $urlId) {
						$urls[] = $this->Prisync->obtenerCompetidoresPorProducto($urlId);
					}
				}

				$productos['results'][$ip]['urls'] = $urls;
			}
			prx($productos);
		}else{
			prx($errors);
		}*/

		
		#prx($this->Prisync->obtenerCompetidoresPorProducto(1906453));
		/**
		 * Layout y permisos públicos
		 */
		if ( ! isset($this->request->params['prefix']) ) {
			//prx($this->request->params);
			$this->Auth->allow();
		}


		/**
		 * Layout administracion
		 */
		if ( ! empty($this->request->params['admin']) )
		{
			$this->layoutPath				= 'backend';
			AuthComponent::$sessionKey		= 'Auth.Administrador';

			// Login action config
			$this->Auth->loginAction['controller'] 	= 'administradores';
			$this->Auth->loginAction['action'] 		= 'login';
			$this->Auth->loginAction['admin'] 		= true;

			// Login redirect and logout redirect
			$this->Auth->loginRedirect = '/admin';
			$this->Auth->logoutRedirect = '/admin';

			// Login Form config
			$this->Auth->authenticate['Form']['userModel']		= 'Administrador';
			$this->Auth->authenticate['Form']['fields']['username'] = 'email';
			$this->Auth->authenticate['Form']['fields']['password'] = 'clave';


			/**
			 * OAuth Google
			 */
			$this->Google->cliente->setRedirectUri(Router::url(array('controller' => 'administradores', 'action' => 'login'), true));
			$this->Google->oauth();

			if ( ! empty($this->request->query['code']) && $this->Session->read('Google.code') != $this->request->query['code'] )
			{
				$this->Google->oauth->authenticate($this->request->query['code']);
				$this->Session->write('Google', array(
					'code'		=> $this->request->query['code'],
					'token'		=> $this->Google->oauth->getAccessToken()
				));
			}

			if ( $this->Session->check('Google.token') )
			{
				$this->Google->cliente->setAccessToken($this->Session->read('Google.token'));
			}

		}

		/**
		* Layout mantenedores
		*/
		if ( ! empty($this->request->params['maintainers']) ) {

			$this->layoutPath				= 'maintainers-backend';

			AuthComponent::$sessionKey		= 'Auth.Mantenedor';

			// Login action config
			$this->Auth->loginAction['controller'] 	= 'usuarios';
			$this->Auth->loginAction['action'] 		= 'login';
			$this->Auth->loginAction['maintainers'] 		= true;

			// Login redirect and logout redirect
			$this->Auth->loginRedirect = '/maintainers/mis-tareas';
			$this->Auth->logoutRedirect = '/maintainers/login';
			$this->Auth->redirectUrl = '/maintainers/mis-tareas';


			// Permitir a usuario no logeado ingresar a los métodos
			// $this->Auth->allow('maintainers_registro', 'maintainers_recuperarclave');

			// Login Form config
			$this->Auth->authenticate['Form']['userModel']		= 'Usuario';
			$this->Auth->authenticate['Form']['fields']['username'] = 'email';
			$this->Auth->authenticate['Form']['fields']['password'] = 'clave';
		}

		/**
		 * Logout FB
		 */
		/*
		if ( ! isset($this->request->params['admin']) && ! $this->Connect->user() && $this->Auth->user() )
			$this->Auth->logout();
		*/

		/**
		 * Detector cliente local
		 */
		$this->request->addDetector('localip', array(
			'env'			=> 'REMOTE_ADDR',
			'options'		=> array('::1', '127.0.0.1'))
		);

		/**
		 * Detector entrada via iframe FB
		 */
		$this->request->addDetector('iframefb', array(
			'env'			=> 'HTTP_REFERER',
			'pattern'		=> '/facebook\.com/i'
		));

		/**
		 * Cookies IE
		 */
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');


		/**
		 * Cambiar tienda
		 */

		$this->cambioTienda();
		
		if (isset($this->request->params['prefix']) && $this->request->params['controller'] == 'tareas' && $this->request->params['action'] == sprintf('%s_edit', $this->request->params['prefix']) && ! empty($this->request->params['pass']) ) {
			$this->forzarCambioTienda();
		}

		if (isset($this->request->params['prefix']) && $this->request->params['controller'] == 'tareas' && $this->request->params['action'] == sprintf('%s_work', $this->request->params['prefix']) && ! empty($this->request->params['pass']) ) {
			$this->forzarCambioTienda();
		}
		
	}

	/**
	 * Guarda el usuario Facebook
	 */
	public function beforeFacebookSave()
	{
		if ( ! isset($this->request->params['admin']) )
		{
			$this->Connect->authUser['Usuario']		= array_merge(array(
				'nombre_completo'	=> $this->Connect->user('name'),
				'nombre'			=> $this->Connect->user('first_name'),
				'apellido'			=> $this->Connect->user('last_name'),
				'usuario'			=> $this->Connect->user('username'),
				'clave'				=> $this->Connect->authUser['Usuario']['password'],
				'email'				=> $this->Connect->user('email'),
				'sexo'				=> $this->Connect->user('gender'),
				'verificado' 		=> $this->Connect->user('verified'),
				'edad'				=> $this->Session->read('edad')
			), $this->Connect->authUser['Usuario']);
		}

		return true;
	}

	public function beforeRender() {

		if ( ! empty($this->request->params['admin']) ) {
			// Capturar permisos de usuario
			try {
				$permisos = $this->hasPermission();
			} catch (Exception $e) {
				$permisos = $e;
			}
			
			// Permisos públicos
			if ( is_object($permisos) && $permisos->getCode() != 66 ) {
				$this->Session->setFlash($permisos->getMessage(), null, array(), 'danger');
				$this->redirect(sprintf('/%s', $this->request->params['prefix']));
			}

			// Modulos activos y disponibles para este Rol
			$modulosDisponibles = $this->modulosDisponibles( $this->Auth->user('rol_id') );
			
			// Tiendas
			$tiendasList = $this->obtenerTiendas();

			// Tareas
			$tareasNotificacion =  $this->tareasRevision();

			// Comentarios
			$comentariosNotificacion =  $this->tareasComentarios();

			/**
			 * Camino de migas automático
			 */
			$this->caminoAutomatico();

			// Camino de migas
			$breadcrumbs	= BreadcrumbComponent::get();
			if ( ! empty($breadcrumbs) ) {
				$this->set(compact('breadcrumbs'));
			}


			/**
			 * Mis tareas
			 */
			$misTareas = $this->misTareas();


			$this->set(compact('permisos', 'modulosDisponibles', 'tiendasList', 'tareasNotificacion', 'comentariosNotificacion', 'misTareas'));
		}

		if ( ! empty($this->request->params['maintainers']) ) {
			// Tiendas
			$tiendasList = $this->obtenerTiendas();

			// Camino de migas
			$breadcrumbs	= BreadcrumbComponent::get();
			if ( ! empty($breadcrumbs) ) {
				$this->set(compact('breadcrumbs'));
			}

			$miAcumulado = $this->miAcumulado();

			$miAcumuladoMesActual = 0;
			$miAcumuladoTotal = 0;

			foreach ($miAcumulado['Actual'] as $ix => $valor) {
				$miAcumuladoMesActual = $miAcumuladoMesActual + $valor['Pago']['monto_a_pagar'];
			}

			foreach ($miAcumulado['Total'] as $ix => $valor) {
				$miAcumuladoTotal = $miAcumuladoTotal + $valor['Pago']['monto_a_pagar'];
			}
			
			if ( $this->Cookie->check('CUENTA') ) {
				
			}

			// Tareas
			$tareasNotificacion = $this->tareasSinIniciar();

			// Comentarios
			$comentariosNotificacion =  $this->tareasComentarios();

			$cuenta = ClassRegistry::init('Cuenta')->find('first', array(
				'conditions' => array('usuario_id' => $this->Auth->user('id')),
				'contain' => array('Banco', 'TipoCuenta')
				));

			/**
			 * Mis tareas
			 */
			$misTareas = $this->misTareas();
			
			$this->set(compact('tiendasList', 'miAcumuladoMesActual', 'miAcumuladoTotal', 'cuenta', 'tareasNotificacion', 'comentariosNotificacion', 'misTareas'));
		}


	}

	/**
	 * Retorna un listado de tiendas activas
	 * @return 	array 	Listado de tiendas
	 */
	private function obtenerTiendas() {
		$tiendas = ClassRegistry::init('Tienda')->find('list', array(
			'conditions' => array('Tienda.activo' => 1)
			));

		if (empty($tiendas)) {
			return array( 0 => 'No existen tiendas');
		}

		return $tiendas;
	}

	/**
	* Functión que determina si el usuario tien permisos para editar, 
	* eliminar y agregar dentro de los módulos.
	* @return 	Array 	$permisosControladorActual 	Arreglo con infromación del acceso al módulo.
	*/ 
	public function hasPermission()
	{
		$jsonPermisos = ClassRegistry::init('Rol')->find('first', array('conditions' => array('Rol.id' => $this->Auth->user('rol_id')), 'fields' => array('permisos')));

		if (empty($jsonPermisos)) {
			return false;
		}

		if (empty($jsonPermisos['Rol']['permisos']) && $this->request->params['action'] != 'admin_login' && $this->request->params['action'] != 'admin_logout') {
		 	throw new Exception('Falta Json con información de permisos.', 11);
		}

		if ( $this->request->params['action'] == 'admin_login' || $this->request->params['action'] == 'admin_logout' ) {
			throw new Exception('Acceso público.', 66);
		}

		$json = json_decode( $jsonPermisos['Rol']['permisos'], true );

		$controladorActual = $this->request->params['controller'];

		$accionActual = $this->request->params['action'];
		

		if( ! array_key_exists($controladorActual, $json) ){
			throw new Exception('Imposible acceder a ese módulo.', 12);
		}

		$permisosControladorActual = $json[$controladorActual];
	
		if( empty($permisosControladorActual) ) {
			throw new Exception('No tiene permiso de acceder a ese módulo.', 13);
		}else {
			return $permisosControladorActual;
		}	
	}


	/**
	 * Function que determina el Rol del usuario y controla el acceos a los módulos
	 * @return array $data  Lista de módulos disponibles para le usuario.
	 */
	public function modulosDisponibles( $rol = '' ){

		if ( empty($rol) ) {
			return false;
		}

		$modulos = ClassRegistry::init('Modulo')->find('all', array(
				'conditions' => array('parent_id' => NULL, 'Modulo.activo' => 1),
				'order' => array('orden' => 'ASC'),
				'joins' => array(
					array(
						'table' => 'modulos_roles',
			            'alias' => 'md',
			            'type'  => 'INNER',
			            'conditions' => array(
			                'md.modulo_id = Modulo.id',
			                'md.rol_id' => $rol)
					)
				),
				'fields' => array('Modulo.id', 'Modulo.parent_id', 'Modulo.nombre', 'Modulo.url', 'Modulo.icono')));
		$data = array();
		foreach ($modulos as $padre) {
			$data[] = array(
				'nombre' => $padre['Modulo']['nombre'],
				'icono'	 => $padre['Modulo']['icono'],
				'url'	 => $padre['Modulo']['url'],
				'hijos' => ClassRegistry::init('Modulo')->find(
					'all', array(
						'conditions' => array('Modulo.parent_id' => $padre['Modulo']['id'], 'Modulo.activo' => 1 ),
						'contain' => array('Rol'),
						'order' => array('orden' => 'ASC'),
						'joins' => array(
							array(
								'table' => 'modulos_roles',
					            'alias' => 'md',
					            'type'  => 'INNER',
					            'conditions' => array(
					                'md.modulo_id = Modulo.id',
					                'md.rol_id' => $rol					            )
							)
						),
						'fields' => array('Modulo.id', 'Modulo.parent_id', 'Modulo.nombre', 'Modulo.url', 'Modulo.icono')
					)
				)
			);
		}
		return $data;
	}

	/**
	 * Muestra las tareas que se han enviado a revisión al administrador responsable
	 * @return 		array 	Listado de tareas
	 */	
	public function	tareasRevision() {

		$misTareas = ClassRegistry::init('Tarea')->find('all', array(
			'conditions' => array(
				'Tarea.finalizado' => 0,
				'Tarea.en_progreso' => 0,
				'Tarea.en_revision' => 1,
				'Tarea.administrador_id' => $this->Auth->user('id')
				),
			'contain' => array(
				'Usuario',
				'Tienda'
				),
			'fields' => array(
				'Tarea.nombre',
				'Tarea.created',
				'Tarea.activo',
				'Tarea.en_revision',
				'Tarea.porcentaje_realizado',
				'Usuario.nombre',
				'Usuario.email',
				'Tienda.nombre',
				'Tarea.id'
				),
			'limit' => 50,
			'order' => array(
				'Tarea.modified' => 'DESC'
				)
			));

		return $misTareas;
	}


	/**
	 * Muestra las tareas que se han enviado a revisión al administrador responsable
	 * @return 		array 	Listado de tareas
	 */	
	public function	tareasSinIniciar() {

		$misTareas = ClassRegistry::init('Tarea')->find('all', array(
			'conditions' => array(
				'Tarea.iniciado' => 1,
				'Tarea.finalizado' => 0,
				'Tarea.en_progreso' => 1,
				'Tarea.en_revision' => 0,
				'Tarea.usuario_id' => $this->Auth->user('id')
				),
			'contain' => array(
				'Usuario',
				'Tienda'
				),
			'fields' => array(
				'Tarea.nombre',
				'Tarea.created',
				'Tarea.activo',
				'Tarea.en_revision',
				'Tarea.porcentaje_realizado',
				'Usuario.nombre',
				'Usuario.email',
				'Tienda.nombre',
				'Tarea.id'
				),
			'limit' => 50,
			'order' => array(
				'Tarea.modified' => 'DESC'
				)
			));

		return $misTareas;
	}


	public function misTareas()
	{
		$options = array();

		if ($this->request->params['prefix'] == 'admin') {
			$options['conditions'] = array(
				'Tarea.administrador_id' => $this->Auth->user('id'),
				'Tarea.finalizado' => 0
			);

			$options['contain'] = array(
				'Usuario'
			);
		}

		if ($this->request->params['prefix'] == 'maintainers') {
			$options['conditions'] = array(
				'Tarea.usuario_id' => $this->Auth->user('id'),
				'Tarea.finalizado' => 0
			);
		}

		$tareas = ClassRegistry::init('Tarea')->find('all', $options);

		$listaTareas =  array();
		foreach ($tareas as $it => $tarea) {
			if (isset($tarea['Usuario']) && !empty($tarea['Usuario'])) {

				$groupLabel = sprintf('%s - %s', $tarea['Usuario']['nombre'], $tarea['Usuario']['email']); 
				$listaTareas[$groupLabel][$tarea['Tarea']['id']] = $tarea['Tarea']['nombre']; 
			}else{
				$listaTareas[$tarea['Tarea']['id']] = $tarea['Tarea']['nombre'];
			}
		}

		return $listaTareas;
	}
	


	public function	tareasComentarios() {

		if ( isset($this->request->params['admin']) ) {
			$options['conditions'] = array(
				'Comentario.visualizado' => 0,
				'Comentario.administrador_id' => '',
			);

			$options['contain'] = array('Tarea');
		}


		if ( isset($this->request->params['maintainers']) ) {
			$options['conditions'] = array(
				'Comentario.visualizado' => 0,
				'Comentario.usuario_id' => '',
			);

			$options['contain'] = array('Tarea');
		}


		
		$comentarios = ClassRegistry::init('Comentario')->find('all', $options);


		foreach ($comentarios as $key => $value) {

			if ( ! $this->esMiTarea($value['Tarea']['id']) ) {
				unset($comentarios[$key]);
			}
			
		}
		
		return count($comentarios);
	}


	public function visualizarComentarios($id = null) {

		if ( isset($this->request->params['admin']) ) {
			$options['conditions'] = array(
				'Comentario.visualizado' => 0,
				'Comentario.administrador_id' => '',
				'Comentario.tarea_id' => $id
			);
		}


		if ( isset($this->request->params['maintainers']) ) {
			$options['conditions'] = array(
				'Comentario.visualizado' => 0,
				'Comentario.usuario_id' => '',
				'Comentario.tarea_id' => $id
			);
		}

		$options['fields'] = array('Comentario.id');

		$comentarios = ClassRegistry::init('Comentario')->find('all', $options);
			
		foreach ($comentarios as $indice=> $comentario) {
			$comentarios[$indice]['Comentario']['visualizado'] = 1;
			$comentarios[$indice]['Comentario']['fecha_visualizado'] = date('Y-m-d H:i:s');
		}
		
		if ( !empty($comentarios) ) {
			ClassRegistry::init('Comentario')->saveMany($comentarios);
		}
	}


	private function cambioTienda() {
		# si es una peticioón post
		if (isset($this->request->data['Tienda']['tienda']) ) {

			# Tema de la tienda
			$tienda = ClassRegistry::init('Tienda')->find('first', array(
				'conditions' => array('Tienda.id' => $this->request->data['Tienda']['tienda'])
				));

			# Método actual
			$action = str_replace(sprintf('%s_', $this->request->params['prefix']), '', $this->request->params['action']);
			
			# Redireccionamos a mismo
			# Si tiene parámetros se redirecciona al index del controllador actual
			if ( !empty($this->request->params['pass']) ) {

				# Cambiamos Session Tienda
				$this->Session->write('Tienda', $tienda['Tienda']);
				
				# Redireccionamos
				if ( isset($this->request->params['maintainers']) ) {
					$this->redirect(array('controller' => 'tareas', 'action' => 'index'));	
				}else{
					$this->redirect(array('action' => 'index'));
				}
			}

			# Cambiamos Session Tienda
			$this->Session->write('Tienda', $tienda['Tienda']);

			$this->redirect(array('action' => $action));
			
		}

	}

	private function forzarCambioTienda()
	{
		$tarea = ClassRegistry::init('Tarea')->find('first', array(
			'conditions' => array('Tarea.id' => $this->request->params['pass'][0])
			)
		);

		# Tema de la tienda
		$tienda = ClassRegistry::init('Tienda')->find('first', array(
			'conditions' => array('Tienda.id' => $tarea['Tarea']['tienda_id'])
			));

		# Cambiamos Session Tienda
		$this->Session->write('Tienda', $tienda['Tienda']);
		return;

	}

	/**
	 * Método que agrega un datasource a los modelos pasados en el arreglo, según la ´tienda que se esté trabajando.
	 * @param  array  $modelos Nombres de los modelos
	 * @return void
	 */
	public function cambiarDatasource( $modelos = array() ) {

		foreach ($modelos as $instancia) {
			ClassRegistry::init($instancia)->useDbConfig 	= $this->Session->read('Tienda.db_configuracion');
		}
	}

	public function obtenerImpuestoTarea() {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('ImpuestoReglaGrupo'));

		$impuestoGrupos = ClassRegistry::init('ImpuestoReglaGrupo')->find('list');		

		return $impuestoGrupos;
	}

	public function obtenerIdiomaTarea() {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Idioma'));

		$idiomas = ClassRegistry::init('Idioma')->find('list');		
		
		return $idiomas;
	}

	public function obtenerShopTarea() {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Shop'));

		$shops = ClassRegistry::init('Shop')->find('list');		
		
		return $shops;
	}

	public function obtenerListaEspecificaciones() {

		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Especificacion', 'EspecificacionIdioma', 'Idioma', 'EspecificacionValor', 'EspecificacionValorIdioma'));

		$especificaciones = ClassRegistry::init('Especificacion')->find('all', array(
			'contain' => array(
				'Idioma',
				),
			'limit' => 100
			));		

		return $especificaciones;
	}

	/**
	 * Función que crea un camino de migas según el controllador y la acción que se está ejecutando.
	 * @return [type] [description]
	 */
	public function caminoAutomatico() {

		BreadcrumbComponent::add(Inflector::humanize($this->request->params['controller']), sprintf('/%s/%s', $this->request->params['prefix'], $this->request->params['controller']));
	
		switch ($this->request->params['action']) {
			case sprintf('%s_index', $this->request->params['prefix']):
				 // Do nothing
				break;
			case sprintf('%s_add', $this->request->params['prefix']):
				BreadcrumbComponent::add('Agregar ');
				break;
			case sprintf('%s_edit', $this->request->params['prefix']):
				BreadcrumbComponent::add('Editar ');
				break;
			case sprintf('%s_view', $this->request->params['prefix']):
				BreadcrumbComponent::add('Ver ');
				break;
			case sprintf('%s_review', $this->request->params['prefix']):
				BreadcrumbComponent::add('Revisar ');
				break;
			case sprintf('%s_work', $this->request->params['prefix']):
				BreadcrumbComponent::add('Trabajar ');
				break;
		}
	}

	/**
	 * Función que elimna lós elementos adjuntos por id
	 * @param  string 	$ids 	String de IDs separados por coma  
	 * @return void
	 */
	public function quitarElementos( $ids = '', $clase = '' ) {
		if ( ! empty($ids) ) {
			# Adjuntos eliminados
			$arrayEliminadas = explode(",", $ids);
			
			ClassRegistry::init($clase)->deleteAll(array(sprintf('%s.id', $clase) => $arrayEliminadas));	
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
	public function cambiarEstadoTarea($idTarea = null, $estado = '' ) {
		if (is_null($idTarea) || empty($estado)) {
			return false;
		}

		$tarea = array(
			'Tarea' => array(
				'id' => $idTarea,
				'en_progreso' 	=> 0,
				'en_revision' 	=> 0,
				'rechazado'		=> 0,
				'finalizado' 	=> 0
			)
		);

		if ($estado == 'finalizado') {
			$tarea['Tarea']['fecha_finalizado'] = date('Y-m-d H:i:s');
		}

		if (array_key_exists($estado, $tarea['Tarea'])) {
			$tarea['Tarea'][$estado] = 1;
			if ( ClassRegistry::init('Tarea')->save($tarea) ) {
				return true;
			}else{
				return false;
			}
		}
		else {
			return false;
		}
	}


	public function calcularMontoTarea ($id = '') {
		if (empty($id)) {
			return false;
		}

		$tarea = ClassRegistry::init('Tarea')->find('first', array(
			'Tarea.id' => $id
			));

		if (empty($tarea)) {
			return false;
		}

	}

	/**
	 * Funcíon que permite identificar si la tarea a la que se está visualizando está asignada al visitante.
	 * @param  int 		$id 	Identificador de la tarea
	 * @return bool
	 */
	public function esMiTarea( $id = null ) {

		if ( empty($id) ) {
			return false;
		}

		if ( isset($this->request->params['admin']) ) {
			$options['conditions'] = array(
				'Tarea.id' => $id,
				'Tarea.administrador_id' => $this->Auth->user('id')
			);
		}

		if ( isset($this->request->params['maintainers']) ) {
			$options['conditions'] = array(
				'Tarea.id' => $id,
				'Tarea.usuario_id' => $this->Auth->user('id'),
				'Tarea.en_revision' => 0,
				'Tarea.finalizado' => 0,
			);
		}

		$options['fields'] = array('id', 'administrador_id', 'nombre');

		$miTarea = ClassRegistry::init('Tarea')->find('first', $options);

		if (!empty($miTarea)) {
			return $miTarea;
		}
		
		return false;
	}

	/**
	 * Funcíon que permite identificar si la tarea a la que se está visualizando está asignada al visitante.
	 * @param  int 		$id 	Identificador de la tarea
	 * @return bool
	 */
	public function esMiTareaFinalizada( $id = null ) {

		if ( empty($id) ) {
			return false;
		}

		if ( isset($this->request->params['admin']) ) {
			$options['conditions'] = array(
				'Tarea.id' => $id,
				'Tarea.administrador_id' => $this->Auth->user('id')
			);
		}

		if ( isset($this->request->params['maintainers']) ) {
			$options['conditions'] = array(
				'Tarea.id' => $id,
				'Tarea.usuario_id' => $this->Auth->user('id'),
				'Tarea.en_revision' => 0,
				'Tarea.finalizado' => 1,
			);
		}

		$options['fields'] = array('id', 'administrador_id', 'nombre');

		$miTarea = ClassRegistry::init('Tarea')->find('first', $options);

		if (!empty($miTarea)) {
			return $miTarea;
		}
		
		return false;
	}


	public function esMiProducto( $id = null, $tarea = null ) {

		if ( empty($id) ) {
			return false;
		}
		
		$options['conditions'] = array(
			'Producto.id' => $id,
			'Producto.usuario_id' => $this->Auth->user('id'),
			'Producto.tarea_id' => $tarea,
			'Producto.aceptado' => 0
		);

		$options['fields'] = array('id', 'usuario_id');

		$miProducto = ClassRegistry::init('Producto')->find('first', $options);
		
		if (!empty($miProducto)) {
			return true;
		}
		
		return false;
	}


	public function miAcumulado() {

		# Acumulados no pagados mes actual
		$rangoFechas = array(
			date('Y-m-01 00:00:00'),
			date('Y-m-t 23:59:59')	
			);
		
		$pagos['Actual'] = ClassRegistry::init('Pago')->find('all', array(
			'conditions' => array(
				'Pago.usuario_id' => $this->Auth->user('id'),
				'Pago.created BETWEEN ? AND ? ' => $rangoFechas,   
				'Pago.pagado' => 0
				)
			));

		$pagos['Total'] = ClassRegistry::init('Pago')->find('all', array(
			'conditions' => array(
				'Pago.usuario_id' => $this->Auth->user('id'),   
				'Pago.pagado' => 0
				)
			));


		return $pagos;
	}


	/**
	* Calular IVA
	* @param 	$precio 	num 	Valor del producto
	* @param 	$iva 		bool 	Valor del IVA
	* @return 	Integer 	Valor calculado
	*/
	public function precio($precio = null, $iva = null) {
		if ( !empty($precio) && !empty($iva)) {
			// Se quitan los 00
			$iva = intval($iva);

			//Calculamos valor con IVA
			$precio = ($precio + round( ( ($precio*$iva) / 100) ) );

			return round($precio);
		}
	}


	public function precio_neto($precio = null, $iva = 19)
	{
		if (!is_null($precio)) {

			$iva = ($iva / 100) +1;

			return round( $precio / $iva );
		}

		return;
	}


	public function precio_bruto($precio = null, $iva = 19)
	{
		if (!is_null($precio)) {

			$iva = ($iva / 100) +1;

			return round( $precio * $iva );
		}
		
		return;
	}
}
