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


    $channel->queue_declare('task_queue', false, true, false, false);

    if(empty($data)) $data = $mensaje;
    
    $msg = new AMQPMessage($data,
                        array('delivery_mode' => 2) # make message persistent
                      );
   // $msg = new AMQPMessage($mensaje);


    $channel->basic_publish($msg, '', 'task_queue');


    $channel->close();
    $connection->close();

   

    }


}