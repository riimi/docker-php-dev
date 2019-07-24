<?php

namespace DockerTutorial;

$GLOBALS['THRIFT_ROOT'] = __DIR__ . '/scribe-php';

// Load up all the thrift stuff
require $GLOBALS['THRIFT_ROOT'].'/Thrift.php';
require $GLOBALS['THRIFT_ROOT'].'/autoload.php';

// Load the package for scribe
require_once $GLOBALS['THRIFT_ROOT'].'/packages/scribe/scribe.php';

class Logger
{
    private $client;
    private $trans;
    private $queue;

    public function __construct($host, $port)
    {
        // Set up the socket connections
        $scribe_servers = array($host);
        $scribe_ports = array($port);
        $sock = new \TSocketPool($scribe_servers, $scribe_ports);
        $sock->setDebug(0);
        $sock->setSendTimeout(1000);
        $sock->setRecvTimeout(2500);
        $sock->setNumRetries(1);
        $sock->setRandomize(false);
        $sock->setAlwaysTryLast(true);
        $this->trans = new \TFramedTransport($sock);
        $prot = new \TBinaryProtocol($this->trans);

        // Create the client
        $this->client = new \scribeClient($prot);
        $this->queue = array();
    }

    public function add($category, $log)
    {
        $this->queue[] = new \LogEntry(array('category'=>$category, 'message'=>json_encode($log)));
    }

    public function flush()
    {
        if (empty($this->queue))
        {
            return ;
        }

        $this->trans->open();
        $this->client->Log($this->queue);
        $this->trans->close();

        $this->queue = array();
    }
}
