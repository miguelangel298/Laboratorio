<?php

namespace Laboratorio\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class ReporteController extends Controller
{

  public function __construct()
    {
       $this->middleware('auth');
    }
   public function ganancias(){
   		$sucursales = DB::SELECT("SELECT IdSucursal, Nombre from sucursales");
   		return view('admin.reporte.ganancia',compact('sucursales'));
   }

   public function ObtenerGanancias($IdMoneda,$IdSucursal,$desde,$hasta){
     $guardar = null;
      if($IdSucursal == 0){
        $guardar  = DB::SELECT(DB::raw("CALL SELECT_GananciasByFechaMoneda('$IdMoneda','$desde','$hasta')"));
      } else {
        $guardar  = DB::SELECT(DB::raw("CALL SELECT_GanaciasByFechaMonedaSucursal('$IdMoneda','$IdSucursal','$desde','$hasta')"));
      }
      return Response()->json($guardar);
   }

   public function ObtenerGananciasTotal($IdMoneda, $IdSucursal, $desde, $hasta){
     $total = null;
     if ($IdSucursal == 0) {
       $total = DB::SELECT(DB::raw("CALL SELECT_GanaciasByFechaMonedaTotal('$IdMoneda','$desde','$hasta')"));
     } else {
       $total = DB::SELECT(DB::raw("CALL SELECT_GanaciasByFechaMonedaSucursalTotal('$IdMoneda','$IdSucursal','$desde','$hasta')"));
     }
     if (count($total)) {
       return response()->json($total[0]);
     }
     return 0;
   }


   public function PdfGanancias($IdMoneda,$IdSucursal,$desde,$hasta){
    if($IdSucursal == 0){
        $Ganancias = DB::SELECT(" SELECT    factura.Fecha, users.name Caja,sucursales.Nombre Sucursal,factura.IdFactura, procedimientos.Nombre Procedimiento,monedas.Simbolo, costos.Costo
    FROM    factura inner JOIN
                detallefactura on detallefactura.IdFactura=factura.IdFactura INNER JOIN
                procedimientos on procedimientos.IdProcedimiento=detallefactura.IdProcedimiento inner JOIN
                monedas ON monedas.IdMoneda = factura.IdMoneda INNER JOIN
                costos ON costos.IdMoneda = monedas.IdMoneda  and costos.IdProcedimiento=procedimientos.IdProcedimiento inner JOIN
                users ON users.IdUser = factura.ModificadoPor INNER JOIN
                sucursales on sucursales.IdSucursal = factura.IdSucursal
    WHERE   factura.IdMoneda = '$IdMoneda' and factura.IdEstadoFactura=1 and ((substring(cast(factura.Fecha AS CHAR),1,10)) BETWEEN '$desde' and '$hasta')
    order by  factura.Fecha, factura.IdFactura,factura.IdSucursal ASC;");
        $pdf = PDF::loadView('admin.reporte.archivos-pdf.pdfganancia',['Ganancias' => $Ganancias]);
        $pdf->setOptions(['isRemoteEnabled' => true, 'isJavascriptEnabled' => true, 'isHtml5ParserEnabled' => true]);
        return $pdf->download('Ganancias.pdf');
    }else{
   $Ganancias  = DB::SELECT(DB::raw("CALL SELECT_GanaciasByFechaMonedaSucursal('$IdMoneda','$IdSucursal','$desde','$hasta')"));
        $pdf = PDF::loadView('admin.reporte.archivos-pdf.pdfganancia',['Ganancias' => $Ganancias]);
        $pdf->setOptions(['isRemoteEnabled' => true, 'isJavascriptEnabled' => true, 'isHtml5ParserEnabled' => true]);
        return $pdf->download('Ganancias.pdf');
    }


   }

   public function Factura(){
   		return view('admin.reporte.factura');
   }

   public function ObtenerFactura($IdFactura){
    	$datos  = DB::SELECT(DB::raw("CALL SELECT_FacturaByIdFactura('$IdFactura')"));
      if (count($datos)) {
        return Response()->json($datos[0]);
      }
      return response()->json(['error' => 'no_existe']);
   }

   public function ObtenerDetalleFactura($IdFactura){
      $datos  = DB::SELECT(DB::raw("CALL SELECT_FacturaDetallesByIdFactura('$IdFactura')"));
      return Response()->json($datos);
   }

   public function PdfFactura($IdFactura){
        $datos  = DB::SELECT(DB::raw("CALL SELECT_FacturaByIdFactura('$IdFactura')"));
        $procedimientos = DB::SELECT(DB::raw("CALL SELECT_FacturaDetallesByIdFactura('$IdFactura')"));


        // return view('admin.reporte.archivos-pdf.pdffactura',['datos' => $datos,'procedimientos' => $procedimientos]);
        $pdf = PDF::loadView('admin.reporte.archivos-pdf.pdffactura',['datos' => $datos,'procedimientos' => $procedimientos]);
        $pdf->setOptions(['isRemoteEnabled' => true, 'isJavascriptEnabled' => true, 'isHtml5ParserEnabled' => true]);
        return $pdf->download('Ganancias.pdf');
   }
}
