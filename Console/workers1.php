<?php

include_once('./db/sql_abstract.php');
include_once('./db/sql_mysql.php');
include_once('./db/sql_postgres.php');

require_once __DIR__ . '/vendor/autoload.php';
 use PhpAmqpLib\Connection\AMQPConnection;
 use PhpAmqpLib\Message\AMQPMessage;



$server       = 'localhost';
$database     = 'music_box';
$user         = 'postgres';
$password     = 'root';

$driver_class = '\DB\SqlPostgres'; //'SqlPostgres';

receiving();


function receiving(){

	$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('task_queue', false, true, false, false);

echo '::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::', "\n";
echo '::             ESPERANDO MENSAJES EN COLA                 ::', "\n";
echo '::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::', "\n";

$callback = function($msg) {


$mensaje = $msg->body;

convercion($mensaje);

 sleep(substr_count($msg->body, '.'));
//echo $mensaje;
$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);


};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    
    $channel->wait();
   
}  

$channel->close();
$connection->close();

}








