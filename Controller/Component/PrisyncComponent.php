<?php
App::uses('Component', 'Controller');
App::import('Vendor', 'Prisync', array('file' => 'Prisync/Prisync.php'));

class PrisyncComponent extends Component
{	

	public $Prisync;


	public function autenticacion()
	{	
		$activo = configuracion('usar_prisync');

		if (!$activo) {
			return false;
		}

		$api_key = configuracion('prisync_key');
		$api_token = configuracion('prisync_token');

		if (empty($api_key) || empty($api_token)) {
			return false;
		}

		$this->Prisync = new Prisync($api_key, $api_token);
	
	}



	public function obtenerProductos($url = '/api/v2/list/product/startFrom/0')
	{	
		$this->autenticacion();

		$productos = $this->Prisync->get($url);
		
		if ($productos['httpCode'] >= 300) {
			throw new Exception( sprintf('%s. Código de error: %d', $productos['body']->error, $productos['body']->errorCode));
			return;
		}else{
			return to_array($productos['body']);
		}
	}


	public function obtenerProductoPorId($id = '')
	{	
		if (!empty($id)) {

			$this->autenticacion();
			
			$url = '/api/v2/get/product/id/' . $id;
			$producto = $this->Prisync->get($url);
			
			if ($producto['httpCode'] >= 300) {
				throw new Exception( sprintf('%s. Código de error: %d', $producto['body']->error, $producto['body']->errorCode));
				return;
			}else{
				return to_array($producto['body']);
			}
		}
	}


	public function obtenerCompetidoresPorProducto($id = '')
	{
		if (!empty($id)) {

			$this->autenticacion();

			$url  = '/api/v2/get/url/id/' . $id;
			
			$urls = $this->Prisync->get($url);
			
			if ($urls['httpCode'] >= 300) {
				throw new Exception( sprintf('%s. Código de error: %d', $urls['body']->error, $urls['body']->errorCode));
				return;
			}else{
				return to_array($urls['body']);
			}

		}
	}


	/**
	 * Insertar
	 */
	public function crearProducto($data = array())
	{
		if ( !empty($data['name']) && !empty($data['brand']) && !empty($data['category']) && !empty($data['product_code']) && !empty($data['cost']) ) {
			
			$this->autenticacion();

			$url = '/api/v2/add/product';

			$crear = $this->Prisync->post($url, $data);
			
			if ($crear['httpCode'] >= 300) {
				throw new Exception( sprintf('%s. Código de error: %d', $crear['body']->error, $crear['body']->errorCode));
				return;
			}else{
				return to_array($crear['body']);
			}

		}else{
			throw new Exception("No se permiten campos vacios");
		}
	}



	public function crearCompetidor($data = array())
	{
		if ( !empty($data['product_id']) && !empty($data['url']) ) {
			
			$this->autenticacion();

			$url = '/api/v2/add/url';

			$crear = $this->Prisync->post($url, $data);

			if ($crear['httpCode'] >= 300) {
				throw new Exception( sprintf('%s. Código de error: %d', $crear['body']->error, $crear['body']->errorCode));
				return;
			}else{
				return to_array($crear['body']);
			}

		}else{
			throw new Exception("No se permiten campos vacios");
		}
	}


	/**
	 * Editar
	*/
	
	public function editarProducto($id = '', $data = array())
	{
		if ( !empty($id) ) {
			
			$this->autenticacion();

			$url = '/api/v2/edit/product/id/' . $id;

			$crear = $this->Prisync->post($url, $data);
			
			if ($crear['httpCode'] >= 300) {
				throw new Exception( sprintf('%s. Código de error: %d', $crear['body']->error, $crear['body']->errorCode));
				return;
			}else{
				return to_array($crear['body']);
			}

		}else{
			throw new Exception("No se permiten campos vacios");
		}
	}


	public function borrarCompetidor($id)
	{
		if ( !empty($id) ) {
			
			$this->autenticacion();

			$url = '/api/v2/delete/url/id/' . $id;

			$eliminar = $this->Prisync->post($url, $data);

			if ($eliminar['httpCode'] >= 300) {
				throw new Exception( sprintf('%s. Código de error: %d', $eliminar['body']->error, $eliminar['body']->errorCode));
				return;
			}else{
				return to_array($eliminar['body']);
			}

		}else{
			throw new Exception("No se permiten campos vacios");
		}
	}
}