<?php

require_once(ROOT.DS.'config.php');

// loading all class in project
function __autoload($class){
	$lib_class = ROOT.DS."libs".DS.strtolower($class).".php";
	$controller_class = ROOT.DS."controllers".DS.strtolower($class).".php";
	$model_class = ROOT.DS."models".DS.strtolower($class).".php";

	if(file_exists($lib_class)){
		require($lib_class);
	}else if(file_exists($controller_class)){
		require($controller_class);
	}else if(file_exists($model_class)){
		require($model_class);
	}
}

CodeBallad::run($_SERVER['REQUEST_URI']);