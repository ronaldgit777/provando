<?php namespace App\Custom;
use App\Models\profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyClass 
{
    public function sueldorpo($id)
    {
       // $profesor=profesor::findOrFail($id);
        //return view('profesor.sueldorpo',compact('profesor'));
        return view('profesor.sueldorpo');
        
    }
}
?>