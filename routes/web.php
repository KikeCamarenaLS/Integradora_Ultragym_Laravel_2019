<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'PrincipalController@indexView')->name('indexRoute');
Route::get('/principal', 'PrincipalController@indexView')->name('indexRou');


Route::get('/principal/Cupones','PrincipalController@ConsultaPersonalPDF')->name('DescargarPDF');



//paquetes
// Abre vista de nuevo paquete
Route::get('/home/nuevo_paquete','PaqueteController@vistaRegistrarPaquete')->name('vistaRegistrarPaquete');

// reguistra un nuevo paquete
Route::post('/home/nuevo_paquete/registrar','PaqueteController@RegistrarPaquete')->name('RegistrarPaquete');

//abre el listado de paquetes para administrador
Route::get('/listado_paquete','PaqueteController@ListadoPaquetes')->name('vistaListadoPaquetes');
Route::get('/cargar/tabla/paquetes','PaqueteController@mostrarTablaPersona')->name('mostrarTablaPersona');
Route::get('/eliminar/tabla/paquetes/{id}','PaqueteController@eliminarTablaPaquetes')->name('eliminarTablaPaquetes');
Route::get('/modificar/paquetes/{id}/{paquete}/{descripcion?}/{precio?}','PaqueteController@modificarpaquete')->name('modificarpaquete');

//abre el listado de paquetes para administrador
Route::get('/listado_paquete_usuario','PaqueteController@ListadoPaquetesUsuario')->name('ListadoPaquetesUsuario');
//fin paquetes


//Rutinas
Route::get('/nuevaRutina','Gimnasio\Rutinas\RutinaController@vistaRegistrarRutina')->name('vistaRegistrarRutina');
Route::post('/RegistrarRutina','Gimnasio\Rutinas\RutinaController@registrarRutina')->name('registrarRutina');

//finRutinas





Route::get('/home', 'UsuarioController@principal')->name('usuarioPrincipal');

//Login
Route::post('/principal/Verifica','PrincipalController@Login')->name('principal.Login');


Route::get('/registro', function () {
    return view('Index/registro');
});

Auth::routes();

//hasta aqui carm,ociinternaldebug

Route::get('/registro', function () {
    return view('Index/registro');
});


Route::post('/principal', 'PrincipalController@store')->name('principal.store');


//Personal
Route::get('/nuevo_personal','PersonalController@vistaRegistrarPersonal')->name('vistaRegistrarPersonal');//Vista Registrar
Route::get('/nuevo_personal/registrar/{nom?}/{ap?}/{am?}/{direccion?}/{correo?}/{tel?}/{contra?}/{t_us?}/{fecha?}','PersonalController@RegistrarPersonal')->name('vistaRegistrarPersonal');//Guardar Personal
Route::get('/comboRoles/Roles','PersonalController@comboRoles')->name('comboRoles');
Route::get('/modificar_personal','PersonalController@ModificarPersonalvista')->name('ModificarPersonalvista');//Vista modificar
Route::get('/Consulta/Personal/{nom?}','PersonalController@ConsultaPersonal')->name('ConsultaPersonal');//Vista modificar
Route::get('/modificar_personal/modificar/{id?}/{nom?}/{ap?}/{am?}/{direccion?}/{correo?}/{tel?}/{fecha?}','PersonalController@ModificarPersona')->name('vistaModificarPersona');//Guardar Personal






//Fin Personal

//Roles
Route::get('/Roles','RolesController@vistaRoles')->name('vistaRoles');
Route::get('/get-roles', 'RolesController@getRoles')->name('getRoles');
Route::get('/get-roles-Admin','RolesController@RolesAdministrador')->name('AdminRoles');
Route::get('/get-usuarios-by-rol/{idRol?}', 'RolesController@UsuariosPorRol')->name('UsuariosPorRol');
Route::get('/get-permisos-by-rol/{idRol?}', 'RolesController@PermisosPorRol')->name('PermisosPorRol');
Route::get('/Roles-disponibles-Persona/{idPersona?}', 'RolesController@RolesDiferentesRol')->name('RolesDisponibles');
Route::get('/Permisos-de-rol', 'RolesController@getPermisos')->name('RolesDeRol');
Route::put('/registro-rol/', 'RolesController@RegistrarRol')->name('RegistroRol');
