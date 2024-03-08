<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class asignarproma extends Model
{
    protected $fillable = [
        'fechadeasignacion',
        'profesor_id',
        'materia_id',
        'aula_id',
        'periodo_id',
        'estado',
    ];
    protected $table = "asignarpromas";
    
   
    public function profesor()
    {
        return $this->belongsTo(profesor::class,'profesor_id');
    }
    public function materia()
    {
        return $this->belongsTo(materia::class,'materia_id');
    }
    public function aula()
    {
        return $this->belongsTo(aula::class,'aula_id');
    }
    public function periodo()
    {
        return $this->belongsTo(periodo::class,'periodo_id');
    }
    
    public static function existeRegistroEnPeriodoYAula($periodoId, $aulaId)
    {
        return static::where('periodo_id', $periodoId)
            ->where('aula_id', $aulaId)
            ->where('estado', 'activo')
            ->exists();
    }
    

    public function inscripcion()
    {
        return $this->hasMany(inscripcion::class,'asignarproma_id','id');
    }


    public static function obtenerprofesores($alumnoid2)
    {
        //Mover al modelo profesor
        return Profesor::select('profesors.*')
        ->join('asignarpromas', 'asignarpromas.profesor_id', '=', 'profesors.id')
        ->where('asignarpromas.estado', 'activo')
        ->whereNotIn('asignarpromas.materia_id', function ($query) use ($alumnoid2) {
            $query->select('asignarpromas.materia_id')
                ->from('inscripcions')
                ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
                ->where('inscripcions.alumno_id', $alumnoid2)
                ->where('inscripcions.estado', 'activo');
        })
        ->where(function ($query) use ($alumnoid2) {
            $query->whereNotIn('asignarpromas.periodo_id', function ($subquery) use ($alumnoid2) {
                $subquery->select('asignarpromas.periodo_id')
                    ->from('inscripcions')
                    ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
                    ->where('inscripcions.alumno_id', $alumnoid2)
                    ->where('asignarpromas.profesor_id', '!=', 'profesor_id')
                    ->where('inscripcions.estado', 'activo');
            });
        })
        ->distinct()
        ->get();
    }

    

    public static function obtenermateriaprofesorid($profesorid2, $alumnoid2)
    {   
        // >select('profesor_id')
        // ->distinct()
        // ->get();

        return static::where('profesor_id', $profesorid2)
        ->where('asignarpromas.estado', 'activo')
        -> whereNotIn('asignarpromas.periodo_id', function ($query) use ($alumnoid2) {
            $query->select('asignarpromas.periodo_id')
                ->from('inscripcions')
                ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
                ->where('inscripcions.alumno_id', $alumnoid2)
                ->where('inscripcions.estado', 'activo');
                })
                -> whereNotIn('asignarpromas.materia_id', function ($query) use ($alumnoid2) {
                    $query->select('asignarpromas.materia_id')
                        ->from('inscripcions')
                        ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
                        ->where('inscripcions.alumno_id', $alumnoid2)
                        ->where('inscripcions.estado', 'activo');
                        })
        ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
        ->select('materias.*')
        ->distinct()
        ->orderBy('materias.materia', 'asc')
        ->get();

    }
    public static function obtenerperimateriaprofesorid($profesorid2,$materiaid2,$alumnoid2)
    {
        return static::where('asignarpromas.profesor_id', $profesorid2)
            ->where('asignarpromas.materia_id', $materiaid2)
            ->where('asignarpromas.estado', 'activo')
            -> whereNotIn('asignarpromas.periodo_id', function ($query) use ($alumnoid2) {
                $query->select('asignarpromas.periodo_id')
                    ->from('inscripcions')
                    ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
                    ->where('inscripcions.alumno_id', $alumnoid2)
                    ->where('inscripcions.estado', 'activo');
                    })
                    
            ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
            ->select('periodos.id as periodo_id', 'periodos.periodo as periodo_nombre')
            ->get();
    }
    public static function obteneraulaperimateriaprofesorid($profesorid2,$materiaid2,$periodoid2)
    {
        return static::where('asignarpromas.profesor_id', $profesorid2)
        ->where('asignarpromas.materia_id', $materiaid2)
        ->where('asignarpromas.periodo_id', $periodoid2)
        ->where('asignarpromas.estado', 'activo')
        ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
        ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
        ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
        ->select('materias.costo as costo_ma', 'aulas.aula as aula_nombre','asignarpromas.id as asig_id')
        ->get();
    }
    public static function obtenerfecchainicioasignaciones($fechaini,$fechafin,$buscaras2, $estadopro2 )
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::
              when($fechaini, function ($query, $fechaini) {
                  return $query->where('asignarpromas.fechadeasignacion', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('asignarpromas.fechadeasignacion', '<=', $fechafin);
              })   
              ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('asignarpromas.estado', '=', $estadopro2);
            }) 
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
                ->when($buscaras2, function ($query, $buscarin2) {
                return $query->where(function ($query) use ($buscarin2) {
                 // $query->where('asignarpromas.asignarproma_id', 'like', "%$buscarin2%");
                    $query->where('profesors.nombre', 'like', "%$buscarin2%")
                         ->orWhere('profesors.apellidopaterno', 'like', "%$buscarin2%") ->orWhere('profesors.apellidomaterno', 'like', "%$buscarin2%")
                        ->orWhere('materias.materia', 'like', "%$buscarin2%")
                        ->orWhere('materias.costo', 'like', "%$buscarin2%")
                        ->orWhere('periodos.periodo', 'like', "%$buscarin2%")
                        ->orWhere('aulas.aula', 'like', "%$buscarin2%");
                });
            })   
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();
            ->select(
                'asignarpromas.*','fechadeasignacion',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as apepa_profesor','profesors.apellidomaterno as apema_profesor',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
              return $consulta->get();  //return $fechaini;
    }
    public static function obtenerdatosde3tablaas()
    {
        return static
        ::
        //where('asignarpromas.estado', 'activo')
            //->
            join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
            ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
            ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
            ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
            ->select(
                'asignarpromas.*','fechadeasignacion',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as apepa_profesor','profesors.apellidomaterno as apema_profesor',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            )->orderBy('aulas.aula', 'asc')
            ->get();
    }
    public static function obtenerfecchainicioasignacionesresecre($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2,$estadoasig2 ,$ordenarasig2, $mayorymenorasig2 )
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::
       
             when($fechaini, function ($query, $fechaini) {
                  return $query->where('asignarpromas.fechadeasignacion', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('asignarpromas.fechadeasignacion', '<=', $fechafin);
              })   
             // ->where('asignarpromas.estado', 'activo')
            ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')

            ->when($profesorid2, function ($query, $profesorid2) {
                return $query->where('profesors.id',$profesorid2);
                })
            ->when($materiaid2, function ($query, $materiaid2) {
                return $query->where('materias.id',$materiaid2);
                })
            ->when($periodoid2, function ($query, $periodoid2) {
                return $query->where('periodos.id',$periodoid2);
                })
            ->when($aulaid2, function ($query, $aulaid2) {
                return $query->where('aulas.id',$aulaid2);
                }) 
                ->when($estadoasig2, function ($query, $estadoasig2) {
                    return $query->where('asignarpromas.estado',$estadoasig2);
                    }) 
            ->select(
                'asignarpromas.*','fechadeasignacion',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesor_apellidopaterno','profesors.apellidomaterno as profesor_apellidomaterno',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
            //aqui tienes q poenr en la vista los opciones del seelc de ordenar m tiene q ser lo q buscas
            if (!empty($ordenarasig2) && !empty($mayorymenorasig2)) {
                $consulta->orderBy($ordenarasig2, $mayorymenorasig2);
            }
              return $consulta->get();  //return $fechaini;
              
             /* ->where('profesors.id', 'like', "%$profesorid2%") 
              ->where('materias.id', 'like', "%$materiaid2%")               y
              ->where('periodos.id', 'like', "%$periodoid2%") 
              ->where('aulas.id', 'like', "%$aulaid2%") */
    }
    public static function obtenerfecchainicioasignacionesre($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2,$estadoasig2 ,$ordenarasig2, $mayorymenorasig2 )
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::
       
             when($fechaini, function ($query, $fechaini) {
                  return $query->where('asignarpromas.fechadeasignacion', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('asignarpromas.fechadeasignacion', '<=', $fechafin);
              })   
             // ->where('asignarpromas.estado', 'activo')
            ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')

            ->when($profesorid2, function ($query, $profesorid2) {
                return $query->where('profesors.id',$profesorid2);
                })
            ->when($materiaid2, function ($query, $materiaid2) {
                return $query->where('materias.id',$materiaid2);
                })
            ->when($periodoid2, function ($query, $periodoid2) {
                return $query->where('periodos.id',$periodoid2);
                })
            ->when($aulaid2, function ($query, $aulaid2) {
                return $query->where('aulas.id',$aulaid2);
                }) 
                ->when($estadoasig2, function ($query, $estadoasig2) {
                    return $query->where('asignarpromas.estado',$estadoasig2);
                    }) 
            ->select(
                'asignarpromas.*','asignarpromas.fechadeasignacion',
               'profesors.nombre as profesor_nombre','profesors.apellidopaterno as apellidopaterno','profesors.apellidomaterno as apellidomaterno',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
            //aqui tienes q poenr en la vista los opciones del seelc de ordenar m tiene q ser lo q buscas
            if (!empty($ordenarasig2) && !empty($mayorymenorasig2)) {
                $consulta->orderBy($ordenarasig2, $mayorymenorasig2);
            }
              return $consulta->get();  //return $fechainio
    }
    public static function obtenerdatosde3tabla()
    {
        return static
        ::
        //where('inscripcions.estado', 'activo')
        //->
        join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
            ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
            ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
            ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
            ->select(
                'asignarpromas.*','asignarpromas.fechadeasignacion',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as apepa_profesor','profesors.apellidomaterno as apema_profesor',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            )
            ->get();
    }

    public static function obtenerasignarcionproreporte($userid)
    {
        return static::join('profesors','asignarpromas.profesor_id','=','profesors.id')
        -> join('materias','asignarpromas.materia_id','=','materias.id')
        -> join('aulas','asignarpromas.aula_id','=','aulas.id')
        -> join('periodos','asignarpromas.periodo_id','=','periodos.id')  
        ->join('users','users.id','=','profesors.user_id')
        ->select('asignarpromas.*','asignarpromas.fechadeasignacion',
        'profesors.nombre as profesor_nombre','profesors.apellidopaterno as apepa_profesor','profesors.apellidomaterno as apema_profesor',
        'materias.materia as materia_nombre',
        'materias.costo as materia_costo',
        'periodos.periodo as periodo_nombre',
        'aulas.aula as aula_nombre')
        ->where('profesors.user_id','=',$userid)
     // ->where('asignarpromas.estado','activo')//que muestre asignacioen activas del profesor
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenerasignarcionpro($userid)
    {
        return static::join('profesors','asignarpromas.profesor_id','=','profesors.id')
        -> join('materias','asignarpromas.materia_id','=','materias.id')
        -> join('aulas','asignarpromas.aula_id','=','aulas.id')
        -> join('periodos','asignarpromas.periodo_id','=','periodos.id')  
        ->join('users','users.id','=','profesors.user_id')
        ->select('asignarpromas.*','asignarpromas.estado','profesors.nombre as profesor_nombre','profesors.apellidopaterno as apepa_profesor','profesors.apellidomaterno as apema_profesor'
        ,'profesors.user_id','materias.materia as nombre_materia','aulas.aula as nombre_aula','periodos.periodo as nombre_periodo')
        ->where('profesors.user_id','=',$userid)
      ->where('asignarpromas.estado','activo')//que muestre asignacioen activas del profesor
     //  ->asignarpromas()
         ->get();  
    }
    public static function obtenerfecchainicioalumnoprofeuserreporte($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2,$estado2, $alumno_nombre2,$alumno_apepa2, $alumno_apema2 ,$ordenarasig2,$mayorymenorasig2,$userid)
    {      
        // Ejemplo de obtención del ssueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::join('inscripcions','asignarpromas.id','=','inscripcions.asignarproma_id')
                ->join('alumnos','inscripcions.alumno_id','=','alumnos.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
              ->join('users','users.id','=','profesors.user_id')
              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('alumnos.fechadeingreso', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('alumnos.fechadeingreso', '<=', $fechafin);
              })   
              ->when($materiaid2, function ($query, $materiaid2) {
                return $query->where('materias.id', '=', $materiaid2);
            })   
            ->when($periodoid2, function ($query, $periodoid2) {
                return $query->where('periodos.id', '=', $periodoid2);
            }) 
            ->when($aulaid2, function ($query, $aulaid2) {
                return $query->where('aulas.id', '=', $aulaid2);
            }) 
            ->when($estado2, function ($query, $estado2) {
                return $query->where('asignarpromas.estado', '=', $estado2);
            }) 
            ->when($alumno_nombre2, function ($query, $alumno_nombre2) {
                return $query->where('alumnos.nombre', '=', $alumno_nombre2);
            }) 
            ->when($alumno_apepa2, function ($query, $alumno_apepa2) {
                return $query->where('alumnos.apellidopaterno', '=', $alumno_apepa2);
            }) 
            ->when($alumno_apema2, function ($query, $alumno_apema2) {
                return $query->where('alumnos.apellidomaterno', '=', $alumno_apema2);
            }) 
            ->where('profesors.user_id','=',$userid)
            //->where('asignarpromas.estado','=','activo')
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();6
            ->select(
                'alumnos.*',
                'asignarpromas.*','asignarpromas.estado as asignarpromas_estado',
                'profesors.nombre as profesor_nombre',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
            if (!empty($ordenarasig2) && !empty($mayorymenorasig2)) {
                $consulta->orderBy($ordenarasig2, $mayorymenorasig2);
            }
            //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
              return $consulta->get();  //return $fechaini;
    }
    public static function obtenerfecchainicioasigprofeuser($fechaini,$fechafin,$estadoasig2,$userid)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::join('inscripcions','asignarpromas.id','=','inscripcions.asignarproma_id')
                ->join('alumnos','inscripcions.alumno_id','=','alumnos.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
              ->join('users','users.id','=','profesors.user_id')
              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('asignarpromas.fechadeasignacion', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('asignarpromas.fechadeasignacion', '<=', $fechafin);
              })   
            ->when($estadoasig2, function ($query, $estadoasig2) {
                return $query->where('asignarpromas.estado', '=', $estadoasig2);
            }) 
            ->where('profesors.user_id','=',$userid)
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();6
            ->select(
                'alumnos.*',
                 'asignarpromas.*','fechadeasignacion','asignarpromas.estado',  
                'profesors.nombre as profesor_nombre',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
            //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
              return $consulta->get();  //return $fechaini;
    }
    public static function obtenerfecchainicioasigprofeuserreporte($fechaini,$fechafin,$materiaid2,$periodoid2,$aulaid2, $estadoasig2,$userid)
    {    
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       $consulta = self::
       //join('inscripcions','asignarpromas.id','=','inscripcions.asignarproma_id')
               //join('alumnos','inscripcions.alumno_id','=','alumnos.id')
             join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
             ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
             ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
             ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
             ->join('users','users.id','=','profesors.user_id')
             ->when($fechaini, function ($query, $fechaini) {
                 return $query->where('asignarpromas.fechadeasignacion', '>=', $fechaini);
             })
             ->when($fechafin, function ($query, $fechafin) {
                 return $query->where('asignarpromas.fechadeasignacion', '<=', $fechafin);
             })   
             ->when($materiaid2, function ($query, $materiaid2) {
               return $query->where('materias.materia', '=', $materiaid2);
           })   
           ->when($periodoid2, function ($query, $periodoid2) {
               return $query->where('periodos.periodo', '=', $periodoid2);
           }) 
           ->when($aulaid2, function ($query, $aulaid2) {
               return $query->where('aulas.aula', '=', $aulaid2);
           }) 
           ->when($estadoasig2, function ($query, $estadoasig2) {
               return $query->where('asignarpromas.estado', '=', $estadoasig2);
           }) 
           ->where('profesors.user_id','=',$userid)
            // ->select('profesors.*', 'users.email', 'users.role')
           //  ->get();6
           ->select(
               //'alumnos.*',
                'asignarpromas.*','fechadeasignacion','asignarpromas.estado as nombre_estado',  
              // 'profesors.nombre as profesor_nombre',
               'profesors.nombre as profesor_nombre','profesors.apellidopaterno as apellidopaterno','profesors.apellidomaterno as apellidomaterno',
               'materias.materia as materia_nombre',
               'materias.costo as materia_costo',
               'periodos.periodo as periodo_nombre',
               'aulas.aula as aula_nombre'
           );
           //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
             return $consulta->get();  //return $fechaini;
    }
    public static function obtenerfecchainicionotasprofeuser($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2, 
    $alumno_nombre2,$alumno_apepa2, $alumno_apema2 ,$promin2 ,$promax2,$estado2, $ordenarasig2, $mayorymenorasig2,$userid)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::join('inscripcions','asignarpromas.id','=','inscripcions.asignarproma_id')
                ->join('alumnos','inscripcions.alumno_id','=','alumnos.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
              ->join('users','users.id','=','profesors.user_id')
              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('alumnos.fechadeingreso', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('alumnos.fechadeingreso', '<=', $fechafin);
              })   
              ->when($materiaid2, function ($query, $materiaid2) {
                return $query->where('materias.id', '=', $materiaid2);
            })   
            ->when($periodoid2, function ($query, $periodoid2) {
                return $query->where('periodos.id', '=', $periodoid2);
            }) 
            ->when($aulaid2, function ($query, $aulaid2) {
                return $query->where('aulas.id', '=', $aulaid2);
            }) 
            ->when($alumno_nombre2, function ($query, $alumno_nombre2) {
                return $query->where('alumnos.nombre', '=', $alumno_nombre2);
            }) 
            ->when($alumno_apepa2, function ($query, $alumno_apepa2) {
                return $query->where('alumnos.apellidopaterno', '=', $alumno_apepa2);
            }) 
            ->when($alumno_apema2, function ($query, $alumno_apema2) {
                return $query->where('alumnos.apellidomaterno', '=', $alumno_apema2);
            }) 
            ->when($estado2, function ($query, $estado2) {
                return $query->where('asignarpromas.estado', '=', $estado2);
            }) 
            ->where('profesors.user_id','=',$userid)    
            //->with(['promedioNotas'])
            ->select(
                'alumnos.*','alumnos.id as alumnoid','alumnos.nombre as alumno_nombre','alumnos.apellidopaterno as alumno_paterno','alumnos.apellidomaterno as alumno_materno',
                'asignarpromas.*','asignarpromas.id as asignarid','inscripcions.*','fechadeasignacion','asignarpromas.estado as nombre_estado',  
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesors_paterno','profesors.apellidomaterno as profesor_materno',
                'materias.materia as materia_nombre','materias.id as materiaid',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre',
                DB::raw('ROUND((SELECT AVG(nota) FROM notas 
                WHERE notas.alumno_id = alumnos.id and notas.materia_id = materias.id), 1) 
                as promedio_notas')
            )
            ->when($promin2, function ($query, $promin2) {
                return $query->having('promedio_notas', '>=', $promin2);
            })
            ->when($promax2, function ($query, $promax2) {
                return $query->having('promedio_notas', '<=', $promax2);
            })  ;
            if (!empty($ordenarasig2) && !empty($mayorymenorasig2)) {
                $consulta->orderBy($ordenarasig2, $mayorymenorasig2);
            }
            //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
              return $consulta->get();  //return $fechaini;s
    }

    public static function obtenerfecchainicionotassecreuser($fechaini,$fechafin,$materiaid2,$periodoid2,$aulaid2, 
    $alumno_nombre2,$alumno_apepa2, $alumno_apema2 ,$promin2 ,$promax2, $ordenarasig2, $mayorymenorasig2,$userid,$estado2)
    {      
        $consulta = self::join('inscripcions','asignarpromas.id','=','inscripcions.asignarproma_id')
                ->join('alumnos','inscripcions.alumno_id','=','alumnos.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
              ->join('users','users.id','=','profesors.user_id')
              ->when($fechaini, function ($query, $fechaini) {
                return $query->where('alumnos.fechadeingreso', '>=', $fechaini);
            })
            ->when($fechafin, function ($query, $fechafin) {
                return $query->where('alumnos.fechadeingreso', '<=', $fechafin);
            })   
            ->when($materiaid2, function ($query, $materiaid2) {
                return $query->where('materias.id', '=', $materiaid2);
            })   
            ->when($periodoid2, function ($query, $periodoid2) {
                return $query->where('periodos.id', '=', $periodoid2);
            }) 
            ->when($aulaid2, function ($query, $aulaid2) {
                return $query->where('aulas.id', '=', $aulaid2);
            }) 
            ->when($alumno_nombre2, function ($query, $alumno_nombre2) {
                return $query->where('alumnos.nombre', '=', $alumno_nombre2);
            }) 
            ->when($alumno_apepa2, function ($query, $alumno_apepa2) {
                return $query->where('alumnos.apellidopaterno', '=', $alumno_apepa2);
            }) 
            ->when($alumno_apema2, function ($query, $alumno_apema2) {
                return $query->where('alumnos.apellidomaterno', '=', $alumno_apema2);
            }) 
            ->when($estado2, function ($query, $estado2) {
                return $query->where('asignarpromas.estado', '=', $estado2);
            }) 
             //->where('secretarias.user_id','=',$userid)
            //->with(['promedioNotas'])
            ->select('alumnos.*','alumnos.nombre as alumno_nombre','alumnos.apellidopaterno as alumno_paterno','alumnos.apellidomaterno as alumno_materno',
            'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesors_paterno','profesors.apellidomaterno as profesor_materno',
            'materias.materia as materia_nombre','materias.id as materiaid',
            //'materias.costo as materia_costo',
            'periodos.periodo as periodo_nombre',
            'aulas.aula as aula_nombre','asignarpromas.estado as asignarpromas_estado',
        DB::raw('ROUND((SELECT AVG(nota) FROM notas 
        WHERE notas.alumno_id = alumnos.id and notas.materia_id = materias.id), 1) 
        as promedio_notas')
        )
        
            ->when($promin2, function ($query, $promin2) {
                return $query->having('promedio_notas', '>=', $promin2);
            })
            ->when($promax2, function ($query, $promax2) {
                return $query->having('promedio_notas', '<=', $promax2);
            })  ;
            // ->join('profesors','users.id','=','profesors.user_id')
            if (!empty($ordenarasig2) && !empty($mayorymenorasig2)) {
                $consulta->orderBy($ordenarasig2, $mayorymenorasig2);
            }
            //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
              return $consulta->get();  //return $fechaini;
    }

    public static function obtenerfecchainicionotassecreuserrol($fechaini,$fechafin,$materiaid2,$periodoid2,$aulaid2, 
    $alumno_nombre2,$alumno_apepa2, $alumno_apema2 ,$promin2 ,$promax2,$estado2, $ordenarasig2, $mayorymenorasig2,$userid)
    {      
        $consulta = self::join('inscripcions','asignarpromas.id','=','inscripcions.asignarproma_id')
                ->join('alumnos','inscripcions.alumno_id','=','alumnos.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
              ->join('users','users.id','=','profesors.user_id')

              ->when($fechaini, function ($query, $fechaini) {
                return $query->where('alumnos.fechadeingreso', '>=', $fechaini);
            })
            ->when($fechafin, function ($query, $fechafin) {
                return $query->where('alumnos.fechadeingreso', '<=', $fechafin);
            })   
            ->when($materiaid2, function ($query, $materiaid2) {
                return $query->where('materias.id', '=', $materiaid2);
            })   
            ->when($periodoid2, function ($query, $periodoid2) {
                return $query->where('periodos.id', '=', $periodoid2);
            }) 
            ->when($aulaid2, function ($query, $aulaid2) {
                return $query->where('aulas.id', '=', $aulaid2);
            }) 
            ->when($alumno_nombre2, function ($query, $alumno_nombre2) {
                return $query->where('alumnos.nombre', '=', $alumno_nombre2);
            }) 
            ->when($alumno_apepa2, function ($query, $alumno_apepa2) {
                return $query->where('alumnos.apellidopaterno', '=', $alumno_apepa2);
            }) 
            ->when($alumno_apema2, function ($query, $alumno_apema2) {
                return $query->where('alumnos.apellidomaterno', '=', $alumno_apema2);
            }) 
            ->when($estado2, function ($query, $estado2) {
                return $query->where('asignarpromas.estado', '=', $estado2);
            }) 
             //->where('secretarias.user_id','=',$userid)
            //->with(['promedioNotas'])
            ->select(
                'alumnos.*','alumnos.id as alumnoid','alumnos.nombre as alumno_nombre','alumnos.apellidopaterno as alumno_paterno','alumnos.apellidomaterno as alumno_materno',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesors_paterno','profesors.apellidomaterno as profesor_materno','inscripcions.*',
            'materias.materia as materia_nombre','materias.id as materiaid',
            'asignarpromas.estado as asignarproma_estado',
            'periodos.periodo as periodo_nombre',
            'aulas.aula as aula_nombre',
        DB::raw('ROUND((SELECT AVG(nota) FROM notas 
        WHERE notas.alumno_id = alumnos.id and notas.materia_id = materias.id), 1) 
        as promedio_notas')
        )
            ->when($promin2, function ($query, $promin2) {
                return $query->having('promedio_notas', '>=', $promin2);
            })
            ->when($promax2, function ($query, $promax2) {
                return $query->having('promedio_notas', '<=', $promax2);
            })  ;
            // ->join('profesors','users.id','=','profesors.user_id')
            // if (!empty($ordenarasig2) && !empty($mayorymenorasig2)) {
            //     $consulta->orderBy($ordenarasig2, $mayorymenorasig2);
            // }
            //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
              return $consulta->get();  //return $fechaini;
    }
    
}
