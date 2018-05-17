<?php

	namespace Control;

	require_once __DIR__.'/../vendor/autoload.php';

	use \Exception;
	use Model\Score;
	use View\Game;
	use View\Home;

	class Session
	{
		private $uname;

		public function __construct()
		{
			$this->uname = $_SESSION["username"];

		}

		public function score($bite)
		{
			$bet = $bite["bite"];
			$fund = (new Score($this->uname))->change($bet);
			$view = (new Game())-> rndr();
		}

		public function init()
		{
			$fund = (new Score($this->uname))->getfund();
			return $fund;
		}

		public function list()
		{
			$res = (new Score($this->uname))->list();
			$s = (new Home())->list($res);
		}
	}
	

?>