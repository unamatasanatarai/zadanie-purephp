<?php
namespace View;

/**
 * Simple template engine. Includes a file and passes set variables.
 */
class Template
{
	public $vars = array();
	public $layout = 'default.php';

	public function render($path, $vars = array()){
		$path_to_view = VIEW . $path . '.php';

		if (file_exists($path_to_view))
		{
			ob_start();
			extract($this->vars);
			extract($vars);
			include $path_to_view;
			return ob_get_clean();
		}
		else
		{
			throw new \Exception('View template does not exist. 404.');
		}
	}

	public function __set($var, $val){
		$this->vars[$var] = $val;
	}

	public function __get($var){
		return array_get($this->vars, $var);
	}
}