<!DOCTYPE html>
<html>
<head>
	<title>{{ $titulo }}</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
   {{HTML::script('js/jquery.js');}}
    {{HTML::script('js/jquery-ui.js');}}

</head>

<?php

use PhpAmqpLib\Connection\AMQPConnection;
 use PhpAmqpLib\Message\AMQPMessage;
 
 ?>

<body>
	<ul>
		<li>{{link_to('home', 'Conversion', array('id' => 'home'), false);}}</li>
		<li>{{link_to('/', 'Principal', false);}}</li>
	</ul>

	{{ $content }}
</body>


	<footer>
		::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.
	</footer>

</html>