<?php

	namespace Model;

	require_once __DIR__.'/../vendor/autoload.php';

	class Score
	{
		private $uname;

		private $uid;

		private $pdo;

		public function __construct($uname)
		{
			$this->pdo = new SQLConnection();
			$this->pdo = $this->pdo->connect();
			$this->uname = $uname;
			$this->uid = $this->pdo->querySingle("SELECT uid FROM users WHERE uname='$this->uname'");
		}

		public function getfund()
		{
			$fund = $this->pdo->querySingle("SELECT fund FROM score WHERE sid='$this->uid'");
			return $fund;
		}

		public function change($bite)
		{
			$fundo = $this->pdo->querySingle("SELECT fund FROM score WHERE sid='$this->uid'");
			$sst = $this->pdo->querySingle("SELECT sesst FROM score WHERE sid='$this->uid'");
			$fund = $fundo + $bite;
			$win += $fund - 1024;
			$sst += 1;

			$this->pdo->exec("UPDATE score SET fund='$fund', win='$win', sesst='$sst' WHERE sid='$this->uid';");
			return $fund;
		}

		public function list()
		{
			$table = $this->pdo->query("SELECT uname, fund, win, sesst FROM users JOIN score ON users.uid = score.sid ORDER BY fund DESC");

			return $table;

		}
	}


?>