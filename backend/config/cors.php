<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => true,
    'allowedOrigins' => ['*', 'localhost:3000', 'http://localhost:3000/*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['Origin', 'Content-type', 'X-Auth-Token', 'Authorization', 'X-Requested-With', 'X-CSRF-TOKEN', 'X-AUTH', 'Access-Control-Allow-Origin'],
    'allowedMethods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    'exposedHeaders' => [],
    'maxAge' => 86400,

];
