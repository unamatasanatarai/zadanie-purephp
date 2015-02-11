<?php
namespace Util;

class Validator
{
	const NOTEMPTY      = 'notempty';
	const EMAIL         = 'email';
	public $validate    = array();
	public $results     = array();

	public function __construct($rules){
		$this->validate = $rules;
	}

	public function validate($data){
		$results = array();
		if (!is_array($data)){
			return false;
		}

		foreach($this->validate as $field => $rules){
			if (   !isset($data[$field])
				|| !$this->{'__' . $rules['rule']}($data[$field], array_get($rules, 'rule_vars', null))) {
				$results[$field] = $rules['msg'];
			}
		}

		$this->results = $results;
		return empty($results);
	}

	public function __notempty($str){
		return trim($str) != '';
	}

	public function __email($str){
		return filter_var($str, FILTER_VALIDATE_EMAIL);
	}

	public function __get($name){
		return array_get($this->results, $name, null);
	}
}