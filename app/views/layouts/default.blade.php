<!DOCTYPE html>
<html>
<head>
	<title>{{ $titulo }}</title>
</head>
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