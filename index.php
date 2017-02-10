<?php

require_once(__DIR__ . '/../app/Loader.php');

$config = require_once(__DIR__ . '/../config/config.php');

$app = new \App\Application($config);

$app->run();
