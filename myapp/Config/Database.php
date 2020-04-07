<?php
namespace App\Config;

use mysqli;

class Database
{
	/**
	 * Database configuration
	 * servername, username, password, databasename
	 */

	CONST DB_HOST = 'localhost';
	CONST DB_USERNAME = 'root';
	CONST DB_PASSWORD = '';
	CONST DB_NAME = 'my-db';
	public $conn;

	public function __construct()
	{
		self::dbConnect();
	}

	private function dbConnect()
	{
		$this->conn = new mysqli(self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);
		if ($this->conn->connect_error) {
			die('Connection failed: ' . $this->conn->connect_error);
		}
	}
}