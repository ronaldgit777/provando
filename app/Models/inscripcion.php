<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscripcion extends Model
{
    protected $table = "inscripcions";
   
    public function asignarproma()
    {
        return $this->belongsTo(asignarproma::class,'asignarproma_id');
    }

    public function alumno()
    {
        return $this->belongsTo(alumno::class,'alumno_id');
    }




    public static function obtenerfecchainicioinscripcion($fechaini,$fechafin,$buscarin2,$estadopro2 )
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::
              when($fechaini, function ($query, $fechaini) {
                  return $query->where('inscripcions.fechadeinscripcion', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('inscripcions.fechadeinscripcion', '<=', $fechafin);
              })   
              ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('inscripcions.estado', '=', $estadopro2);
            }) 
              ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('alumnos', 'inscripcions.alumno_id', '=', 'alumnos.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
              ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
                ->when($buscarin2, function ($query, $buscarin2) {
                return $query->where(function ($query) use ($buscarin2) {
                 // $query->where('asignarpromas.asignarproma_id', 'like', "%$buscarin2%");
                    $query->where('alumnos.nombre', 'like', "%$buscarin2%")
                        ->orWhere('profesors.nombre', 'like', "%$buscarin2%")->orWhere('profesors.apellidopaterno', 'like', "%$buscarin2%")->orWhere('profesors.apellidomaterno', 'like', "%$buscarin2%")
                        ->orWhere('materias.materia', 'like', "%$buscarin2%")
                        ->orWhere('materias.costo', 'like', "%$buscarin2%")
                        ->orWhere('periodos.periodo', 'like', "%$buscarin2%")
                        ->orWhere('aulas.aula', 'like', "%$buscarin2%");
                });
            })   
            ->select(
                'inscripcions.*','fechadeinscripcion',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesor_apellidopaterno','profesors.apellidomaterno as profesor_apellidomaterno',
                'alumnos.nombre as alumno_nombre',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
              return $consulta->get();       
        //return $fechaini;
    }
    public static function obtenerdatosde3tabla()
    {   
        return static
        ::
        //where('inscripcions.estado', 'activo')    y
        //->
        join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
            ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
            ->join('alumnos', 'inscripcions.alumno_id', '=', 'alumnos.id')
            ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
            ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
            ->join('aulas', 'asignarpromas.aula_id', '=', 'aulas.id')
            ->select(
                'inscripcions.*','fechadeinscripcion',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesor_apellidopaterno','profesors.apellidomaterno as profesor_apellidomaterno',
                'alumnos.nombre as alumno_nombre',
                'alumnos.apellidopaterno as alumno_apellidopaterno',
                'alumnos.apellidomaterno as alumno_apellidomaterno',
                'materias.materia as materia_nombre',
                'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            )
            ->get();
    }
    public static function obtenerfecchainicioinscripcionreportesecre($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2,$alumnoid2,$ordenarins2,$mayorymenorins2,$alumnoidpa2,$alumnoidma2,$estadosecre2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::
              when($fechaini, function ($query, $fechaini) {
                  return $query->where('inscripcions.fechadeinscripcion', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('inscripcions.fechadeinscripcion', '<=', $fechafin);
              })   
              ->join('alumnos', 'inscripcions.alumno_id', '=', 'alumnos.id')
              ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
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
            ->when($alumnoid2, function ($query, $alumnoid2) {
            return $query->where('alumnos.nombre',$alumnoid2);
            }) 
            ->when($alumnoidpa2, function ($query, $alumnoidpa2) {
                return $query->where('alumnos.apellidopaterno',$alumnoidpa2);
                }) 
            ->when($alumnoidma2, function ($query, $alumnoidma2) {
                return $query->where('alumnos.apellidomaterno',$alumnoidma2);
                }) 
            ->when($estadosecre2, function ($query, $estadosecre2) {
                return $query->where('inscripcions.estado', '=', $estadosecre2);
            }) 
            ->select(
                'inscripcions.*','inscripcions.estado as inscripcion_estado',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesor_apellidopaterno','profesors.apellidomaterno as profesor_apellidomaterno',
               'alumnos.nombre as alumno_nombre', 'alumnos.apellidopaterno as alumno_apellidopaterno', 'alumnos.apellidomaterno as alumno_apellidomaterno',
                'materias.materia as materia_nombre',
                 'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
            if (!empty($ordenarins2) && !empty($mayorymenorins2)) {
                $consulta->orderBy($ordenarins2, $mayorymenorins2);
            }
              return $consulta->get();       
        //return $fechaini;
    }
    public static function obtenerfecchainicioinscripcionreporte($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2,$alumnoid2,$ordenarins2,$mayorymenorins2,$alumnoidpa2,$alumnoidma2,$estadosecre2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::
              when($fechaini, function ($query, $fechaini) {
                  return $query->where('inscripcions.fechadeinscripcion', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('inscripcions.fechadeinscripcion', '<=', $fechafin);
              })   
              ->join('alumnos', 'inscripcions.alumno_id', '=', 'alumnos.id')
              ->join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')
              ->join('materias', 'asignarpromas.materia_id', '=', 'materias.id')
              ->join('periodos', 'asignarpromas.periodo_id', '=', 'periodos.id')
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
            ->when($alumnoid2, function ($query, $alumnoid2) {
            return $query->where('alumnos.nombre',$alumnoid2);
            }) 
            ->when($alumnoidpa2, function ($query, $alumnoidpa2) {
                return $query->where('alumnos.apellidopaterno',$alumnoidpa2);
                }) 
            ->when($alumnoidma2, function ($query, $alumnoidma2) {
                return $query->where('alumnos.apellidomaterno',$alumnoidma2);
                }) 
            ->when($estadosecre2, function ($query, $estadosecre2) {
                return $query->where('inscripcions.estado', '=', $estadosecre2);
            }) 
            ->select(
                'inscripcions.*','fechadeinscripcion',
                'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesor_apellidopaterno','profesors.apellidomaterno as profesor_apellidomaterno',
               'alumnos.nombre as alumno_nombre', 'alumnos.apellidopaterno as alumno_apellidopaterno', 'alumnos.apellidomaterno as alumno_apellidomaterno',
                'materias.materia as materia_nombre',
                 'materias.costo as materia_costo',
                'periodos.periodo as periodo_nombre',
                'aulas.aula as aula_nombre'
            );
            if (!empty($ordenarins2) && !empty($mayorymenorins2)) {
                $consulta->orderBy($ordenarins2, $mayorymenorins2);
            }
              return $consulta->get();       
        //return $fechaini;
    }
    
    public static function obtenerlistaalumnosinscritos($materiaid2)
    {
        return static
        ::
        join('asignarpromas', 'inscripcions.asignarproma_id', '=', 'asignarpromas.id')



        ->where('asignarpromas.materia_id',$materiaid2 )
        
        ->join('alumnos', 'inscripcions.alumno_id', '=', 'alumnos.id')


            ->select(
                'alumnos.*'
            )
            ->get();
    }
    
    public static function verificarregistroins($fechadeinscripcion, $asignarproma_id, $alumno_id , $estado)
    {
        return self::
        where('inscripcions.fechadeinscripcion',$fechadeinscripcion )
        ->where('inscripcions.asignarproma_id',$asignarproma_id )
        ->where('inscripcions.alumno_id',$alumno_id )
        ->where('inscripcions.estado',$estado )// Cambia 'campo2' por el nombre real del campo
            ->first();



    }
    public static function obtenerfecchainicioalumnoslistaprofe($fechaini,$rutaImagenBase,$fechafin,$buscaralu2,$userid,$materiaid2,$aulaid2,$periodoid2)
   {      
       // Ejemplo de obtención del sueldo del profesor
      // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       return self::join('alumnos','inscripcions.alumno_id','=','alumnos.id')
            ->join('asignarpromas','inscripcions.asignarproma_id','=','asignarpromas.id')
            ->join('materias','asignarpromas.materia_id','=','materias.id')
            ->join('aulas','asignarpromas.aula_id','=','aulas.id')
            ->join('periodos','asignarpromas.periodo_id','=','periodos.id')
            ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
            ->join('users','users.id','=','profesors.user_id')

            ->when($fechaini, function ($query, $fechaini) {
                 return $query->where('alumnos.fechadeingreso', '>=', $fechaini);
             })
             ->when($fechafin, function ($query, $fechafin) {
                 return $query->where('alumnos.fechadeingreso', '<=', $fechafin);
             })  
             ->when($materiaid2, function ($query, $materiaid2) {
                return $query->where('materias.materia', '=', $materiaid2);
            })  
            ->when($aulaid2, function ($query, $aulaid2) {
                return $query->where('aulas.aula', '=', $aulaid2);
            })  
            ->when($periodoid2, function ($query, $periodoid2) {
                return $query->where('periodos.periodo', '=', $periodoid2);
            })  
             
             ->where('profesors.user_id','=',$userid)

             ->when($buscaralu2, function ($query, $buscaralu2) {
                 return $query->where(function ($query) use ($buscaralu2) {
                     $query->where('alumnos.ci', 'like', "%$buscaralu2%")
                         ->orWhere('alumnos.nombre', 'like', "%$buscaralu2%")
                         ->orWhere('alumnos.apellidopaterno', 'like', "%$buscaralu2%")
                         ->orWhere('alumnos.apellidomaterno', 'like', "%$buscaralu2%")
                         ->orWhere('alumnos.celular', 'like', "%$buscaralu2%")
                         ->orWhere('alumnos.direccion', 'like', "%$buscaralu2%")
                         ->orWhere('alumnos.correo', 'like', "%$buscaralu2%")
                         ->orWhere('alumnos.estado', 'like', "%$buscaralu2%")
                         ->orWhere('materias.materia', 'like', "%$buscaralu2%")
                         ->orWhere('periodos.periodo', 'like', "%$buscaralu2%")
                         ->orWhere('aulas.aula', 'like', "%$buscaralu2%");
                 });
             })  
            // ->select('profesors.*', 'users.email', 'users.role')
           //  ->get();
             ->select(
                'alumnos.*','alumnos.id as alumnoid','alumnos.nombre as alumno_nombre','alumnos.apellidopaterno as alumno_paterno','alumnos.apellidomaterno as alumno_materno',
                  'profesors.nombre as profesor_nombre','profesors.apellidopaterno as profesors_paterno','profesors.apellidomaterno as profesor_materno',
             'materias.materia as nombre_materia','materias.id as materiaid',
             'aulas.aula as nombre_aula','aulas.id as aulaid',
             'periodos.periodo as nombre_periodo','periodos.id as periodoid')
             ->where('asignarpromas.estado','=','activo')
           ->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen")
           ->get();
       //return $fechaini;
   }
 }
 


