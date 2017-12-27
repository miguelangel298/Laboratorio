@extends('layouts.admin')
@section('title')
Laboratorio | Reporte Ganancia
@endsection
@section('script')
<script type="text/javascript" src="/js/reporte/ganancia.js"></script>
@endsection

@section('content')
<section class="content-header">
      <h1>
       Reporte
        <small>Ganancia</small>
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
          <h3 class="box-title">Reporte de Ganancia</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <div id="DivM">
                  <select class="form-control select2" id="IdMoneda" style="width: 100%;">
                    <option selected="selected" disabled>Tipo de Moneda</option>
                    <option value="1" >RD$</option>
                    <option value="2" >US$</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <div id="DivD">
                    <input type="text" id="desde" placeholder="AAAA-MM-DD" class="form-control pull-right" >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <div id="DivH">
                    <input type="text" id="hasta" placeholder="AAAA-MM-DD" class="form-control pull-right" >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <div id="DivS">
                  <div class="form-group">
                    <select id="IdSucursal" class="form-control select2 select2-hidden-accessible" data-placeholder="Seleccione Sucursal" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <option disabled="" selected="">Seleccione Sucursal</option>
                      <option value="0" >Todas</option>
                      @foreach($sucursales as  $sucursal)
                        <option value="{{$sucursal->IdSucursal}}" >{{$sucursal->Nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <button type="button" type="button" id="BuscarReporteGanancia" class="btn btn-primary pull-right"> Buscar</button>
        </div>
</div>
  </div>
</div>
<div class="row" id="ContenedorTabla">
  <div class="col-lg-12">
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Resultado (Total: $<b id="totalGananciaFactura"></b>)</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
              <div class="text-center">
                <button  id="PdfGanancias" class="btn btn-primary">PDF</button>
              </div>
            <div class="col-md-12 table-responsives">
              <table id="TablaDeGanancia" width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sucursal</th>
                  <th>Caja</th>
                  <th>Fecha</th>
                  <th>Nº Factura</th>
                  <th>Procedimiento</th>
                  <th>Costo</th>
                </tr>
                </thead>
                <tbody id="DatosReporteGanancias">
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <button type="button" type="submit" id="AgregarCliente" class="btn btn-primary pull-right"> Guardar</button>
        </div>
</div>
  </div>
</div>

@endsection
