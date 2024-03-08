<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\asignarproma;
//use illuminate\faca

class profesor extends Model
{
   // static $rules =['fechadeingreso'=>'required',];
   // protected $perpage=20;

  //  protected $fillable = ['fechadeingreso'];
  protected $fillable = [
    'fechadeingreso',
    'ci',
    'nombre',
    'apellidopaterno',
    'apellidomaterno',
    'celular',
    'direccion',
    'estado',
    'imagen',
    'sueldo',
    'user_id'
];
  protected $table = "profesors";
   
  public function asignarprom()
  {
      return $this->hasMany(asignarproma::class,'profesor_id','id');
  }

  public function User()
  {
      return $this->belongsTo(User::class,'user_id');
  }
 
  public static function obtenerSueldo($profesorId)
  {      
      // Ejemplo de obtención del sueldo del profesor
      $sueldo = self::where('id', $profesorId)->value('sueldo');
      
      return $sueldo;
  }
  public static function obtenerProfesoresConRutaImagen()
    {
        $rutaImagenBase = asset('storage').'/';

        return self::join('users', 'profesors.user_id', '=', 'users.id')
            ->select('profesors.*', 'users.email', 'users.role')
            ->selectRaw("CONCAT('$rutaImagenBase', profesors.imagen) as ruta_imagen")
            ->get();
    }
  public static function obtenerprofesoresdesdefechainicio($fechaini,$rutaImagenBase,$fechafin,$cipro2,$nombrepro2,
  $apellidopaternopro2,$apellidomaternopro2,$celularpro2,$direccionpro2,$emailpro2,$estadopro2,$sueldominpro2,$sueldomaxpro2
  ,$ordenarpro2, $mayorymenorpro2)
  {      
      // Ejemplo de obtención del sueldo del profesor
     // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
      $consulta = self::join('users', 'profesors.user_id', '=', 'users.id') 
            ->when($fechaini, function ($query, $fechaini) {
                return $query->where('profesors.fechadeingreso', '>=', $fechaini);
            })
            ->when($fechafin, function ($query, $fechafin) {
                return $query->where('profesors.fechadeingreso', '<=', $fechafin);
            })  
            ->where('profesors.ci', 'like', "%$cipro2%") 
            ->where('profesors.nombre', 'like', "%$nombrepro2%")->where('profesors.apellidopaterno', 'like', "%$apellidopaternopro2%")
            ->where('profesors.apellidomaterno', 'like', "%$apellidomaternopro2%")  ->where('profesors.celular', 'like', "%$celularpro2%")  
            ->where('profesors.direccion', 'like', "%$direccionpro2%")->where('users.email', 'like', "%$emailpro2%")  
            ->where('profesors.estado', 'like', "%$estadopro2%") 
            ->when($sueldominpro2, function ($query, $sueldominpro2) {
                return $query->where('profesors.sueldo', '>=', $sueldominpro2);
            })
            ->when($sueldomaxpro2, function ($query, $sueldomaxpro2) {
                return $query->where('profesors.sueldo', '<=', $sueldomaxpro2);
            })      
           // ->select('profesors.*', 'users.email', 'users.role')
          //  ->get();
          ->select('profesors.*', 'users.email', 'users.role')
          ->selectRaw("CONCAT('$rutaImagenBase', profesors.imagen) as ruta_imagen");
            // Verificar si ambas variables tienen valor
            if (!empty($ordenarpro2) && !empty($mayorymenorpro2)) {
                $consulta->orderBy($ordenarpro2, $mayorymenorpro2);
            }
            return $consulta->get();       
      //return $fechaini;
  }
  
  public static function obtenermenorfechadesdefechainicio()
  {      
      // Ejemplo de obtención del sueldo del profesor
      $fechaingreso = self::min('fechadeingreso');
      
      return $fechaingreso;
  }
  public static function obtenerprofesoresdesdefechainicio2($fechaini,$rutaImagenBase,$fechafin,$buscarpro2,$estadopro2)
  {      
      // Ejemplo de obtención del sueldo del profesor
     // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
      return self::join('users', 'profesors.user_id', '=', 'users.id') 
            ->when($fechaini, function ($query, $fechaini) {
                return $query->where('profesors.fechadeingreso', '>=', $fechaini);
            })
            ->when($fechafin, function ($query, $fechafin) {
                return $query->where('profesors.fechadeingreso', '<=', $fechafin);
            })  
            ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('profesors.estado', '=', $estadopro2);
            }) 
            ->when($buscarpro2, function ($query, $buscarpro2) {
                return $query->where(function ($query) use ($buscarpro2) {
                    $query->where('ci', 'like', "%$buscarpro2%")
                        ->orWhere('nombre', 'like', "%$buscarpro2%")
                        ->orWhere('apellidopaterno', 'like', "%$buscarpro2%")
                        ->orWhere('apellidomaterno', 'like', "%$buscarpro2%")
                        ->orWhere('celular', 'like', "%$buscarpro2%")
                        ->orWhere('direccion', 'like', "%$buscarpro2%")
                        ->orWhere('users.email', 'like', "%$buscarpro2%")
                        ->orWhere('sueldo', 'like', "%$buscarpro2%");
                });
            })  
           // ->select('profesors.*', 'users.email', 'users.role')
          //  ->get();
          ->select('profesors.*', 'users.email', 'users.role','profesors.estado')
          ->selectRaw("CONCAT('$rutaImagenBase', profesors.imagen) as ruta_imagen")
          ->get();
      //return $fechaini;
  }
  public static function obtenerprofesoresdesdefechainicio2secre($fechaini,$rutaImagenBase,$fechafin,$buscarpro2,$estadopro2)
  {      
      // Ejemplo de obtención del sueldo del profesor
     // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
      return self::join('users', 'profesors.user_id', '=', 'users.id') 
            ->when($fechaini, function ($query, $fechaini) {
                return $query->where('profesors.fechadeingreso', '>=', $fechaini);
            })
            ->when($fechafin, function ($query, $fechafin) {
                return $query->where('profesors.fechadeingreso', '<=', $fechafin);
            })  
            ->when($estadopro2, function ($query, $estadopro2) {
                return $query->where('profesors.estado', '=', $estadopro2);
            }) 
            ->when($buscarpro2, function ($query, $buscarpro2) {
                return $query->where(function ($query) use ($buscarpro2) {
                    $query->where('ci', 'like', "%$buscarpro2%")
                        ->orWhere('nombre', 'like', "%$buscarpro2%")
                        ->orWhere('apellidopaterno', 'like', "%$buscarpro2%")
                        ->orWhere('apellidomaterno', 'like', "%$buscarpro2%")
                        ->orWhere('celular', 'like', "%$buscarpro2%")
                        ->orWhere('direccion', 'like', "%$buscarpro2%")
                        ->orWhere('users.email', 'like', "%$buscarpro2%")
                        ->orWhere('sueldo', 'like', "%$buscarpro2%");
                });
            })  
           // ->select('profesors.*', 'users.email', 'users.role')
          //  ->get();
          ->select('profesors.*', 'users.email', 'users.role','profesors.estado')
          ->selectRaw("CONCAT('$rutaImagenBase', profesors.imagen) as ruta_imagen")
          ->get();
      //return $fechaini;
  }

}


   