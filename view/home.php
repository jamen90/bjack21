<?php

	namespace View;

	require_once __DIR__.'/../vendor/autoload.php';


	class Home
	{

		private $twig;

		public function __construct()
		{
			$this->twig = (new Config())-> tw();
		}

		public function fullhouse($uname)
		{
			echo $this->twig->render("home.html", array('uname' => $uname));
		}
	}


?>