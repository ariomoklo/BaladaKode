<?php

class Router{
	protected $uri;
	protected $controller;
	protected $action;
	protected $params = "";

	public function getURI(){
		return $this->uri;
	}

	public function getController(){
		return $this->controller;
	}

	public function getAction(){
		return $this->action;
	}

	public function getParams(){
		return $this->params;
	}

	public function __construct($uri){
		$this->uri = urldecode(trim($uri, '/'));

		$this->controller = Config::get('DEFAULT_ROUTE');
		$this->action = Config::get('DEFAULT_ACTION');

		$uri_parts = explode('?', $this->uri);

		$path = $uri_parts[0];

		$path_parts = explode('/', $path);

		if(count($path_parts)){
			if(current($path_parts) == "BaladaKode"){
				array_shift($path_parts);
			}

			if(current($path_parts)){
				$this->controller = strtolower(current($path_parts));
				array_shift($path_parts);
			}

			if(current($path_parts)){
				$this->action = current($path_parts);
				array_shift($path_parts);
			}

			$this->params = $path_parts;
		}
	}
}