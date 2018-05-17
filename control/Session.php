<?php

	namespace Control;

	require_once __DIR__."/../vendor/autoload.php";

	use View\Game;
	use Model\Score;

	class Session
	{
		private $sock;

		public function __construct()
		{
			$this->sock = socket_create(AF_INIT, SOCK_STREAM, 0);
			socket
		}
	}


?>