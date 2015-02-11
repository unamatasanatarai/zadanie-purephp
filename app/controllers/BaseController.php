<?php
namespace controllers;

use View\Template;

/**
 * Common actions for controllers
 * - loading layout template system
 * - before each action is called, `beforeFilter()` gets called. Used in ApiController
 */
class BaseController
{
	public $action  = 'index';
	public $params  = array();
	public $layout  = 'default';
	public $tpl;

	public function beforeFilter(){
		$this->tpl->title = 'Zadanie';
	}


	public function __construct($action, $params = array())
	{
		$this->action = $action;
		$this->params = $params;
		$this->tpl = new Template();

		$this->beforeFilter();

		$content = $this->__call(
			$this->action,
			$this->params
		);

		$view = $this->tpl->render(
			'layouts' . DS . $this->layout
		);

		// faster loads
		if ( extension_loaded( 'zlib' ) ) { ob_start( 'ob_gzhandler' ); }
		echo $view;
        if ( extension_loaded( 'zlib' ) ) { ob_end_flush(); }
	}

	public function __call($method, $params)
	{
		if (!method_exists($this, $method)){
			throw new \Exception('Action does not exist. 404..');
			return;
		}
		return $this->{$method}();
	}

}


