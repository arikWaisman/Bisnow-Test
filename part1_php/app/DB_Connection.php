<?php

namespace App;

class DB_Connection 
{

	public function __construct(){

		$dotenv = new \Dotenv\Dotenv( __DIR__ . '/../');
		$dotenv->load();

	}

	public function db_connect(){

		$db_conntection = $_ENV['DB_CONNECTION'];
		$db_host = $_ENV['DB_HOST'];
		$db_database = $_ENV['DB_DATABASE'];
		$db_username = $_ENV['DB_USERNAME'];
		$db_password = $_ENV['DB_PASSWORD'];

		return new \PDO("{$db_conntection}:host={$db_host}; dbname={$db_database}", $db_username, $db_password);

	}

	
}