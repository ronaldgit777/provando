<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aula extends Model
{
    protected $table = "aulas";

    public static function obtenerlistaaulas($buscaraula2,$estadopro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::select('aulas.*') 
              ->when($buscaraula2, function ($query, $buscaraula2) {
                  return $query->where(function ($query) use ($buscaraula2) {
                      $query->where('aula', 'like', "%$buscaraula2%")
                         // ->orWhere('estado', 'like', "%$buscaraula2%")
                          ;
                  });
              })  
                ->when($estadopro2, function ($query, $estadopro2) {
                    return $query->where('aulas.estado', '=', $estadopro2);
                }) 
                
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();
            ->select('aulas.*')
            ->get();
        //return $fechaini;
    }
    public static function obteneraulaproreporte($userid)
    {
        return static::join('asignarpromas','aulas.id','=','asignarpromas.aula_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('aulas.*')//aqui falta arrelar
        ->where('profesors.user_id','=',$userid)
     //->where('asignarpromas.estado','activo')
     //  ->asignarpromas()
         ->distinct()
         ->get();  
    }
    public static function obteneraulapro($userid)
    {
        return static::join('asignarpromas','aulas.id','=','asignarpromas.aula_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('aulas.*')
        ->where('profesors.user_id','=',$userid)
     //   ->where('asignarpromas.estado','activo')
     //  ->asignarpromas()
         //->distinct()
         ->get();  
    }
    public static function obteneraulapronotas($userid)
    {
        return static::join('asignarpromas','aulas.id','=','asignarpromas.aula_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('aulas.*')
        ->distinct()
        ->where('profesors.user_id','=',$userid)
     //   ->where('asignarpromas.estado','activo')
     //  ->asignarpromas()
         //->distinct()
         ->get();  
    }
    public static function obteneraulaproalumno($userid)
    {
        return static::join('asignarpromas','aulas.id','=','asignarpromas.aula_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('aulas.*')
        ->where('profesors.user_id','=',$userid)
     //   ->where('asignarpromas.estado','activo')
     //  ->asignarpromas()
         ->distinct()
         ->get();  
    }
    public static function obteneraulasDisponibles( $profesorId)
    {//falta solucionar
        $periodosNoAsignados = Periodo::whereNotIn('id', function ($query) use ($profesorId) {
            $query->select('periodo_id')
                ->from('asignarpromas')
                ->where('estado', 'activo')
                ->where('profesor_id', $profesorId);
        })
        ->pluck('id');
        $aulasNoAsignadas = Aula::whereNotIn('id', function ($query) use ($profesorId, $periodosNoAsignados) {
            $query->select('aula_id')
                ->from('asignarpromas')
                ->where('estado', 'activo')
                ->whereIn('periodo_id', $periodosNoAsignados    )
                ->groupBy('aula_id')
                ->havingRaw('COUNT(DISTINCT periodo_id) = ?', [count($periodosNoAsignados)]);
        })
        ->get();
        return $aulasNoAsignadas;
    }
    public static function obteneraulaprouser($userid)
    {
        return static::join('asignarpromas','aulas.id','=','asignarpromas.aula_id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('aulas.*')
        ->where('profesors.user_id','=',$userid)
        ->where('asignarpromas.estado','activo')
        ->distinct()
     //  ->asignarpromas()
         //->distinct()
         ->get();  
    }

}
