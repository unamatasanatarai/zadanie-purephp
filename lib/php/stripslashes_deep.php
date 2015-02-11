<?php

/**
 * recursive/deep stripslashes
 */

function stripslashes_deep($values) {
	if (ini_get('magic_quotes_gpc') !== '1'){
		return $values;
	}

	if (is_array($values)) {
		foreach ($values as $key => $value) {
			$values[$key] = stripslashes_deep($value);
		}
	} else {
		$values = stripslashes($values);
	}
	return $values;
}