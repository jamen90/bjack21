<?php

	namespace Model;

	class Config
	{
		const SQL_PATH = "db/accounts.db";

		const SQL_TABLES = array("CREATE TABLE IF NOT EXISTS users (
									uid integer PRIMARY KEY AUTOINCREMENT NOT NULL,
									uname text UNIQUE NOT NULL,
									pword text NOT NULL);",
								 "CREATE TABLE IF NOT EXISTS score (
								 	sid integer PRIMARY KEY AUTOINCREMENT NOT NULL,
								 	win integer NOT NULL,
								 	fund integer NOT NULL,
								 	sesst integer NOT NULL,
								 		FOREIGN KEY (sid) REFERENCES users(uid));");

	}

?>