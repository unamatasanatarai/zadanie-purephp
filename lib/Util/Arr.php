<?php
namespace Util;

class Arr
{

	/**
	 * Sets new keys for array values (for example ID column from DB)
	 */
	public static function reindex($data, $new_key, $new_val = null)
	{
		if (!empty($new_val)){
			return self::reindexFlat($data, $new_key, $new_val);
		}
		$r = array();

		foreach($data as $k => $v)
		{
			$r[$v[$new_key]] = $v;
		}

		return $r;
	}

	/**
	 * Creates new key=>val relationship (flat array)
	 */
	public static function reindexFlat($data, $new_key, $new_val)
	{
		$r = array();

		foreach($data as $k => $v)
		{
			$r[$v[$new_key]] = $v[$new_val];
		}

		return $r;
	}

	/**
	 * Pluck value (values)
	 */
	public static function get($data, $keys)
	{
		return (is_string($keys) || is_numeric($keys))
			? self::getOne($data, $keys)
			: self::getMulti($data, $keys);
	}

	public static function getOne($data, $key)
	{
		return (array_key_exists($key, $data))
			? $data[$key]
			: null;
	}

	public static function getMulti($data, $keys)
	{
		$r = array();

		foreach($keys as $key)
		{
			$r[$key] = self::get($data, $key);
		}

		return $r;
	}

}