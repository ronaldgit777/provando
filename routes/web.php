<?php
use App\Custom\MyClass;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignarpromaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\AdelantoproController;
use App\Http\Controllers\AdelantosecreController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\SueldoproController;
use App\Http\Controllers\SueldosecreController;
use App\Http\Controllers\TurnoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
Route::get('/profesor', function () {
    return view('profesor.index');
});
Route::get('/sueldopro', function () {
    return view('sueldopro.index');
});

Route::get('/profesor', function () {
    return view('profesor.hola');
});
*/

Auth::routes();


Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();

//route::get('/home',[ProfesorController::class,'index'])->name('home');
//route::get('/home',[SueldoproController::class,'index'])->name('home');

        //route::get('/',[ProfesorController::class,'index'])->name('home');
    
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      
        Route::post('/notamodal',[App\Http\Controllers\NotaController::class, 'notamodal'])->name('notamodal')->middleware('auth'); //lista de aulas
        Route::post('/obtener-listaalumnosinscritos',[App\Http\Controllers\InscripcionController::class, 'listaalumnosinscritos'])->name('obtener-listaalumnosinscritos')->middleware('auth'); //lista de aulas
        Route::get('/notasproreporte',[App\Http\Controllers\NotaController::class, 'notasproreporte'])->name('notasproreporte')->middleware('auth'); //lista de alumnos notas
        Route::get('/notasreportesecre',[App\Http\Controllers\NotaController::class, 'notasreportesecre'])->name('notasreportesecre')->middleware('auth'); //index notas profe rol admi
        Route::get('/alumno/show2/{id}', [App\Http\Controllers\AlumnoController::class,'show2alu'])->name('show2alu')->middleware('auth');
        Route::get('/perfiluser', [App\Http\Controllers\Auth\RegisterController::class, 'verperfiluser'])->name('perfiluser')->middleware('auth');//ver al user -
        Route::post('/perfiluser', [App\Http\Controllers\Auth\RegisterController::class, 'verperfiluser'])->name('perfiluser')->middleware('auth');//ver al user -
        Route::post('/editaruser/{id}/{role}', [App\Http\Controllers\Auth\RegisterController::class, 'actualizaruser'])->name('editaruser')->middleware('auth');//editar al user -
      
        Route::post('/obtener-fechainicionotasecrerol',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicionotassecreuserrol'])->name('obtener-fechainicionotasecrerol')->middleware('auth'); //arreglar 1/9
        Route::post('/obtener-notasdelalumnoid',[App\Http\Controllers\NotaController::class, 'obtenernotasdelalumnoid'])->name('obtener-notasdelalumnoid')->middleware('auth'); //buscar de asignaciones
        Route::post('/obtener-notasdelalumnoidadmi',[App\Http\Controllers\NotaController::class, 'obtenernotasdelalumnoidadmi'])->name('obtener-notasdelalumnoidadmi')->middleware('auth'); //repote de notas cargas notas rol adm
        Route::post('/obtener-notasdelalumnoidsecre',[App\Http\Controllers\NotaController::class, 'obtenernotasdelalumnoidsecre'])->name('obtener-notasdelalumnoidsecre')->middleware('auth'); //repote de notas cargas notas rol secre
        Route::post('/obtener-fechainicioinscripcionesreporte',[App\Http\Controllers\InscripcionController::class, 'buscarfechainicioinscripcionesreporte'])->name('obtener-fechainicioinscripcionesreporte')->middleware('auth');//ajax inscripcionrol admi
        Route::get('/reporprofealumno',[App\Http\Controllers\InscripcionController::class, 'index2'])->name('reporprofealumno');//repor de profe con alumno rol admi
        Route::get('/indexsecre', [App\Http\Controllers\ProfesorController::class, 'indexsecre'])->name('indexsecre')->middleware('auth');///lista deprofesores rol secre  
      
        Route::post('/obtener-menorfechainicio',[App\Http\Controllers\ProfesorController::class, 'obtenermenorfechainicio'])->name('obtener-menorfechainicio')->middleware('auth');
       
        Route::post('/obtener-fechainicio2secre',[App\Http\Controllers\ProfesorController::class, 'obtenerfechainicio2secre'])->name('obtener-fechainicio2secre')->middleware('auth'); //buscar profesro rol secre
        
        Route::post('/obtener-menorfechainiciosecre',[App\Http\Controllers\SecretariaController::class, 'obtenermenorfechainicio'])->name('obtener-menorfechainiciosecre')->middleware('auth');
        route::resource('nota',NotaController::class)->middleware('auth');  
        Route::get('/repornota', [App\Http\Controllers\NotaController::class, 'repornota'])->name('repornota')->middleware('auth'); 
        Route::post('/obtener-fechainicionotareporte',[App\Http\Controllers\NotaController::class, 'obtenerfechainicionotareporte'])->name('obtener-fechainicionotareporte')->middleware('auth');
        Route::post('/obtener-fechainicionota',[App\Http\Controllers\NotaController::class, 'obtenerfechainicionota'])->name('obtener-fechainicionota')->middleware('auth'); 
        Route::get('/reporasigsecre', [App\Http\Controllers\AsignarpromaController::class, 'reporasigsecre'])->name('reporasigsecre')->middleware('auth');//reporte de asignaciones rol secre
        Route::post('/obtener-fechainicioasigresecre',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicioasignacionesresecre'])->name('obtener-fechainicioasigresecre')->middleware('auth'); //repor asig rol secre
        Route::get('/reporprofealumnosecre',[App\Http\Controllers\InscripcionController::class, 'index2secre'])->name('reporprofealumnosecre')->middleware('auth');//repor de profe con alumno rol secre
        Route::post('/obtener-fechainicioinscripcionesreportesecre',[App\Http\Controllers\InscripcionController::class, 'buscarfechainicioinscripcionesreportesecre'])->name('obtener-fechainicioinscripcionesreportesecre')->middleware('auth');
        Route::get('/repor-alusecre', [App\Http\Controllers\AlumnoController::class, 'reporalusecre'])->name('repor-alusecre')->middleware('auth');// lista de alumnos rol secre
        Route::post('/obtener-fechainicioreporalusecre',[App\Http\Controllers\AlumnoController::class, 'obtenerfechainicioreporalusecre'])->name('obtener-fechainicioreporalusecre')->middleware('auth'); //reporte de alumno rol secre ajax
//rol director

Route::get('/registroEmpleado', [App\Http\Controllers\Auth\RegisterController::class, 'formularioEmpleado'])->name('formularioEmpleado')->middleware('auth');
Route::post('/registroEmpleado', [App\Http\Controllers\Auth\RegisterController::class, 'registrarEmpleado'])->name('registroEmpleado')->middleware('auth');
//secretaria
route::resource('secretaria',SecretariaController::class)->middleware('auth');
Route::post('/obtener-fechainiciosecre2',[App\Http\Controllers\SecretariaController::class, 'obtenerfechainiciosecre2'])->name('obtener-fechainiciosecre2')->middleware('auth'); //lista de secretarias
//secreadelanto
route::resource('adelantosecre',AdelantosecreController::class)->middleware('auth');
Route::post('/obtener-fechainiciosecreade',[App\Http\Controllers\AdelantosecreController::class, 'obtenerfechainiciosecreade'])->name('obtener-fechainiciosecreade')->middleware('auth'); //reporte buscadir
Route::post('/obtener-adelantodisposecre', [App\Http\Controllers\AdelantosecreController::class, 'adelantodisposecre'])->name('obtener-adelantodisposecre')->middleware('auth');//modal ver ade de ade
Route::post('/obtener-adelantosecre', [App\Http\Controllers\SueldosecreController::class, 'obtenerlistasecreid'])->name('obtener-adelantosecre')->middleware('auth');
Route::post('/validar-montoadelantosecre', [App\Http\Controllers\AdelantosecreController::class, 'validaradelantosecre'])->name('validar-montoadelantosecre')->middleware('auth');
//secre sueldo
route::resource('sueldosecre',SueldosecreController::class)->middleware('auth');
Route::post('/obtener-fechainiciosusecre',[App\Http\Controllers\SueldosecreController::class, 'obtenerfechainiciosusecre'])->name('obtener-fechainiciosusecre')->middleware('auth');
Route::post('/obtener-sueldosecretaria', [App\Http\Controllers\SueldosecreController::class, 'obtenerSueldosecretaria'])->name('obtener-sueldosecretaria')->middleware('auth');
Route::post('/obtener-SumatoriaAdelantossecre', [App\Http\Controllers\AdelantosecreController::class, 'obtenersumatoriaadelantossecretaria'])->name('obtener-SumatoriaAdelantossecre')->middleware('auth');
Route::post('/obtener-mesessaldosecre', [App\Http\Controllers\SueldosecreController::class, 'mesessaldosecre'])->name('obtener-mesessaldosecre')->middleware('auth');
//profesor

route::resource('profesor', ProfesorController::class)->middleware('auth');
Route::post('/obtener-fechainicio2',[App\Http\Controllers\ProfesorController::class, 'obtenerfechainicio2'])->name('obtener-fechainicio2')->middleware('auth'); //buscar profesor rol admi
//profe adelanto
route::resource('adelantopro',adelantoprocontroller::class)->middleware('auth');
Route::post('/obtener-fechainicioproade',[App\Http\Controllers\AdelantoproController::class, 'obtenerfechainicioproade'])->name('obtener-fechainicioproade')->middleware('auth');//index ade pro
Route::post('/obtener-adelantodispopro', [App\Http\Controllers\AdelantoproController::class, 'adelantodispopro'])->name('obtener-adelantodispopro')->middleware('auth');//modal ver ade de ade
Route::post('/obtener-adelantopro', [App\Http\Controllers\SueldoproController::class, 'obtenerlistaproid'])->name('obtener-adelantopro')->middleware('auth');
Route::post('/validar-montoadelanto', [App\Http\Controllers\AdelantoproController::class, 'validaradelanto'])->name('validar-montoadelanto')->middleware('auth');
//sueldo profesor
route::resource('sueldopro',SueldoproController::class)->middleware('auth');
Route::post('/obtener-fechainiciosupro',[App\Http\Controllers\SueldoproController::class, 'obtenerfechainiciosupro'])->name('obtener-fechainiciosupro')->middleware('auth');
Route::post('/obtener-sueldoprofesor', [App\Http\Controllers\SueldoproController::class, 'obtenerSueldoProfesor'])->name('obtener-sueldoprofesor')->middleware('auth');
Route::post('/obtener-SumatoriaAdelantos', [App\Http\Controllers\AdelantoproController::class, 'obtenersumatoriaadelantosProfesor'])->name('obtener-SumatoriaAdelantos')->middleware('auth');
Route::post('/obtener-mesessaldopro', [App\Http\Controllers\SueldoproController::class, 'mesessaldopro'])->name('obtener-mesessaldopro')->middleware('auth');
route::resource('aula',AulaController::class)->middleware('auth');
Route::post('/buscar-aulas',[App\Http\Controllers\AulaController::class, 'buscaraulas'])->name('buscar-aulas')->middleware('auth'); //lista de aulas
route::resource('materia',MateriaController::class)->middleware('auth');   
Route::post('/buscar-materias',[App\Http\Controllers\MateriaController::class, 'buscarmaterias'])->name('buscar-materias')->middleware('auth'); //lista de aulas
route::resource('periodo',PeriodoController::class)->middleware('auth');
Route::post('/buscar-periodos',[App\Http\Controllers\PeriodoController::class, 'buscarperiodos'])->name('buscar-periodos')->middleware('auth'); //lista de aulas
//asignaciones
route::resource('asignarproma',AsignarpromaController::class)->middleware('auth');
Route::post('/obtener-fechainicioasig',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicioasignaciones'])->name('obtener-fechainicioasig')->middleware('auth'); //buscar de asignaciones
Route::post('/obtener-periodos', [App\Http\Controllers\AsignarpromaController::class, 'obtenerPeriodos'])->name('obtener-periodos')->middleware('auth');
Route::post('/obtener-aulas', [App\Http\Controllers\AsignarpromaController::class, 'obteneraulas'])->name('obtener-aulas')->middleware('auth');
//allumno
route::resource('alumno',AlumnoController::class)->middleware('auth');
Route::post('/obtener-fechainicioalumnos',[App\Http\Controllers\AlumnoController::class, 'obtenerfechainicioalumnos'])->name('obtener-fechainicioalumnos')->middleware('auth'); //lista de alumnos
//inscripcion
route::resource('inscripcion',InscripcionController::class)->middleware('auth');
Route::post('/obtener-fechainicioinscripciones',[App\Http\Controllers\InscripcionController::class, 'buscarfechainicioinscripciones'])->name('obtener-fechainicioinscripciones')->middleware('auth'); //lista de aulas
Route::post('/obtener-profesoresid',[App\Http\Controllers\AsignarpromaController::class, 'obtenerprofesoresid'])->name('obtener-profesoresid')->middleware('auth');//ajax de insc de profesor roo admi
Route::post('/obtener-materiasdelprofesorid',[App\Http\Controllers\AsignarpromaController::class, 'obtenermateriasdelprofesorid'])->name('obtener-materiasdelprofesorid')->middleware('auth');//ajas de inscrip de materias rol admi
Route::post('/obtener-periodosmateriaprofesor',[App\Http\Controllers\AsignarpromaController::class, 'obtenerperiodosmateriaprofesor'])->name('obtener-periodosmateriaprofesor')->middleware('auth');//ajax de inscri de period materias rol admi 
Route::post('/obtener-aulaperiodosmateriaprofesor',[App\Http\Controllers\AsignarpromaController::class, 'obteneraulaperiodosmateriaprofesor'])->name('obtener-aulaperiodosmateriaprofesor')->middleware('auth');//
//reportes secretaria
Route::get('/opciones-reportesecre', [App\Http\Controllers\SecretariaController::class, 'opcionesreportesecre'])->name('opciones-reportesecre')->middleware('auth');
Route::get('/repor-secre', [App\Http\Controllers\SecretariaController::class, 'reporsecres'])->name('repor-secre')->middleware('auth');
Route::post('/obtener-fechainiciosecre',[App\Http\Controllers\SecretariaController::class, 'obtenerfechainiciosecre'])->name('obtener-fechainiciosecre')->middleware('auth'); 

Route::get('/reporadesecre', [App\Http\Controllers\AdelantosecreController::class, 'reporadesecre'])->name('reporadesecre')->middleware('auth');//ruta
Route::post('/obtener-fechainiciosecreadereporte',[App\Http\Controllers\AdelantosecreController::class, 'obtenerfechainiciosecreadere'])->name('obtener-fechainiciosecreadereporte')->middleware('auth');//repor adelanto pro

Route::get('/reporsusecre', [App\Http\Controllers\SueldosecreController::class, 'reporsusecre'])->name('reporsusecre')->middleware('auth');//ruta
Route::post('/obtener-fechainiciosecresureporte',[App\Http\Controllers\SueldosecreController::class, 'obtenerfechainiciosecresureporte'])->name('obtener-fechainiciosecresureporte')->middleware('auth');//repor adelanto pro
//reporte profesor
Route::get('/reporopciones', [App\Http\Controllers\ProfesorController::class, 'opcionesreporte'])->name('reporopciones')->middleware('auth');
Route::get('/repor-pro', [App\Http\Controllers\ProfesorController::class, 'reporpro'])->name('repor-pro')->middleware('auth');
Route::post('/obtener-fechainicio',[App\Http\Controllers\ProfesorController::class, 'obtenerfechainicio'])->name('obtener-fechainicio')->middleware('auth'); 

Route::get('/reporasig', [App\Http\Controllers\AsignarpromaController::class, 'reporasig'])->name('reporasig')->middleware('auth');//reporte asiganciones profesor rol admi
Route::post('/obtener-fechainicioasigre',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicioasignacionesre'])->name('obtener-fechainicioasigre')->middleware('auth'); //repor asignacion de profe rol admi

Route::get('/reporadepro', [App\Http\Controllers\AdelantoproController::class, 'reporadepro'])->name('reporadepro')->middleware('auth');//ruta
Route::post('/obtener-fechainicioproadereporte',[App\Http\Controllers\AdelantoproController::class, 'obtenerfechainicioproadere'])->name('obtener-fechainicioproadereporte')->middleware('auth');//repor adelanto pro

Route::get('/reporsupro', [App\Http\Controllers\SueldoproController::class, 'reporsupro'])->name('reporsupro')->middleware('auth');//ruta
Route::post('/obtener-fechainicioprosureporte',[App\Http\Controllers\SueldoproController::class, 'obtenerfechainicioprosureporte'])->name('obtener-fechainicioprosureporte')->middleware('auth');//repor    
//reporte alumnos
Route::get('/opciones-reportealumno', [App\Http\Controllers\AlumnoController::class, 'opcionesreportealumno'])->name('opciones-reportealumno')->middleware('auth');
Route::get('/repor-alu', [App\Http\Controllers\AlumnoController::class, 'reporalu'])->name('repor-alu')->middleware('auth');// lista de alumnos rol admi
Route::post('/obtener-fechainicioreporalu',[App\Http\Controllers\AlumnoController::class, 'obtenerfechainicioreporalu'])->name('obtener-fechainicioreporalu')->middleware('auth'); //reporte de alumno rol admin ajax

Route::get('/notasreporte',[App\Http\Controllers\NotaController::class, 'notasreporte'])->name('notasreporte')->middleware('auth'); 
Route::post('/obtener-fechainicionotasecre',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicionotassecreuser'])->name('obtener-fechainicionotasecre')->middleware('auth'); //ajaax repor notas estudiantes rol admin

//rol profesor
route::resource('actividad',ActividadController::class)->middleware('auth');
Route::post('/buscar-actividades',[App\Http\Controllers\ActividadController::class, 'buscaractividades'])->name('buscar-actividades')->middleware('auth'); //lista de aulas

Route::get('/asigpro', [App\Http\Controllers\AsignarpromaController::class, 'index2'])->name('index2')->middleware('auth');
Route::post('/asigpro', [App\Http\Controllers\AsignarpromaController::class, 'index2'])->name('index2')->middleware('auth');
Route::post('/obtener-fechainicioasigprofeuser',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicioasigprofeuser'])->name('obtener-fechainicioasigprofeuser')->middleware('auth'); //asignaciones profesor user

Route::get('/alumpro', [App\Http\Controllers\AlumnoController::class, 'index2'])->name('index2')->middleware('auth');
Route::post('/alumpro', [App\Http\Controllers\AlumnoController::class, 'index2'])->name('index2')->middleware('auth');
Route::post('/obtener-fechainicioalumnosprofe',[App\Http\Controllers\InscripcionController::class, 'obtenerfechainicioalumnosprofe'])->name('obtener-fechainicioalumnosprofe')->middleware('auth');//rol profe notas ajax
Route::post('/obtener-eliminarnotaid',[App\Http\Controllers\NotaController::class, 'obtenereliminarnotaid'])->name('obtener-eliminarnotaid')->middleware('auth'); //edita nota
Route::post('/obtener-editarnota',[App\Http\Controllers\NotaController::class, 'obtenereeditarnota'])->name('obtener-editarnota')->middleware('auth'); //edita nota
Route::get('/profesor/show2/{id}', [App\Http\Controllers\ProfesorController::class,'show2'])->name('show2')->middleware('auth');//ver alumno profe
//reportes
Route::get('/reporte-asigproreporte', [App\Http\Controllers\AsignarpromaController::class, 'reporteasigproreporte'])->name('reporte-asigproreporte')->middleware('auth');//reporte de asisg profe user
Route::post('/obtener-fechainicioasigprofereporte',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicioasigprofeuserreporte'])->name('obtener-fechainicioasigprofereporte')->middleware('auth'); //asignaciones reporte profe user

Route::get('/alumproreporte',[App\Http\Controllers\AlumnoController::class, 'alumproreporte'])->name('alumproreporte')->middleware('auth'); //lista de alumnos reporte
Route::post('/obtener-fechainicioalumnoprofereporte',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicioalumnoprofeuserreporte'])->name('obtener-fechainicioalumnoprofereporte')->middleware('auth'); //alumnos reporte profe user
   
Route::post('/obtener-fechainicionotaprofe',[App\Http\Controllers\AsignarpromaController::class, 'buscarfechainicionotasprofeuser'])->name('obtener-fechainicionotaprofe')->middleware('auth'); 

Route::post('/custom/password/email',[App\Http\Controllers\Auth\ForgotPasswordController::class, 'customSendResetLinkEmail'])->name('EnviarTokenParaPassword');
Route::get('/proyecto/public/password/reset/{token}',[App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('custom.password.reset');