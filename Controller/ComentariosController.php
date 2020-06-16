<?php
App::uses('AppController', 'Controller');
class ComentariosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);

		$comentarios	= $this->paginate();
		
		$this->set(compact('comentarios'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Comentario->create();
			if ( $this->Comentario->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		$parentComentarios	= $this->Comentario->ParentComentario->find('list');
		$tareas	= $this->Comentario->Tarea->find('list');
		$importancias	= $this->Comentario->Importancia->find('list');
		$usuarios = $this->Comentario->Usuario->find('list');
		$administradores = $this->Comentario->Administrador->find('list');

		$this->set(compact('parentComentarios', 'tareas', 'importancias', 'usuarios', 'administradores'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Comentario->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Comentario->save($this->request->data) )
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
			$this->request->data	= $this->Comentario->find('first', array(
				'conditions'	=> array('Comentario.id' => $id)
			));
		}
		$parentComentarios	= $this->Comentario->ParentComentario->find('list');
		$tareas	= $this->Comentario->Tarea->find('list');
		$importancias	= $this->Comentario->Importancia->find('list');
		$usuarios = $this->Comentario->Usuario->find('list');
		$administradores = $this->Comentario->Administrador->find('list');

		$this->set(compact('parentComentarios', 'tareas', 'importancias', 'usuarios', 'administradores'));
	}

	public function admin_delete($id = null)
	{
		$this->Comentario->id = $id;
		if ( ! $this->Comentario->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Comentario->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Comentario->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Comentario->_schema);
		$modelo			= $this->Comentario->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function comentar()
	{	
		if ($this->request->is('post')) {

			$this->request->data['Comentario']['comentario'] = strip_tags($this->request->data['Comentario']['comentario']);

			if (!empty($this->request->data['Comentario']['administrador_id']) || !empty($this->request->data['Comentario']['usuario_id'])) {
				if($this->Comentario->save($this->request->data)) {
					$res = array(
						'code' => 200,
						'message' => 'Mensaje enviado correctamente.',
						'data' => $this->request->data
					);
					echo json_encode($res);
		    		exit;
				}
			}
		}

		$res = array(
			'code' => 500,
			'message' => 'Mensaje no enviado. Verifique los campos.',
			'data' => $this->request->data
		);
		echo json_encode($res);
		exit;
	}


	public function obtenerTareasComentarios($id = '', $rol = '', $limite = 10, $offset = 0)
	{
		$options['limit']      = $limite;
		$options['offset']     = $offset;
		$options['order']      = array('Tarea.created' => 'DESC');

		$options['conditions'] = array(
			'Tarea.activo'         => 1
		);

		if ($rol == 'admin') {
			$options = array_replace_recursive($options, array(
				'conditions' => array('Tarea.administrador_id' => $id)
			));
		}

		if ($rol == 'usuario') {
			$options = array_replace_recursive($options, array(
				'conditions' => array('Tarea.usuario_id' => $id)
			));
		}

		/*$options['contain'] = array(
			'Comentario' => array(
				'order' => array(
					'Comentario.created' => 'DESC'
				),
			'Usuario',
			'Administrador'
			)
		);*/
		
		$tareas = ClassRegistry::init('Tarea')->find('all', $options);

		if (empty($tareas)) {
			$res = array(
				'code' => 400,
				'message' => 'No hay tareas disponibles.',
				'data' => '<li>No hay tareas disponibles</li>'
			);
			
			echo json_encode($res);
			exit;
		}

		foreach ($tareas as $key => $value) {

			if ( ! $this->esMiTarea($value['Tarea']['id']) ) {
				unset($tareas[$key]);
			}
			
		}

		if (empty($tareas)) {
			$res = array(
				'code' => 400,
				'message' => 'No hay tareas disponibles.',
				'data' => '<li>No hay tareas disponibles</li>'
			);
			
			echo json_encode($res);
			exit;
		}
		
		$html = '';
		foreach ($tareas as $key => $value) {
			$html .= '<li class="list-group-item">';
            $html .= '<a class="btn-block btn-tarea" role="button" data-id="'.$value['Tarea']['id'].'" href="#' . Inflector::slug($value['Tarea']['nombre']) . $value['Tarea']['id'] . '" ><span class="status status-online"></span> ' . $value['Tarea']['nombre'] . '</a>';
            $html .= '</li>';
		}

		$res = array(
			'code' => 200,
			'message' => 'Tareas obtenidas correctamente.',
			'data' => $html
		);

		echo json_encode($res);
		exit;

	}


	public function obtenerComentariosPorTareaId($idUsuario, $rolUsuario, $idComentario)
	{	
		if (empty($idComentario) || empty($idUsuario) || empty($rolUsuario)) {
			$res = array(
				'code' => 400,
				'message' => 'No hay mensajes para ésta tarea.',
				'data' => '<li>No hay mensajes</li>'
			);
			
			echo json_encode($res);
			exit;
		}

		$options['order']      = array('Comentario.created' => 'DESC');

		$options['conditions'] = array('Comentario.tarea_id' => $idComentario);

		$options['contain'] = array(
			'Tarea',
			'Usuario',
			'Administrador'
		);

		$comentarios = ClassRegistry::init('Comentario')->find('all', $options);

		if (empty($comentarios)) {
			$res = array(
				'code' => 400,
				'message' => 'No hay mensajes para ésta tarea.',
				'data' => '<li>No hay mensajes</li>'
			);
			
			echo json_encode($res);
			exit;
		}

		$html = '<div class="messages messages-img">';
                        
    	foreach ($comentarios as $ico => $comentario) {
    		
    		# Comentario del administrador
    		if ($rolUsuario == 'admin' && $idUsuario == $comentario['Comentario']['administrador_id']) {
    			$html .= '<div class="item in">';
                $html .= '<div class="image">';
                
                $imagen = Router::url('/', true) . '/webroot/img/logo_user.jpg';
                
                if ($comentario['Administrador']['google_imagen'] != '' ) {
                	$imagen = $comentario['Administrador']['google_imagen'];
                }

                $html .= '<img src="' . $imagen . '" alt="' . $comentario['Administrador']['nombre'] . ' ' . $comentario['Administrador']['apellidos'] . '">';
                $html .= '</div>';
                $html .= '<div class="text">';
				$html .= '<div class="heading">';
				$html .= '<a href="#">Yo</a>';

				if (date('Y-m-d', strtotime($comentario['Comentario']['created'])) == date('Y-m-d') ) {
					$fechaComentario = 'Hoy a las ' . date('H:i:s', strtotime($comentario['Comentario']['created']));
				}else{
					$fechaComentario = date('Y-m-d H:i:s', strtotime($comentario['Comentario']['created']));
				}

				$html .= '<span class="date">' . $fechaComentario . '</span>';
				$html .= '<span class="visto">';
					if (($comentario['Comentario']['visualizado'])) {
						$html .= '<i class="fa fa-check visto"></i><i class="fa fa-check visto"></i>';
					}else{
						$html .= '<i class="fa fa-check"></i><i class="fa fa-check"></i>';
					}
				$html .= '</span>';
				$html .= '</div>';
				$html .= strip_tags(nl2br($comentario['Comentario']['comentario']));
				if (!empty($comentario['Comentario']['adjunto'])) :
					$html .= '<br/><br/>';
					$html .= '<a class="btn btn-xs btn-info" href="'.sprintf('%swebroot/img/%s', Router::url('/', true), $comentario['Comentario']['adjunto']['path']).'" target="_blank"><i class="fa fa-eye"></i> Ver adjunto</a>';
					endif;
				$html .= '</div>';
				$html .= '</div>';

    		}elseif ($rolUsuario == 'usuario' && $idUsuario == $comentario['Comentario']['usuario_id']) {
    			
    			$html .= '<div class="item in">';
                $html .= '<div class="image">';

                $imagen = Router::url('/', true) . '/webroot/img/logo_user.jpg';
                
                if ($comentario['Usuario']['imagen'] != '' ) {
                	$imagen = sprintf('%s/webroot/img/Usuario/%d/mini_%s',Router::url('/', true) , $comentario['Usuario']['id'] , $comentario['Usuario']['imagen']);
                }

                $html .= '<img src="' . $imagen . '" alt="' . $comentario['Usuario']['nombre'] . ' ' . $comentario['Usuario']['apellidos'] . '">';
                $html .= '</div>';
                $html .= '<div class="text">';
				$html .= '<div class="heading">';
				$html .= '<a href="#">Yo</a>';

				if (date('Y-m-d', strtotime($comentario['Comentario']['created'])) == date('Y-m-d') ) {
					$fechaComentario = 'Hoy a las ' . date('H:i:s', strtotime($comentario['Comentario']['created']));
				}else{
					$fechaComentario = date('Y-m-d H:i:s', strtotime($comentario['Comentario']['created']));
				}

				$html .= '<span class="date">' . $fechaComentario . '</span>';
				$html .= '<span class="visto">';
					if ($comentario['Comentario']['visualizado']) {
						$html .= '<i class="fa fa-check visto"></i><i class="fa fa-check visto"></i>';
					}else{
						$html .= '<i class="fa fa-check"></i><i class="fa fa-check"></i>';
					}
				$html .= '</span>';
				$html .= '</div>';
				$html .= strip_tags(nl2br($comentario['Comentario']['comentario']));
				if (!empty($comentario['Comentario']['adjunto'])) :
					$html .= '<br/><br/>';
					$html .= '<a class="btn btn-xs btn-info" href="'.sprintf('%swebroot/img/%s', Router::url('/', true), $comentario['Comentario']['adjunto']['path']).'" target="_blank"><i class="fa fa-eye"></i> Ver adjunto</a>';
					endif;
				$html .= '</div>';
				$html .= '</div>';

    		}else{

    			if (!empty($comentario['Usuario']['id'])) {
    				$html .= '<div class="item not-my">';
                    $html .= '<div class="image">';

                    $imagen = Router::url('/', true) . '/webroot/img/logo_user.jpg';
                    
                    if ($comentario['Usuario']['imagen'] != '' ) {
                    	 $imagen = sprintf('%s/webroot/img/Usuario/%d/mini_%s',Router::url('/', true) , $comentario['Usuario']['id'] , $comentario['Usuario']['imagen']);
                    }

                    $html .= '<img src="' . $imagen . '" alt="' . $comentario['Usuario']['nombre'] . ' ' . $comentario['Usuario']['apellidos'] . '">';
                    $html .= '</div>';
                    $html .= '<div class="text">';
					$html .= '<div class="heading">';
					$html .= '<a href="#" data-id="'.$comentario['Comentario']['id'].'">' . $comentario['Usuario']['nombre'] . ' ' . $comentario['Usuario']['apellidos'] . ' <small>Mantenedor</small></a>';

					if (date('Y-m-d', strtotime($comentario['Comentario']['created'])) == date('Y-m-d') ) {
						$fechaComentario = 'Hoy a las ' . date('H:i:s', strtotime($comentario['Comentario']['created']));
					}else{
						$fechaComentario = date('Y-m-d H:i:s', strtotime($comentario['Comentario']['created']));
					}

					$html .= '<span class="date">' . $fechaComentario . '</span>';
					$html .= '<span class="visto">';
					if (($comentario['Comentario']['visualizado'])) {
						$html .= '<i class="fa fa-check visto"></i><i class="fa fa-check visto"></i>';
					}else{
						$html .= '<i class="fa fa-check"></i><i class="fa fa-check"></i>';
					}
					$html .= '</span>';
					$html .= '</div>';
					$html .= strip_tags(nl2br($comentario['Comentario']['comentario']));
					if (!empty($comentario['Comentario']['adjunto'])) :
						$html .= '<br/><br/>';
					$html .= '<a class="btn btn-xs btn-info" href="'.sprintf('%swebroot/img/%s', Router::url('/', true), $comentario['Comentario']['adjunto']['path']).'" target="_blank"><i class="fa fa-eye"></i> Ver adjunto</a>';
					endif;
					$html .= '</div>';
					$html .= '</div>';
    			}


    			if (!empty($comentario['Administrador']['id'])) {
    				$html .= '<div class="item not-my">';
                    $html .= '<div class="image">';
                    
                    $imagen = Router::url('/', true) . '/webroot/img/logo_user.jpg';
                    
                    if ($comentario['Administrador']['google_imagen'] != '' ) {
                    	$imagen = $comentario['Administrador']['google_imagen'];
                    }

                    $html .= '<img src="' . $imagen . '" alt="' . $comentario['Administrador']['nombre'] . ' ' . $comentario['Administrador']['apellidos'] . '">';
                    $html .= '</div>';
                    $html .= '<div class="text">';
					$html .= '<div class="heading">';
					$html .= '<a href="#" data-id="'.$comentario['Comentario']['id'].'">' . $comentario['Administrador']['nombre'] . ' ' . $comentario['Administrador']['apellidos'] . ' <small>Administrador</small></a>';

					if (date('Y-m-d', strtotime($comentario['Comentario']['created'])) == date('Y-m-d') ) {
						$fechaComentario = 'Hoy a las ' . date('H:i:s', strtotime($comentario['Comentario']['created']));
					}else{
						$fechaComentario = date('Y-m-d H:i:s', strtotime($comentario['Comentario']['created']));
					}

					$html .= '<span class="date">' . $fechaComentario . '</span>';
					$html .= '<span class="visto">';
					if (($comentario['Comentario']['visualizado'])) {
						$html .= '<i class="fa fa-check visto"></i><i class="fa fa-check visto"></i>';
					}else{
						$html .= '<i class="fa fa-check"></i><i class="fa fa-check"></i>';
					}
					$html .= '</span>';
					$html .= '</div>';
					$html .= strip_tags(nl2br($comentario['Comentario']['comentario']));
					if (!empty($comentario['Comentario']['adjunto'])) :
						$html .= '<br/><br/>';
					$html .= '<a class="btn btn-xs btn-info" href="'.sprintf('%swebroot/img/%s', Router::url('/', true), $comentario['Comentario']['adjunto']['path']).'" target="_blank"><i class="fa fa-eye"></i> Ver adjunto</a>';
					endif;
					$html .= '</div>';
					$html .= '</div>';
    			}
    		}
    	}

        $html .= '</div>';
            
        $res = array(
			'code' => 200,
			'message' => 'Mensajes obtenidos correctamente.',
			'data' => $html
		);

		echo json_encode($res);
		exit;
	}


	public function visualizado($id)
	{	
		$res = array(
			'code' => 500,
			'message' => 'Error en la petición'
		);

		if ( ! $this->Comentario->exists($id) )
		{
			$res = array(
				'code' => 400,
				'message' => 'No existe el comentario'
			);
			echo json_encode($res);
			exit;
		}

		$this->Comentario->id = $id;
		if ($this->Comentario->saveField('visualizado', 1)) {
			$res = array(
				'code' => 200,
				'message' => 'Comentario visualizado'
			);
		}

		echo json_encode($res);
		exit;
	}
}
