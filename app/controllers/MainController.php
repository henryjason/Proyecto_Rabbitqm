<?php

class MainController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //$music = Music::all();
		$this->layout->titulo = 'Conversion de Archivos';
		return $this->layout->nest('content', 'Main.main', array('music' => null));
		//return View::make('Main.main');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		   $name = '';
		   $formato = Input::get('formato');
		   $auto_string = ModelCola::auto_string();

   	if(Input::hasFile('archivo')) {

   		  $file = Input::file('archivo');
           
          $extension = $file->getClientOriginalExtension();
          //$type = $file->getMimeType();

                   if($extension == 'mp3' || $extension == 'wav' || $extension == 'ogg' || $extension == 'wma' || $extension == 'ac3' || $extension == 'aac' || $extension == 'rm'){
                        // $name = $file->getClientOriginalName();
                         $name = $auto_string.'.'.$extension;
                         $file->move( 'public/Upload_Files/', $name);
                    }else{
                    	$this->layout->titulo = 'Conversion de Archivos';
		return $this->layout->nest('content', 'Main.main', array('music' => null));
                    }

    }


        $input = array(
        'url' =>'public/Upload_Files/'.$name,
        'formato' => $formato,
        'channel' => $auto_string
        );
            
            //creamos un nuevo registro 
         $id = Music::create($input)->id;

            //array del registro registrado
         $music = Music::findOrFail($id);
    		
    		//pasos a  json los resultados
    	 $json_music =  json_encode($music);


          //ponemos en cola  $json_music
		  ModelCola::cola($json_music);
           
           //esperamos la respuesta del servidor
		  $json_array = ModelCola::Receiving_msg($auto_string);

           //descodificamos el json que nos devuelve los woker
		  $MsgArray = json_decode($json_array);
           $url = $MsgArray->url;
           $formato = $MsgArray->formato;

           //actualizamos la nueva direccion donde se encuentra convertido
          $music->url = $url;
          $music->formato = $formato;
          $music->save();
 
	   
	      $this->layout->titulo = 'prueba';
	  	return $this->layout->nest('content', 'Main.main', array('music' =>  $music));	

	}




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
