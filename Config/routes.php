<?php
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

# Administración
Router::connect('/admin', array('controller' => 'tareas', 'action' => 'index', 'admin' => true));
Router::connect('/admin/login', array('controller' => 'administradores', 'action' => 'login', 'admin' => true));

# Mantenedores
Router::connect('/maintainers', array('controller' => 'tareas', 'action' => 'index', 'maintainers' => true));
Router::connect('/maintainers/login', array('controller' => 'usuarios', 'action' => 'login', 'maintainers' => true));

Router::connect('/seccion/*', array('controller' => 'pages', 'action' => 'display'));

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
