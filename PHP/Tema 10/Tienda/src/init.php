<?php

session_start();

// Usar la clase con las rutas
use Routes\Routes;

require_once '../vendor/autoload.php';
require_once '../config/config.php';

// Para los datos ocultos en el .env
$dotenv =Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->safeLoad();

//Llamar al metodo
Routes::index();