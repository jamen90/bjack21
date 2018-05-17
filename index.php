<?php
	
	require_once __DIR__.'/vendor/autoload.php';

	use Control\AuthControl;
	use Control\Initialization;
	use Control\Session;

	class Router
	{
		const ROUT_MAP = array('visit' => 'Control\Initialization',
			'login' => 'Control\AuthControl', 'logout' => 'Control\AuthControl','register' => 'Control\AuthControl',
			'score' => 'Control\Session');

		const ARGUMENTS_CONTROL = array("logout"=>0, "visit"=>0,
										"score"=>0, "login"=>3, "register"=>3);


		private $response;

		private $action;

		private $controller;

		private $param = array();

		private function arg_handler()
		{
			if(self::ARGUMENTS_CONTROL[$this->action] != 0 && count($this->param) == 0)
				$this->action = "visit";
		}

		public function __construct($req)
		{
			if(array_key_exists($req["action"], self::ROUT_MAP) == FALSE)
			{
					$this->action = "visit";
			}
			else
			{
				$this->action = $req["action"];
			}

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
			$this->arg_handler();	

			$func = $this->controller;
			$bar = $this->action;
			$foo = $this->param;
			if(count($this->param) != 0)
			{
				$this->response = (new $func())-> $bar($foo);
			}
			elseif (count($this->param) == 0)
			{
				$this->response = (new $func())-> $bar();
			}
	//		return $this->response;
		}
	}


	session_start();

	$request = array();

	if(isset($_GET["action"]))
	{
		$request = array("action" => $_GET["action"]);
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			foreach ($_POST as $key => $value) {
				$request = array_merge($request, array($key => $value));
			}
		}

	}
	else
	{
		$request = array("action" => "visit");
	}

	$interact = new Router($request);
	$response = $interact->send();
	



?>