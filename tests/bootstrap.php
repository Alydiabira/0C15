<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/config/bootstrap.php')) {
    require dirname(__DIR__) . '/config/bootstrap.php';
} else {
    // Charge .env.test si présent, sinon fallback sur .env
    if (file_exists(dirname(__DIR__) . '/.env.test')) {
        (new Dotenv())->usePutenv()->loadEnv(dirname(__DIR__) . '/.env.test');
    } else {
        (new Dotenv())->usePutenv()->loadEnv(dirname(__DIR__) . '/.env');
    }
}
