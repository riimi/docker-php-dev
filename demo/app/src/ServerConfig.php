<?php

namespace DockerTutorial;

class ServerConfig
{
    private $obj = null;

    public function __construct($config_name)
    {
        $this->obj = yaml_parse_file($config_name);
    }

    public function getDBConfig()
    {
        return $this->obj['db'];
    }

    public function getLogDBonfig()
    {
        return $this->obj['logdb'];
    }

    public function getRedisConfig()
    {
        return $this->obj['redis'];
    }

    public function getScribedConfig()
    {
        return $this->obj['scribed'];
    }

}