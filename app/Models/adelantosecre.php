<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adelantosecre extends Model
{
    protected $table = "adelantosecres";
    protected $fillable = [
        'secretaria_id', 
        'monto',
        'estadoade',
        'observacion',
        'fechaadelantosecre'
    ];
   
    public function secretaria()
    {
        return $this->belongsTo(secretaria::class,'secretaria_id');
    }
    public static function obteneradelantosecre($secretariaId)
    {
        $sumatoriaMonto = adelantosecre::where('secretaria_id', $secretariaId)->where('estadoade','pendiente')
        ->sum('monto');
        return $sumatoriaMonto;
    }

    public static function obtenerlistasecreid2($secretariaId)
    {
        $adelantosecre = adelantosecre::where('secretaria_id', $secretariaId)->where('estadoade','pendiente')
                    ->join('secretarias', 'adelantosecres.secretaria_id', '=', 'secretarias.id')
                    ->select('adelantosecres.*', 'secretarias.nombre as nombre_secretaria')
                    ->get();

        return $adelantosecre;
    }
    public static function obteneradesecredesdefechainicio($fechaini,$fechafin,$buscarpro2,$estadopro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::join('secretarias', 'adelantosecres.secretaria_id', '=', 'secretarias.id') 
              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('adelantosecres.fechaadelantosecre', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('adelantosecres.fechaadelantosecre', '<=', $fechafin);
              })  
              ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('adelantosecres.estadoade', '=', $estadopro2);
            }) 
              ->when($buscarpro2, function ($query, $buscarpro2) {
                  return $query->where(function ($query) use ($buscarpro2) {
                      $query->where('monto', 'like', "%$buscarpro2%")
                          ->orWhere('estadoade', 'like', "%$buscarpro2%")
                          ->orWhere('observacion', 'like', "%$buscarpro2%")
                          ->orWhere('secretarias.nombre', 'like', "%$buscarpro2%");
                  });
              })  
                
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();
            ->select('adelantosecres.*', 'secretarias.nombre as nombre_secretaria','secretarias.apellidopaterno as secreapellidopaterno','secretarias.apellidomaterno as secreapellidomaterno')
            ->get();
        //return $fechaini;
    }
    public static function obteneradeprodesdefechainicio($fechaini,$fechafin,$buscarpro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::join('profesors', 'adelantopros.profesor_id', '=', 'profesors.id') 
              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('adelantopros.fechaadelantopro', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('adelantopros.fechaadelantopro', '<=', $fechafin);
              })  
              ->when($buscarpro2, function ($query, $buscarpro2) {
                  return $query->where(function ($query) use ($buscarpro2) {
                      $query->where('monto', 'like', "%$buscarpro2%")
                          ->orWhere('estadoade', 'like', "%$buscarpro2%")
                          ->orWhere('observacion', 'like', "%$buscarpro2%")
                          ->orWhere('profesors.nombre', 'like', "%$buscarpro2%");
                  });
              })  
                
             // ->select('profesors.*', 'users.email', 'users.role')
            //  ->get();
            ->select('adelantopros.*', 'profesors.nombre as nombre_profesor')
            ->get();
        //return $fechaini;
    }   

    public static function obteneradesecredesdefechainiciore($fechaini,$fechafin,$secretariaid2,$monto11,$monto22,$estadosecre2,$ordenaradepro2,$mayorymenoradepro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       $consulta = self::join('secretarias', 'adelantosecres.secretaria_id', '=', 'secretarias.id')  

             ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('adelantosecres.fechaadelantosecre', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('adelantosecres.fechaadelantosecre', '<=', $fechafin);
              })  
             // ->where('profesors.id', $profesorid2) 
                ->when($secretariaid2, function ($query, $secretariaid2) {
                return $query->where('secretarias.id',$secretariaid2);
                })
              
                ->when($monto11, function ($query, $monto11) {
                    return $query->where('adelantosecres.monto', '>=', $monto11);
                })
                ->when($monto22, function ($query, $monto22) {
                    return $query->where('adelantosecres.monto', '<=', $monto22);
                })  
                ->when($estadosecre2, function ($query, $estadosecre2) {
                    return $query->where('adelantosecres.estadoade', '=', $estadosecre2);
                }) 

            ->select('adelantosecres.*','adelantosecres.fechaadelantosecre', 
            'secretarias.nombre as nombre_secretaria','secretarias.apellidopaterno','secretarias.apellidomaterno');
            if (!empty($ordenaradepro2) && !empty($mayorymenoradepro2)) {
                $consulta->orderBy($ordenaradepro2, $mayorymenoradepro2);
            }
            return $consulta->get();  
    }
    public static function obtenernombresecretaria(){
        

        return self::join('secretarias', 'adelantosecres.secretaria_id', '=', 'secretarias.id')
            ->select('adelantosecres.*','secretarias.nombre as nombre_secretaria','secretarias.apellidopaterno as apepa_secretaria','secretarias.apellidomaterno as apema_secretaria')
            //->selectRaw("CONCAT('$rutaImagenBase', secretarias.imagen) as ruta_imagen")
            ->get();
    }
   
}

