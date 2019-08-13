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

//Ejercicios
Route::get('/nuevoEjercicio', 'Gimnasio\Rutinas\RutinaController@vistaRegistrarEjercicio')->name('vistaRegistrarEjercicio');
Route::get('/cargar/card/rutina/{caja?}','Gimnasio\Rutinas\RutinaController@mostrarCardRutina')->name('jmostrarCardRutina');


//fin ejercicios





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
Route::delete('personal/eliminarRegistro/{id}', 'PersonalController@eliminarPersonal')->name('eliminarPersonal');
Route::get('/listado_personal','PersonalController@vistaPersonal')->name('vistaPersonal');//Vista Registrar

//Fin Personal



//Clientes
Route::get('/nuevo_cliente','ClienteController@vistaRegistrarCliente')->name('vistaRegistrarCliente');//Vista Registrar
Route::get('/nuevo_cliente/registrar/{nom?}/{ap?}/{am?}/{direccion?}/{correo?}/{tel?}/{contra?}/{t_us?}','ClienteController@RegistrarCliente')->name('RegistrarCliente');//Guardar Personal
Route::get('/modificar_cliente','ClienteController@ModificarClientevista')->name('ModificarClientevista');//Vista modificar
Route::get('/modificar_cliente/modificar/{id?}/{nom?}/{ap?}/{am?}/{direccion?}/{correo?}/{tel?}','ClienteController@ModificarCliente')->name('ModificarCliente');//Guardar Personal
Route::get('/Consulta/Cliente/{nom?}','ClienteController@ConsultaCliente')->name('ConsultaCliente');//Vista modificar
Route::delete('cliente/eliminarRegistro/{id}', 'ClienteController@eliminarCliente')->name('eliminarCliente');
Route::get('/Consultar_Cliente','ClienteController@vistaCliente')->name('vistaCliente');//Vista Registrar



//Fin clientes


//Roles
Route::get('/Roles','RolesController@vistaRoles')->name('vistaRoles');
Route::get('/get-roles', 'RolesController@getRoles')->name('getRoles');
Route::get('/get-roles-Admin','RolesController@RolesAdministrador')->name('AdminRoles');
Route::get('/get-usuarios-by-rol/{idRol?}', 'RolesController@UsuariosPorRol')->name('UsuariosPorRol');
Route::get('/get-permisos-by-rol/{idRol?}', 'RolesController@PermisosPorRol')->name('PermisosPorRol');
Route::get('/Roles-disponibles-Persona/{idPersona?}', 'RolesController@RolesDiferentesRol')->name('RolesDisponibles');
Route::get('/Permisos-de-rol', 'RolesController@getPermisos')->name('RolesDeRol');
Route::put('/registro-rol/', 'RolesController@RegistrarRol')->name('RegistroRol');

//Permisos

Route::get('/Permisos', 'PermisosControler@vistaPermisos')->name('vistaPermisos');
Route::get('/get-permisos', 'PermisosControler@getPermisos')->name('getPermisos');
Route::put('/registrar-permiso', 'PermisosControler@registroPermisos')->name('registroPermiso');

//Listado Personas

Route::get('/ListadoUsuariosRol' , 'ListadoRolesControler@vistaListado')->name('vistaListadoRol');
Route::get('/get-Listado', 'ListadoRolesControler@getListado')->name('GetListado');
Route::get('/roles-diferent-get/{idRol?}', 'ListadoRolesControler@diferentesRoles')->name('DiferentesRoles');
Route::put('/change-rol', 'ListadoRolesControler@ModificarRol')->name('ModificarRol');

Route::get('/get-Detalles-usuarios/{idUser?}', 'ListadoRolesControler@DetallesUsuario')->name('DetallesUsarioRol');

//Productos

Route::get('/productos', 'ProductsController@create');
Route::post('/productos_store', 'ProductsController@store');
Route::get('/productos/edit/{id?}','ProductsController@edit');

Route::get('/productos_edit', 'ProductsController@indexProductsEdit');
Route::get('/get_productos', 'ProductsController@getProductos');
Route::get('/get_productos/json', 'ProductsController@getProductosJSON');
Route::get('/get-Tipo/product', 'ProductsController@getTipos');
Route::get('/get-Tipo/product/discart/{id?}', 'ProductsController@getTiposDiscard');
Route::put('/edit-product/put', 'ProductsController@editarProducto');