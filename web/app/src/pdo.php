<?php

// class Database extends PDO {

// 	private function __construct() {
// 		try {
// 			$dsn = 'mysql:host='.DB_TYPE.';dbname='.DB_NAME.';charset=utf8;port=3306';
// 			parent::__construct($dsn, DB_USER, DB_PATH);
// 		} catch (PDOException $e) {
// 			echo "Pdo error: ",$e->getMessage();
// 		}
// 	}
// }

class Database {

	private $db;

	public function __construct() {
		// $this->db = new Database();
		try {
			$dsn = 'mysql:host='.DB_TYPE.';dbname='.DB_NAME.';charset=utf8;port=3306';
			$this->db = new PDO($dsn, DB_USER, DB_PASS);
			$this->db->exec('SET NAMES UTF8');
		} catch (PDOException $e) {
			echo "Pdo error: ",$e->getMessage();
		}
	}

	public function initErrorHandling() {
		$this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}

	public function select($query, $params = array()) {
		$sth = $this->db->prepare($query);
		$is_ok = $sth->execute($params);
		if ($is_ok === false) return false;
		return $sth->fetchAll();
	}

	public function selectRow($query, $params = array()) {
		$sth = $this->db->prepare($query);
		$is_ok = $sth->execute($params);
		if ($is_ok === false) return false;
		return $sth->fetch();
	}

	public function selectColumn($query, $params = array()) {
		$sth = $this->db->prepare($query);
		$is_ok = $sth->execute($params);
		if ($is_ok === false) return false;
		return $sth->fetchColumn();
	}

	public function perform($query, $params = array()) {
		$sth = $this->db->prepare($query);
		$is_ok = $sth->execute($params);
		return $is_ok;
	}

	public function highLevelOp($sql) {
		try {
			$this->db->exec($sql);
			return true;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}
}