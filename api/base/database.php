<?php
/*

function connection($connection){
	define("UTF8",JSON_UNESCAPED_UNICODE);  
	$conn = new mysqli(
						$connection["servername"],
						$connection["username"], 
						$connection["password"],
						$connection["dbname"]
	);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset("utf8mb4");
	return $conn;
}

*/


class Database{
	public function __construct(
		private string $host,
		private string $name,
		private string $user,
		private string $password
	) {}

	public function getConnection() : PDO {
		$dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";
		return new PDO($dsn, $this->user, $this->password);
	}
}