<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\asignarproma;

class materia extends Model
{
    protected $table = "materias";

    public function asignarpromas()
    {
        return $this->hasMany(asignarproma::class,'materia_id','id');
    }
    public function notas()
    {
        return $this->hasMany(nota::class,'materia_id','id');
    }

    public static function obtenerlistamaterias($buscarma2,$estadopro2 )
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::select('materias.*') 
              ->when($buscarma2, function ($query, $buscarma2) {
                  return $query->where(function ($query) use ($buscarma2) {
                      $query->where('materia', 'like', "%$buscarma2%")
                          ->orWhere('costo', 'like', "%$buscarma2%")
                          ;
                  });
              })  
              ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('materias.estado', '=', $estadopro2);
            }) 
                
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();
            ->select('materias.*')
            ->get();
        //return $fechaini;
    }
  
    public static function obtenermateriasasignadas()
    {      
       // return self::with('asignarpromas')->has('asignarpromas')->get();
       return self::whereIn('id', function ($query) {   //busca una seleccion
            $query->select('materia_id')
            ->where('asignarpromas.estado','activo')
                ->from('asignarpromas')
                    ->whereIn('id', function ($subquery) {
                        $subquery->select('asignarproma_id')
                            ->from('inscripcions');
                    });
        })->get();
    
    }
    public static function obtenermateriaproreporte($userid)
    {
        return static::join('asignarpromas','materias.id','=','asignarpromas.materia_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('materias.*')
       
        ->where('profesors.user_id','=',$userid)
        ->distinct()
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenermateriapro($userid)
    {
        return static::join('asignarpromas','materias.id','=','asignarpromas.materia_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('materias.*')
       // ->distinct()
        ->where('profesors.user_id','=',$userid)
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenermateriapronotas($userid)
    {
        return static::join('asignarpromas','materias.id','=','asignarpromas.materia_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('materias.*')
       ->distinct()
        ->where('profesors.user_id','=',$userid)
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenermateriaproalumno($userid)
    {
        return static::join('asignarpromas','materias.id','=','asignarpromas.materia_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('materias.*')
      
        ->where('profesors.user_id','=',$userid)
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
     ->distinct()
         ->get();  
    }
    public static function obtenermateriaprouser($userid)
    {
        return static::join('asignarpromas','materias.id','=','asignarpromas.materia_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('materias.*')
        ->where('profesors.user_id','=',$userid)
        ->where('asignarpromas.estado','=','activo')
        ->distinct()
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenerperiodoprouser($userid)
    {
        return static::join('asignarpromas','periodos.id','=','asignarpromas.periodo_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('periodos.*')
        ->where('profesors.user_id','=',$userid)
        ->where('asignarpromas.estado','=','activo')
        ->distinct()
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenermateriasecre()
    {
        return static::join('asignarpromas','materias.id','=','asignarpromas.materia_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('materias.*')
        //->where('secretarias.user_id','=',$userid)
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenermateriapronombre($userid)
    {
        return static::join('asignarpromas','materias.id','=','asignarpromas.materia_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('materias.*')
        ->where('profesors.user_id','=',$userid)
        ->distinct()
        //->where('asignarpromas.estado','activo')//mostrando todas las asignaciones activas
     //  ->asignarpromas()
         ->get();  
    }
    
}
