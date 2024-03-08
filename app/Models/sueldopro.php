<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\profesor;

class sueldopro extends Model
{
    
   // static $rules =['fechadeingreso'=>'required',];
   // protected $perpage=20;

    protected $table = "sueldopros";
   
    public function profesor()
    {
        return $this->belongsTo(profesor::class,'profesor_id');
    }
    public static function obtenersueldoprodesdefechainicio($fechaini,$fechafin,$buscarpro2)
    {      
        // Ejemplo de obtención del sueldo del profesor
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
        return self::join('profesors', 'sueldopros.profesor_id', '=', 'profesors.id') 
              ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('sueldopros.fechadesueldo', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('sueldopros.fechadesueldo', '<=', $fechafin);
              })  
              ->when($buscarpro2, function ($query, $buscarpro2) {
                  return $query->where(function ($query) use ($buscarpro2) {
                      $query->where('mesdepago', 'like', "%$buscarpro2%")
                          ->orWhere('profesors.sueldo', 'like', "%$buscarpro2%")
                          ->orWhere('totaldescuento', 'like', "%$buscarpro2%")
                          ->orWhere('totalpago', 'like', "%$buscarpro2%")
                          ->orWhere('observacion', 'like', "%$buscarpro2%")
                          ->orWhere('profesors.nombre', 'like', "%$buscarpro2%");
                  });
              })  
            ->select('sueldopros.*', 'profesors.*', 'profesors.sueldo')
            ->get();
    }  
    public static function obtenersuprodesdefechainiciore($fechaini,$fechafin,$profesorid2,
    $sueldomin2,$sueldomax2,$todesmin2,$todesmax2,$topamin2,$topamax2,$ordenarsupro2,$mayorymenorsupro2)
    {      
       // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
       $consulta = self::join('profesors', 'sueldopros.profesor_id', '=', 'profesors.id')  
  
             ->when($fechaini, function ($query, $fechaini) {
                  return $query->where('sueldopros.fechadesueldo', '>=', $fechaini);
              })
              ->when($fechafin, function ($query, $fechafin) {
                  return $query->where('sueldopros.fechadesueldo', '<=', $fechafin);
              })  
             // ->where('profesors.id', $profesorid2) 
                ->when($profesorid2, function ($query, $profesorid2) {
                return $query->where('profesors.id',$profesorid2);
                })
                ->when($sueldomin2, function ($query, $sueldomin2) {
                    return $query->where('profesors.sueldo', '>=', $sueldomin2);
                })
                ->when($sueldomax2, function ($query, $sueldomax2) {
                    return $query->where('profesors.sueldo', '<=', $sueldomax2);
                }) 
                ->when($todesmin2, function ($query, $todesmin2) {
                    return $query->where('sueldopros.totaldescuento', '>=', $todesmin2);
                })
                ->when($todesmax2, function ($query, $todesmax2) {
                    return $query->where('sueldopros.totaldescuento', '<=', $todesmax2);
                }) 
                ->when($topamin2, function ($query, $topamin2) {
                    return $query->where('sueldopros.totalpago', '>=', $topamin2);
                })
                ->when($topamax2, function ($query, $topamax2) {
                    return $query->where('sueldopros.totalpago', '<=', $topamax2);
                }) 
  
            ->select('sueldopros.*','profesors.sueldo as sueldo_secre',
            'profesors.nombre as nombre_profesor','profesors.apellidopaterno','profesors.apellidomaterno');
            if (!empty($ordenarsupro2) && !empty($mayorymenorsupro2)) {
                $consulta->orderBy($ordenarsupro2, $mayorymenorsupro2);
            }
            return $consulta->get();
    }
    public static function obtenernombreprofesor(){
        return self::join('profesors', 'sueldopros.profesor_id', '=', 'profesors.id')
            ->select('sueldopros.*','profesors.nombre as nombre_profesor','profesors.apellidopaterno as apepa_profesor','profesors.apellidomaterno as apema_profesor'
            ,'profesors.sueldo as sueldo_profesor')
            //->selectRaw("CONCAT('$rutaImagenBase', secretarias.imagen) as ruta_imagen")
            ->get();
    }
}
   