<?php

require 'vendor/autoload.php';
require 'function.php';
require_once 'model/Model.php';
require_once 'model/User.php';
require_once 'app/Router.php';

// require_once 'model/Product.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $user = new User();
// var_dump($user);

$newUser = new User();
$users = $newUser->all();

foreach ($users as $user) {
    var_dump($user);
}


// Create a new instance of the Router
$router = new Router();

// // Define some example routes
// $router->get('/', function () {
//     echo "Welcome to the homepage!";
// });

// $router->get('/about', function () {
//     echo "This is the about page.";
// });

$router->get('/products', 'ProductController@show');  // Route to a specific controller and action
$router->post('/contact', 'ContactController@submit');  // Another controller action for POST requests

// Dispatch the current request
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$router->dispatch($requestUri, $requestMethod);



// $routes = [
//     '/' => 'views/pages/index.view.php',
//     '/pricing' => 'views/pages/pricing.view.php',
//     '/products' => 'controllers/product/show.product.php',
//     '/about' => 'views/pages/about.view.php',
//     '/contact' => 'views/pages/contact.view.php',
//     '404' => 'views/pages/404.view.php',
// ];

// // dd($_SERVER['REQUEST_URI']);
// if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
//     require $routes[$_SERVER['REQUEST_URI']];
// } else {
//     require 'views/pages/404.view.php';
// }
