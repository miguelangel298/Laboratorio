@extends('layouts.admin')
@section('title')
Laboratorio | Sucursales
@endsection
@section('script')
<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript" src="/js/mantenimiento/sucursales.js"></script>
@endsection

@section('modals')
  @include('admin.mantenimiento.Modales.EditarProcedimiento')
@endsection

@section('content')

<section class="content-header">
      <h1>
       Sucursales
        <small>Mantenimiento</small>
      </h1>
      <ol class="breadcrumb">
        <li><a  href="/"><i  class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Empresa</li>
      </ol>
</section><br>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
			<div class="col-lg-12">
		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar nuevo Empresa</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-6">
               <div class="form-group">
                <label>Nombre:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <div id="DivN" >
                   <input type="text" placeholder="Sucursal" class="form-control" id="Nombre" name="Nombre">
                  </div>
                </div>
              </div>

             <div class="form-group">
                <label>Telefono:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <div id="DivT">
                     <input type="text" id="Telefono" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                </div>
              </div>
              </div>
			     <div class="col-md-6">
               <div class="form-group">
                <label>Direccion:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <div id="DivCl">
                    <input type="text"  id="Direccion" class="form-control" placeholder="Direccion" name="Direccion" >
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Año de Apertura:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <div id="DivF">
                    <input type="text" id="AnoApertura" placeholder="2000" class="form-control pull-right date-picker" autocomplete="off" >
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-6 col-md-offset-3">
             <div class="form-group">
                <label>Municipio</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <div id="DivSG">
                    <select id="IdMunicipio" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled="">Seleccione Municipio</option>
                    @foreach($provices as $provice)
                    <option value="{{$provice->IdMunicipio}}">{{$provice->Nombre}}</option>

                    @endforeach
                    <option value="2">Naco</option>
                  </select>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer row col-md-12" style="margin: 0 !important;">
          <div class="pull-right">
            <button  id="Cancelar" onclick="cancelar();" type="button" class="btn btn-danger"> Guardar</button>
            <button  id="Actualizar" type="button" class="btn btn-primary"> Actualizar</button>
            <button  id="CrearEmpresa" type="button" class="btn btn-primary"> Guardar</button>
          </div>
        </div>
		</div>
			</div>
		</div>

        </div>

      </div>

    </section>
    <div class="col-md-12">
      <div class="pad margin no-print">
      <div class="callout callout-default text-center" style=" background-color:#fff; margin-bottom: 0!important;">
        <h3>Sucursales</h3>
      </div>
    </div>

    </div>
<div class="row">
	<div id="ContenedorSucursal" class="col-lg-12">

    </div>
  </div>
</div>


@endsection
