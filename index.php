<?php
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();
$router-> setBasePath ( ' / ' );
// Define routes
$router->match('GET', 'test', function() {
	require "pages/test.php";
});
$router->match('GET', '/', function() {
	require "pages/mainwindow.php";
});

$router->set404(function () { 
require "pages/404.php";
});

// Run it!
$router->run();