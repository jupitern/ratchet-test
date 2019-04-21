<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatServerTest implements MessageComponentInterface {

    protected $clients;
    private $debug = true;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        if($this->debug) {
            echo "new user connected: {$conn->resourceId} Total connections: ". count($this->clients) .PHP_EOL;
        }
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        if($this->debug) echo "MESSAGE RECEIVED: {$msg} from ".$from->resourceId ." => Total connections: ". count($this->clients).PHP_EOL;

        //$this->broadcast($msg);
    }

    public function onClose(ConnectionInterface $conn)
    {
        if($this->debug) echo "user left : ".$conn->resourceId ." => Total connections: ". count($this->clients).PHP_EOL;

        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    public function broadcast($msg)
    {
        foreach ($this->clients as $client) {
            $client->send(json_encode($msg));
        }
    }

}