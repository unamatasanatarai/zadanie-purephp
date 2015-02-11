<?php

/**
 * useful shorthand function to get a value from an array
 * @param $arr Array
 * @param $key What key value to get
 * @param $notfound Default return
 *
 * @example array_get(array('name' => 'sting', 'band' => 'police'), 'year', '1873') -> will return `1873`
 * @example array_get(array('name' => 'sting', 'band' => 'police'), 'band', '1873') -> will return `police`
 */

function array_get($arr, $key, $notfound = ''){
	if (!isset($arr[$key])){
		return $notfound;
	}
	return $arr[$key];
}