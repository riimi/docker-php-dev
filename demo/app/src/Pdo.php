<?php

namespace DockerTutorial;

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
			$this->pdo = new \PDO($this->dsn);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch(\PDOException $e) {
			echo $e->getMessage();
		}
	}
}
