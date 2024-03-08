<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nota extends Model
{  protected $fillable = [
    'fechadenota',
    'actividad_id',
    'materia_id',
    'nota',
    'estado',
];
    protected $table = "notas";
   
    public function actividad()
    {
        return $this->belongsTo(actividad::class,'actividad_id');
    }

    public function alumno()
    {
        return $this->belongsTo(alumno::class,'alumno_id');
    }
    public function materia()
    {
        return $this->belongsTo(materia::class,'materia_id');
    }
    public static function obtenernotadesdefechainicio($fechaini,$fechafin,$buscarpro2,$estadopro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::join('alumnos', 'notas.alumno_id', '=', 'alumnos.id')  
        ->join('actividads', 'notas.actividad_id', '=', 'actividads.id')
        ->join('materias', 'notas.materia_id', '=', 'materias.id')
        ->join('asignarpromas', 'materias.id', '=', 'asignarpromas.materia_id')
        ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')  

              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('notas.fechadenota', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('notas.fechadenota', '<=', $fechafin);
              })   
              ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('notas.estado', '=', $estadopro2);
            }) 

              ->when($buscarpro2, function ($query, $buscarpro2) {
                  return $query->where(function ($query) use ($buscarpro2) {
                      $query->where('actividads.actividad', 'like', "%$buscarpro2%")
                          ->orWhere('nota', 'like', "%$buscarpro2%")
                          ->orWhere('alumnos.nombre', 'like', "%$buscarpro2%")
                          ->orWhere('materias.materia', 'like', "%$buscarpro2%")
                          ->orWhere('profesors.nombre', 'like', "%$buscarpro2%");
                  });
              })  
            
                
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();
            ->select(
                'notas.*',
                'profesors.nombre as profesor_nombre',
                'materias.materia as materia_nombre',
                'actividads.actividad as actividad_nombre',
                'alumnos.nombre as alumno_nombre',
            )
            ->get();
        //return $fechaini;
    }

    public static function obtenernotafechainiciore($fechaini,$fechafin,$profesorid2,$alumnoid2,$materiaid2,$estado2,$actividadid2,$notamin2,$notamax,$ordenarnot2,$mayorymenornot2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       $consulta = self::
   
             when($fechaini, function ($query, $fechaini) {
                  return $query->where('notas.fechadenota', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('notas.fechadenota', '<=', $fechafin);
              })  

              ->join('alumnos', 'notas.alumno_id', '=', 'alumnos.id')  
              ->join('actividads', 'notas.actividad_id', '=', 'actividads.id')
              ->join('materias', 'notas.materia_id', '=', 'materias.id')
              ->join('asignarpromas', 'materias.id', '=', 'asignarpromas.materia_id')
              ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')  
              
             // ->where('profesors.id', $profesorid2) 
             ->when($profesorid2, function ($query, $profesorid2) {
                return $query->where('profesors.id',$profesorid2);
                })
                ->when($alumnoid2, function ($query, $alumnoid2) {
                return $query->where('alumnos.id',$alumnoid2);
                })
                ->when($actividadid2, function ($query, $actividadid2) {
                return $query->where('actividads.id',$actividadid2);
                })
                ->when($estado2, function ($query, $estado2) {
                    return $query->where('notas.estado',$estado2);
                    })
                ->when($materiaid2, function ($query, $materiaid2) {
                    return $query->where('materias.id',$materiaid2);
                    })
              
                ->when($notamin2, function ($query, $notamin2) {
                    return $query->where('notas.nota', '>=', $notamin2);
                })
                ->when($notamax, function ($query, $notamax) {
                    return $query->where('notas.nota', '<=', $notamax);
                })  

                ->select(
                    'notas.*',
                    'profesors.nombre as profesor_nombre',
                    'materias.materia as materia_nombre',
                    'actividads.actividad as actividad_nombre',
                    'alumnos.nombre as alumno_nombre',
                );
            if (!empty($ordenarnot2) && !empty($mayorymenornot2)) {
                $consulta->orderBy($ordenarnot2, $mayorymenornot2);
            }
            return $consulta->get();  
    }
    public static function obtenerdatosde3tablaas()
    {
        return Nota::join('actividads', 'notas.actividad_id', '=', 'actividads.id')
                 ->join('materias', 'notas.materia_id', '=', 'materias.id')
                 ->join('alumnos', 'notas.alumno_id', '=', 'alumnos.id')
                 
                 ->join('asignarpromas', 'materias.id', '=', 'asignarpromas.materia_id')
                 ->join('profesors', 'asignarpromas.profesor_id', '=', 'profesors.id')

       
            ->select(
                'notas.*',
                'profesors.nombre as profesor_nombre',
                'materias.materia as materia_nombre',
                'actividads.actividad as actividad_nombre',
                'alumnos.nombre as alumno_nombre',
            )
            ->get();
    }
    public static function obtenernotaalumnoiduser($materiaid2,$alumnoid2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        $consulta = self::join('actividads','notas.actividad_id','=','actividads.id')
              
              ->where('notas.materia_id','=',$materiaid2)
              ->where('notas.alumno_id','=',$alumnoid2)
          
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();6
            ->select(
                'actividads.actividad as nombre_actividad','notas.*'
            );
            //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
              return $consulta->get();  //return $fechaini;
    }
    public static function obtenernotaalumnoiduseradmi($materiaid2,$alumnoid2)
    {      
        $consulta = self::join('actividads','notas.actividad_id','=','actividads.id')
              
        ->where('notas.materia_id','=',$materiaid2)
        ->where('notas.alumno_id','=',$alumnoid2)
    
       // ->select('profesors.*', 'users.email', 'users.role')
      //  ->get();6
      ->select(
          'actividads.actividad as nombre_actividad','notas.*'
      );
      //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
        return $consulta->get();  //return $fechaini;
    }
    public static function obtenernotaalumnoidusersecre($materiaid2,$alumnoid2)
    {      
        $consulta = self::join('actividads','notas.actividad_id','=','actividads.id')
              
        ->where('notas.materia_id','=',$materiaid2)
        ->where('notas.alumno_id','=',$alumnoid2)
    
       // ->select('profesors.*', 'users.email', 'users.role')
      //  ->get();6
      ->select(
          'actividads.actividad as nombre_actividad','notas.*'
      );
      //->selectRaw("CONCAT('$rutaImagenBase', alumnos.imagen) as ruta_imagen");
        return $consulta->get();  //return $fechaini;
    }
    public static function enviarnotaeditada($notaid2,$nota2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       $registro = nota::find($notaid2);
       if ($registro) {
           $registro->nota = $nota2;
           $registro->save();

           return response()->json(['success' => true]);
       } else {
           return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
       }
    }
    public static function enviarnotaeliminada($notaid2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       $registro = nota::find($notaid2);
       if ($registro) {
          // $registro->nota = $nota2;
           $registro->delete();

           return response()->json(['success' => true]);
       } else {
           return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
       }
    }
}
