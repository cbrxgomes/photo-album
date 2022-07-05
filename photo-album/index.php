<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Controllers
$router->namespace("Source\Controllers");

//FormController
$router->group(null);
$router->get("/", "BookController:search");
$router->get("/book/{bookId}", "BookController:get");
$router->get("/book/create", "BookController:create");
$router->post("/book/create", "BookController:createSave");
$router->get("/book/edit", "BookController:edit");
$router->post("/book/edit", "BookController:editSave");

/*
$router->group("ops");
$router->get("/ops/{errcode}", "HomeController:error");
*/

$router->dispatch();

/*
if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
*/