<?php

// Налаштування інтерпретатора для нашого проекту
ini_set('display_errors', true);                // вмикаємо відображення помилок
ini_set('display_startup_errors', true);        // вмикаємо відобр. помилок які зявл. на старті
ini_set('log_errors', true);                    // вмикаємо логування помилок у файл
ini_set('error_log', __DIR__.'/storage/logs/errors.log'); // в який файл будемо логувати

// Вмикаємо відображення усіх помилок, warnings and notices
error_reporting(E_ALL);                    

// Налаштування сесій
session_save_path(__DIR__.'/storage/sessions/');
session_start();

// Константи нашого application
define('BASE_URL', 'http://localhost:8181/');               // базовий url для включення JS/CSS
define('APP_CONTROLLERS_PATH', __DIR__.'/controllers/');    // файловий шлях до контроллерів
define('APP_VIEWS_PATH', __DIR__.'/views/');                // файловий шлях до шаблонів

define('WORDS_FILE_PATH', __DIR__.'/storage/json/words.json'); // шлях до json-файла із словами 

// spl_autoload_register() - реєструє задану анонімну функцію
// як автоматичний "загрузчик" файлів із класами
// в нашому випадку ця анонімна ф-ція буде шукати і require-рити клас-кнотроллер
spl_autoload_register(function ($controllerClassName) {
    // будуємо ФАЙЛОВИЙ шлях до класа-контроллера, який потрібно завантажити
    $controllerFilePath = APP_CONTROLLERS_PATH."{$controllerClassName}.php";
    if (is_readable($controllerFilePath)) {
        // include_once А НЕ require_once
        // include_once - не зупинить програму якщо такий файл не знайдено
        // require_once - зупинить
        // і таких "автозагрузчиків" може і буде багато, тому вони повинні
        // виконувати послідовно і не зупиняти програму якщо файл знайти не вдалося
        include_once $controllerFilePath;
    } 
});

require_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/routes.php';
