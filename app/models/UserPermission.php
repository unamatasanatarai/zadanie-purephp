<?php
namespace models;

class UserPermission extends BaseModel{

	public $table = 'user_permissions';

	static public function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$instance[0] = new UserPermission();
		}
		return $instance[0];
	}

	public function getByUserId($user_id){
		return $this->db->PGetCol('SELECT permission_id FROM ' . $this->table . ' WHERE user_id = ?', $user_id);
	}

	public function syncUserIdPermissions($user_id, $permissions = array()){
		$this->delete($user_id, 'user_id');
		foreach($permissions as $permission){
			$this->create(array('user_id' => $user_id, 'permission_id' => $permission));
		}
	}

}