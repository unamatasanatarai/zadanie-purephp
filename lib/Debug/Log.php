<?php
namespace Debug;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log{
	private static $log;

	static public function start() {
		self::$log = new Logger('debug');
		self::$log->pushHandler(new StreamHandler(APP . 'logs' . DS . 'debug.log', Logger::DEBUG));
	}

	public static function debug($msg, $info = array()){
		$info['_server'] = $_SERVER;
		self::$log->addInfo($msg, $info);
	}

	public static function error($msg, $info = array()){
		$info['_server'] = $_SERVER;
		self::$log->addError($msg, $info);
	}


}
