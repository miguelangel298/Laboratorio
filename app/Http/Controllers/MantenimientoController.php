<?php

namespace Laboratorio\Http\Controllers;

use Illuminate\Http\Request;
use Laboratorio\Personas;
use Laboratorio\Paciente;
use Laboratorio\Empresa;
use DB;
use DataTables;
use Auth;

class MantenimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //--------------------AREA DE CLIENTE-------------------------
    public function Cliente(){
      $nacionalidad = DB::SELECT("SELECT nacionalidades.IdNacionalidades, nacionalidades.Nombre from nacionalidades");
    	return view('admin.mantenimiento.personas',compact('nacionalidad'));
    }

    public function CrearCliente(Request $request){
        Personas::create($request->all());
            return response()->json([
                "mensaje"=>"Creado"
                ]);

    }

    public function ObtenerCliente(){
    	$Obtener = DB::select("SELECT MAX(Idpersona) as Idpersona from personas");
		return Response()->json($Obtener[0]);
    }

    public function CrearPaciente(Request $request){
      $creacion =  Paciente::create($request->all());
            return response()->json([
                "mensaje"=>"Creado"
                ]);

    }


//--------------------AREA DE PROCEDIMIENTO-------------------------

    public function Procedimiento(){

        return view('admin.mantenimiento.procedimiento');
    }

    public function CrearProcedimiento(Request $request){
		$nombre = $request->input('Nombre');
		$costo = $request->input('CostoPeso');
		$CostoDolar = $request->input('CostoDolar');
		$IdUser = $request->input('IdUser');
    	$guardar  = DB::SELECT(DB::raw("CALL INSERT_Procedimiento('$nombre','$costo','$CostoDolar','$IdUser')"));
    	return response()->json([
                "mensaje"=>"Creado"
                ]);
    }

    public function MostrarProcedimiento($id){
    	$MostrarProcedimiento = DB::SELECT(DB::raw("SELECT T.Nombre as Procedimiento, T.Costo as Peso,T2.Costo as Dolar
			FROM	(SELECT procedimientos.IdProcedimiento,procedimientos.Nombre, costos.Costo
						FROM 	procedimientos inner JOIN
								costos on costos.IdProcedimiento=procedimientos.IdProcedimiento
						WHERE	procedimientos.IdProcedimiento='$id' and costos.IdMoneda=1) T inner JOIN
			         (SELECT procedimientos.IdProcedimiento,procedimientos.Nombre, costos.Costo
						FROM 	procedimientos inner JOIN
								costos on costos.IdProcedimiento=procedimientos.IdProcedimiento
						WHERE	procedimientos.IdProcedimiento='$id' and costos.IdMoneda=2) T2 on T.IdProcedimiento=T2.IdProcedimiento
			"));

    	return Response()->json($MostrarProcedimiento[0]);
    }

    public function EditarProcedimiento(Request $request){
		$nombre = $request->input('Nombre');
		$costo = $request->input('CostoPeso');
		$CostoDolar = $request->input('CostoDolar');
		$IdProcedimiento = $request->input('IdProcedimiento');
		$IdUser = $request->input('IdUser');
    	$guardar  = DB::SELECT(DB::raw("CALL UPDATE_Procedimiento('$nombre','$costo','$CostoDolar','$IdProcedimiento','$IdUser')"));
    	return response()->json([
                "mensaje"=>"Creado"
                ]);
    }


    public function ListadoProcedimiento(){
    	return Datatables::of(DB::select("call SELECT_Procedimientos"))->make(true);
    }


 //---------------------------AREA DE EMPLEADO-------------------------------//

    public function Empleado(){
        $Sucursales = DB::SELECT("SELECT sucursales.Nombre, sucursales.IdSucursal
                                                from sucursales  ");

        $Cargos = DB::select("SELECT cargos.IdCargo, cargos.Nombre FROM cargos");


        return view('admin.mantenimiento.empleado',compact('Sucursales','Cargos'));
    }

    public function CrearEmpleado(Request $request){
        $Nombres = $request->input('Nombres');
        $Apellido1 = $request->input('Apellido1');
        $Apellido2 = $request->input('Apellido2');
        $IdSexo = $request->input('IdSexo');
        $Correo = $request->input('Correo');
        $Cedula = $request->input('Cedula');
        $FechaNacimineto = $request->input('FechaNacimineto');
        $IdNacionalidad = $request->input('IdNacionalidad');
        $Celular = $request->input('Celular');
        $Telefono = $request->input('Telefono');
        $IdUser = $request->input('IdUser');
        $IdSucursal = $request->input('IdSucursal');
        $IdCargo = $request->input('IdCargo');
        $Pass = bcrypt($request->input('Pass'));
        $token = "";
        $emial = "";
        $guardar  = DB::SELECT(DB::raw("CALL INSERT_PersonaEmpleado('$Cedula','$Nombres','$Apellido1','$Apellido2','$FechaNacimineto','$IdNacionalidad',' $IdSexo','$Telefono','$Celular','$Correo','$IdUser','$Pass','$emial','$token','$IdCargo','$IdSucursal')"));
        return response()->json([
                "mensaje"=>"Creado"
                ]);
    }

    //--------------UPDATE EMPLEADO---------------------------------//

    public function UpdateEmpleado(Request $request){
        $Nombres = $request->input('Nombres');
        $Apellido1 = $request->input('Apellido1');
        $Apellido2 = $request->input('Apellido2');
        $IdSexo = $request->input('IdSexo');
        $Correo = $request->input('Correo');
        $Cedula = $request->input('Cedula');
        $FechaNacimineto = $request->input('FechaNacimineto');
        $IdNacionalidad = $request->input('IdNacionalidad');
        $Celular = $request->input('Celular');
        $Telefono = $request->input('Telefono');
        $IdUser = $request->input('IdUser');
        $IdSucursal = $request->input('IdSucursal');
        $IdCargo = $request->input('IdCargo');

        $guardar  = DB::SELECT(DB::raw("CALL UPDATE_PersonaEmpleado('$Cedula','$Nombres','$Apellido1','$Apellido2','$FechaNacimineto','$IdNacionalidad',' $IdSexo','$Telefono','$Celular','$Correo','$IdUser','$IdSucursal','$IdCargo')"));
        return response()->json([
                "mensaje"=>"Creado"
                ]);
    }
     //---------------------------AREA DE EMPRESA-------------------------------//

    public function Empresa(){

        return view('admin.mantenimiento.empresa');
    }

    public function CrearEmpresa(Request $request){
            Empresa::create($request->all());
            return response()->json([
                "mensaje"=>"Creado"
                ]);
    }

     public function EmpresaListado(){
     $listado = DB::SELECT("SELECT s.Codigo, s.Nombre, s.AnoApertura,s.Direccion, if(s.Estado = 1,'ACTIVA','NO ACTIVA') AS Estado, s.IdSucursal
                                    from sucursales as s
                                    order by s.IdSucursal desc ");
        return Response()->json($listado);
    }

    public function mostrarSucursalPorId($id){
      $sucursal = DB::select("select * from sucursales where IdSucursal = '$id'");
      if(count($sucursal) == 0){
        return;
      }
      return Response()->json($sucursal[0]);
    }

    public function editarSucursalPorId(Request $request){
      $IdSucursal = $request->input('IdSucursal');
      $Nombre = $request->input('Nombre');
      $AnoApertura = $request->input('AnoApertura');
      $Codigo = $request->input('Codigo');
      $Telefono = $request->input('Telefono');
      $Direccion = $request->input('Direccion');
      $Estado = $request->input('Estado');
      $IdMunicipio = $request->input('IdMunicipio');

      $fields = [
        'Nombre' => $Nombre,
        'AnoApertura' => $AnoApertura,
        'Codigo' => $Codigo,
        'Telefono' => $Telefono,
        'Direccion' => $Direccion,
        'Estado' => $Estado,
        'IdMunicipio' => $IdMunicipio
      ];

      $aja = Empresa::find($IdSucursal);
			$aja->fill($fields);
			$aja->save();
		return response()->json([
				"mensaje"=>"Actualizado"
				]);

    }

    public function ListadoPaciente(){
        return view('admin.paciente.pacientelis');
    }

    public function ObtenerListadoPaciente(){
         return Datatables::of(DB::select("call SELECT_Pacientes()"))->make(true);
    }

    public function ListadoFactura(){
        return view('admin.facturas.listadofactura');
    }

    public function ObtenerListadoFactura(){
        $IdSucursal = Auth::user()->IdSucursal;
         return Datatables::of(DB::select("call SELECT_facturas('$IdSucursal','$IdSucursal')"))->make(true);
    }

    public function UpdateEstadoFactura(Request $request){
        $IdEstadoFactura = $request->input('IdEstadoFactura');
        $IdFactura = $request->input('IdFactura');
        $ModificadoPor = $request->input('ModificadoPor');
        $update = DB::SELECT("call UPDATE_FacturaEstado('$IdEstadoFactura','$ModificadoPor','$IdFactura')");
        return response()->json([
                "mensaje"=>"Creado"
                ]);
    }

    public function EmpleadoIndex(){
        return view('admin.empleado.index');
    }
    public function EmpleadoListado(){
        return Datatables::of(DB::select("CALL select_usuarios()"))->make(true);
    }

    public function EmpleadoMostrar($IdPersona){
        $datos = DB::select("call SELECT_PersonaEmpleado('$IdPersona')");
        return Response()->json($datos[0]);
    }

    public function CambiarPassword(Request $request){
        $name = $request->input('UserName');
        $Pass = bcrypt($request->input('pass'));
        $guardar  = DB::statement("call UPDATE_ContraseñaUsuarios('$Pass','$name')");
        return response()->json([
                "mensaje"=>"Actualizada"
                ]);
    }

    public function PacienteMostrar($IdPersona){
        $datos = DB::select("call SELECT_PersonaPaciente('$IdPersona')");
        return Response()->json($datos[0]);
    }

    public function UpdatePaciente(Request $request){
        $Nombres = $request->input('Nombres');
        $Apellido1 = $request->input('Apellido1');
        $Apellido2 = $request->input('Apellido2');
        $IdSexo = $request->input('IdSexo');
        $NumeroSeguro = $request->input('NumeroSeguro');
        $Correo = $request->input('Correo');
        $Cedula = $request->input('Cedula');
        $FechaNacimineto = $request->input('FechaNacimineto');
        $IdNacionalidad = $request->input('IdNacionalidad');
        $Celular = $request->input('Celular');
        $Telefono = $request->input('Telefono');
        $IdPersona = $request->input('IdPersona');
        $SeguroMedico = $request->input('SeguroMedico');
        $guardar  = DB::SELECT(DB::raw("CALL UPDATE_PersonaPaciente('$Cedula','$Nombres','$Apellido1','$Apellido2','$FechaNacimineto','$IdNacionalidad',' $IdSexo','$Telefono','$Celular','$Correo','$SeguroMedico','$IdPersona', '$NumeroSeguro')"));
        return response()->json([
                "mensaje"=>"Creado"
                ]);
    }


}
