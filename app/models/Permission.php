<?php
namespace models;

class Permission extends BaseModel{

	public $table = 'permissions';

	static public function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$instance[0] = new Permission();
		}
		return $instance[0];
	}

}