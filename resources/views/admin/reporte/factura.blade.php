@extends('layouts.admin')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="content-header">
      <h1>
       Reporte
        <small>Factura</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Reporte</li>
      </ol>
</section><br>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Reporte Por Factura</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row  ">
            <div class="col-md-3 col-md-offset-4 ">
              <div class="form-group ">
                <div id="DivS"><form >
                  <input type="number"  id="IdFactura" class="form-control" placeholder="Nº Factura" name="Factura" >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer ">
         <button type="button" type="submit" id="BuscarFactura" class="btn btn-primary pull-right"> Buscar</button></form>
        </div>

	</div>
  </div>
</div>
<div class="row" id="ContenedorTabla">
<section class="invoice">
  <input type="hidden" id="ModificadoPor" value="{{ Auth::user()->IdUser}}">
    <!-- title row -->
    <div class="row">
      <div class='text-center'><button type='button' id="PdfFactura" class='btn btn-primary'>PDF</button></div>
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-bank"></i> Laboratorio Clinico Dr.Garcia / <span id="Sucursal"></span>
          <small class="pull-right">Fecha: <span id="Fecha"> </span></small>
        </h2>
      </div>
    </div>
    <hr>
    <!-- info row -->
    <div class="row invoice-info" >
    <div id="contenedorDatos">

    </div>

    </div>


    <!-- Table row -->
    <div class="row" >
      <div class="col-xs-12 table-responsives">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Codigo</th>
            <th>Procedimiento</th>
            <th>Precio</th>
          </tr>
          </thead>
          <tbody id="ProcedimientoList">
          <tr >

          </tr>

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class=" col-lg-4 col-md-4 pull-right">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td id="dinero">RD$</td>
            </tr>
             <tr>
              <th>DESCUENTO:</th>
              <td id="descuentoHtml" ></td>
            </tr>
            <tr>
              <th>ITBIS (0.18%)</th>
              <td id="itbis"></td>
            </tr>
            <tr>
              <th>Total:</th>
              <td id="total"></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
     {{-- <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" id="GenerarFactura" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generar
          </button>
        </div>
      </div> --}}
    <!-- /.row -->
  </section>
</div>

<script type="text/javascript" src="/js/reporte/factura.js"></script>
<link rel="stylesheet" type="text/css" href="/js/sweetalert/sweetalert2.min.css">
<script type="text/javascript" src="/js/sweetalert/sweetalert2.min.js"></script>

@endsection