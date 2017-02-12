<?php

return [
    'home' => [
        'pattern' => '/',
        'controller' => 'Src\Controller\MainController',
        'action'     => 'indexAction',
        'requirements' => [
            '_method' => 'GET'
        ]
    ],
    'show_tasks' => [
        'pattern' => '/tasks',
        'controller' => 'Src\Controller\TaskController',
        'action' => 'getAction'
    ],
    'show_task' => [
        'pattern' => '/tasks/{id}', 
        'controller' => 'Src\Controller\TaskController',
        'action' => 'getOneAction',
        'requirements' => [
            'id' => '\d+'
        ]
    ],
    'add_task' => [
        'pattern' => '/tasks',
        'controller' => 'Src\Controller\TaskController',
        'action' => 'postAction',
        'requirements' => [
            '_method' => 'POST'
        ]
    ],
    'update_task' => [
        'pattern' => '/tasks/{id}',
        'controller' => 'Src\Controller\TaskController',
        'action' => 'putAction',
        'requirements' => [
            '_method' => 'PUT',
            'id' => '\d+'
        ]
    ],
    '404' => [
        'pattern' => '/error',
        'controller' => 'Src\Controller\MainController',
        'action' => 'errorAction',
    ]
];
