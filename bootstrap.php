<?php

require __DIR__.'/vendor/autoload.php';

// Force DATABASE_URL for test environment
if (($_SERVER['APP_ENV'] ?? '') === 'test') {
    $_SERVER['DATABASE_URL'] = $_ENV['DATABASE_URL'] = 'mysql://root:@127.0.0.1:3306/ina_test?charset=utf8mb4';
}
