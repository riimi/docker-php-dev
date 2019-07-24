<?php

namespace DockerTutorial;

class Pdo
{
	public $pdo = null;
	private $dsn = "";

	public function __construct($cfg)
	{
		$this->dsn = "mysql:host=${$cfg['host']};port=${$cfg['port']};dbname=${$cfg['db']};charset=utf8";
        try {
            $this->pdo = new \PDO($this->dsn, $cfg['user'], $cfg['pass']);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
	}

	public function connect() {

	}
}
