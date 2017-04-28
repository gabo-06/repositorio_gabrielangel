<?php

require 'vendor/autoload.php';
include 'funciones.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function() use($app) {	 
	$empleados = obtenerEmpleados(); // Obtiene el arreglo de empleados.
	$app->render('index.php', compact('empleados'));
});

$app->run();

?>

