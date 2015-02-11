<?php

ob_start();
use Configure\Configure;
use Session\Session;
use Network\Response;
use Network\Request;
use Network\QueryRouter;
use Debug\Log;

Log::start();

require APP . 'config.php';
Session::start(SESSION_NAME, 31556926);
$match = QueryRouter::match();

try{
	if (empty($match)){
		throw new \Exception('Route does not exist. 404.');
	}

	$ctrl = 'controllers' . $match['c'];

	if (!class_exists($ctrl)){
		throw new \Exception('Route does not exist.. 404.');
	}

	new $ctrl(
		$match['a'],
		$match['vars']
	);
}
catch(Exception $e)
{
	Response::code('404');
	Log::debug($e->getMessage());
}

ob_end_flush();