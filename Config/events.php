<?php
App::uses('CakeEventManager', 'Event');
App::uses('UsuarioListener', 'Lib/Event');
App::uses('TareaListener', 'Lib/Event');
App::uses('ComentarioListener', 'Lib/Event');
//App::uses('RecuperarClaveListener', 'Lib/Event');

CakeEventManager::instance()->attach(new UsuarioListener());
CakeEventManager::instance()->attach(new TareaListener());
CakeEventManager::instance()->attach(new ComentarioListener());
//CakeEventManager::instance()->attach(new RecuperarClaveListener());