<?php

	require_once '../vendor/autoload.php';

	namespace View;

	class Hello
	{
		
		private $card1;
		private $card2;
		private $twig;

		public function __construct()
		{
			$this->twig = (new Config())-> twig();
		}

		public function hello()
		{
			$vals = array_rand(Config::CARD_VAL, 2);
			$type = array_rand(Config::CARD_TYPE, 2);
			$this->card1 = Config::PNG_PATH.$vals[0]."_of_".$type[0];
			$this->card2 = Config::PNG_PATH.$vals[1]."_of_".$type[1];

			echo $this->twig->render('hello.html', array('card1'=>$this->card1,'card2'=>$this->card2));
		} 
	}


?>