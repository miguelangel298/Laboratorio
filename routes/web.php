

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


Route::get('/', 'AdminController@Inicio');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


			// AREA DE CLIENTES Y PERSONAS //
Route::get('/mantenimiento/clientes', 'MantenimientoController@Cliente')->name('clientes');

Route::post('/clientes/crear', 'MantenimientoController@CrearCliente')->name('CrearCliente');

Route::post('/paciente/crear', 'MantenimientoController@CrearPaciente')->name('CrearPaciente');

Route::post('/paciente/update', 'MantenimientoController@UpdatePaciente')->name('UpdatePaciente');

Route::get('/paciente-mostrar/{IdPersona}', 'MantenimientoController@PacienteMostrar')->name('PacienteMostrar');

Route::get('/obtener/personas', 'MantenimientoController@ObtenerCliente')->name('ObtenerCliente');

Route::get('/pacientes-list', 'MantenimientoController@ListadoPaciente')->name('ListadoPaciente');

Route::get('/listadopaciente', 'MantenimientoController@ObtenerListadoPaciente')->name('ObtenerListadoPaciente');

Route::get('/factura-listado', 'MantenimientoController@ListadoFactura')->name('ListadoFactura');

Route::get('/listado-factura', 'MantenimientoController@ObtenerListadoFactura')->name('ObtenerListadoFactura');

Route::post('/estado-update-factura', 'MantenimientoController@UpdateEstadoFactura')->name('UpdateEstadoFactura');

	// AREA DE PROCEDIMIENTO //

Route::get('/mantenimiento/procedimiento', 'MantenimientoController@Procedimiento')->name('procedimiento');

Route::post('/mantenimiento/procedimiento/nuevo', 'MantenimientoController@CrearProcedimiento')->name('CrearProcedimiento');

Route::post('/mantenimiento/procedimiento/editar', 'MantenimientoController@EditarProcedimiento')->name('EditarProcedimiento');

Route::get('/mantenimiento/procedimiento/listado', 'MantenimientoController@ListadoProcedimiento')->name('ListadoProcedimiento');

Route::get('/mantenimiento/procedimiento/{id}/editar', 'MantenimientoController@MostrarProcedimiento')->name('MostrarProcedimiento');

// AREA DE PROCEDIMIENTO //

Route::get('/mantenimiento/empleado', 'MantenimientoController@Empleado')->name('Empleado');

Route::post('/mantenimiento/empleado/crear', 'MantenimientoController@CrearEmpleado')->name('CrearEmpleado');

Route::post('/mantenimiento/empleado/update', 'MantenimientoController@UpdateEmpleado')->name('UpdateEmpleado');

// AREA DE EMPRESA //

Route::get('/mantenimiento/empresa', 'MantenimientoController@Empresa')->name('Empresa');

Route::post('/mantenimiento/empresa/crear', 'MantenimientoController@CrearEmpresa')->name('CrearEmpresa');


Route::get('/mantenimiento/empresa/listado', 'MantenimientoController@EmpresaListado')->name('EmpresaListado');

Route::get('/mantenimiento/sucursal-edit/{id}', 'MantenimientoController@mostrarSucursalPorId')->name('mostrarSucursalPorId');

Route::post('/update-sucursal', 'MantenimientoController@editarSucursalPorId')->name('editarSucursalPorId');

// Route::get('/mantenimiento/empleado/listado', 'MantenimientoController@EmpleadoListado')->name('EmpleadoListado');

Route::get('/listado-empleado', 'MantenimientoController@EmpleadoListado')->name('EmpleadoListado');

Route::get('/mostrar-empleado/{IdPersona}', 'MantenimientoController@EmpleadoMostrar')->name('EmpleadoMostrar');

Route::post('/update-password', 'MantenimientoController@CambiarPassword')->name('CambiarPassword');


// AREA DE FACTURAS //listadopaciente

Route::get('/factura', 'AdminController@Facturas')->name('Facturas');

Route::get('/factura/cliente/datos/{cedula}', 'AdminController@DatosFacturaCliente')->name('DatosFacturaCliente');

Route::get('/procemiento-pesos/{moneda}/{id}', 'AdminController@ProcedimientoPesos')->name('ProcedimientoPesos');

Route::post('/factura/detalle/crear', 'AdminController@DetalleFacturacrear')->name('DetalleFacturacrear');

Route::post('/factura-generar', 'AdminController@CrearFactura')->name('CrearFactura');

Route::get('/factura-id', 'AdminController@IdFacturaMax')->name('IdFacturaMax');

Route::get('/factura-print/{IdFactura}', 'AdminController@PrintFactura')->name('PrintFactura');

// ARE DE REPORTE //

Route::get('/reporte/ganancia', 'ReporteController@ganancias')->name('ganancias');

Route::get('/reporte-ganancia/{IdMoneda}/{IdSucursal}/{desde}/{hasta}', 'ReporteController@ObtenerGanancias')->name('ObtenerGanancias');

Route::get('/reporte/factura', 'ReporteController@Factura')->name('Factura');

Route::get('/reporte/factura/{IdFactura}', 'ReporteController@ObtenerFactura')->name('ObtenerFactura');

Route::get('/reporte/detalle-factura/{IdFactura}', 'ReporteController@ObtenerDetalleFactura')->name('ObtenerDetalleFactura');


//--------------PDF-------------------//

Route::get('/pdf/reporte-ganancia/{IdMoneda}/{IdSucursal}/{desde}/{hasta}','ReporteController@PdfGanancias')->name('PdfGanancias');

Route::get('/pdf/factura/{id}','ReporteController@PdfFactura')->name('PdfFactura');

//------------AREA DE EMPLEADO--------------//



// -------------- INICIO -------------------//
Route::get('/divisas/valor/{id}', 'AdminController@obtenerActualDivisa')->name('ObtenerValorDivisa');

Route::post('/divisas/actualizar', 'AdminController@updateDivisa')->name('UpdateValorDivisa');

Route::get('/chart/ingresos', 'AdminController@ObtenerIngresosUltimoAnio')->name('ObtenerIngresosUltimoAnio');

Route::get('/pacientes/total', 'AdminController@ObtenerTotalPacientes')->name('ObtenerTotalFacturaPorSucursal');

Route::get('/facturas/total', 'AdminController@ObtenerTotalFacturaPorSucursal')->name('ObtenerTotalPacientes');
