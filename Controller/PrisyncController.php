<?php
App::uses('AppController', 'Controller');

class PrisyncController extends AppController {

	public $uses = array('Producto');


	/**
	 * Ordena la información de la categoria
	 * @param 	$id_category 		int 		Identificador de categoia
	 * @param 	$name 				string 		Nombre de la categoria
	 * @param 	$level_depth 		int 		Nivel de categoria
	 * @param 	$parent_categories	array 		Arreglo de datos de categorias padres
	 * @return 	$array 
	 */
	public function formatTree($id_category = null, $name = '', $level_depth = null, $parent_categories = array())
	{
		$arr = array(
			'id_category' => (int) $id_category,
			'name' => (string) $name,
			'level_depth' => (int) $level_depth,
			'parent_categories' => (array) $parent_categories
		);

		return $arr;
	}


	public function getParentCategory($id_category = '', $prefix = 'tm_')
	{	
		if (empty($id_category)) {
			return;
		}

		$categories = array();

		$q = "SELECT c.id_category, c.id_parent, c.level_depth, cl.name FROM  ".$prefix."category AS c 
			LEFT JOIN ".$prefix."category_lang cl ON (c.id_category = cl.id_category) 
			WHERE c.id_category =" . $id_category;
			
		$parentCategory = ClassRegistry::init('Productotienda')->query($q);
		
		for ( $i = $parentCategory[0]['c']['level_depth'] ; $i > 1 ; $i--) {
			if ($i == $parentCategory[0]['c']['level_depth']) {
				$categories[$i] = $this->formatTree($parentCategory[0]['c']['id_category'], $parentCategory[0]['cl']['name'], $parentCategory[0]['c']['level_depth'], $this->getParentCategory($parentCategory[0]['c']['id_parent'], $prefix));	
			}
		}
	
		return $categories;
	
	}

	public function categoriesTree( $categories = array() )
	{
		$arr = '';
		
		foreach ($categories as $ix => $category) {
			$arr .= $category['name'] . ',';
			
			for ( $i = $category['level_depth']; $i > 0 ; $i-- ) { 
				if ($i == $category['level_depth'] ) {
					$arr .= $this->categoriesTree($category['parent_categories']);
				}
			}
		}

		return $arr;
	}

	public function tree($string)
	{
		$formatted = explode(',', $string);
		$formatted = array_reverse($formatted);
		
		$s = '';

		foreach ($formatted as $key => $value) {
			if ($key > 1) {
				$s .= ' > ' . $value;
			}else{
				$s .= $value;
			}
		}

		return $s;
	}



	public function obtenerProductoPorReferencia($referencia = '')
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Productotienda', 'PrecioEspecifico'));

		if (empty($this->Session->read('Tienda.protocolo'))) {
			$sitioUrl = 'http://' . $this->Session->read('Tienda.url');
		}else{
			$sitioUrl = $this->Session->read('Tienda.protocolo') . $this->Session->read('Tienda.url');
		}

		// Buscamos los productos que cumplan con el criterio
		$productos	= ClassRegistry::init('Productotienda')->find('all', array(
			'fields' => array(
				'concat(\'' . $sitioUrl . '/img/p/\',mid(im.id_image,1,1),\'/\', if (length(im.id_image)>1,concat(mid(im.id_image,2,1),\'/\'),\'\'),if (length(im.id_image)>2,concat(mid(im.id_image,3,1),\'/\'),\'\'),if (length(im.id_image)>3,concat(mid(im.id_image,4,1),\'/\'),\'\'),if (length(im.id_image)>4,concat(mid(im.id_image,5,1),\'/\'),\'\'), im.id_image, \'-home_default.jpg\' ) AS url_image_thumb',
				'concat(\'' . $sitioUrl . '/img/p/\',mid(im.id_image,1,1),\'/\', if (length(im.id_image)>1,concat(mid(im.id_image,2,1),\'/\'),\'\'),if (length(im.id_image)>2,concat(mid(im.id_image,3,1),\'/\'),\'\'),if (length(im.id_image)>3,concat(mid(im.id_image,4,1),\'/\'),\'\'),if (length(im.id_image)>4,concat(mid(im.id_image,5,1),\'/\'),\'\'), im.id_image, \'.jpg\' ) AS url_image_large',
				'Productotienda.id_product',
				'Productotienda.id_category_default',
				'pl.name', 
				'pl.description_short',
				'Productotienda.price', 
				'pl.link_rewrite', 
				'Productotienda.reference', 
				'Productotienda.show_price',
				'Productotienda.quantity',
				'CategoriaIdioma.*',
				'Tax.rate'
			),
			'joins' => array(
				array(
		            'table' => sprintf('%sproduct_lang', $this->Session->read('Tienda.prefijo')),
		            'alias' => 'pl',
		            'type'  => 'LEFT',
		            'conditions' => array(
		                'Productotienda.id_product = pl.id_product'
		            )

	        	),
	        	array(
		            'table' => sprintf('%simage', $this->Session->read('Tienda.prefijo')),
		            'alias' => 'im',
		            'type'  => 'LEFT',
		            'conditions' => array(
		                'Productotienda.id_product = im.id_product',
                		'im.cover' => 1
		            )
	        	),
	        	array(
		            'table' => sprintf('%scategory_lang', $this->Session->read('Tienda.prefijo')),
		            'alias' => 'CategoriaIdioma',
		            'type'  => 'LEFT',
		            'conditions' => array(
		                'Productotienda.id_category_default = CategoriaIdioma.id_category'
		            )
	        	),
	        	array(
		            'table' => sprintf('%stax_rules_group', $this->Session->read('Tienda.prefijo')),
		            'alias' => 'TaxRulesGroup',
		            'type'  => 'LEFT',
		            'conditions' => array(
		                'Productotienda.id_tax_rules_group = TaxRulesGroup.id_tax_rules_group'
		            )
	        	),
	        	array(
		            'table' => sprintf('%stax_rule', $this->Session->read('Tienda.prefijo')),
		            'alias' => 'TaxRule',
		            'type'  => 'LEFT',
		            'conditions' => array(
		                'TaxRulesGroup.id_tax_rules_group = TaxRule.id_tax_rules_group'
		            )
	        	),
	        	array(
		            'table' => sprintf('%stax', $this->Session->read('Tienda.prefijo')),
		            'alias' => 'Tax',
		            'type'  => 'LEFT',
		            'conditions' => array(
		                'TaxRule.id_tax_rule = TaxRule.id_tax_rule'
		            )
	        	)
			),
			'contain' => array(
				'PrecioEspecifico' => array(
					'conditions' => array(
						'OR' => array(
							array(
								'PrecioEspecifico.from <= "' . date('Y-m-d H:i:s') . '"',
								'PrecioEspecifico.to >= "' . date('Y-m-d H:i:s') . '"'
							),
							array(
								'PrecioEspecifico.from' => '0000-00-00 00:00:00',
								'PrecioEspecifico.to >= "' . date('Y-m-d H:i:s') . '"'
							),
							array(
								'PrecioEspecifico.from' => '0000-00-00 00:00:00',
								'PrecioEspecifico.to' => '0000-00-00 00:00:00'
							),
							array(
								'PrecioEspecifico.from <= "' . date('Y-m-d H:i:s') . '"',
								'PrecioEspecifico.to' => '0000-00-00 00:00:00'
							)
						)
					)
				)
			),
			'conditions' => array(
				'Productotienda.reference' => $referencia
			)
		));
		
		$result = array();
		
		foreach ($productos as $ip => $producto) {
			
			if (!empty($producto['Productotienda']['id_category_default'])) {
				$cate = $this->getParentCategory($producto['Productotienda']['id_category_default'], $this->Session->read('Tienda.prefijo'));
				$cate = $this->categoriesTree($cate);
			}else{
				$cate = 'Única';
			}

			if ( !isset($producto['Tax']['rate']) ) {
				$producto['Productotienda']['valor_iva'] = $producto['Productotienda']['price'];	
			}else{
				$producto['Productotienda']['valor_iva'] = $this->precio($producto['Productotienda']['price'], $producto['Tax']['rate']);
			}
			
			$producto['Productotienda']['valor_final'] = $producto['Productotienda']['valor_iva'];

			// Retornar último precio espeficico según criterio del producto
			foreach ($producto['PrecioEspecifico'] as $precio) {
				if ( $precio['reduction'] == 0 ) {
					$producto['Productotienda']['valor_final'] = $producto['Productotienda']['valor_iva'];

				}else{

					$producto['Productotienda']['valor_final'] = $this->precio($producto['Productotienda']['valor_iva'], ($precio['reduction'] * 100 * -1) );
					$producto['Productotienda']['descuento']   = ($precio['reduction'] * 100 * -1 );

				}
			}

			$result[$ip]['Identifier']        = $producto['Productotienda']['id_product'];
			$result[$ip]['Reference']         = $producto['Productotienda']['reference'];
			$result[$ip]['Description']       = strip_tags($producto['pl']['description_short']);
			$result[$ip]['Title']             = $producto['pl']['name'];
			$result[$ip]['ProductListImage']  = $producto[0]['url_image_thumb'];
			$result[$ip]['ProductViewImages'] = $producto[0]['url_image_large'];
			$result[$ip]['ProductUrl']        = sprintf('%s/%s-%s.html', $sitioUrl, $producto['pl']['link_rewrite'], $producto['Productotienda']['id_product']);;
			$result[$ip]['CategoryId']        = $producto['Productotienda']['id_category_default'];
			$result[$ip]['CategoryTree']      = $this->tree($cate);
			$result[$ip]['CategoryName']      = $producto['CategoriaIdioma']['name'];
			$result[$ip]['Stock']             = ($producto['Productotienda']['quantity'] > 0) ? '1' : '0';
			$result[$ip]['InternetPrice']     = $producto['Productotienda']['valor_final'];

		}
		
		return $result;
	}

	public function admin_ver_resultados_productos()
	{
		$productos = $this->PrisyncProducto->find('all', array(
			'contain' => array(
				'PrisyncRuta'
			)
		));

		if (empty($productos)) {
			$response = array(
				'code'    => 200,
				'message' => 'No se encontraron productos',
				'value'   => 0
			);

			echo json_encode($response);
			exit;
		}

		$resultados		= array();
		$productosAlta  = array();
		$productosBaja  = array();
		$productosIgual = array();
		$contAlta       = 0;
		$contBaja       = 0;
		$contIgual      = 0;

		$competidores = array();
		$micompania = 'toolmania';

		foreach ($productos as $ip => $producto) {
			foreach ($producto['PrisyncRuta'] as $ir => $competidor) {
				$url      = parse_url($competidor['url']);
				$compania = explode('.', str_replace('www.', '', $url['host']));
				
				$competidores[$ip][$compania[0]]['url']          = $compania[0];
				$competidores[$ip][$compania[0]]['product_id'] 	= $producto['PrisyncProducto']['id'];
				$competidores[$ip][$compania[0]]['product_name'] = $producto['PrisyncProducto']['name'];
				$competidores[$ip][$compania[0]]['product_code'] = $producto['PrisyncProducto']['internal_code'];
				$competidores[$ip][$compania[0]]['price']        = $competidor['price'];
				
			}	
		}


		if (!empty($competidores)) {
			
			$base = (int) 0;
			
			foreach ($competidores as $ic => $competidor) {

				if (array_key_exists($micompania, $competidor)) {
					
					$base = $competidor[$micompania]['price'];

					foreach ($competidor as $ico => $comp) {
						if ($ico != $micompania) {
							if ($comp['price'] > $base) {
								$contBaja                    = $contBaja + 1;
								$resultados[$ico]['Alto']['total'] = $contBaja;		
							}

							if ($comp['price'] < $base) {
								$contAlta                    = $contAlta + 1;
								$resultados[$ico]['Bajo']['total'] = $contAlta;		
							}

							if ($comp['price'] == $base) {
								$contIgual                    = $contIgual + 1;
								$resultados[$ico]['Igual']['total'] = $contIgual;		
							}
						}
					}
				}
							
			}
			
		}

		$response = array(
			'code'    => 200,
			'message' => 'Resultados de la operación',
			'value'   => $resultados
		);

		echo json_encode($response);
		exit;
	}

	/**
	 * Verifica que el producto exista en la base de datos de la tienda
	 * @param  array  	$productos 	Listado de productos
	 * @return array 	$productos  Listado de productos
	 */
	public function verificarExistenciaTienda($productos = array())
	{	
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Productotienda'));

		foreach ($productos as $ip => $producto) {
			$ptienda = ClassRegistry::init('Productotienda')->find('count', array(
				'conditions' => array(
					'Productotienda.reference' => $producto['Producto']['referencia']
				)
			));

			if ($ptienda > 0) {
				$productos[$ip]['Producto']['en_tienda'] = true;
			}else{
				$productos[$ip]['Producto']['en_tienda'] = false;
			}
		}

		return $productos;
	}


	/**
	 * Verifica que un producto exista en prisync
	 * @param  array  $productos Listado de productos
	 * @return array  $productos Listado de productos 
	 */
	public function verificarExistenciaPrisync($productos = array())
	{
		foreach ($productos as $ip => $producto) {
			$ptienda = ClassRegistry::init('PrisyncProducto')->find('count', array(
				'conditions' => array(
					'PrisyncProducto.internal_code' => $producto['Producto']['referencia']
				)
			));

			if ($ptienda > 0) {
				$productos[$ip]['Producto']['en_prisync'] = true;
			}else{
				$productos[$ip]['Producto']['en_prisync'] = false;
			}
		}

		return $productos;
	}


	/**
     * Crea un redirect y agrega a la URL los parámetros del filtro
     * @param 		$controlador 	String 		Nombre del controlador donde redirijirá la petición
     * @param 		$accion 		String 		Nombre del método receptor de la petición
     * @return 		void
     */
    public function filtrar($controlador = '', $accion = '')
    {
    	$redirect = array(
    		'controller' => $controlador,
    		'action' => $accion
    		);

		foreach ($this->request->data['Filtro'] as $campo => $valor) {
			if (!empty($valor)) {
				$redirect[$campo] = $valor;
			}
		}

    	$this->redirect($redirect);

    }


	public function admin_index()
	{
		# Cambiamos el datasource de los modelos que necesitamos externos
		$this->cambiarDatasource(array('Fabricante', 'Proveedor'));

		$options['limit'] = 10;
		$options['recursive'] = 0;
		$options['order'] = array('Producto.created' => 'DESC');
		$options['conditions'] = array(
			'Producto.aceptado' => 1
		);

		$options['contain'] = array(
			'Competidor',
			'Tarea',
			'Marca'
		);

		$total = 0;
    	$totalMostrados = 0;

		// Filtrado de productos por formulario
		if ( $this->request->is('post') ) {

			$this->filtrar('prisync', 'index');

		}


		/**
		* Buscar por nombre
		*/
		if ( ! empty($this->request->params['named']['nombre']) ) {
			$options		= array_replace_recursive($options, array(
				'conditions'	=> array(
					'Producto.nombre_final LIKE "%' . trim($this->request->params['named']['nombre']) . '%"'
				)
			));
			
		}

		/**
		* Buscar por tarea
		*/
		if ( ! empty($this->request->params['named']['tarea']) ) {

			$options		= array_replace_recursive($options, array(
				'conditions'	=> array(
					'Producto.tarea_id' => $this->request->params['named']['tarea']
				)
			));
			
		}

		/**
		* Buscar por mantenedor
		*/
		if ( ! empty($this->request->params['named']['mantenedor']) ) {

			$options		= array_replace_recursive($options, array(
				'conditions'	=> array(
					'Producto.usuario_id' => $this->request->params['named']['mantenedor']
				)
			));
			
		}


		/**
		* Buscar por marca
		*/
		if ( ! empty($this->request->params['named']['marca']) ) {

			$options		= array_replace_recursive($options, array(
				'conditions'	=> array(
					'Producto.marca_id' => $this->request->params['named']['marca']
				)
			));
			
		}


		/**
		* Buscar por prisync
		*/
		if ( ! empty($this->request->params['named']['prisync']) && $this->request->params['named']['prisync'] ) {

			$options		= array_replace_recursive($options, array(
				'conditions'	=> array(
					'Producto.prisync_id != ""'  
				)
			));
			
		}


		/**
		* Buscar por id_prisync
		*/
		if ( ! empty($this->request->params['named']['id_prisync']) ) {

			$options		= array_replace_recursive($options, array(
				'conditions'	=> array(
					'Producto.prisync_id' => $this->request->params['named']['id_prisync']
				)
			));
			
		}

		$this->paginate		= $options;

		$productos		= $this->verificarExistenciaTienda($this->paginate());
		$productos		= $this->verificarExistenciaPrisync($productos);
		$total          = ClassRegistry::init('Producto')->find('count', array('Producto.aceptado' => 1));
		$totalMostrados = count($productos);
		$tareas         = ClassRegistry::init('Tarea')->find('list');
		$mantenedores   = ClassRegistry::init('Usuario')->find('list', array('conditions' => array('Usuario.activo' => 1)));
		$prisync        = array(1 => 'Publicado en prisync', 0 => 'No publicado');
		$marcas         = ClassRegistry::init('Marca')->find('list', array('conditions' => array('Marca.activo' => 1)));
		
		$this->set(compact('productos', 'tareas', 'mantenedores', 'prisync', 'marcas', 'total', 'totalMostrados'));
	}

	public function admin_editar($id)
	{
		if (!$this->Producto->exists($id)) {
			$this->Session->setFlash('No existe producto solicitado.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ($this->request->is('post') || $this->request->is('put') ) {

			$errores 	= '';
			$exitos 	= '';

			if (empty($this->request->data['Producto']['product_code'])) {
				$errores .= '<li>Código del producto está incompleto.</li>';
			}

			if (empty($this->request->data['Producto']['name'])) {
				$errores .= '<li>Nombre del producto es requerido.</li>';
			}

			if (empty($this->request->data['Producto']['brand'])) {
				$errores .= '<li>Marca del producto es requerido.</li>';
			}

			if (empty($this->request->data['Producto']['category'])) {
				$errores .= '<li>Categoría del producto es requerido.</li>';
			}

			if (empty($this->request->data['Producto']['cost'])) {
				$errores .= '<li>Precio del producto es requerido.</li>';
			}

			if (!empty($errores)) {
				$this->Session->setFlash('Hay errores en el formulario: <br><ul>' . $errores . '</ul>', null, array(), 'danger');
				$this->redirect(array('action' => 'publish', $id));
			}
			#prx($this->request->data);

			$data = array(
				'name'         => trim($this->request->data['Producto']['name']),
				'brand'        => trim($this->request->data['Producto']['brand']),
				'category'     => trim($this->request->data['Producto']['category']),
				'product_code' => trim($this->request->data['Producto']['product_code']),
				'cost'         => str_replace('.', '', $this->request->data['Producto']['cost'])
			);

			$editar = array();
			
			try {
				$editar = $this->Prisync->editarProducto($this->request->data['Producto']['id_prisync'], $data);
			} catch (Exception $e) {
				$errores .= '<li>' . $e->getMessage() . '</li>';
			}

			# Producto editado con éxito
			if (isset($editar['id']) && $editar['result'] ) {
				
				$exitos .= '<li>Producto editado con éxito. ID Prisync #' . $editar['id'];

				# Eliminamos y guardamos las urls
				foreach ($this->request->data['Competidor'] as $ic => $competidor) {
					
					$dataUrl = array(
						'product_id' => $this->request->data['Producto']['id_prisync'],
						'url'        => $competidor['url']
					);

					if (isset($competidor['id_prisync'])) {
						try {
							$eliminarUrl = $this->Prisync->borrarCompetidor($competidor['id_prisync']);
						} catch (Exception $e) {
							$errores .= '<li>' . $e->getMessage() . '</li>';
						}

						if (isset($eliminarUrl['result']) && $eliminarUrl['result'] ) {
							try {
								$crearUrl = $this->Prisync->crearCompetidor($dataUrl);
							} catch (Exception $e) {
								$errores .= '<li>' . $e->getMessage() . '</li>';
							}

							if (isset($crearUrl['id'])) {

								if (isset($competidor['id'])) {
									# Guardamos id prosync en data interna
									$competidorData = array(
										'CompetidoresProducto' => array(
											'id'         => $competidor['id'],
											'id_prisync' => $crearUrl['id'],
											'url'        => $competidor['url']
										)
									);

									if (ClassRegistry::init('CompetidoresProducto')->save($competidorData)) {
										$exitos .= '<li>Competidores creado con éxito. ID Prisync #' . $crearUrl['id'];
									}	
								}
							}
						}	
					}
				}
				
			}

			if (!empty($exitos)) {
				$this->Session->setFlash('¡Éxito! Resultados de la operación: <br><ul>' . $exitos . '</ul>', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}

			if (!empty($errores)) {
				$this->Session->setFlash('Hay errores en el formulario: <br><ul>' . $errores . '</ul>', null, array(), 'danger');
				$this->redirect(array('action' => 'editar', $id));
			}

		}else{

			$this->request->data = $this->Producto->find('first', array(
				'conditions' => array(
					'Producto.id' => $id
				),
				'contain' => array(
					'Marca', 
					'Competidor',
					'Tarea' => array(
						'Administrador',
						'Tienda'
					),
					'Usuario'
				)
			));

			$this->request->data['Productotienda'] = $this->obtenerProductoPorReferencia($this->request->data['Producto']['referencia']);

			$categorias      = array();
			$identificadores = array();
			$precios         = array();
			$urlProducto 	 = array();

			foreach ($this->request->data['Productotienda'] as $icat => $producto) {
				$categorias[$producto['CategoryName']]    = $producto['CategoryName'];
				$identificadores[$producto['Identifier']] = $producto['Identifier'];
				$precios[$producto['InternetPrice']]      = CakeNumber::currency($producto['InternetPrice'], 'CLP');
				$urlProducto[$producto['ProductUrl']]     = $producto['ProductUrl'];
			}

			$prisync = array();

			if (!empty($this->request->data['Producto']['prisync_id'])) {
				
				try {
					$prisync = $this->Prisync->obtenerProductoPorId($this->request->data['Producto']['prisync_id']);
				} catch (Exception $e) {
					
					# Cambiamos el datasource de los modelos que necesitamos externos
					$this->cambiarDatasource(array('Fabricante', 'Proveedor'));

					# Se limpia el ID de prisync
					$this->Producto->id = $id;
					
					if( $this->Producto->saveField('prisync_id', '', array('callbacks' => false))){
						$this->Session->setFlash('Éste producto fue eliminado de Prisync manualmente.', null, array(), 'danger');
						$this->redirect(array('action' => 'index'));
					}else{
						$this->Session->setFlash('Ha ocurrido un error.', null, array(), 'danger');
						$this->redirect(array('action' => 'index'));
					}
				}

				$urls = array();
				if (!empty($prisync['urls'])){
					foreach ($prisync['urls'] as $ipu => $urlId) {
						$urls[] = $this->Prisync->obtenerCompetidoresPorProducto($urlId);
					}
				}

				$prisync['urls'] = $urls;	
			}else{
				$this->Session->setFlash('Éste producto no existe en prisync.', null, array(), 'danger');
				$this->redirect(array('action' => 'index'));
			}

			$this->set(compact('categorias', 'identificadores', 'precios', 'urlProducto', 'prisync'));

		}
	}


	public function admin_publish($id)
	{
		if (!$this->Producto->exists($id)) {
			$this->Session->setFlash('No existe producto solicitado.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ($this->request->is('post') || $this->request->is('put') ) {

			$errores 	= '';
			$exitos 	= '';

			if (empty($this->request->data['Producto']['product_code_id']) || empty($this->request->data['Producto']['product_code_reference'])) {
				$errores .= '<li>Código del producto está incompleto.</li>';
			}

			if (empty($this->request->data['Producto']['name'])) {
				$errores .= '<li>Nombre del producto es requerido.</li>';
			}

			if (empty($this->request->data['Producto']['brand'])) {
				$errores .= '<li>Marca del producto es requerido.</li>';
			}

			if (empty($this->request->data['Producto']['category'])) {
				$errores .= '<li>Categoría del producto es requerido.</li>';
			}

			if (empty($this->request->data['Producto']['cost'])) {
				$errores .= '<li>Precio del producto es requerido.</li>';
			}

			if (!empty($errores)) {
				$this->Session->setFlash('Hay errores en el formulario: <br><ul>' . $errores . '</ul>', null, array(), 'danger');
				$this->redirect(array('action' => 'publish', $id));
			}

			$data = array(
				'name'         => trim($this->request->data['Producto']['name']),
				'brand'        => trim($this->request->data['Producto']['brand']),
				'category'     => trim($this->request->data['Producto']['category']),
				'product_code' => trim($this->request->data['Producto']['product_code_id'] . '|' . $this->request->data['Producto']['product_code_reference']),
				'cost'         => str_replace('.', '', $this->request->data['Producto']['cost'])
			);
			#prx($this->request->data);
			$crear = array();

			try {
				$crear = $this->Prisync->crearProducto($data);
			} catch (Exception $e) {
				$errores .= '<li>' . $e->getMessage() . '</li>';
			}


			if (isset($crear['id'])) {
				# Cambiamos el datasource de los modelos que necesitamos externos
				$this->cambiarDatasource(array('Fabricante', 'Proveedor'));

				# Guardamos el id de prisync
				$this->Producto->id = $id;
				if ($this->Producto->saveField('prisync_id', $crear['id'], array('callbacks' => false))) {
					$exitos .= '<li>Producto creado con éxito. ID Prisync #' . $crear['id'];
				}

				# Guardamos las urls
				foreach ($this->request->data['Competidor'] as $ic => $competidor) {
					
					$dataUrl = array(
						'product_id' => $crear['id'],
						'url'        => $competidor['url']
					);

					try {
						$crearUrl = $this->Prisync->crearCompetidor($dataUrl);
					} catch (Exception $e) {
						$errores .= '<li>' . $e->getMessage() . '</li>';
					}

					if (isset($crearUrl['id'])) {

						if (isset($competidor['id'])) {
							# Guardamos id prosync en data interna
							$competidorData = array(
								'CompetidoresProducto' => array(
									'id'         => $competidor['id'],
									'id_prisync' => $crearUrl['id'],
									'url'        => $competidor['url']
								)
							);

							if (ClassRegistry::init('CompetidoresProducto')->save($competidorData)) {
								$exitos .= '<li>Competidores creado con éxito. ID Prisync #' . $crearUrl['id'];
							}	
						}
					}
				}
			}

			if (!empty($exitos)) {
				$this->Session->setFlash('¡Éxito! Resultados de la operación: <br><ul>' . $exitos . '</ul>', null, array(), 'success');
				$this->redirect(array('action' => 'editar', $id));
			}

			if (!empty($errores)) {
				$this->Session->setFlash('Hay errores en el formulario: <br><ul>' . $errores . '</ul>', null, array(), 'danger');
				$this->redirect(array('action' => 'publish', $id));
			}
			

			
		}else{
			$this->request->data = $this->Producto->find('first', array(
				'conditions' => array(
					'Producto.id' => $id
				),
				'contain' => array(
					'Marca', 
					'Competidor',
					'Tarea' => array(
						'Administrador',
						'Tienda'
					),
					'Usuario'
				)
			));

			$this->request->data['Productotienda'] = $this->obtenerProductoPorReferencia($this->request->data['Producto']['referencia']);

			$categorias      = array();
			$identificadores = array();
			$precios         = array();
			$urlProducto 	 = array();

			foreach ($this->request->data['Productotienda'] as $icat => $producto) {
				$categorias[$producto['CategoryName']]    = $producto['CategoryName'];
				$identificadores[$producto['Identifier']] = $producto['Identifier'];
				$precios[$producto['InternetPrice']]      = CakeNumber::currency($producto['InternetPrice'], 'CLP');
				$urlProducto[$producto['ProductUrl']]     = $producto['ProductUrl'];
			}

			$this->set(compact('categorias', 'identificadores', 'precios', 'urlProducto'));
		}
	}

}