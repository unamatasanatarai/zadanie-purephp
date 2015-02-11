<?php
namespace Configure;

/**
 * "Array" holding configuration values
 */

use Util\DotSet;

class Configure
{
	static $c = array();

	public static function write($name, $value)
	{
		self::$c = DotSet::insert(self::$c, $name, $value);
	}

	public static function read($name = null)
	{
		return DotSet::get(self::$c, $name);
	}

	public static function delete($name)
	{
		return DotSet::remove(self::$c, $name);
	}
}