<?php

namespace Laboratorio\Http\Controllers;

use Illuminate\Http\Request;
use Laboratorio\Personas;
use Laboratorio\DetalleFactura;
use DB;
use Auth;
class AdminController extends Controller
{

       public function __construct()
    {
        $this->middleware('auth');
    }

    public function Inicio(){

        return view ('admin.inicio');
    }

     public function DetalleFacturacrear(Request $request){
        DetalleFactura::create($request->all());
            return response()->json([
                "mensaje"=>"Creado"
                ]);

    }

    public function Facturas(){

        $clientes = DB::SELECT("CALL SELECT_FiltroPaciente()");
        $procedimientos = DB::SELECT("SELECT p.Nombre, p.IdProcedimiento  FROM procedimientos p");
        return view ('admin.facturas.factura',compact('procedimientos','clientes'));
    }

    public function PrintFactura($IdFactura){
        $datos  = DB::SELECT(DB::raw("CALL SELECT_FacturaByIdFactura('$IdFactura')"));
        $procedimientos = DB::SELECT(DB::raw("CALL SELECT_FacturaDetallesByIdFactura('$IdFactura')"));
        return view('admin.reporte.archivos-pdf.pdffactura',['datos' => $datos,'procedimientos' => $procedimientos]);

    }

    public function IdFacturaMax(){
        $datos = DB::SELECT("SELECT max(factura.IdFactura) as IdFactura from factura");
       return response()->json($datos[0]);
    }

    public function CrearFactura(Request $request){
        $IdPersona = $request->input('IdPersona');
        $IdMoneda = $request->input('IdMoneda');
        $IdTipoPago = $request->input('IdTipoPago');
        $Total = $request->input('Total');
        $Itbis = $request->input('Itbis');
        $Descuento = $request->input('Descuento');
        $TotalPagar = $request->input('TotalPagar');
        $ModificadoPor = Auth::user()->IdPersona;
        $IdSucursal = Auth::user()->IdSucursal;
        $monto = $request->input('Monto');
        $guardar  = DB::SELECT(DB::raw("CALL INSERT_Factura('$IdPersona','$IdMoneda','$IdTipoPago' ,'$Total','$Itbis','$Descuento','$TotalPagar','$ModificadoPor','$IdSucursal')"));

        if($monto != ""){
          $IdFactura = DB::SELECT("SELECT max(factura.IdFactura) as IdFactura from factura");
          $IdFacturaId = $IdFactura[0]->IdFactura;
          $this->abonoFactura($IdFacturaId,$monto);
        }

        return response()->json([
                "mensaje"=>"Creado"
                ]);
        }

        public function abonoFactura($IdFactura,$monto){
          $abono = DB::statement("call INSERT_AbonoFactura('$IdFactura','$monto')");
          // return response()->json([
          //         "mensaje"=>"Creado"
          //         ]);
        }


    public function DatosFacturaCliente($cedula){
        $datos = DB::SELECT("SELECT  CONCAT(personas.Nombres,' ',personas.Apellido1,' ',personas.Apellido2) AS Nombre, personas.Cedula,personas.Correo,nacionalidades.Nombre as IdNacionalidad,personas.FechaNacimineto,personas.Celular, pacientes.SeguroMedico,pacientes.IdPersona
                                                from    personas inner JOIN
                                                        nacionalidades ON nacionalidades.IdNacionalidades =                                                             personas.IdNacionalidad inner join
                                                        pacientes on pacientes.IdPersona = personas.Idpersona

                                                where   personas.Idpersona = '$cedula'");
        if($datos != null){
        return Response()->json($datos[0]);
        }else{
            return response()->json([
                "Error"=>"Funciona"
                ]);
        }

    }

    public function ProcedimientoPesos($moneda,$id){
        $procedimientos = DB::SELECT("SELECT T.Nombre as Procedimiento, T.Costo as Peso, T.IdProcedimiento
                                            FROM    (SELECT procedimientos.IdProcedimiento,procedimientos.Nombre, costos.Costo
                                                    FROM    procedimientos inner JOIN
                                                            costos on costos.IdProcedimiento=procedimientos.IdProcedimiento
                                                    WHERE    costos.IdMoneda='$moneda') T
                                            where T.IdProcedimiento = '$id'");

        return Response()->json($procedimientos[0]);
    }
}
