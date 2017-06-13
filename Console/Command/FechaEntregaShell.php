<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('View', 'View');
App::uses('Validation', 'Utility');
class FechaEntregaShell extends AppShell
{
	public $uses			= array('Tarea');
	public $host			= 'localhost';

	public function main()
	{	
		# Obtenemos la configuracion
		$configuracion = ClassRegistry::init('Configuracion')->find('first', array(
			'conditions' => array('Configuracion.id' => 1)
			));


		# Obtenemos las tareas que estan prontas a finalizar y aun no se han revisado
		$tareas = $this->Tarea->find('all', array(
			'conditions' => array(
				'Tarea.finalizado' => 0,
				'Tarea.en_revision' => 0),
			'contain' => array(
				'Usuario' => array('conditions' => array('Usuario.activo' => 1)))
			));

		foreach ($tareas as $key => $value) {

			$this->out(sprintf('%s días de diferencia', $this->dateDiferencia($value['Tarea']['fecha_entrega'], date('Y-m-d H:i:s'), '%R%a') ) );

			$diferenciaDias = $this->dateDiferencia($value['Tarea']['fecha_entrega'], date('Y-m-d H:i:s'));
			$diasConfiguracion = $configuracion['Configuracion']['dias_notificar_tareas'];

			# verificamos que la fecha de entrega sea mayor a hoy
			if ( strtotime($value['Tarea']['fecha_entrega']) > strtotime(date('Y-m-d H:i:s')) ) {

				if ( $diferenciaDias < configuracion('dias_notificar_tareas') ) {
					
					$this->out('Tarea a punto de expirar');

					# asignamos el valor de los días que quedan a la data de la tarea
					$value['Tarea']['dias'] = $diferenciaDias;

					## Guardamos en tabla email
					$this->guardarEmail($value);


				}else{
					## Guardamos en tabla email
					$this->out('Tarea aun no expira');
				}

			}elseif ( strtotime($value['Tarea']['fecha_entrega']) < strtotime(date('Y-m-d H:i:s')) ) {
				## Guardamos en tabla email
				$this->out('Tarea expirada');
	
			}

			$this->hr();
		}

	}

	public function guardarEmail($tarea) {
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
		$html						= $this->View->render('notificar_tarea_a_exiprar');

		/**
		 * Guarda el email a enviar
		 */
		$this->Correo->create();
		$this->Correo->save(array(
			'estado'					=> 'Notificación tarea a punto de expirar mantenedor',
			'html'						=> $html,
			'asunto'					=> '[NDRZA] ¡Su tarea está a punto de expirar!',
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

		return;
	}

	/**
	 * Calcula la diferencia entre 2 fechas
	 * @param 	datetime 	$fecha_1
	 * @param 	datetime 	$fecha_2
	 * @param 	string 		$formato 
	 */
	public function dateDiferencia($fecha_1 , $fecha_2 , $formato = '%a' )
	{
	    $f_uno = date_create($fecha_1);
	    $f_dos = date_create($fecha_2);
	   
	    $diferencia = date_diff($f_uno, $f_dos);
	   
	    return $diferencia->format($formato);
	   
	}
}
