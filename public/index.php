<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../routes.php';

// Default route → Welcome Page
if (!isset($_GET['p'])) {
    $_GET['p'] = 'home/index';
}

$route = explode('/', $_GET['p']);
$controllerName = ucfirst($route[0]) . 'Controller';
$action = isset($route[1]) ? $route[1] : 'index';

$controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        die("Action not found");
    }
} else {
    die("Controller not found");
}
