<?php
	
	require_once __DIR__.'/vendor/autoload.php';

	use Control/Initialization;
	use Control/Authentication;
	use Control/Session;

	class Router
	{
		const ROUT_MAP = array('visit' => 'Initialization',
			'login' => 'Authentication', 'logout' => 'Authentication','register' => 'Authentication',
			'score' => 'Session', 'deal' => 'Session');

		private $response;

		private $action;

		private $controller;

		private $param = array();

		public function __construct($req)
		{
			if(array_key_exists($req["action"], self::ROUT_MAP) == FALSE)
			{
					$this->action = "visit";
			}
			else {  $this->action = $req["action"];  }

			$this->controller = self::ROUT_MAP[$this->action];

			if(count($req) > 1)
			{
				foreach ($req as $key => $value) {
					if($key != "action")
						$this->param = array_merge($this->param, array($key => $value));
				}
			}
		}

		public function send()
		{
			if(count($this->param) != 0)
			{
				$this->response = (new $this->controller.'()')-> $this->action.'('.$this->param.')';
			}
			else if (count($this->param) == 0)
			{
				$this->response = (new $this->controller.'()')-> $this->action.'()';
			}
		}
	}

	$request = array();
	if(!isset($_GET["action"]))
	{
		$request = array("action" => "visit");
	}
	else if(isset($_GET["action"]))
	{
		$request = array("action" => $_GET["action"]);
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			foreach ($_POST as $key => $value) {
				$request = array_merge($request, array($key => $value));
			}
		}

	}
	$interact = new Router($request);
	$response = $interact->send();




?>