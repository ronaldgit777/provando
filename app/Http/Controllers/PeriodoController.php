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
        $datos['periodos']=periodo::paginate(5);
        return view('periodo.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periodo.create');
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
        $periodo=periodo::findOrFail($id);
        //$sueldopro=sueldopro::get()->where('$id','=','12');
        return view('periodo.edit',compact('periodo'));
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
