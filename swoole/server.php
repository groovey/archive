#!/usr/bin/env php
<?php

require 'bootstrap.php';

use Swoole\WebSocket\Server;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;

$server = new Server("0.0.0.0", 8080);

$server->on("Start", function (Server $server) {
    dump("Swoole WebSocket Server is started at http://localhost:8080");
});

$server->on('Open', function (Server $server, Request $request) {
    dump("connection open: {$request->fd}");
});

$server->on('Message', function (Server $server, Frame $frame) {
    dump("received message: " . $frame->data);
    $server->push($frame->fd, json_encode(['message' => $frame->data]));
});

$server->on('Close', function (Server $server, int $fd) {
    dump("connection close: {$fd}");
});

$server->on('Disconnect', function ($server, int $fd) {
    dump("connection disconnect: {$fd}");
});

$server->start();