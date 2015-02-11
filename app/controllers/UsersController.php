<?php
namespace controllers;

use View\Template;
use Session\Notification;
use models\User;
use models\Permission;
use models\UserPermission;
use Network\Request;
use Network\QueryRouter;
use Network\Response;
use Util\Arr;
use Util\Validator;

class UsersController extends BaseController{

	public function index(){
		$User = User::getInstance();

		$per_page    = 40;
		$page        = (int)Request::get('page');
		$users_count = $User->getCount();
		$offset      = $page * $per_page;
		$users       = $User->paginate($offset, $per_page);

		$tpl = new Template();
		$tpl->paginate = array(
			'total'   => ceil($users_count/$per_page),
			'current' => $page
		);
		$tpl->users = $users;

		$this->tpl->title = 'Users / ' . $this->tpl->title;
		$this->tpl->content = $tpl->render('users/index');
	}

	/**
	 * One action takes care of showing the form and saving the data
	 */
	public function add(){
		$tpl = new Template();
		$this->tpl->title = 'Add User / ' . $this->tpl->title;
		$data = Request::post('data');

		if (!empty($data)){

			$Validator = new Validator(
				array(
					'firstname' => array(
						'rule' => Validator::NOTEMPTY,
						'msg'  => 'Firstname is required'
					),
					'lastname' => array(
						'rule' => Validator::NOTEMPTY,
						'msg'  => 'Lastname is required'
					),
					'email' => array(
						'rule' => Validator::EMAIL,
						'msg'  => 'Valid email required'
					),
					'password' => array(
						'rule' => Validator::NOTEMPTY,
						'msg'  => 'Password required'
					),
				)
			);

			if (!$Validator->validate($data['User'])){
				Notification::add('There were some errors.', 'danger');
				$tpl->errors = $Validator->results;
			}else{
				$User = User::getInstance();
				$exists = $User->getById($data['User']['email'], 'email');

				if ($exists){
					Notification::add('The E-Mail address is in our database', 'danger');
				}else{
					$user_id = $User->create($data['User'], array('firstname', 'lastname', 'email', 'password'));
					UserPermission::getInstance()->syncUserIdPermissions($user_id, array_get($data, 'Permission', array()));
					Notification::add('User has been created', 'success');
					Request::redirect(QueryRouter::url('index'));
				}
			}
		}

		$permissions = Permission::getInstance()->getAll();

		$tpl->permissions   = $permissions;
		$tpl->old_data      = $data;
		$this->tpl->content = $tpl->render('users/add');
	}

	public function edit(){
		$tpl = new Template();
		$this->tpl->title = 'Edit User / ' . $this->tpl->title;
		$User = User::getInstance();
		$user = $User->getById(Request::get('id'));

		// realign data with "post"
		$data = array(
			'User'       => $user,
			'Permission' => $user['permissions']
		);

		if (empty($data)){
			Notification::add('User not found.', 'danger');
			Request::redirect(QueryRouter::url('index'));
		}

		if (Request::post('data')){

			$new_data = Request::post('data');
			$Validator = new Validator(
				array(
					'firstname' => array(
						'rule' => Validator::NOTEMPTY,
						'msg'  => 'Firstname is required'
					),
					'lastname' => array(
						'rule' => Validator::NOTEMPTY,
						'msg'  => 'Lastname is required'
					),
					'email' => array(
						'rule' => Validator::EMAIL,
						'msg'  => 'Valid email required'
					),
				)
			);

			if (!$Validator->validate($new_data['User'])){
				Notification::add('There were some errors.', 'danger');
				$tpl->errors = $Validator->results;
			}else{
				if ($data['User']['email'] != $new_data['User']['email']){
					$exists = $User->getCountWhere('email', $new_data['User']['email']);
				}else{
					$exists = false;
				}

				if (empty($new_data['User']['password'])){
					$new_data['User']['password'] = $data['User']['password'];
				}

				if ($exists){
					Notification::add('The E-Mail address is in our database', 'danger');
				}else{
					$User->update($new_data['User'], $data['User']['id'], 'id', array('firstname', 'lastname', 'email', 'password'));
					UserPermission::getInstance()->syncUserIdPermissions($data['User']['id'], array_get($new_data, 'Permission', array()));
					Notification::add('User has been updated', 'success');
					Request::refresh();
				}
			}
			$data = $new_data;
		}

		$permissions = Permission::getInstance()->getAll();

		$tpl->permissions   = $permissions;
		$tpl->old_data      = $data;
		$this->tpl->content = $tpl->render('users/edit');
	}

	public function delete(){
		Response::type('json');

		if (!Request::is('ajax')){
			echo json_encode(array('result' => 0, 'message' => 'Error'));
			die;
		}
		$id = Request::get('id');
		if (empty($id)){
			echo json_encode(array('result' => 0, 'message' => 'User not found.'));
			die;
		}

		$User = User::getInstance();
		$user = $User->getById($id);

		if (empty($user)){
			echo json_encode(array('result' => 0, 'message' => 'User not found.'));
			die;
		}

		$User->delete($user['id']);

		echo json_encode(array('result' => 1, 'message' => 'Deleted!'));
		die;
	}

}