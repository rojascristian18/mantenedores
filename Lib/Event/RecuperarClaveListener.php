<?php
App::uses('CakeEventListener', 'Event');
App::uses('View', 'View');
App::uses('Validation', 'Utility');
class RecuperarClaveListener implements CakeEventListener
{
	public $prefix		= null;

	public function implementedEvents()
	{ 	
		return array(
			'Model.Empresa.afterSave'		=> 'enviarEmailEmpresa',
		);
	}

	public function enviarEmailEmpresa(CakeEvent $evento)
	{
		
		/**
		 * Si la empresa no tiene correo
		 * o no existe administrador para notificar, se detiene.
		 */
		if ( ! $evento->data['Empresa']['email'] )
		{
			return false;
		}

		$evento->data['asunto'] = 'Recuperar contraseña - Portal Egresados Manpower';
		$evento->data['titulo'] = 'Su contraseña ha sido actualizada';
		$evento->data['cuerpo'] = sprintf('Estimado/a %s su nueva contraeña para ingresar a nuestro portal de egresados es: </br><center><strong>%s</strong></center>', $evento->data['Empresa']['nombre'], $evento->data['Empresa']['enviar_email_clave']);
		$evento->data['cuerpo2'] = 'Recuerde actualizarla posteriormente.';
		
		/**
		 * Clases requeridas
		 */
		$alerta						= $evento->data;
		$this->View					= new View();
		$this->View->viewPath		= 'Emails' . DS . 'html';
		$this->View->layoutPath		= 'Emails' . DS . 'html';
		$this->View->set(compact('alerta'));
		$this->Email				= ClassRegistry::init('Email');

		/**
		 * Correo de respuesta a empresa
		 */
		$emailEmpresa				= $alerta['Empresa']['email'];
		$emailNombre				= $alerta['Empresa']['nombre'];
;
		if ( ! empty($emailEmpresa) && Validation::email($emailEmpresa) )
		{
			$this->View->hasRendered	= false;
			$html						= $this->View->render('alerta_recuperar_clave');
			
			/**
			 * Guarda el email a enviar
			 */
			$this->Email->create();
			$this->Email->save(array(
				'estado'					=> 'Empleo',
				'html'						=> $html,
				'asunto'					=> $alerta['asunto'],
				'destinatario_email'		=> $emailEmpresa,
				'destinatario_nombre'		=> $emailNombre,
				'remitente_email'			=> 'apps@brandon.cl',
				'remitente_nombre'			=> 'Manpower Portal Egresados',
				'cc_email'					=> null,
				'bcc_email'					=> null,
				'traza'						=> null,
				'procesado_origen'			=> null,
				'procesado'					=> 0,
				'enviado'					=> 0,
				'reintentos'				=> 0,
				'atachado'					=> null,
			));
		}

		/**
		 * Ejecuta la consola automaticamente en ambientes de desarrollo
		 */
		if ( ! Configure::read('Ambiente.produccion') )
		{
			App::uses('AppShell', 'Console/Command');
			App::uses('EnviarEmailsShell', 'Console/Command');
			$this->EnviarEmails = new EnviarEmailsShell();
			$this->EnviarEmails->main();
		}
	}
}
