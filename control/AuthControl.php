<?php

	namespace Control;

	require_once __DIR__.'/../vendor/autoload.php';

	use Model\Authentication;
	use Model\SQLConnection;
	use View\Hello;
	use View\Home;

	class AuthControl
	{
		private $uname;

		private $pword;

		private $response;

		public function visit()
		{
			$this->permission = (new Authentication())-> connect();
			if($this->permission == TRUE)
			{
				$this->view = (new Home())-> fullhouse($_SESSION["username"]);
			}
			else
			{
				$this->view = (new Hello())-> hello();
			}

			//return $this->view;
		}

		public function login($param)
		{
			$func = __FUNCTION__;

			$this->uname = $param["uname"];
			$this->pword = $param["pword"];
			$this->response = new Authentication();
			$this->response = $this->response->$func($this->uname, $this->pword);
			if($this->response != 1)
			{
				$err = (new Hello())->error($this->response);
			}
			else
			{
				$in = (new Home())->fullhouse($_SESSION["username"]);
			} 

		}

		public function register($param)
		{
			$func = __FUNCTION__;

			$this->uname = $param["uname"];
			$this->pword = $param["pword"];

			$this->response = new Authentication();
			$this->response = $this->response->$func($this->uname, $this->pword);
			if($this->response != 1)
				$err = (new Hello())->error($this->response);
			else
			{
				$in = (new Home())-> fullhouse($_SESSION["username"]);
			}
		}

		public function logout()
		{
			$func = __FUNCTION__;

			$out = (new Authentication())-> $func();
			$redirect = (new Hello())-> hello();
		}
	}

?>