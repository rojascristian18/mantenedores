<?php 
/**
 * Plugin desarrollado para CakePHP 2.X
 * Este plugin nos permite utilizar la librería de TinyPNG
 * y optimizar las imágenes.
 * 
 * Para más información ir a : https://tinypng.com/developers/reference
 * @author Cristian Rojas Pérez <crojasnoventa@gmail.com> 2017
 *
 */

class TinyController extends TinyPngAppController {

	
	public function index()
	{
		exit;
	}

	/**
	 * TEST
	 */
	public function test()
	{
		if ($this->request->is('post')) {
		
			echo 'Arreglo original del archivo:' . '\n';
			print_r($this->request->data['Test']);
			echo '\n';

			$this->request->data['Test'] = $this->comprimir_imagen($this->request->data['Test']);

			echo 'Arreglo comprimido del archivo:' . '\n';
			print_r($this->request->data['Test']);
			exit;

		}
	}

}