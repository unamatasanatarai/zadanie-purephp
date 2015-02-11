<?php
namespace DB;

/**
 * DB
 */

use Configure\Configure;

class DB extends \DALMP\Database{

	static public function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$db = Configure::read('_db');
			$sql = new \DB\DB('utf8://'.$db['user'].':'.$db['pass'].'@'.$db['host'].':'.$db['port'].'/'.$db['db']);
			$sql->FetchMode('ASSOC');
			$instance[0] =& $sql;
		}
		return $instance[0];
	}
}