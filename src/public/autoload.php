<?php

defined("DS") or define("DS", DIRECTORY_SEPARATOR);

function myAutoload($name){

	$pathName = str_replace("_", DS, $name) . '.php';

	require_once '..' . DS . 'library' . DS . 'Ip' . DS . $pathName;
}

spl_autoload_register("myAutoload");