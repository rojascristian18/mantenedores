<?php
App::uses('Component', 'Controller');

# Archivos de TinyPNG
require_once( APP ."Plugin/TinyPng/Vendor/lib/Tinify/Exception.php");
require_once( APP ."Plugin/TinyPng/Vendor/lib/Tinify/ResultMeta.php");
require_once( APP ."Plugin/TinyPng/Vendor/lib/Tinify/Result.php");
require_once( APP ."Plugin/TinyPng/Vendor/lib/Tinify/Source.php");
require_once( APP ."Plugin/TinyPng/Vendor/lib/Tinify/Client.php");
require_once( APP ."Plugin/TinyPng/Vendor/lib/Tinify.php");

class TinyComponent extends Component
{	
	
	/**
	 * Tipos de archivo soportados por TinyPNG
	 */
	public $soportados = array(
		'image/jpeg', 'image/png'
	);
	
	public function initialize(Controller $controller)
	{	
		$this->Controller = $controller;

		try
		{
			Configure::load('tinypng');
		}
		catch ( Exception $e )
		{
			throw new Exception('No se encontró el archivo Config/tinypng.php');
		}
	}

	/**
	 * Método que hace la conexión con TinyPNG mediante el parámetro API KEY
	 * LA API KEI se obtiene desde: https://tinypng.com/developers/
	 * @return TRUE: La apikey es válida y se logra autenticar, FALSE No se logra contactar
	 */
	public function conexion() 
	{
		try {
		    \Tinify\setKey(Configure::read('TinyPNG.api_key'));
		    \Tinify\validate();
		} catch(\Tinify\Exception $e) {
		    return false;
		}

		return true;
	}

	/**
	 * Método utilizado para realizar la compración de la o las imágenes
	 * @param 	$imagenes 	Array 	Arreglo del cual queremos optmizar sus imágenes. 
	 * 								Si tiene dudas, vea el método test de esta misma clase.
	 * @return 	$imagenes 	Array 	si se cumplieron las condiciones se devuelve un arreglo
	 * 								con las imágenes comprimidas, de los contrario se devuelve el mismo el arreglo de entrada.
	 */
	public function comprimir_imagen($imagenes =  array())
	{
		if ( !empty($imagenes) && $this->conexion() ) {

			foreach ($imagenes as $indice => $campos) {
				foreach ($campos as $campo => $valor) {
					# Es un archivo de formato válido
					if ( isset($imagenes[$indice][$campo]['type']) && 
						 in_array($imagenes[$indice][$campo]['type'], $this->soportados) && 
						 $imagenes[$indice][$campo]['error'] == 0 ) {
						
						# Obtenemos el dato del arcivho temporal de la imagen subida
						$sourceData = file_get_contents($imagenes[$indice][$campo]['tmp_name']);

						# Optimizamos la imagen
						try {
							$resultData = \Tinify\fromBuffer($sourceData)->toBuffer();
						} catch (Exception $e) {
							$resultData = '';
						}

						if ( !empty($resultData) ) {
							$imagenes[$indice][$campo]['tmp_name'] = $this->crear_temporal($resultData);
							$imagenes[$indice][$campo]['size'] = filesize($imagenes[$indice][$campo]['tmp_name']);
						}
					}	
				}
			}
		}
		
		return $imagenes;
	}

	/**
	 * Método que crea un archivo temporal con la imagen optmizada.
	 * @param $resultData 	String 		Imagen comprimida obtenida desde TinyPNG
	 * @return $tmpfname 	String 	 	ruta del nuevo archivo temporal
	 */
	public function crear_temporal($resultData = '')
	{
		if (!empty($resultData)) {

			$tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();

			# Creamos el archivo temporal
			$tmpfname = tempnam($tmp_dir, "TIN");
			$handle = fopen($tmpfname, "w");
			
			# Insertamos la data de la imagen dentro
			fwrite($handle, $resultData);

			# Se cierra el archivo temporal
			fclose($handle);

			return $tmpfname;
		}
		
	}


	/**
	 * Método que devuelve la cantidad de compresiones que hemos hecho durante este mes
	 * # REF: https://tinypng.com/developers/reference#compression-count
	 */
	public function compresiones() {
		$this->conexion();
		return \Tinify\compressionCount();
	}


}