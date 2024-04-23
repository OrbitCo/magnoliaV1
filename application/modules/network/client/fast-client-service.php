<?php

require __DIR__ . '/libs/Local.php';
require __DIR__ . '/libs/Daemon.php';
require __DIR__ . '/libs/ElephantIO/Client.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// TODO: Придумать, где брать путь
$logs_dir = dirname(dirname(dirname(dirname(__DIR__)))) . '/temp/logs/network/';

$local = new Local();
try {
    $daemon = new Daemon($logs_dir);
    $pid = $daemon->run();
    $local->saveDaemonPid($pid);
    // TODO: Добавить периодическую проверку pid-файла на всякий случай.
} catch (Exception $e) {
    $local->log('error', 'Daemon start error: ' . $e->getMessage(), 'fast');
    exit($e->getMessage());
}
$events_dir = $local->getEventsDir();
if (!is_dir($events_dir)) {
    mkdir($events_dir, 0777, true);
}
$local->log('info', 'Daemon started with pid "' . $pid . '"', 'fast');
$conn_data = $local->getConnectionData();

// TODO: Реакция на отключение сервера.
$elephant = new ElephantIO\Client(
        $conn_data['url'], // Server url
        'socket.io', // Socket.io path
        2, // Protocol
        true, // Read
        true, // Check ssl peer
        $local->isDebug(), // Debug
        $conn_data['namespace'], // Namespace
        '127.0.0.1', // Command address
        10000, // Command port
        'file', // Command type
        $events_dir // Command dir
);
$elephant->setLogger($local);
$elephant->setLicence($conn_data['key'], $conn_data['domain']);

foreach ($local->getEvents() as $event) {
    $elephant->on($event, function ($data) use ($event, $local) {
        $local->log('info', 'Event received: ' . $event . '(' . serialize($data) . ')', 'fast');
        $local->handle($event, $data);
    });
}

pcntl_signal(15, [$elephant, 'close']);

$elephant->init(true, true, true, 10000);
