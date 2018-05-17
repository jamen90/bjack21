<?php

	namespace View;

	require_once __DIR__."/../vendor/autoload.php";

	use Control\Session;

	class Game
	{
		private $twig;

		private $uname;

		public $fund;

		public function __construct()
		{
			$this->uname = $_SESSION["username"];
			$this->twig = (new Config())->tw();
		}

		public function load()
		{
			$this->fund = (new Session())->init();
			return $this->twig->render("game.html", array('chip' => Config::CHIP_PATH, 'fund'=>$this->fund));
		}

		public function rndr()
		{
			$this->fund = (new Session())->init();
			echo $this->twig->render("game.html", array('chip' => Config::CHIP_PATH, 'fund'=>$this->fund));
		}

	}


?>