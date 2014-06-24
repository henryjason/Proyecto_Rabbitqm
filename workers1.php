<?php

include_once('./db/sql_abstract.php');
include_once('./db/sql_mysql.php');
include_once('./db/sql_postgres.php');

require_once __DIR__ . '/vendor/autoload.php';
 use PhpAmqpLib\Connection\AMQPConnection;
 use PhpAmqpLib\Message\AMQPMessage;


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


function convercion($json_array){


$server       = 'localhost';
$database     = 'music_box';
$user         = 'postgres';
$password     = 'root';

$driver_class = '\DB\SqlPostgres'; //'SqlPostgres';


$sql = new $driver_class($server, $database, $user, $password);
$sql->connect();



$MsgArray = json_decode($json_array);
    
    $id = $MsgArray->id;
    $url = $MsgArray->url;
    $formato = $MsgArray->formato;
    $canal = $MsgArray->channel;
     
    $url_out = '/Download_Files/'.$canal.'.'.$formato;

     //exec('lame '. $url.' public/Download_Files/'.$canal.'.'.$formato);

    exec('ffmpeg -y -i '. $url.' public/Download_Files/'.$canal.'.'.$formato);

    $msg_out = array('id' => $id, 'url' => $url_out, 'formato' => $formato, 'channel' => $canal);

    $msg_out=  json_encode($msg_out);

    //response($msg_out, $canal);

     $sql->runSql("UPDATE music
     SET url = '$url_out',
     formato = '$formato',
     status = '1'
     WHERE
     id = $id;");

      $sql->disconnect();

echo '::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::', "\n";
echo '::              lA CONVERSION FUE EXITOSA                 ::', "\n";
echo '::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::', "\n";


}







