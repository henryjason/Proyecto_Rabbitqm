<?php

require_once __DIR__ . '/vendor/autoload.php';
  use PhpAmqpLib\Connection\AMQPConnection;
    use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('hello', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) {
  echo " [x] Received ", $msg->body, "\n";
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('hello', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
    response();

}

$channel->close();
$connection->close();


function response(){

	 $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();


    $channel->queue_declare('response', false, false, false, false);

    $msg = new AMQPMessage('Msg Recivido --> by HENRY');
    $channel->basic_publish($msg, '', 'response');

    echo " [x] Sent 'response'\n";

    $channel->close();
    $connection->close();

}

?>