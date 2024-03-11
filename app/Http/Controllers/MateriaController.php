<?php

namespace App\Http\Controllers;

use App\Models\materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  buscarmaterias(Request $request)
    {   
       $buscarma2 = $request->input('buscarma');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = materia::obtenerlistamaterias($buscarma2,$estadopro2 );
       return response()->json($resultadoconsulta); 
    }
    public function index()
    {
       /* $datos['materias']=materia::paginate(5);
        return view('materia.index',$datos);*/

        $datos['materias']=materia::paginate(5);  
        $response = response()->view('materia.index',$datos)
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate') // HTTP 1.1.
        ->header('Pragma', 'no-cache') // HTTP 1.0.
        ->header('Expires', '0'); // Proxies.
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('materia.create');
        return response()->view('materia.create')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosmateria=request()->except('_token');
        materia::insert($datosmateria);
        //return response()->json($datosprofesor);
        return redirect('materia');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /* $materia=materia::findOrFail($id);
        //$sueldopro=sueldopro::get()->where('$id','=','12');
        return view('materia.edit',compact('materia'));*/

        $materia=materia::findOrFail($id);
        return response()->view('materia.edit',compact('materia'))->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $datosmateria=request()->except(['_token','_method']);
        materia::where('id','=',$id)->update($datosmateria);
        $materia=materia::findOrFail($id);
        //return view('materia.edit',compact('materia'));
        return redirect('materia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(materia $materia)
    {
        //
    }
}
