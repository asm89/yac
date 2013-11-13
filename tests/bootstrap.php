<?php

if (file_exists($file = __DIR__.'/../vendor/autoload.php')) {
    $loader = require $file;
    $loader->add('Yac\\', __DIR__);
    $loader->add('YacPerformance\\', __DIR__);
} else {
    throw new RuntimeException('Install dependencies to run test suite.');
}
