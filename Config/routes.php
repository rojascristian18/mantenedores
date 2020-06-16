<?php

Router::connect('/', array('controller' => 'pages', 'action' => 'inicio'));

# Administración
Router::connect('/admin', array('controller' => 'tareas', 'action' => 'index', 'admin' => true));
Router::connect('/admin/login', array('controller' => 'administradores', 'action' => 'login', 'admin' => true));
Router::connect('/admin/mantenedores', array('controller' => 'usuarios', 'action' => 'index', 'admin' => true));
Router::connect('/admin/mantenedores/crear', array('controller' => 'usuarios', 'action' => 'add', 'admin' => true));
Router::connect('/admin/mantenedores/modificar', array('controller' => 'usuarios', 'action' => 'edit', 'admin' => true));

# Mantenedores
Router::redirect('/maintainers', array('controller' => 'tareas', 'action' => 'index', 'maintainers' => true));
Router::connect('/maintainers/login', array('controller' => 'usuarios', 'action' => 'login', 'maintainers' => true));
Router::connect('/maintainers/mi-perfil', array('controller' => 'usuarios', 'action' => 'profile', 'maintainers' => true));
Router::connect('/maintainers/mis-tareas', array('controller' => 'tareas', 'action' => 'index', 'maintainers' => true));

Router::connect('/seccion/*', array('controller' => 'pages', 'action' => 'display'));

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
