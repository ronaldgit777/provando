<?php

namespace App\Http\Controllers;

use App\Models\aula;
use Illuminate\Http\Request;
s
class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function  buscaraulas(Request $request)
    {   
       $buscaraula2 = $request->input('buscaraula');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = aula::obtenerlistaaulas($buscaraula2,$estadopro2);
       return response()->json($resultadoconsulta); 
    }
    public function index()
    {
       /* $datos['aulas']=aula::paginate(5);
        return view('aula.index',$datos);*/

        $datos['aulas']=aula::paginate(5);   
        $response = response()->view('aula.index',$datos)
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
       // return view('aula.create');
        return response()->view('aula.create')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosaula=request()->except('_token');
        aula::insert($datosaula);
        //return response()->json($datosprofesor);
        return redirect('aula');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function show(aula $aula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /* $aula=aula::findOrFail($id);
        //$sueldopro=sueldopro::get()->where('$id','=','12');
        return view('aula.edit',compact('aula'));*/

        $aula=aula::findOrFail($id);
        return response()->view('aula.edit',compact('aula'))->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $datosaula=request()->except(['_token','_method']);
        aula::where('id','=',$id)->update($datosaula);
        $aula=aula::findOrFail($id);
      //  return view('aula.edit',compact('aula'));
        return redirect('aula');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function destroy(aula $aula)
    {
        //
    }
}
