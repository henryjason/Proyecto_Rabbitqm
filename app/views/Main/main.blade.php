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
     'url'=>'home/', 
     'method' => 'post',
     'enctype'=>'multipart/form-data'
) )}}

{{ Form::label('formato', 'Formato')}}
    
    <select name="formato">
    	<option value='mp3'>MP3</option>
    	<option value='wav'>WAV</option>
    	<option value='ogg'>ogg</option>
    	<option value='amr'>ARM</option>
    	<option value='ac3'>AC3</option>
    	<option value='Wma'>WMA</option>
    </select>

<br>

{{ Form::file('archivo') }}
<br>
{{ Form::submit('subir') }}

{{ Form::close()}}     

<br>




<?php



if($music != null){

//descodificamos el json que nos devuelve el controlador
		  $MsgArray = json_decode($music);
          $url = $MsgArray->url;
           echo "Link: ", '<a href="'.$url.'">Descargar</a>', "\n";
}

?>



	</div>
</body>
</html>
