<?php
App::uses('CakeEventListener', 'Event');
App::uses('View', 'View');
App::uses('Validation', 'Utility');
class TareaListener implements CakeEventListener
{
	public $prefix		= null;

	public function implementedEvents()
	{ 	
		return array(
			'Model.Tarea.afterSave'		=> 'enviarEmailMantenedor',
		);
	}

	public function enviarEmailMantenedor(CakeEvent $evento)
	{	

		# Seleccionamos la plantilla según el condiciones
		# Estados posibles
		# 	- Tarea asignada		asignada 		Notificar a Mantenedor, no al administrador 		
		# 	- Tarea en progreso 	en_progreso 	Notificar a Administrador, no al mantenedor
		# 	- Tarea en revisión		en_revision		Notificar a Administrador, no al mantenedor
		# 	- Tarea finalizada 	 	finalizada		Notificar a Mantenedor, no al administrador
		# 	- Tarea rechazada 		rechazada		Notificar a Mantenedor, no al administrador
		# 
		
		if ( isset($evento->data['Tarea']['notificar_tarea_rechazada_matenedor']) ) {
			# Buscamos la información y relaciones de la tarea
			$tarea = ClassRegistry::init('Tarea')->find('first', array(
				'conditions' => array(
					'Tarea.id' => $evento->data['Tarea']['id']
					),
				'contain' => array(
					'Administrador', 'Usuario'
					)
				)
			);

			/**
			 * Clases requeridas
			 */
			$alerta						= $tarea;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a mantenedor rechazo de la tarea
			 */
			$html						= $this->View->render('notificar_tarea_rechazada_matenedor');
	
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de rechazo tarea a mantenedor',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] Su tarea fue revisada',
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'cristian.rojas@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> 'cristian.rojas@nodriza.cl',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
		}


		if ( isset($evento->data['Tarea']['notificar_tarea_aceptada_matenedor']) ) {
			# Buscamos la información y relaciones de la tarea
			$tarea = ClassRegistry::init('Tarea')->find('first', array(
				'conditions' => array(
					'Tarea.id' => $evento->data['Tarea']['id']
					),
				'contain' => array(
					'Administrador', 'Usuario'
					)
				)
			);

			/**
			 * Clases requeridas
			 */
			$alerta						= $tarea;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a mantenedor rechazo de la tarea
			 */
			$html						= $this->View->render('notificar_tarea_aceptada_matenedor');
	
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de tarea aceptada a mantenedor',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] ¡Hurra! su tarea fue aceptada',
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
		}
		
		if ( isset($evento->data['Tarea']['notificar_tarea_revision_administrador']) ) {
			# Buscamos la información y relaciones de la tarea
			$tarea = ClassRegistry::init('Tarea')->find('first', array(
				'conditions' => array(
					'Tarea.id' => $evento->data['Tarea']['id']
					),
				'contain' => array(
					'Administrador', 'Usuario'
					)
				)
			);

			/**
			 * Clases requeridas
			 */
			$alerta						= $tarea;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a administrador comentario a la tarea
			 */
			$html						= $this->View->render('notificar_tarea_revision_administrador');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de revision tarea a administrador',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] Nueva tarea para revisión',
				'destinatario_email'		=> $alerta['Administrador']['email'],
				'destinatario_nombre'		=> $alerta['Administrador']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
		}
	
		if ( isset($evento->data['Tarea']['notificar_inicio_tarea_administrador']) && isset($evento->data['Tarea']['administrador_id']) ) {
			# Buscamos la información del administrador que se debe notificar
			$administrador = ClassRegistry::init('Administrador')->find('first', array(
				'conditions' => array(
					'Administrador.id' => $evento->data['Tarea']['administrador_id'],
					'Administrador.activo' => 1
					)
				)
			);
	
			$administrador['Tarea'] = $evento->data['Tarea'];

			/**
			 * Clases requeridas
			 */
			$alerta						= $administrador;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a administrador comentario a la tarea
			 */
			$html						= $this->View->render('notificar_inicio_tarea_administrador');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de inicio tarea a administrador',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] El mantenedor ha iniciado una tarea',
				'destinatario_email'		=> $alerta['Administrador']['email'],
				'destinatario_nombre'		=> $alerta['Administrador']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
		}
		
		if ( isset($evento->data['Tarea']['asignada']) && isset($evento->data['Tarea']['usuario_id']) ) {
			# Buscamos la información del mantenedor que se debe notificar
			$mantenedor = ClassRegistry::init('Usuario')->find('first', array(
				'conditions' => array(
					'Usuario.id' => $evento->data['Tarea']['usuario_id'],
					'Usuario.activo' => 1
					)
				)
			);

			$mantenedor['Tarea'] = $evento->data['Tarea'];

			/**
			 * Clases requeridas
			 */
			$alerta						= $mantenedor;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a mantenedor asignación de tarea
			 */
			$html						= $this->View->render('notificar_tarea_asignada');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de tarea asignada',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] ¡Se le ha asignado una tarea!',
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
			
		}

		if ( isset($evento->data['Tarea']['desasignar_a']) ) {

			# Buscamos la información del mantenedor que se debe notificar
			$mantenedor = ClassRegistry::init('Usuario')->find('first', array(
				'conditions' => array(
					'Usuario.id' => $evento->data['Tarea']['desasignar_a'],
					'Usuario.activo' => 1
					)
				)
			);

			$mantenedor['Tarea'] = $evento->data['Tarea'];

			/**
			 * Clases requeridas
			 */
			$alerta						= $mantenedor;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a mantenedor desasignación de tarea
			 */
			$html						= $this->View->render('notificar_tarea_desasignada');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de tarea cancelada',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] Se ha cancelado una tarea',
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
		}


		if ( isset($evento->data['Tarea']['notificar_reabrir_tarea']) ) {
			
			# Buscamos la información del mantenedor que se debe notificar
			$mantenedor = ClassRegistry::init('Usuario')->find('first', array(
				'conditions' => array(
					'Usuario.id' => $evento->data['Tarea']['usuario_id'],
					'Usuario.activo' => 1
					)
				)
			);

			$mantenedor['Tarea'] = $evento->data['Tarea'];

			/**
			 * Clases requeridas
			 */
			$alerta						= $mantenedor;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a mantenedor asignación de tarea
			 */
			$html						= $this->View->render('notificar_reabrir_tarea');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de tarea re abierta',
				'html'						=> $html,
				'asunto'					=> sprintf('[NDRZA] La tarea %d ha sido re abierta', $mantenedor['Tarea']['id']),
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
			
		}


		if ( isset($evento->data['Tarea']['modificada']) ) {
			# Buscamos la información del mantenedor que se debe notificar
			$mantenedor = ClassRegistry::init('Usuario')->find('first', array(
				'conditions' => array(
					'Usuario.id' => $evento->data['Tarea']['usuario_id'],
					'Usuario.activo' => 1
					)
				)
			);

			$mantenedor['Tarea'] = $evento->data['Tarea'];

			/**
			 * Clases requeridas
			 */
			$alerta						= $mantenedor;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a mantenedor asignación de tarea
			 */
			$html						= $this->View->render('notificar_tarea_modificada');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de tarea modificada',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] Se ha modificado su tarea',
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_tareas'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));
			
		}


		if ( isset($evento->data['Tarea']['notificar_comentario_mantenedor']) && isset($evento->data['Tarea']['usuario_id']) ) {

			# Buscamos la información del mantenedor que se debe notificar
			$mantenedor = ClassRegistry::init('Usuario')->find('first', array(
				'conditions' => array(
					'Usuario.id' => $evento->data['Tarea']['usuario_id'],
					'Usuario.activo' => 1
					)
				)
			);

			$mantenedor['Tarea'] = $evento->data['Tarea'];
			$mantenedor['Comentario'] = $evento->data['Comentario'][1];

			/**
			 * Clases requeridas
			 */
			$alerta						= $mantenedor;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a mantenedor comentario a la tarea
			 */
			$html						= $this->View->render('notificar_comentario_mantenedor');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de comentario hacia mantenedor',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] El administrador ha comentado su tarea',
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_comentarios'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));

		}


		if ( isset($evento->data['Tarea']['notificar_comentario_administrador']) && isset($evento->data['Tarea']['administrador_id']) ) {
			
			# Buscamos la información del administrador que se debe notificar
			$administrador = ClassRegistry::init('Administrador')->find('first', array(
				'conditions' => array(
					'Administrador.id' => $evento->data['Tarea']['administrador_id'],
					'Administrador.activo' => 1
					)
				)
			);

			$administrador['Tarea'] = $evento->data['Tarea'];
			$administrador['Comentario'] = $evento->data['Comentario'][1];

			/**
			 * Clases requeridas
			 */
			$alerta						= $administrador;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');
			
			/**
			 * Correos a administrador comentario a la tarea
			 */
			$html						= $this->View->render('notificar_comentario_administrador');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación de comentario hacia administrador',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] El mantenedor ha comentado su tarea',
				'destinatario_email'		=> $alerta['Administrador']['email'],
				'destinatario_nombre'		=> $alerta['Administrador']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> configuracion('bcc_comentarios'),
				'traza'						=> null,
				'proceso_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null
			));

		}
		

		# Se ejecuta el comando para enviar los correos
		/*App::uses('AppShell', 'Console/Command');
		App::uses('EnviarCorreosShell', 'Console/Command');
		$this->EnviarEmails = new EnviarCorreosShell();
		$this->EnviarEmails->main();*/

	}
}
