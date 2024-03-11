<?php

namespace App\Http\Controllers;

use App\Models\periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  buscarperiodos(Request $request)
    {   
       $buscarpe2 = $request->input('buscarpe');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = periodo::obtenerlistaperiodos($buscarpe2, $estadopro2);
       return response()->json($resultadoconsulta); 
    }
    public function index()
    {
       /* $datos['periodos']=periodo::paginate(5);
        return view('periodo.index',$datos);*/

        
        $datos['periodos']=periodo::paginate(5); 
        $response = response()->view('periodo.index',$datos)
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
        //return view('periodo.create');
        return response()->view('periodo.create')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosperiodo=request()->except('_token');
        periodo::insert($datosperiodo);
        //return response()->json($datosprofesor);
        return redirect('periodo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show(periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$periodo=periodo::findOrFail($id);
        //$sueldopro=sueldopro::get()->where('$id','=','12');
        return view('periodo.edit',compact('periodo'));*/

        $periodo=periodo::findOrFail($id);
        return response()->view('periodo.edit',compact('periodo'))->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $datosperiodo=request()->except(['_token','_method']);
        periodo::where('id','=',$id)->update($datosperiodo);
        $periodo=periodo::findOrFail($id);
       // return view('periodo.edit',compact('periodo'));
        return redirect('periodo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(periodo $periodo)
    {
        //
    }
}
