<?php
define('SESSION_NAME', 'zadanie');
define('VIEW', APP . 'views' . DS);

use Configure\Configure;

// Database uses DALMP tool
Configure::write(
	'_db',
	array(
		'user' => 'root',
		'pass' => '',
		'port' => '3307',
		'host' => 'localhost',
		'db'   => 'zadanie',
		'debug'=> Configure::read('debug'),
	)
);
