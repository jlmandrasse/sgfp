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
$route->post("/entrar", "Web:login");
$route->get("/recuperar", "Web:forget");
$route->post("/recuperar", "Web:forget");
$route->get("/recuperar/{code}", "Web:reset");
$route->post("/recuperar/resetar", "Web:reset");

//services
$route->group(null);
$route->get("/termos", "Web:terms");

/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/admin");

//dash
$route->get("/", "Dash:dash");
$route->get("/dash/home", "Dash:home");
$route->get("/logoff", "Dash:logoff");

//category
$route->post("/create-category", "Category:create");
$route->post("/read-category", "Category:read");
$route->post("/update-category", "Category:update");
$route->post("/delete-category", "Category:delete");

//launch
$route->post("/create-launch", "Launch:create");
$route->post("/read-launch", "Launch:read");
$route->post("/update-launch", "Launch:update");
$route->post("/delete-movement", "Launch:delete");
$route->post("/searchByYear", "Launch:search");

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
 * Faz o controlo caso o $route->dispatch(); não consiga entregar uma rota solicitada
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();