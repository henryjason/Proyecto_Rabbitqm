<?php

class MainController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //$aviones = Avion::all();
		$this->layout->titulo = 'Conversion de Archivos';
		return $this->layout->nest('content', 'Main.main', array('aviones' => ""));
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

                   if($extension == 'mp3' || $extension == 'wav'){
                        // $name = $file->getClientOriginalName();
                         $name = $auto_string.'.'.$extension;
                         $file->move( 'public/Upload_Files/', $name);
                    }

    }


        $input = array(
        'url' =>'public/Upload_Files/'.$name,
        'formato' => $formato,
        'channel' => $auto_string
        );
 
         $id = Music::create($input)->id;

         $music = Music::findOrFail($id);
    		
    	 $music =  json_encode($music);

          //echo $music;

		  ModelCola::cola($music);
		  ModelCola::Receiving_msg($auto_string);

	    $this->layout->titulo = 'prueba';
		return $this->layout->nest('content', 'Main.main', array('aviones' => ""));	

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
