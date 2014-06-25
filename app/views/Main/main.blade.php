<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	

</head>

<body>


	<div align="leght">

     {{ Form::open(array(
     'url'=>'home/', 
     'method' => 'post',
     'class' => 'pure-form',
     'enctype'=>'multipart/form-data'
) )}}


{{Form::select('formato', array('mp3' => 'MP3', 'wav' => 'WAV', 'ogg' => 'OGG', 'aac' => 'AAC', 'ac3' => 'AC3', 'wma' => 'WMA'), 'mp3')}}

<br><br>

{{ Form::file('archivo')}}
<br><br>
{{ Form::submit('SUBIR ARCHVO') }}

{{ Form::close()}}     

<br><br>



<div id="dialog" title="Proyecto">
 <a id="link">DOWNLOAD LINK</a>
</div>

<div id="progressbar"></div>


	</div>


<script type="text/javascript">


//verificamos si la variable musica trae datos
<?php if (isset($music)) { ?>

// 
var id = (<?php echo $music->id ?>);

var sleep=setInterval(function(){llamadoAjax(id)},1000);


<?php } ?>


function progress(val) {
    $( "#progressbar" ).progressbar({
      value: val
    });
  }


function llamadoAjax(id){
	progress(25);

	$.ajax({
		url: '/home/'+id,
		type: 'GET'
	})
	.done(function(response) {
		
		//alert(response);
        
        var music = JSON.parse(response);
		//alert(music.id +" " + music.url);

         if(music.status == 1){

         	progress(100);
         clearInterval(sleep);
         

         $(function() {
    $( "#dialog" ).dialog();

     document.getElementById("link").href=music.url;

  });


         }else{
         	progress(75);
         }


		

	})
	.fail(function() {
		alert("error"); 
	});
	
}


	</script>


</body>
</html>
