<?php
class CMS_Autoload
{
    public static function register() {
        return spl_autoload_register(array('CMS_Autoload', 'load'));
    }

    public static function load($request)
	{
		if (file_exists(LIB . str_replace('\\', DS, $request) . '.php'))
		{
			include LIB . str_replace('\\', DS, $request) . '.php';
			return;
		}

		if (file_exists(APP . str_replace('\\', DS, $request) . '.php'))
		{
			include APP . str_replace('\\', DS, $request) . '.php';
			return;
		}

		throw new \Exception('Autoload failed: ' . $request);
	}
}