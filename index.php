<?php
ob_start(); //Controlando o cache da aplicação

require __DIR__."/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * WEB ROUTES
 */

//auth
$route->group(null);
$route->get("/", "Web:login");
$route->post("/", "Web:login");
$route->get("/recuperar", "Web:forget");

/**
 * ERROR ROUTES
 */
$route->namespace("Source\App")->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 * Faz o controlo caso o $route->dispatch(); não consiga entregar uma rota par o usuário
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();