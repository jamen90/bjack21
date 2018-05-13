<?php

	namespace Control;

	require_once __DIR__.'/../vendor/autoload.php';

	use Model\SQLConnection;
	use Model\Authentication;
	use View\Home;
	use View\Hello;

	class Initialization
	{
		private $otp;
		private $permission;
		private $view;

		public function __construct()
		{
			$this->otp = (new SQLConnection())->create();
		}

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
	}

?>