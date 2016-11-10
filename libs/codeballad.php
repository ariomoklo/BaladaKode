<?php

class CodeBallad{
	protected static $router;
    protected static $database;

	public static function Routing(){
		return self::$router;
	}

    public static function getDatabase(){
        return self::$database;
    }

	public static function run($uri){
		self::$router = new Router($uri);
        self::$database = new Database();

		$controller = ucfirst(self::$router->getController());
		$method		= self::$router->getAction();

		if(class_exists($controller)){
			$object 	= new $controller();

			if(method_exists($object, $method)){
			    if(self::$router->getParams() != ""){
                    $result = $object->$method(self::$router->getParams());
                }else{
                    $result = $object->$method();
                }
			}else{
				if(self::$router->getParams() != ""){
					$param = array($method,);
					$param = array_merge($param, self::$router->getParams());
                    $result = $object->index($param);
                }else{
                    $result = $object->index();
                }
			}
		}else{
            $data['message'] = 'The page you are looking for cannot be found';
			ob_start();
	        include (VIEW_PATH.DS.'static/404.php');
		}
	}
}