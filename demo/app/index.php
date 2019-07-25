<?php

require __DIR__ . '/vendor/autoload.php';

use DockerTutorial\ServerConfig;
use DockerTutorial\Pdo;
use DockerTutorial\Logger;

// load server configuration
$cfg = new ServerConfig('server.yml');
$hostname = gethostname();

// test to connect mysql server
$gamedb = new Pdo($cfg->getDBConfig());
$logdb = new Pdo($cfg->getLogDBConfig());

// test to connect scribe server
$scribe_config = $cfg->getScribedConfig();
$logger = new Logger($scribe_config['host'], $scribe_config['port']);
$logger->add('hello_log', array("hostname"=>$hostname));
$logger->flush();
print_r('hostname: ' . $hostname);

// test to connect memcache server
$mem_config = $cfg->getMemcachedConfig();
$memc = new Memcache();
$memc->connect($mem_config['host'], $mem_config['port']);
print_r($memc->getStats());

// test to connect redis server
$redis_config = $cfg->getRedisConfig();
$redis = new Redis();
$redis->connect($redis_config['host'], $redis_config['port']);
print_r($redis->ping());