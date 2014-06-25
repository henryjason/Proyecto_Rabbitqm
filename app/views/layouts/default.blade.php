<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>{{ $titulo }}</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="interfaz/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" href="interfaz/nivo-slider.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">


	<script type="text/javascript" src="interfaz/lib/jquery.nivo.slider.pack.js"></script>

        {{HTML::script('js/jquery.js');}}
        {{HTML::script('js/jquery-ui.js');}}


	</head>
	<body>
		<div id="bg_black">
			<div id="logo">	
				<h1>&nbsp;</h1>
				<a href=""><small><img src="interfaz/images/logo_seite.jpg" alt="" width="112" height="89" /></small></a>
			</div>
			<div id="wrap">
				<div id="header">
					<div id="wrapper">
						<div id="slider-wrapper">
							<div id="slider" class="nivoSlider">
								<img src="interfaz/images/headerprinciapal.jpg" alt="" />
								<img src="interfaz/images/header2.jpg" alt=""/>
								<img src="interfaz/images/header3.jpg" alt="" />
								<img src="interfaz/images/header4.jpg" alt="" />
							</div>
						</div>
					</div>
					<div class="ic"></div>
				
					<script type="text/javascript">
					$(window).load(function() {
						$('#slider').nivoSlider();
					});
					</script>
				</div>
				<div id="menu">
					<ul>
					    <li>{{link_to('/', 'PRINCIPAL', false);}}</li>
					 	<li>{{link_to('home', 'CONVERSION', array('id' => 'home'), false);}}</li>
				
					</ul>
					<div class="clear"></div>
				</div>
				<div id="column_box">
					

					 {{ $content }}
					 
				</div>
				

			</div>
		</div>
		
		<div id="footer_bot">
			<p>Todos los derechos reservados</p>
		</div>
	</body>


</html>