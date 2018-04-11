<?php
App::uses('CakeEventListener', 'Event');
App::uses('View', 'View');
App::uses('Validation', 'Utility');
class ComentarioListener implements CakeEventListener
{
	public $prefix		= null;

	public function implementedEvents()
	{ 	
		return array(
			'Model.Comentario.afterSave'		=> 'guardarEmail',
		);
	}

	public function guardarEmail(CakeEvent $evento)
	{	
		if ( isset($evento->data['Comentario']['notificar_comentario_mantenedor']) && $evento->data['Comentario']['notificar_comentario_mantenedor'] ) {

			$tarea =  ClassRegistry::init('Tarea')->find('first', array(
				'conditions' => array(
					'Tarea.id' => $evento->data['Comentario']['tarea_id']
				),
				'contain' => array(
					'Usuario'
				)
				
			));
	
			if (empty($tarea)) {
				return;
			}

			$mantenedor = $tarea;
			$mantenedor['Comentario'] = $evento->data['Comentario'];

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


		if ( isset($evento->data['Comentario']['notificar_comentario_administrador']) && $evento->data['Comentario']['notificar_comentario_administrador'] ) {
			
			$tarea =  ClassRegistry::init('Tarea')->find('first', array(
				'conditions' => array(
					'Tarea.id' => $evento->data['Comentario']['tarea_id']
				),
				'contain' => array(
					'Administrador'
				)
				
			));
			
			if (empty($tarea)) {
				return;
			}

			$administrador = $tarea;
			$administrador['Comentario'] = $evento->data['Comentario'];

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
	}
}