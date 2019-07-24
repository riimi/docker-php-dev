<?php

require __DIR__ . 'vendor/autoload.php';

use DockerTutorial\ServerConfig;

$cfg = new ServerConfig('server.yml');
var_dump($cfg->getDBConfig());
var_dump($cfg->getLogDBonfig());
var_dump($cfg->getRedisConfig());
var_dump($cfg->getScribedConfig());