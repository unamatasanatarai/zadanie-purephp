<?php
/**
 * ładny var_dump
 */
function v()
{
	$backtrace = debug_backtrace();
	$args = func_get_args();
	$size = sizeOf($args) -1;
	$i = 0;

	$title = str_replace(ROOT, '', $backtrace[0]['file']);
	$line = $backtrace[0]['line'];
	$content = '';
	for ($i; $i <= $size; $i++)
	{
		ob_start();
		var_dump($args[$i]);
		$out = ob_get_clean();
		$out = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $out);
		$content .= (strpos($out, 'xdebug-var-dump'))
			? $out
			: h($out);
		if ($i < $size)
		{
			$content .= "\n";
		}
	}

	include 'debug.tpl';
}
/**
 * +die();
 * @return [type] [description]
 */
function vd(){
	$backtrace = debug_backtrace();
	$args = func_get_args();
	$size = sizeOf($args) -1;
	$i = 0;

	$title = $backtrace[0]['file'];
	$line = $backtrace[0]['line'];
	$content = '';
	for ($i; $i <= $size; $i++)
	{
		ob_start();
		var_dump($args[$i]);
		$out = ob_get_clean();
		$out = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $out);
		$content .= (strpos($out, 'xdebug-var-dump'))
			? $out
			: h($out);
		if ($i < $size)
		{
			$content .= "\n";
		}
	}

	include 'debug.tpl';
	die;
}
