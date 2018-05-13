<?php

	namespace Model;

	class SQLConnection
	{

		private $pdo;

		public function __construct()
		{
			if ($this->pdo == NULL)
			{
				try
				{
					$this->pdo = new \SQLite3(Config::SQL_PATH);
				}catch(Throwable $e)
				{
					echo $e;
				}
			}

		}

		public function connect()
		{
			if($this->pdo != null)
				return $this->pdo;
			else
				echo "not sql-object ";
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