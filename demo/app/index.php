<?php

require __DIR__ . '/vendor/autoload.php';

use DockerTutorial\ServerConfig;
use DockerTutorial\Pdo;
use DockerTutorial\Logger;

$cfg = new ServerConfig('server.yml');

$gamedb = new Pdo($cfg->getDBConfig());
$logdb = new Pdo($cfg->getLogDBConfig());
$scribe_config = $cfg->getScribedConfig();
$logger = new Logger($scribe_config['host'], $scribe_config['port']);

$logger->add('hello_log', array("hostname"=>gethostname()));
$logger->flush();

