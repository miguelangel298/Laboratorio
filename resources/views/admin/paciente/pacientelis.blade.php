@extends('layouts.admin')
@section('title')
Laboratorio | Paciente
@endsection
@section('script')
<script type="text/javascript" src="/js/cliente/paciente.js"></script>
@endsection
@section('modals')
  @include('admin.mantenimiento.Modales.EditarPaciente')
@endsection
@section('content')
<section class="content-header">
      <h1>
       Paciente
        <small>Listado</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Paciente</li>
      </ol>
</section><br>
<div class="row">
	<div class="col-lg-12">
		<div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Listado Paciente</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="TablaPaciente" width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Cedula</th>
                  <th>Fecha de N</th>
                  <th>Nacionalidad</th>
                  <th>Sexo</th>
                  <th>Seguro M</th>
                  <th>Celular</th>
                  <th>Telefono</th>
                  <th>acciones</th>
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


@endsection
