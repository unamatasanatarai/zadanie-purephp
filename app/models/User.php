<?php
namespace models;

use Util\Arr;

class User extends BaseModel{

	public $table = 'users';

	static public function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$instance[0] = new User();
		}
		return $instance[0];
	}

	public function paginate($offset, $limit){
		$users          = parent::paginate($offset, $limit);

		$Permission     = Permission::getInstance();
		$UserPermission = UserPermission::getInstance();

		$permissions = $Permission->getAll();
		$permissions = Arr::reindex($permissions, 'id', 'name');
		if (empty($users)){
			$users = array();
		}

		foreach($users as &$user){
			$user_permissions = $UserPermission->getByUserId($user['id']);
			$user['permissions'] = array();
			if (empty($user_permissions)){
				continue;
			}
			foreach($user_permissions as $permission_id){
				$user['permissions'][] = $permissions[$permission_id];
			}
		}

		return $users;
	}

	public function getById($id, $column = 'id'){
		$user = parent::getById($id, $column);
		if (empty($user)){
			return false;
		}
		$user['permissions'] = array();

		$permissions = Permission::getInstance()->getAll();
		$permissions = Arr::reindex($permissions, 'id', 'name');
		$user_permissions = UserPermission::getInstance()->getByUserId($user['id']);

		if (is_array($user_permissions)){
			foreach($user_permissions as $permission_id){
				$user['permissions'][$permission_id] = $permissions[$permission_id];
			}
		}
		return $user;
	}

	public function delete($id, $col = 'id'){
		$r = parent::delete($id, $col);
		UserPermission::getInstance()->delete($id, 'user_id');
		return $r;
	}

}