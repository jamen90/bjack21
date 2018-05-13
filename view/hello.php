<?php

	namespace View;

	require_once __DIR__.'/../vendor/autoload.php';

	class Hello
	{
		
		private $card1;
		private $card2;
		private $twig;

		public function __construct()
		{
			$this->twig = (new Config())-> tw();

			$vals = array_rand(Config::CARD_VAL, 2);
			$type = array_rand(Config::CARD_TYPE, 2);
			$this->card1 = Config::PNG_PATH.Config::CARD_VAL[$vals[0]]."_of_".Config::CARD_TYPE[$type[0]];
			$this->card2 = Config::PNG_PATH.Config::CARD_VAL[$vals[1]]."_of_".Config::CARD_TYPE[$type[1]];
		}

		public function hello()
		{
			echo $this->twig->render('hello.html', array('card1'=>$this->card1,'card2'=>$this->card2));
		}

		public function error($err)
		{
			echo $this->twig->render('hello.html', array('card1'=>$this->card1,'card2'=>$this->card2, 'err'=>$err));
		}
	}


?>