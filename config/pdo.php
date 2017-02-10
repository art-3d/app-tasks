<?php

return [
	'dsn' => 'mysql:host=localhost;dbname=app_task',
	'user' => 'root',
	'password' => 'root',
	'opt' => [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	],
];
