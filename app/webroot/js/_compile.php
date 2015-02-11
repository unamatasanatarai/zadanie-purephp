<?php
$js = array();
$js[] = file_get_contents('jquery.js');
$js[] = file_get_contents('bootstrap.js');
$js[] = file_get_contents('notify.js');
$js[] = file_get_contents('s.js');

file_put_contents('all.js', implode(';', $js));