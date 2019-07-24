<?php

namespace DockerTutorial\Base;

class DB
{
	private $pdo = null;
	private $dsn = "";

	public function __construct()
	{
		$this->dsn = "mysql:host=mysql;port=3306;dbname=test;charset=utf8";
	}

	public function connect() {
		try {
			$pdo = new \PDO($this->dsn);
			$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch(\PDOException $e) {
			echo $e->getMessage();
		}
	}
}
