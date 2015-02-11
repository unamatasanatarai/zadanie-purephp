<?php
namespace Session;

/**
 * Session management
 */

use Util\DotSet;

class Session{

	public static function start($name='DEFSESSKEY', $lifetime = 0)
	{
		if (self::started())
		{
			return;
		}
		session_set_cookie_params($lifetime);
		session_name($name);
		session_start();
		register_shutdown_function('session_write_close');
	}

	public static function started()
	{
		return isset($_SESSION) && session_id();
	}


	public static function remove($key)
	{
		if ( ! self::started())
		{
			return false;
		}

		$_SESSION = DotSet::remove($_SESSION, $key);

		return true;
	}

	public static function insert($key, $val = null)
	{
		if ( ! self::started())
		{
			return false;
		}

		$_SESSION = DotSet::insert($_SESSION, $key, $val);

		return true;
	}

	public static function get($key = null)
	{
		if ( ! self::started())
		{
			return false;
		}
		return DotSet::get($_SESSION, $key);
	}
}