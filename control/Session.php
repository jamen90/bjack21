<?php

	namespace Control;

	require_once __DIR__."/../vendor/autoload.php";

	use View\Game;
	use Model\Score;

	class Session
	{
		private $socket;

		private $player;

		public function __construct()
		{
			$this->socket = socket_create(AF_INET, SOCK_STREAM, 0);
			$result = socket_connect($this->socket, Config::HOST, Config::PORT);

		}

		public function deal()
		{
			$this->player = $_SESSION["username"];
			socket_write($this->socket,$this->player,strlen($this->player));
			
			$replay = socket_read($this->socket, 1024);

			$this->show($replay);

		}

		private function show($replay)
		{
			$result = (new Game())-> first($replay);
		}
	}


?>