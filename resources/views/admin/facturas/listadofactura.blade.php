@extends('layouts.admin')
@section('content')
<section class="content-header">
      <h1>
       Factura
        <small>Listado</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Factura</li>
      </ol>
</section><br>
<div class="row">

	<div class="col-lg-12">
		<div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Listado Factura</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsives">
              <table id="TablaFactura" width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Paciente</th>
                  <th>Surcursal</th>
                  <th>Total</th>
                  <th>Estado</th>
                  <th><span><i class='fa  fa-cog' aria-hidden='true'></i></span></th>
                </tr>
                </thead>
                <tbody>
               
               	</tbody>
               	<tfoot>
                </tfoot>
              </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/cliente/listadofactura.js"></script>
@endsection