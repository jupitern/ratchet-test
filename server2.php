<?php

use Lib\Chat\ChatServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\Socket\Server;
use Ratchet\Server\IoServer;
use React\EventLoop\Factory as EventLoopFactory;

error_reporting(E_ALL);
ini_set("display_errors", 1);
define('DS', DIRECTORY_SEPARATOR);
require __DIR__ .DS. 'vendor' .DS. 'autoload.php';
require __DIR__ .DS. 'ChatServerTest.php';

$chatServer = new ChatServerTest;
$server = IoServer::factory(new HttpServer(new WsServer($chatServer)), 8082);
$server->run();

//$chatServer = new ChatServerTest;
//$loop = EventLoopFactory::create();
//$ports = [8081, 8082];
//foreach ($ports as $port) {
//    $sock = new Server("0.0.0.0:{$port}", $loop);
//    $server = new IoServer(new HttpServer(new WsServer($chatServer)), $sock, $loop);
//}
//
//$loop->run();
