<?php



use \Ratchet\Server\IoServer;
use Application\Resource\Chat;

   

    $server = IoServer::factory(
        new Chat(),
        8080
    );

    $server->run();