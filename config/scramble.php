<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    /*
     * Your API path. By default, all routes starting with this path will be added to the docs.
     * If you need to change this behavior, you can add your custom routes resolver using `Scramble::routes()`.
     */
    'api_path' => 'api',

    /*
     * Your API domain. By default, app domain is used. This is also a part of the default API routes
     * matcher, so when implementing your own, make sure you use this config if needed.
     */
    'api_domain' => null,

    'info' => [
        /*
         * API version.
         */
        'version' => env('API_VERSION', '0.0.1'),

        /*
         * Description rendered on the home page of the API documentation (`/docs/api`).
         */
        'description' => <<<EOD
        <h1>Overview</h1>
        Esta es la documentación de la <strong>REST API</strong> para nuestro sistema.\n
        
        Aquí encontrarás información detallada sobre todos los endpoints disponibles, incluyendo los métodos HTTP que 
        aceptan, los parámetros que requieren, y los formatos de respuesta que devuelven.\n
        
        Todos los endpoints enumerados aquí están registrados en <strong>routes/api.php</strong>, lo que te brinda una 
        visión estructurada de la funcionalidad que nuestra API tiene para ofrecer.
        
        Es importante destacar que la mayoría de los endpoints incluidos en esta documentación están diseñados para 
        respaldar funciones específicas del sistema, como la generación de informes, la importación de datos, entre 
        otros. No encontrarás endpoints relacionados con las operaciones CRUD de los recursos principales del sistema, 
        como instructores, estudiantes, grupos, etc.\n
        
        Esta documentación ha sido generada de manera automática mediante el uso de la librería <a href="https://scramble.dedoc.co" target="_blank">Scramble</a>.
        EOD,
    ],

    /*
     * Customize Stoplight Elements UI
     */
    'ui' => [
        /*
         * Hide the `Try It` feature. Enabled by default.
         */
        'hide_try_it' => false,

        /*
         * URL to an image that displays as a small square logo next to the title, above the table of contents.
         */
        'logo' => '',

        /*
         * Use to fetch the credential policy for the Try It feature. Options are: omit, include (default), and same-origin
         */
        'try_it_credentials_policy' => 'include',
    ],

    /*
     * The list of servers of the API. By default, when `null`, server URL will be created from
     * `scramble.api_path` and `scramble.api_domain` config variables. When providing an array, you
     * will need to specify the local server URL manually (if needed).
     *
     * Example of non-default config (final URLs are generated using Laravel `url` helper):
     *
     * ```php
     * 'servers' => [
     *     'Live' => 'api',
     *     'Prod' => 'https://scramble.dedoc.co/api',
     * ],
     * ```
     */
    'servers' => null,

    'middleware' => [
        'web',
        RestrictedDocsAccess::class,
    ],

    'extensions' => [],
];
