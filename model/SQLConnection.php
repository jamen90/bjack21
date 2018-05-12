<?php

	namespace Model;

	class SQLConnection
	{

		private $pdo;

		public function __construct()
		{
			if ($pdo == NULL)
			{
				try
				{
					$this->pdo = new \SQLite3(Config::SQL_PATH);
				}catch(Throwable $e)
				{
					echo $e;
				}
			}

			return $this->pdo;
		}

		public function create()
		{
			foreach (Config::SQL_TABLES as $stm)
				{
					$this->pdo->exec($stm);
				}

		}

	}

?>