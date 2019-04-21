<?php

require __DIR__ . '/vendor/autoload.php';

for ($i=0; $i<5; ++$i) {
    \Ratchet\Client\connect('ws://localhost:8081')->then(function ($conn) {
        $conn->on('message', function ($msg) use ($conn) {
            echo "Received: {$msg}\n";
            //$conn->close();
        });
        
        $conn->send('Hello World!');
    }, function ($e) {
        echo "Could not connect: {$e->getMessage()}\n";
    });
}