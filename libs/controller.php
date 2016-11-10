   <?php

abstract class Controller{
	
	protected $data;
	protected $params;

	public function getUri($uri = ''){
		return 'views/assets'.$uri;
	}

	public function getData(){
		return $this->data;
	}

	public function getParams(){
		return $this->params;
	}

	public function loadView($viewFile, $data = null){
        ob_start();
	    include (VIEW_PATH.DS.$viewFile.'.php');
    }

	public function __construct(){
		$this->params = CodeBallad::Routing()->getParams();
	}
}