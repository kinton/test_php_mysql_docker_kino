<?php

class Database extends PDO {
	public function __construct() {
		try {
			$dsn = 'mysql:host='.DB_TYPE.';dbname='.DB_NAME.';charset=utf8;port=3306';
			parent::__construct($dsn, DB_USER, DB_PATH);
		} catch (PDOException $e) {
			echo "Pdo error: ",$e->getMessage();
		}
	}
}