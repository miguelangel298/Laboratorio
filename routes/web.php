

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

Route::group(['middleware' =>['auth', 'HasPermission']],function(){


Route::get('/', 'AdminController@Inicio');

// Route::get('/home', 'HomeController@index')->name('home');

			// AREA DE CLIENTES Y PERSONAS //
Route::get('/mantenimiento/clientes', 'MantenimientoController@Cliente')->name('clientes')->middleware('HasPermission:1,2,3');

Route::post('/clientes/crear', 'MantenimientoController@CrearCliente')->name('CrearCliente')->middleware('HasPermission:1,2,3');

Route::post('/paciente/crear', 'MantenimientoController@CrearPaciente')->name('CrearPaciente')->middleware('HasPermission:1,2,3');

Route::post('/paciente/update', 'MantenimientoController@UpdatePaciente')->name('UpdatePaciente')->middleware('HasPermission:1,2,3');

Route::get('/paciente-mostrar/{IdPersona}', 'MantenimientoController@PacienteMostrar')->name('PacienteMostrar')->middleware('HasPermission:1,2,3');

Route::get('/obtener/personas', 'MantenimientoController@ObtenerCliente')->name('ObtenerCliente')->middleware('HasPermission:1,2,3');

Route::get('/pacientes-list', 'MantenimientoController@ListadoPaciente')->name('ListadoPaciente')->middleware('HasPermission:1,2,3');

Route::get('/listadopaciente', 'MantenimientoController@ObtenerListadoPaciente')->name('ObtenerListadoPaciente')->middleware('HasPermission:1,2,3');

Route::get('/factura-listado', 'MantenimientoController@ListadoFactura')->name('ListadoFactura')->middleware('HasPermission:1,2,3');

Route::get('/listado-factura', 'MantenimientoController@ObtenerListadoFactura')->name('ObtenerListadoFactura')->middleware('HasPermission:1,2,3');

Route::post('/estado-update-factura', 'MantenimientoController@UpdateEstadoFactura')->name('UpdateEstadoFactura')->middleware('HasPermission:1,2,3');

	// AREA DE PROCEDIMIENTO //

Route::get('/mantenimiento/procedimiento', 'MantenimientoController@Procedimiento')->name('procedimiento')->middleware('HasPermission:1,2,3');

Route::post('/mantenimiento/procedimiento/nuevo', 'MantenimientoController@CrearProcedimiento')->name('CrearProcedimiento')->middleware('HasPermission:1,2,3');

Route::post('/mantenimiento/procedimiento/editar', 'MantenimientoController@EditarProcedimiento')->name('EditarProcedimiento')->middleware('HasPermission:1,2,3');

Route::get('/mantenimiento/procedimiento/listado', 'MantenimientoController@ListadoProcedimiento')->name('ListadoProcedimiento')->middleware('HasPermission:1,2,3');

Route::get('/mantenimiento/procedimiento/{id}/editar', 'MantenimientoController@MostrarProcedimiento')->name('MostrarProcedimiento')->middleware('HasPermission:1,2,3');

// AREA DE PROCEDIMIENTO //

Route::get('/mantenimiento/empleado', 'MantenimientoController@Empleado')->name('Empleado')->middleware('HasPermission:1,2,3');

Route::post('/mantenimiento/empleado/crear', 'MantenimientoController@CrearEmpleado')->name('CrearEmpleado')->middleware('HasPermission:1,2,3');

Route::post('/mantenimiento/empleado/update', 'MantenimientoController@UpdateEmpleado')->name('UpdateEmpleado')->middleware('HasPermission:1,2,3');

// AREA DE EMPRESA //

Route::get('/mantenimiento/empresa', 'MantenimientoController@Empresa')->name('Empresa')->middleware('HasPermission:1,2,3');

Route::post('/mantenimiento/empresa/crear', 'MantenimientoController@CrearEmpresa')->name('CrearEmpresa')->middleware('HasPermission:1,2,3');


Route::get('/mantenimiento/empresa/listado', 'MantenimientoController@EmpresaListado')->name('EmpresaListado')->middleware('HasPermission:1,2,3');

Route::get('/mantenimiento/sucursal-edit/{id}', 'MantenimientoController@mostrarSucursalPorId')->name('mostrarSucursalPorId')->middleware('HasPermission:1,2,3');

Route::post('/update-sucursal', 'MantenimientoController@editarSucursalPorId')->name('editarSucursalPorId')->middleware('HasPermission:1,2,3');

// Route::get('/mantenimiento/empleado/listado', 'MantenimientoController@EmpleadoListado')->name('EmpleadoListado')->middleware('HasPermission:1,2,3');

Route::get('/listado-empleado', 'MantenimientoController@EmpleadoListado')->name('EmpleadoListado')->middleware('HasPermission:1,2,3');

Route::get('/mostrar-empleado/{IdPersona}', 'MantenimientoController@EmpleadoMostrar')->name('EmpleadoMostrar')->middleware('HasPermission:1,2,3');

Route::post('/update-password', 'MantenimientoController@CambiarPassword')->name('CambiarPassword')->middleware('HasPermission:1,2,3');


// AREA DE FACTURAS //listadopaciente

Route::get('/factura', 'AdminController@Facturas')->name('Facturas')->middleware('HasPermission:1,2,3');

Route::get('/factura/cliente/datos/{cedula}', 'AdminController@DatosFacturaCliente')->name('DatosFacturaCliente')->middleware('HasPermission:1,2,3');

Route::get('/procemiento-pesos/{moneda}/{id}', 'AdminController@ProcedimientoPesos')->name('ProcedimientoPesos')->middleware('HasPermission:1,2,3');

Route::post('/factura/detalle/crear', 'AdminController@DetalleFacturacrear')->name('DetalleFacturacrear')->middleware('HasPermission:1,2,3');

Route::post('/factura-generar', 'AdminController@CrearFactura')->name('CrearFactura')->middleware('HasPermission:1,2,3');

Route::post('/factura-abono', 'AdminController@preAbonoFactura')->name('preAbonoFactura')->middleware('HasPermission:1,2,3');

Route::get('/factura-id', 'AdminController@IdFacturaMax')->name('IdFacturaMax')->middleware('HasPermission:1,2,3');

Route::get('/factura-print/{IdFactura}', 'AdminController@PrintFactura')->name('PrintFactura')->middleware('HasPermission:1,2,3');

// ARE DE REPORTE //

Route::get('/reporte/ganancia', 'ReporteController@ganancias')->name('ganancias')->middleware('HasPermission:1,2,3');

Route::get('/reporte-ganancia/{IdMoneda}/{IdSucursal}/{desde}/{hasta}', 'ReporteController@ObtenerGanancias')->name('ObtenerGanancias')->middleware('HasPermission:1,2,3');
Route::get('/reporte-ganancia-total/{IdMoneda}/{IdSucursal}/{desde}/{hasta}', 'ReporteController@ObtenerGananciasTotal')->name('ObtenerGananciasTotal')->middleware('HasPermission:1,2,3');

Route::get('/reporte/factura', 'ReporteController@Factura')->name('Factura')->middleware('HasPermission:1,2,3');

Route::get('/reporte/factura/{IdFactura}', 'ReporteController@ObtenerFactura')->name('ObtenerFactura')->middleware('HasPermission:1,2,3');

Route::get('/reporte/detalle-factura/{IdFactura}', 'ReporteController@ObtenerDetalleFactura')->name('ObtenerDetalleFactura')->middleware('HasPermission:1,2,3');


//--------------PDF-------------------//

Route::get('/pdf/reporte-ganancia/{IdMoneda}/{IdSucursal}/{desde}/{hasta}','ReporteController@PdfGanancias')->name('PdfGanancias')->middleware('HasPermission:1,2,3');

Route::get('/pdf/factura/{id}','ReporteController@PdfFactura')->name('PdfFactura')->middleware('HasPermission:1,2,3');

//------------AREA DE EMPLEADO--------------//



// -------------- INICIO -------------------//
Route::get('/divisas/valor/{id}', 'AdminController@obtenerActualDivisa')->name('ObtenerValorDivisa')->middleware('HasPermission:1,2,3');

Route::post('/divisas/actualizar', 'AdminController@updateDivisa')->name('UpdateValorDivisa')->middleware('HasPermission:1,2,3');

Route::get('/chart/ingresos', 'AdminController@ObtenerIngresosUltimoAnio')->name('ObtenerIngresosUltimoAnio')->middleware('HasPermission:1,2,3');

Route::get('/pacientes/total', 'AdminController@ObtenerTotalPacientes')->name('ObtenerTotalFacturaPorSucursal')->middleware('HasPermission:1,2,3');

Route::get('/facturas/total', 'AdminController@ObtenerTotalFacturaPorSucursal')->name('ObtenerTotalPacientes')->middleware('HasPermission:1,2,3');

});

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
