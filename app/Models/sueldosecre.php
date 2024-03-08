<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sueldosecre extends Model
{
    protected $table = "sueldosecres";
    protected $fillable = [
        'secretaria_id', 
        'totaldescuento',
        'totalpago',
        'totaldescuento',
        'observacion',
        'mesdepago',
        'fechadesueldo'
    ];
    public function secretaria()
    {
        return $this->belongsTo(secretaria::class,'secretaria_id');
    }
    public static function obtenersueldoprodesdefechainicio($fechaini,$fechafin,$buscarpro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::join('secretarias', 'sueldosecres.secretaria_id', '=', 'secretarias.id') 
              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('sueldosecres.fechadesueldo', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('sueldosecres.fechadesueldo', '<=', $fechafin);
              })  
              ->when($buscarpro2, function ($query, $buscarpro2) {
                  return $query->where(function ($query) use ($buscarpro2) {
                      $query->where('mesdepago', 'like', "%$buscarpro2%")
                          ->orWhere('secretarias.sueldo', 'like', "%$buscarpro2%")
                          ->orWhere('totaldescuento', 'like', "%$buscarpro2%")
                          ->orWhere('totalpago', 'like', "%$buscarpro2%")
                          ->orWhere('observacion', 'like', "%$buscarpro2%")
                          ->orWhere('secretarias.nombre', 'like', "%$buscarpro2%");
                  });
              })  
            ->select('sueldosecres.*', 'secretarias.*', 'secretarias.sueldo')
            ->get();
    }  
    public static function obtenersusecredesdefechainiciore($fechaini,$fechafin,$secretariaid2,
    $sueldomin2,$sueldomax2,$todesmin2,$todesmax2,$topamin2,$topamax2,$ordenarsusecre2,$mayorymenorsusecre2)
    {      
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       $consulta = self::join('secretarias', 'sueldosecres.secretaria_id', '=', 'secretarias.id')  

             ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('sueldosecres.fechadesueldo', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('sueldosecres.fechadesueldo', '<=', $fechafin);
              })  
             // ->where('profesors.id', $profesorid2) 
                ->when($secretariaid2, function ($query, $secretariaid2) {
                return $query->where('secretarias.id',$secretariaid2);
                })
                ->when($sueldomin2, function ($query, $sueldomin2) {
                    return $query->where('secretarias.sueldo', '>=', $sueldomin2);
                })
                ->when($sueldomax2, function ($query, $sueldomax2) {
                    return $query->where('secretarias.sueldo', '<=', $sueldomax2);
                }) 
                ->when($todesmin2, function ($query, $todesmin2) {
                    return $query->where('sueldosecres.totaldescuento', '>=', $todesmin2);
                })
                ->when($todesmax2, function ($query, $todesmax2) {
                    return $query->where('sueldosecres.totaldescuento', '<=', $todesmax2);
                }) 
                ->when($topamin2, function ($query, $topamin2) {
                    return $query->where('sueldosecres.totalpago', '>=', $topamin2);
                })
                ->when($topamax2, function ($query, $topamax2) {
                    return $query->where('sueldosecres.totalpago', '<=', $topamax2);
                }) 

            ->select('sueldosecres.*','secretarias.sueldo as sueldo_secre',
            'secretarias.nombre as nombre_secretaria','secretarias.apellidopaterno','secretarias.apellidomaterno');
            if (!empty($ordenarsusecre2) && !empty($mayorymenorsusecre2)) {
                $consulta->orderBy($ordenarsusecre2, $mayorymenorsusecre2);
            }
            return $consulta->get();  
    }
    
    public static function obtenernombresecretaria(){
        return self::join('secretarias', 'sueldosecres.secretaria_id', '=', 'secretarias.id')
            ->select('sueldosecres.*','secretarias.nombre as nombre_secretaria','secretarias.apellidopaterno as apepa_secretaria','secretarias.apellidomaterno as apema_secretaria'
            ,'secretarias.sueldo as sueldo_secretaria')
            //->selectRaw("CONCAT('$rutaImagenBase', secretarias.imagen) as ruta_imagen")
            ->get();
    }
}
