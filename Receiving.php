<?php

require_once __DIR__ . '/vendor/autoload.php';
  use PhpAmqpLib\Connection\AMQPConnection;
    use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('hello', false, false, false, false);

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
$channel->basic_consume('hello', '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    
    $channel->wait();
   
}  

$channel->close();
$connection->close();


function convercion($json_array){

$MsgArray = json_decode($json_array);
    
    $id = $MsgArray->id;
    $url = $MsgArray->url;
    $formato = $MsgArray->formato;
    $canal = $MsgArray->channel;
     
    $url_out = '/Download_Files/'.$canal.'.'.$formato;


    exec('lame '. $url.' public/Download_Files/'.$canal.'.'.$formato);

    $msg_out = array('id' => $id, 'url' => $url_out, 'formato' => $formato, 'channel' => $canal);

    $msg_out=  json_encode($msg_out);

    response($msg_out, $canal);

}


function response($mensaje, $canal){

    

     $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();


    $channel->queue_declare($canal, false, false, false, false);

    $msg = new AMQPMessage($mensaje);
    $channel->basic_publish($msg, '', $canal);

echo '::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::', "\n";
echo '::              lA CONVERSION FUE EXITOSA                 ::', "\n";
echo '::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::', "\n";

    $channel->close();
    $connection->close();

}

?>