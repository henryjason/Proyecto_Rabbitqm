<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Home</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="interfaz/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" href="interfaz/nivo-slider.css" type="text/css" media="screen" />
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
								<img src="interfaz/images/header.jpg" alt="" />
								<img src="interfaz/images/header2.jpg" alt=""/>
								<img src="interfaz/images/header3.jpg" alt="" />
								<img src="interfaz/images/header4.jpg" alt="" />
							</div>
						</div>
					</div>
					<div class="ic"></div>
					<script type="text/javascript" src="interfaz/lib/jquery-1.4.3.min.js"></script>
					<script type="text/javascript" src="interfaz/lib/jquery.nivo.slider.pack.js"></script>
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
					<div id="column1">
				
                      <h1>Formatos Compatibles</h1>
                      
                      	<h3>* MP3 </h3>
                      	<h3>* WAV</h3>
                      	<h3>* OGG</h3>
                      	<h3>* AAC</h3>
                      	<h3>* AC3</h3>
                      	<h3>* WMA</h3>
                    


					</div>
					<div id="column2">
					<h1>Acerca de Nosotros:</h1><br>
                     
                     <p>Somos dos estudiantes de Ingenieria del software, 
                     con alto nivel en programacion orientado a objetos. 
                     Actualmente cursamos el Bachillerato en tecnologias del software.</p> 
                

					</div>
					<div id="column3">
						
						<h1>Contactos:</h1><br>
                         
                         <h3>Henry Cordero:</h3>
                         <h4>henryjason2009@hotmail.com</h4>

                         <h3>Kenneth Aguilar:</h3>
                         <h4>klas120@hotmail.com</h4>


					</div>
					<div class="clear"></div>
				</div>
				
			</div>
		</div>
		<div id="footer_bot">
			<p>Todos los derechos reservados</p>
		</div>
	</body>
</html>
