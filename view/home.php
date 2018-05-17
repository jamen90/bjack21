<?php

	namespace View;

	require_once __DIR__.'/../vendor/autoload.php';


	class Home
	{

		private $twig;

		private $game;

		private $uname;

		public function __construct()
		{
			$this->game = new Game();
			$this->twig = (new Config())-> tw();
		}

		public function fullhouse($uname)
		{
			$this->uname = $uname;
			$gma = $this->game->load();
			echo $this->twig->render("home.html", array('uname' => $this->uname , 'game'=>$gma));
		}

		public function list($table)
		{
			$sss = $this->tablize($table);
			echo $this->twig->render("home.html", array('uname' => $_SESSION["username"] , 'game'=>$sss));

		}

		private function tablize($t)
		{

			$list = array();

			while($row = $t->fetchArray(SQLITE3_ASSOC))
			{
				$tmp = array();
				array_push($tmp, $row);
				array_push($list, $tmp);
			}

			return $this->twig->render("score.html", array('table'=> $list,'u'=>$_SESSION["username"] ));

		}
	}


?>