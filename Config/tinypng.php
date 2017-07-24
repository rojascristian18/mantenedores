<?php

use Cake\Core\Configure;
use Cake\Core\Bootstrap;
use Cake\Routing\Router;

$config = array(
	'TinyPNG' => array(
		'api_key' => configuracion('tiny_api_key')
		) 
);

return $config;
