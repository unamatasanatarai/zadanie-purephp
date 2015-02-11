<?php
namespace controllers;

use View\Template;
use models\User;
use models\Permission;

class HomeController extends BaseController{

	function index(){
		$tpl = new Template();
		$tpl->user_count = User::getInstance()->getCount();
		$tpl->perm_count = Permission::getInstance()->getCount();
		$this->tpl->title = 'Home / ' . $this->tpl->title;
		$this->tpl->content = $tpl->render('home/index');
	}
}