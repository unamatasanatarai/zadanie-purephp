<?php
namespace controllers;

use models\User;
use Network\Response;
use Network\Request;
use Network\QueryRouter;
use Debug\Log;

class ApiController extends BaseController{

	public function beforeFilter(){

		if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])){
			Log::error('Empty credentials');
			Response::code(401);
			die;
		}

		if ($_SERVER['PHP_AUTH_USER'] != 'Marek' || $_SERVER['PHP_AUTH_PW'] != 'authpass'){
			Log::error('Bad credentials');
			Response::code(401);
			die;
		}

		Response::type('json');
		parent::beforeFilter();
	}

	public function index(){
		$User = User::getInstance();

		$users = $User->paginate(0, 999999);

		foreach($users as &$user){
			unset($user['password']);
			$user['links'] = array(
				array(
					'href' => QueryRouter::url(array('a' => 'user', 'id' => $user['id'])),
					'rel' => 'self'
				),
				array(
					'href' => QueryRouter::url(array('a' => 'index')),
					'rel' => 'index'
				)
			);
		}

		echo json_encode($users);
		die;
	}

	public function user(){
		$User = User::getInstance();
		$user = $User->getById(Request::get('id'));
		if (empty($user)){
			Log::debug('User not found');
			Response::code(404);
			die;
		}

		unset($user['password']);
		$user['links'] = array(
			array(
				'href' => QueryRouter::url(array('a' => 'user', 'id' => $user['id'])),
				'rel' => 'self'
			),
			array(
				'href' => QueryRouter::url(array('a' => 'index')),
				'rel' => 'index'
			)
		);
		echo json_encode($user);
		die;
	}
}