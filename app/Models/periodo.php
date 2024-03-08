<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periodo extends Model
{
    protected $table = "periodos";
   /* public static function obtenerPeriodosDisponibles($aulaId)
    {
        $periodosAula = Asignarproma::where('aula_id', $aulaId)->pluck('periodo_id');  
        $periodosProfesor = Asignarproma::where('profesor_id', $profesorId)->pluck('periodo_id'); 

        $periodosUsados = $periodosAula->merge($periodosProfesor); 

        $periodosDisponibles = Periodo::whereNotIn('id', $periodosUsados) ->get(); 
        
        return $periodosDisponibles;
    }*/
    public static function obtenerperiodoprouser($userid)
    {
        return static::join('asignarpromas','periodos.id','=','asignarpromas.periodo_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('periodos.*')
        //
        ->where('profesors.user_id','=',$userid)
       ->where('asignarpromas.estado','activo')
       ->distinct()
     //  ->asignarpromas()
         ->get();  
    }
    
    public static function obtenerPeriodosDisponibles($aulaId, $profesorId)
    {
        $periodosAula = Asignarproma::where('aula_id', $aulaId)->where('estado','activo')
        ->pluck('periodo_id');  
        $periodosProfesor = Asignarproma::where('profesor_id', $profesorId)->where('estado','activo')
        ->pluck('periodo_id'); 

        $periodosUsados = $periodosAula->merge($periodosProfesor); 

        $periodosDisponibles = Periodo::whereNotIn('id', $periodosUsados) ->get(); 
        
        return $periodosDisponibles;
    }
    

    public static function obtenerlistaperiodos($buscarpe2, $estadopro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::select('periodos.*') 
              ->when($buscarpe2, function ($query, $buscarpe2) {
                  return $query->where(function ($query) use ($buscarpe2) {
                      $query->where('periodo', 'like', "%$buscarpe2%")
                         // ->orWhere('estado', 'like', "%$buscaraula2%")
                          ;
                  });
              })  
              ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('periodos.estado', '=', $estadopro2);
            }) 
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();
            ->select('periodos.*')
            ->get();
        //return $fechaini;
    }
    public static function obtenerperiodopro($userid)
    {
        return static::join('asignarpromas','periodos.id','=','asignarpromas.periodo_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('periodos.*')
       ->distinct()
        ->where('profesors.user_id','=',$userid)
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenerperiodopronotas($userid)
    {
        return static::join('asignarpromas','periodos.id','=','asignarpromas.periodo_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('periodos.*')
       ->distinct()
        ->where('profesors.user_id','=',$userid)
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenerperiodoproalumno($userid)
    {
        return static::join('asignarpromas','periodos.id','=','asignarpromas.periodo_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('periodos.*')
       // 
        ->where('profesors.user_id','=',$userid)
        ->distinct()
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenerperiodoproreporte($userid)
    {
        return static::join('asignarpromas','periodos.id','=','asignarpromas.periodo_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('periodos.*')
        ->distinct()
        ->where('profesors.user_id','=',$userid)
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
}
