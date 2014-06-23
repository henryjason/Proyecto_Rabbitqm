<?php

 use PhpAmqpLib\Connection\AMQPConnection;
 use PhpAmqpLib\Message\AMQPMessage;


class ModelCola
{
      public static $msg_response; 

      public static function auto_string()
        {

            $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
$numerodeletras=10; //numero de letras para generar el texto
$cadena = ""; //variable para almacenar la cadena generada
for($i=0;$i<$numerodeletras;$i++)
{
    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres 
entre el rango 0 a Numero de letras que tiene la cadena */
}


            return $cadena;
        }



    public static function cola($mensaje)
    {


    $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();


    $channel->queue_declare('hello', false, false, false, false);

    $msg = new AMQPMessage($mensaje);
    $channel->basic_publish($msg, '', 'hello');


    $channel->close();
    $connection->close();

   

    }


    public static function Receiving_msg($canal)
{



$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare($canal, false, false, false, false);

$callback = function($msg) {


  //echo "Link: ", '<a href="'.$msg->body.'">Descargar</a>', "\n";

ModelCola::$msg_response =  $msg->body;

};


$channel->basic_qos(null, 1, null);
$channel->basic_consume($canal, '', false, true, false, false, $callback);

    
   $channel->wait();


    $channel->close();
    $connection->close();

   return ModelCola::$msg_response;

}


}