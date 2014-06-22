<?php

require_once __DIR__ . '/vendor/autoload.php';
  use PhpAmqpLib\Connection\AMQPConnection;
    use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('hello', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";



$callback = function($msg) {
$mensaje = $msg->body;

//echo $mensaje;

     response($mensaje);


};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('hello', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    
    $channel->wait();
   
}  

$channel->close();
$connection->close();




function response($mensaje){

    $MsgArray = json_decode($mensaje);
    
    $id = $MsgArray->id;
    $url = $MsgArray->url;
    $formato = $MsgArray->formato;
    $canal = $MsgArray->channel;
     
    $url_out = '/Download_Files/'.$canal.'.'.$formato;

    exec('lame '. $url.' public/Download_Files/'.$canal.'.'.$formato);

	 $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();


    $channel->queue_declare($canal, false, false, false, false);

    $msg = new AMQPMessage($url_out);
    $channel->basic_publish($msg, '', $canal);

    echo " [x] Sent 'response'\n";

    $channel->close();
    $connection->close();

}

?>