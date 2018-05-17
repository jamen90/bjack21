<?php

	namespace View;

	require_once __DIR__."/../vendor/autoload.php";

	class Game
	{
		private $twig;

		public function __construct()
		{
			$this->twig = (new Config())-> tw();
		}

		public function first($header)
		{
			echo $this->twig->render("home.html", array("header"=> $header));
		}
	}

?>