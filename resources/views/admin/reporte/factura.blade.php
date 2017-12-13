@extends('layouts.admin')

@section('title')
Laboratorio | Reporte Factura
@endsection
@section('script')
<script type="text/javascript" src="/js/reporte/factura.js"></script>
@endsection
@section('content')
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
          <div class="row">
            <div class="col-md-3 col-md-offset-4 ">
              <div id="DivS">
              <form id="BuscarFacturaForm">
              <div class="form-group ">
                  <input type="number"  id="IdFactura" class="form-control" placeholder="Nº Factura" name="Factura" >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer ">
         <button type="submit"  id="BuscarFactura" class="btn btn-primary pull-right"> Buscar</button>
        </div>
          </form>
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
  </section>
</div>

@endsection
