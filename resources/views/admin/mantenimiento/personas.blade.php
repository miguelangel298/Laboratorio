@extends('layouts.admin')
@section('title')
Laboratorio | Agregar Paciente
@endsection
@section('script')
<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="/js/cliente/crearcliente.js"></script>
@endsection
@section('content')

<section class="content-header">
      <h1>
       Pacientes
        <small>Agregar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Pacientes</li>
      </ol>
</section><br>

<div class="row">
	<div class="col-lg-12">
		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar nuevo Pacientes</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            <input type="hidden" id="IdUser" value="{{ Auth::user()->IdUser }}">
                 <div class="form-group">
                <label>Cedula:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-card"></i>
                  </div>
                  <div id="DivC">
                  <input type="text" id="Cedula" class="form-control" placeholder="999-9999999-9" data-inputmask='"mask": "999-9999999-9"' data-mask>
                  </div>
                </div>
              </div>
               <div class="form-group">
                <label>Nombre:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <div id="DivN" >
                   <input type="text" placeholder="Nombre" class="form-control" id="Nombres" name="Nombres">
                  </div>
                </div>
              </div>
               <div class="form-group">
                <label>Primer Apellido:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
      					<div id="DivA">
                    <input type="text" placeholder="Apellido" class="form-control" id="Apellidos" name="Primer Apellido">
      					</div>
                </div>
              </div>
              <div class="form-group">
                <label>Segundo Apellido:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                <div id="DivSP">
                    <input type="text" placeholder="Segundo Apellido" class="form-control" id="Apellido2" name="Apellido2">
                </div>
                </div>
              </div>
               <div class="form-group">
                <label>Sexo:</label>
                <div id="DivS">
	                <select class="form-control select2" id="IdSexo" style="width: 100%;">
	                  <option selected="selected" disabled>Seleccione Sexo</option>
	                  <option value="1" >Hombre</option>
	                  <option value="2" >Mujer</option>
	                </select>
                </div>
              </div>
              <div class="form-group">
                <label>Correo:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <div id="DivE">
                  	 <input type="email" placeholder="ejemplo@gmail.com" class="form-control" id="Correo" name="Correo">
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label>Fecha de Nacimiento:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <div id="DivF">
                  	<input type="text" id="FechaNacimineto" placeholder="AAAA/MM/DD" class="form-control pull-right" >
                  </div>
                </div>
              </div>
               <div class="form-group">
                <label>Nacionalidad:</label>
                <div id="DivNc">
                	<select id="IdNacionalidad" class="form-control select2" style="width: 100%;">
	                  <option selected="selected" disabled="">Seleccione Nacionalidad</option>
                    @foreach($naciones as $nacion)
                    <option value="{{$nacion->IdNacionalidades}}">{{$nacion->Nombre}}</option>
                    @endforeach
	                </select>
                </div>
              </div>
               <div class="form-group">
                <label>Celular:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <div id="DivCl">
                  	<input type="text" id="Celular" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
              <div class="form-group">
                <label>Seguro Medico:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-id-card-o"></i>
                  </div>
                  <div id="DivSG">
                    <select id="SeguroMedico" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled="">Seguro Medico</option>
                    <option value="ARS">ARS</option>
                    <option value="PALIC">PALIC</option>
                  </select>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>No. de Afiliado:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-id-card-o"></i>
                  </div>
                  <div id="DivNS">
                    <input type="text" placeholder="No. de Afiliado" id="NumeroSeguro" class="form-control" style="width: 100%;">
                  </div>
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <button type="button" type="submit" id="AgregarCliente" class="btn btn-primary pull-right"> Guardar</button>
        </div>
</div>
	</div>
</div>
@endsection
