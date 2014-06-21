<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	

	<style type="text/css">
		body{
			font-size: 16px;
			text-align: center;
			width: 500px;
			margin: 0 auto;

		}
		.mensage{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: left;
			margin: 10px auto; 
			display: none;//Al cargar el documento el contenido del mensaje debe estar oculto
		}
	</style>

</head>

<body>
	<div class="welcome">

	<h1>Upload Files</h1>
 
      	   {{ Form::open(array(
     'url'=>'home/subir', 
     'method' => 'post',
     'enctype'=>'multipart/form-data'
) )}}

{{ Form::file('archivo') }}
{{ Form::submit('subir') }}

{{ Form::close()}}     


<?php

//require_once __DIR__ . '/vendor/autoload.php';
   use PhpAmqpLib\Connection\AMQPConnection;
    use PhpAmqpLib\Message\AMQPMessage;

for ($i=0; $i < 1; $i++) { 
	send_msg($i);
}

function send_msg($i)
{

    $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();


    $channel->queue_declare('hello', false, false, false, false);

    $msg = new AMQPMessage('['.$i.']'.'Henry Cordero Bonilla');
    $channel->basic_publish($msg, '', 'hello');

    echo " [x] Sent 'Hello World!'\n";

    $channel->close();
    $connection->close();


    Receiving_msg();

}

function Receiving_msg()
{

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('response', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) {
  echo " [x] Received ", $msg->body, "\n";
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('response', '', false, true, false, false, $callback);

    
    $channel->wait();


    $channel->close();
    $connection->close();


}

?>



	</div>
</body>
</html>
