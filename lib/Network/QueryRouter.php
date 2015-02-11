<?php
namespace Network;
use \Network\Request;
/**
 * GET based routing
 */
class QueryRouter
{
	public static $default = array(
		'c' => 'Home',
		'a' => 'index'
	);

	public static $request = array();

	/**
	 * Router takes GET params: c = Controller, a = action, `any` => params
	 */
	public static function match()
	{
		$get = Request::get();

		$route = array();
		$route['_c'] = array_get($get, 'c', self::$default['c']);
		$route['c']  = '\\' . $route['_c'] . 'Controller';
		$route['a']  = array_get($get, 'a', self::$default['a']);
		unset($get['c']);
		unset($get['a']);

		$route['vars'] = $get;
		self::$request = $route;
		self::$request['c'] = $route['_c'];
		unset(self::$request['_c']);
		return $route;
	}

	/* Build URL from Array */
	public static function url($vars = null, $html_safe = false, $include_vars = false){
		if (is_null($vars)){
			$vars = array();
		}elseif(is_string($vars)){
			$vars = array('a' => $vars);
		}

		if ($include_vars){
			$vars = array_merge(self::$request, array_get(self::$request, 'vars', array()), $vars);
		}else{
			$vars = array_merge(self::$request, $vars);
		}

		unset($vars['vars']);

		foreach($vars as $k => $v){
			$url[] = $k . '=' . $v;
		}

		return URL . '?' . (($html_safe)?h(join('&', $url)):join('&', $url));
	}
}