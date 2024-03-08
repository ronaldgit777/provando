<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class secretaria extends Model
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
  protected $table = "secretarias";
   
  public function User()
  {
      return $this->belongsTo(User::class,'user_id');
  }

  public static function obtenerSueldo($secretariaId)
  {      
      // Ejemplo de obtención del sueldo del profesor
      $sueldo = self::where('id', $secretariaId)->value('sueldo');
      
      return $sueldo;
  }
  public static function obtenersecretariasConRutaImagen()
    {
        $rutaImagenBase = asset('storage').'/';

        return self::join('users', 'secretarias.user_id', '=', 'users.id')
            ->select('secretarias.*', 'users.email', 'users.role')
            ->selectRaw("CONCAT('$rutaImagenBase', secretarias.imagen) as ruta_imagen")
            ->get();
    }
  public static function obtenersecretariasdesdefechainicio($fechaini,$rutaImagenBase,$fechafin,$cisecre2,$nombresecre2,
  $apellidopaternosecre2,$apellidomaternosecre2,$celularsecre2,$direccionsecre2,$emailsecre2,$estadosecre2,$sueldominsecre2,$sueldomaxsecre2
  ,$ordenarsecre2, $mayorymenorsecre2)
  {      
      // Ejemplo de obtención del sueldo del profesor
     // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
      $consulta = self::join('users', 'secretarias.user_id', '=', 'users.id') 
            ->when($fechaini, function ($query, $fechaini) {
                return $query->where('secretarias.fechadeingreso', '>=', $fechaini);
            })
            ->when($fechafin, function ($query, $fechafin) {
                return $query->where('secretarias.fechadeingreso', '<=', $fechafin);
            })  
            ->where('secretarias.ci', 'like', "%$cisecre2%") 
            ->where('secretarias.nombre', 'like', "%$nombresecre2%")->where('secretarias.apellidopaterno', 'like', "%$apellidopaternosecre2%")
            ->where('secretarias.apellidomaterno', 'like', "%$apellidomaternosecre2%")  ->where('secretarias.celular', 'like', "%$celularsecre2%")  
            ->where('secretarias.direccion', 'like', "%$direccionsecre2%")->where('users.email', 'like', "%$emailsecre2%")  
            ->where('secretarias.estado', 'like', "%$estadosecre2%") 
            ->when($sueldominsecre2, function ($query, $sueldominsecre2) {
                return $query->where('secretarias.sueldo', '>=', $sueldominsecre2);
            })
            ->when($sueldomaxsecre2, function ($query, $sueldomaxsecre2) {
                return $query->where('secretarias.sueldo', '<=', $sueldomaxsecre2);
            })      
           // ->select('profesors.*', 'users.email', 'users.role')
          //  ->get();
          ->select('secretarias.*', 'users.email', 'users.role')
          ->selectRaw("CONCAT('$rutaImagenBase', secretarias.imagen) as ruta_imagen");
            // Verificar si ambas variables tienen valor
            if (!empty($ordenarsecre2) && !empty($mayorymenorsecre2)) {
                $consulta->orderBy($ordenarsecre2, $mayorymenorsecre2);
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
  public static function obtenersecretariasdesdefechainicio2($fechaini,$rutaImagenBase,$fechafin,$buscarpro2,$estadosecre2)
  {      
      // Ejemplo de obtención del sueldo del profesor
     // $fechaini = self::where('fechadeingreso','>=', $fechaini)->get();
      return self::join('users', 'secretarias.user_id', '=', 'users.id') 
            ->when($fechaini, function ($query, $fechaini) {
                return $query->where('secretarias.fechadeingreso', '>=', $fechaini);
            })
            ->when($fechafin, function ($query, $fechafin) {
                return $query->where('secretarias.fechadeingreso', '<=', $fechafin);
            })  
            ->when($estadosecre2, function ($query, $estadosecre2) {
                return $query->where('secretarias.estado', '=', $estadosecre2);
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
          ->select('secretarias.*', 'users.email', 'users.role')

          
          ->selectRaw("CONCAT('$rutaImagenBase', secretarias.imagen) as ruta_imagen")
          ->get();
      //return $fechaini;
  }
}