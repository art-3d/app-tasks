<?php

return [
    'defaultController' => 'Main',
    'defaultAction' => 'index',
    'layout' => 'index.php',
    'pdo' => include_once('pdo.php'),
    'routes' => include_once('routing.php')
];
