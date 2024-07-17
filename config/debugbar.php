<?php

return [
    'enabled' => env('DEBUGBAR_ENABLED', false),
    'except' => [
        'telescope*'
    ],
    'storage' => [
        'enabled' => true,
        'driver' => 'file', // opciones: file, redis, pdo, custom
        'path' => storage_path('debugbar'), // Para el driver 'file'
        'connection' => null,   // Para el driver 'pdo'
        'provider' => '' // Instancia de proveedor de almacenamiento personalizada
    ],
    'capture_ajax' => true,
    'clockwork' => false,
    'collectors' => [
        'phpinfo' => true,
        'messages' => true,
        'time' => true,
        'memory' => true,
        'exceptions' => true,
        'log' => true,
        'db' => true,
        'views' => true,
        'route' => true,
        'auth' => false,
        'gate' => false,
        'session' => true,
        'symfony_request' => true,
        'mail' => true,
        'laravel' => true,
        'events' => true,
        'default_request' => true,
        'logs' => true,
        'files' => false,
        'config' => true,
        'cache' => true,
        'models' => true,
        'livewire' => true,
    ],
    'options' => [
        'auth' => [
            'show_name' => false,   // Muestra el nombre del usuario autenticado
        ],
        'db' => [
            'with_params' => true,   // Incluye los parámetros de la consulta SQL
            'backtrace' => true,   // Muestra la pila de llamadas que condujo a la consulta
            'timeline' => true,  // Añade las consultas a la línea de tiempo
            'explain' => [      // `explain` se muestra para las consultas lentas
                'enabled' => true,
                'types' => ['SELECT'],
            ],
            'hints' => true,    // Agrega sugerencias al código SQL para optimización
        ],
        'mail' => [
            'full_log' => false
        ],
        'views' => [
            'data' => true,    // Muestra los datos pasados a las vistas
        ],
        'route' => [
            'label' => true,  // Muestra la etiqueta de la ruta
            'details' => true // Muestra los detalles de la ruta
        ],
        'log' => [
            'file' => null
        ],
    ],
];
