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
        'start' => 'AppController@start',
        'init' => 'AppController@init',
        'learning' => 'AppController@learning',
        'answering' => 'AppController@answering',
        'score' => 'AppController@score',
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
