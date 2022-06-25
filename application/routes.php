<?php 

$action = 'start';
if(isset($_GET['action'])) {
    $action = $_GET['action'];
}

// дістаємо масив маршрутів (роутів) з основного конфігураційного файла
$routes = $config['routes'];

if (array_key_exists($action, $routes)) {
    // в змінні $controllerClassName та $method записуємо назву класа-контроллера та його метода
    // в якому знаходитсья бізнес-логіка (або код-обробник) http request-а від користувача
    list($controllerClassName, $method) = explode('@', $routes[$action]);    
    
    // ЗВЕРНІТЬ УВАГУ, ЩО КОД ВКЛЮЧЕННЯ КЛАССУ-КОНТРОЛЛЕРА ЗНИК
    // він переїхав в bootstrap.php у виклик: spl_autoload_register()
    $controller = new $controllerClassName();    
    $controller->$method(); 
} else {
    die('Unrecognized http-request!');
}
