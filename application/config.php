<?php 

// Основний конфігураційний масив нашого web-application
$config = [

    /**
     * Маршрутизація в середині програми:
     * 
     * Синтаксис: request => Controller@method
     * Приклад: 'home' => 'HomeController@index'
     */
    'routes' => [
        'home' => 'HomeController@index',
    ],

    /**
     * Info about the application.
     */
    'app' => [
        'name' => 'Flash Cards Applications',
        'author' => 'ozadorozhnyi@yahoo.com',
        'year' => 2022,
    ],
];
