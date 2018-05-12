<?php

	require_once '../vendor/autoload.php';

	namespace Model;

	class Authentication
	{
		private function assign($uname)
		{

		}

		private function test_it($input)
		{

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

		}

		public function register($uname, $pword)
		{

		}

		public function logout()
		{

		}
	}

?>