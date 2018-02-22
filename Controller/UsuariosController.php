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
			# Bit que habilita la notificacion al usuario
			$this->request->data['Usuario']['creado'] = true;
			
			# creamos la clave nueva de 10 dígitos random
			$this->request->data['Usuario']['clave'] = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
			$this->request->data['Usuario']['clave_normal'] = $this->request->data['Usuario']['clave'];

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
		{	#prx($this->request->data);

			if (empty($this->request->data['Usuario']['id_pago']) 
				|| empty($this->request->data['Usuario']['monto_pagado'])
				|| empty($this->request->data['Usuario']['codigo_pago']) 
				|| empty($this->request->data['Usuario']['medio_de_pago']) 
				|| empty($this->request->data['Usuario']['fecha_pagado']) 
				|| empty($this->request->data['Usuario']['detalle'])) 
			{
				$this->Session->setFlash('No se permiten campos vacios', null, array(), 'danger');
				$this->redirect(array('action' => 'edit', $id));
			}

			# Normalizamos los datos
			$this->request->data['Usuario']['id_pago'] = explode(',', $this->request->data['Usuario']['id_pago']);

			# Pago/s

			foreach ($this->request->data['Usuario']['id_pago'] as $key => $pago) {
				if ( empty($pago) ) {
					unset($this->request->data['Usuario']['id_pago'][$key]);
				}
			}

			$pagos = $this->Usuario->Pago->find('all', array(
				'conditions' => array(
					'Pago.id' => $this->request->data['Usuario']['id_pago'],
					'Pago.pagado' => 0
					)
				));

			# Verificamos que el monto pagado sea igual al monto a pagar de los pagos
			$sumaPagos = 0;
			foreach ($pagos as $key => $value) {
				$sumaPagos = $sumaPagos + $value['Pago']['monto_a_pagar'];
			}

			if ( $sumaPagos != intval(str_replace('.', '', $this->request->data['Usuario']['monto_pagado'])) ) {
				$this->Session->setFlash('Error con el pago. El monto pagado no es igual al monto a pagar.', null, array(), 'danger');
				$this->redirect(array('action' => 'edit', $id));
			}

			$this->request->data['Pago'] = array();

			foreach ($pagos as $key => $pago) {
				$this->request->data['Pago'][$key]['id'] = $pago['Pago']['id'];
				$this->request->data['Pago'][$key]['monto_pagado'] = $pago['Pago']['monto_a_pagar'];
				$this->request->data['Pago'][$key]['codigo_pago'] = $this->request->data['Usuario']['codigo_pago'];
				$this->request->data['Pago'][$key]['medio_de_pago'] = $this->request->data['Usuario']['medio_de_pago'];
				$this->request->data['Pago'][$key]['detalle'] = $this->request->data['Usuario']['detalle'];
				$this->request->data['Pago'][$key]['fecha_pagado'] = $this->request->data['Usuario']['fecha_pagado'];
				$this->request->data['Pago'][$key]['pagado'] = 1;
			}

			unset($this->request->data['Usuario']);
			$this->request->data['Usuario']['id'] = $id;
			
			if ( $this->Usuario->saveAssociated($this->request->data) )
			{
				$this->Session->setFlash('Pagos actualizados correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'edit', $id));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		else
		{
			$this->request->data	= $this->Usuario->find('first', array(
				'conditions'	=> array('Usuario.id' => $id),
				'contain' => array('Codigopaise', 'Cuenta' => array('Banco', 'TipoCuenta'), 'Calificacion', 'Tarea' => array('Tienda'), 'Pago' => array('Cuenta', 'Tienda'))
			));
		}

		$tareas	= $this->Usuario->Tarea->find('list');
		$codigopaises	= $this->Usuario->Codigopaise->find('list', array('conditions' => array('activo' => 1)));

		$this->set(compact('tareas', 'codigopaises'));
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
	 * Muestra una tabla con el avatar del mantenedor
	 * @param  	string 		$id 	Identificador de mantenedor
	 * @return  string 				Tabla con información  
	 */				
	public function admin_obtenerAvatar($id = '') {

		if ( ! empty($id) ) {

			$this->Usuario->id = $id;
			if ( ! $this->Usuario->exists() ) {
				echo "";
				exit;
			}

			$mantenedor = $this->Usuario->find('first', array(
				'conditions'	=> array('Usuario.id' => $id),
				'fields' => array('id', 'imagen', 'rut', 'email', 'fono', 'calificacion_media', 'nombre', 'apellidos')
			));
			
			# Cargamos las librerias helpers para utilizar alguno de sus métodos
			App::uses('AppHelper', 'View/Helper');
			App::uses('HtmlHelper', 'View/Helper');

			# instanciamos los Helpers
			$appHelper = new AppHelper(new View());
			$htmlHelper = new HtmlHelper(new View());

			# Armamos la tabla con la data
			$tabla = '<tr>';
			$tabla .= '<td colspan="2" align="center" class="mantenedor-avatar">';
			$tabla .= $imagenPerfil = (!empty($mantenedor['Usuario']['imagen'])) ? $htmlHelper->image($mantenedor['Usuario']['imagen']['mini'], array('class' => 'img-responsive img-circle', 'alt' => $mantenedor['Usuario']['nombre'])) : $htmlHelper->image('logo_user.jpg', array('class' => 'img-responsive img-circle image-perfil-list', 'alt' => $mantenedor['Usuario']['nombre'])) ;
			$tabla .= '<span class="mantenedor-avatar-nombre">';
			$tabla .= $mantenedor['Usuario']['nombre'] . ' ' . $mantenedor['Usuario']['apellidos'];
			$tabla .= '</span>';
			$tabla .= '</td>';
			$tabla .= '</tr>';
			$tabla .= '<tr>';
			$tabla .= '<th><label>' . __('Rut') . '</label></th>';
			$tabla .= '<td>' . $mantenedor['Usuario']['rut'] . '</td>';
			$tabla .= '</tr>';
			$tabla .= '<tr>';
			$tabla .= '<th><label>' . __('Email') . '</label></th>';
			$tabla .= '<td>' . $mantenedor['Usuario']['email'] . '</td>';
			$tabla .= '</tr>';
			$tabla .= '<tr>';
			$tabla .= '<th><label>' . __('Fono') . '</label></th>';
			$tabla .= '<td>' . $mantenedor['Usuario']['fono'] . '</td>';
			$tabla .= '</tr>';
			$tabla .= '<tr>';
			$tabla .= '<th><label>' . __('Calificación') . '</label></th>';
			$tabla .= '<td>' . $appHelper->estrellas($mantenedor['Usuario']['calificacion_media']) . '</td>';
			$tabla .= '</tr>';

			echo $tabla;
			exit;

		}else{
			echo "";
			exit;
		}
	}



	/**
	 * Métodos para Mantenedores
	 */

	public function maintainers_login() {
		/**
		 * Login normal
		 */
		if ( $this->request->is('post') )
		{	
			if ( $this->Auth->login() )
			{	
				# Obtenemos la tienda principal
				$tiendaPrincipal = ClassRegistry::init('Tienda')->find('first', array(
					'conditions' => array('Tienda.principal' => 1),
					'order' => array('Tienda.modified' => 'DESC')
					));

				if ( empty($tiendaPrincipal) ) {
					
					# Enviamos mensaje de porque la redirección
					$this->Session->setFlash('No existe una tienda principal, porfavor contácte al encargado.', null, array(), 'danger');

					# Eliminamos la sesión tienda
					$this->Session->delete('Tienda');
					# Deslogeamos
					$this->maintainers_logout();
				}else {
					$this->Session->setFlash('Su tienda principal es ' . $tiendaPrincipal['Tienda']['nombre'], null, array(), 'success');
					$this->Session->write('Tienda', $tiendaPrincipal['Tienda']);
				}


				/**
				 * Verificamos que exista el usuario en la DB y esté activo
				 */
				$usuario			= $this->Usuario->find('first', array(
					'conditions'			=> array('Usuario.email' => $this->request->data['Usuario']['email'], 'Usuario.activo' => 1)
				));

				if (empty($usuario)) {

					$this->Session->setFlash('Su cuenta ha sido desactivada.', null, array(), 'danger');

					# Deslogeamos
					$this->maintainers_logout();
				}

				$this->Usuario->id = $usuario['Usuario']['id'];
				$this->Usuario->saveField('ultimo_acceso', date('Y-m-d H:i:s'));
				$this->Session->write('Auth.Mantenedor.clave', $usuario['Usuario']['clave']);
				$this->redirect($this->Auth->redirectUrl());
			}
			else
			{	
				// Recuperar clave
				if (isset($this->request->data['Usuario']['email_recuperar'])) {
					
					$mantenedor = $this->Usuario->find('first', array(
						'conditions' => array(
							'Usuario.email' => $this->request->data['Usuario']['email_recuperar'],
							'Usuario.activo' => 1
							),
						'fields' => array('Usuario.id', 'Usuario.nombre', 'Usuario.email')
						)
					);

					if (!empty($mantenedor)) {
						$nuevaClave =  substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
						
						$mantenedor['Usuario']['clave'] = $nuevaClave;
						$mantenedor['Usuario']['clave_'] = $nuevaClave;

						if ( $this->Usuario->save($mantenedor) ) {
							$this->Session->setFlash('Su nueva contraseña ha sido enviada a su correo electrónico.', null, array(), 'success');
						}else{
							$this->Session->setFlash('Ocurrió un error al generar su nueva contraseña. Intente nuevamente.', null, array(), 'danger');
						}
					}else{
						$this->Session->setFlash('Nombre de usuario incorrecto.', null, array(), 'danger');
					}

				}else{
					$this->Session->setFlash('Nombre de usuario y/o clave incorrectos.', null, array(), 'danger');
				}
			}
		}


		$this->layout	= 'login';
	}

	public function maintainers_logout()
	{	
		$this->Session->delete('Tienda');
		$this->redirect($this->Auth->logout());
	}

	public function maintainers_edit($id = null)
	{	if ( $id != $this->Auth->user('id') ) {
			$this->redirect(array('action' => 'profile'));
		}
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


	public function maintainers_profile()
	{	#Id de sesión
		$id = $this->Auth->user('id');
		
		if ( ! $this->Usuario->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			# Normalizamos la clave
			if ( ! $this->validarClave() ) {
				$this->Session->setFlash('Las contraseñas no estan correctas. Verifiquelas y vuelva a intentar.', null, array(), 'danger');
				$this->redirect(array('action' => 'profile'));
			}

			# Verificamos el tamaño de la imagen si es que existe
			if ( !empty($this->request->data) ) {
				
			}
			
			if ( $this->Usuario->saveAll($this->request->data) )
			{	
				# Actualizamos el valor de la sesión
				
				$this->actualizarAuth($id);

				$this->Session->setFlash('Información guardada con éxito.', null, array(), 'success');
				$this->redirect(array('action' => 'profile'));
			}
			else
			{	
				$this->Session->setFlash('Error al guardar la información. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		else
		{
			$this->request->data	= $this->Usuario->find('first', array(
				'conditions'	=> array('Usuario.id' => $id),
				'contain' => array('Cuenta', 'Calificacion', 'Codigopaise', 
					'Pago' => array(
						'Tienda',
						'conditions' => array('Pago.monto_pagado = Pago.monto_a_pagar'),
						'limit' => 10
					))
			));
		}
		
		$bancos = $this->Usuario->Cuenta->Banco->find('list', array('conditions' => array('Banco.activo' => 1)));
		$tipoCuentas = $this->Usuario->Cuenta->TipoCuenta->find('list', array('conditions' => array('TipoCuenta.activo' => 1)));
		$codigopaises	= $this->Usuario->Codigopaise->find('list', array('conditions' => array('activo' => 1)));
		$tareas = $this->Usuario->Tarea->find('all', array(
			'conditions' => array('Tarea.usuario_id' => $id, 'Tarea.finalizado' => 1), 
			'limit' => 5, 
			'contain' => array('Tienda')
			));

		# Montos
		$acumuladoNoPagado 		= 0;
		$acumuladoPagado 		= 0;
		$totalMontoTareas 		= 0;
		foreach ( $tareas as $ix => $tarea) {
			$acumuladoNoPagado = 0;
		}

		BreadcrumbComponent::add('Mis Perfil ');

		

		$this->set(compact('bancos', 'tipoCuentas', 'codigopaises', 'tareas'));
	}


	public function actualizarAuth ($id = null) {

		if ( ! $this->Usuario->exists($id) )
		{
			$this->Session->setFlash('Ocurrió un error al actualizar la sesión, por favor ingrese nuevamente.', null, array(), 'danger');
			# Deslogeamos
			$this->maintainers_logout();
		}
		
		$usuario = $this->Usuario->find('first', array('conditions' => array('Usuario.id' => $id)));
	
		$this->Session->write('Auth.Mantenedor', $usuario['Usuario']);

	}

	public function validarClave() {
		# Verificamos que este vacia para quitarla del arreglo
		if (empty($this->request->data['Usuario']['clave'])) {
			unset($this->request->data['Usuario']['clave'], $this->request->data['Usuario']['clave_nueva'], $this->request->data['Usuario']['rep_clave_nueva']);
			return true;
		}

		# Validamos la nueva contraseña
		if ( ! empty($this->request->data['Usuario']['clave']) && ! empty($this->request->data['Usuario']['clave_nueva']) && ! empty($this->request->data['Usuario']['rep_clave_nueva']) ) {
	
			# Verificamos que la clave se la misma registrada en la BD
			if (AuthComponent::password($this->request->data['Usuario']['clave']) == $this->Auth->user('clave')) {
				# Verificamos que las nuevas claves sean iguales
				if ( $this->request->data['Usuario']['clave_nueva'] == $this->request->data['Usuario']['rep_clave_nueva'] ) {
					$this->request->data['Usuario']['clave'] = $this->request->data['Usuario']['clave_nueva'];
					unset($this->request->data['Usuario']['clave_nueva'], $this->request->data['Usuario']['rep_clave_nueva']);
					return true;
				}else{
					return false;
				}	
			}else{
				return false;
			}
		}

		return true;
	}
}
