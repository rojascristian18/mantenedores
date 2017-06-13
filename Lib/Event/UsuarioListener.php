<?php
App::uses('CakeEventListener', 'Event');
App::uses('View', 'View');
App::uses('Validation', 'Utility');
class UsuarioListener implements CakeEventListener
{
	public $prefix		= null;

	public function implementedEvents()
	{ 	
		return array(
			'Model.Usuario.afterSave'		=> 'enviarEmailMantenedor',
		);
	}

	public function enviarEmailMantenedor(CakeEvent $evento)
	{	
		
		/**
		 * Verificamos que exista un registro en el campo email del Usuario y que el bit notificar no exista
		 */
		if ( isset($evento->data['Usuario']['email']) && isset($evento->data['Usuario']['creado']) )
		{	

			/**
			 * Clases requeridas
			 */
			$alerta						= $evento->data;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');

			/**
			 * Correos a mantenedor creación de cuenta
			 */
			if ( $alerta['Usuario']['creado'] )
			{	
				$html						= $this->View->render('notificar_nuevo_mantenedor');

				/**
				 * Guarda el email a enviar
				 */
				$this->Correo->create();
				$this->Correo->save(array(
					'estado'					=> 'Notificación de nueva cuenta',
					'html'						=> $html,
					'asunto'					=> '¡Bienvenido a Nodriza Spa!',
					'destinatario_email'		=> $alerta['Usuario']['email'],
					'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
					'remitente_email'			=> 'no-reply@nodriza.cl',
					'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
					'cc_email'					=> '',
					'bcc_email'					=> 'cristian.rojas@nodriza.cl',
					'traza'						=> null,
					'proceso_origen'			=> null,
					'procesado'					=> 0,
					'enviado'					=> 0,
					'reintentos'				=> 0,
					'atachado'					=> null
				));
			}

		}


		if ( isset($evento->data['Usuario']['clave_']) ) {

			/**
			 * Clases requeridas
			 */
			$alerta						= $evento->data;
			$this->View					= new View();
			$this->View->viewPath		= 'Correos' . DS . 'html';
			$this->View->layoutPath		= 'Emails' . DS . 'html';
			$this->View->set(compact('alerta'));
			$this->Correo				= ClassRegistry::init('Correo');

			/**
			 * Correos a mantenedor creación de cuenta
			 */
			$html						= $this->View->render('notificar_recuperar_clave');

			/**
			 * Guarda el email a enviar
			 */
			$this->Correo->create();
			$this->Correo->save(array(
				'estado'					=> 'Notificación recuperar clave',
				'html'						=> $html,
				'asunto'					=> '[NDRZA] Nueva constraseña',
				'destinatario_email'		=> $alerta['Usuario']['email'],
				'destinatario_nombre'		=> $alerta['Usuario']['nombre'],
				'remitente_email'			=> 'no-reply@nodriza.cl',
				'remitente_nombre'			=> 'Portal mantenedores - Nodriza Spa',
				'cc_email'					=> '',
				'bcc_email'					=> 'cristian.rojas@nodriza.cl',
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
