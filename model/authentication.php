<?php

	namespace Model;

	require_once __DIR__.'/../vendor/autoload.php';

	class Authentication
	{

		private $pdo;

		private $uname;

		private $pword;

		public $answer;

		private function assign()
		{
			$_SESSION["username"] = $this->uname;
		}

		private function test_it($it)
		{
			if(empty($it))
			{
				return false;
			}
			$it = trim($it);
			$it = stripslashes($it);
			$it = htmlspecialchars($it);
			return $it;
		}

		public function __construct()
		{
			$this->pdo = new SQLConnection();
			$this->pdo = $this->pdo->connect();
		}

		public function connect()
		{
			if(isset($_SESSION["username"]))
			{
				return TRUE;
			}
			else
				return FALSE;
		}

		public function login($uname, $pword)
		{
			$uname = $this->test_it($uname);
			$pword = $this->test_it($pword);
			if($uname==false || $pword==false)
			{
				return Config::ERROR_MAP[__FUNCTION__.":empty"];
			}
			else
			{
				$this->pword = $this->pdo->querySingle("SELECT pword FROM users WHERE uname='$uname'");
				if($this->pword == null)
				{
					return Config::ERROR_MAP[__FUNCTION__.":uname"];
				}
				else
				{
					if($this->pword!=$pword)
						return Config::ERROR_MAP[__FUNCTION__.":pword"];
					else if($this->pword == $pword)
					{
						$this->uname = $uname;
						$this->assign();
						return 1;
					}
				}
			}
		}

		public function register($uname, $pword)
		{
			$uname = $this->test_it($uname);
			$pword = $this->test_it($pword);
			if($uname==false || $pword==false)
				return Config::ERROR_MAP[__FUNCTION__.":empty"];
			else
				$exists = $this->pdo->querySingle("SELECT uid FROM users WHERE uname='$uname'");
				if($exists!=false){
					return Config::ERROR_MAP[__FUNCTION__.":uname"];
				}
				else
				{
					$this->pdo->exec("INSERT INTO users ('uname', 'pword') VALUES 
									  ('$uname', '$pword');");
					$id = $this->pdo->querySingle("SELECT uid FROM users WHERE uname='$uname'");
					$this->pdo->exec("INSERT INTO score ('sid', 'win', 'fund', 'sesst') VALUES 
										('$id', 0, 1024, 0);");

					$this->uname = $uname;
					$this->assign();
					return 1;
				}			
		}

		public function logout()
		{
			unset($_SESSION["username"]);
		}
	}

?>