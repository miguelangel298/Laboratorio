@extends('layouts.admin')
@section('title')
Laboratorio | Empleado
@endsection
@section('script')
<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="/js/mantenimiento/empleado.js"></script>
@endsection
@section('content')
<section class="content-header">
      <h1>
       Empleados
        <small>Mantenimiento</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Empleado</li>
      </ol>
</section><br>

@include('admin.mantenimiento.Modales.cambiarcontraseña')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
			<div class="col-lg-12">
		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title" id="TituloModal">Agregar nuevo Empleado</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            {!! Form::open(['url'=>'/mantenimiento/empleado/crear','method'=>'POST']) !!}
            <div class="col-md-6">
            <input type="hidden" id="IdUser" name="IdUser" value="{{ Auth::user()->IdUser }}">
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
                    <input type="text" placeholder="Primer Apellido" class="form-control" id="Apellido1" name="Apellido1">
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
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-venus-mars"></i>
                  </div>
                <div id="DivS">
                  <select class="form-control select2" id="IdSexo" name="IdSexo" style="width: 100%;">
                    <option selected="selected" disabled>Seleccione Sexo</option>
                    <option value="1" >Hombre</option>
                    <option value="2" >Mujer</option>
                  </select>
                </div>
                </div>
              </div>
              <div class="form-group">
                <label>Correo:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <div id="DivE">
                     <input type="text" placeholder="ejemplo@gmail.com" class="form-control" id="Correo" name="Correo">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Cedula:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-card"></i>
                  </div>
                  <div id="DivC">
                  <input type="text" id="Cedula" name="Cedula" class="form-control" placeholder="999-9999999-9" data-inputmask='"mask": "999-9999999-9"' data-mask>
                  </div>
                </div>
              </div>

              <div class="form-group hiddenUp">
                <label>Contraseña:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                  <div id="DivCC">
                  <input type="password" id="Pass" name="Pass" class="form-control" placeholder="Contraseña" >
                  </div>
                </div>
              </div>

            <div class="form-group hiddenUp" >
                <label>Confirmar Contraseña:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                  <div id="DivCCC">
                  <input type="password" id="PassCon" class="form-control" placeholder="Confirmar Contraseña" >
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
                    <input type="text" name="FechaNacimineto" id="FechaNacimineto" placeholder="AAAA/MM/DD" class="form-control pull-right" >
                  </div>
                </div>
              </div>
               <div class="form-group">
                <label>Nacionalidad:</label>
                <div id="DivNc">
                  <select id="IdNacionalidad" name="IdNacionalidad" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled="">Seleccione Nacionalidad</option>
                    <option value="1">Republica Dom</option>
                    <option value="2">USA</option>
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
                    <input type="text" id="Celular" name="Celular" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                     <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                </div>

              </div>
              <div class="form-group">
                <label>Sucursal:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-university"></i>
                  </div>
                  <div id="DivSL">
                    <select id="IdSucursal" name="IdSucursal" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled="">Sucursal</option>
                    @foreach($Sucursales as $Sucursale)
                      <option value="{{$Sucursale->IdSucursal}}">{{$Sucursale->Nombre}}</option>
                    @endforeach
                  </select>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Cargo:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-university"></i>
                  </div>
                  <div id="DivCR">
                    <select id="IdCargo" name="IdCargo" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled="">Cargo</option>

                       @foreach($Cargos as $Cargo)
                      <option value="{{$Cargo->IdCargo}}">{{$Cargo->Nombre}}</option>
                    @endforeach
                  </select>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
          <button  id="CancelarUp" onclick="Limpiar()" type="button" class="btn btn-danger "> Cancelar</button>
          <button  id="ActualizarEmpleado" type="submit" class="btn btn-primary "> Actualizar</button>
          <button  id="AgregarEmpleado" type="submit" class="btn btn-primary "> Guardar</button>
          </div>
        </div>
		</div>
   {!! Form::close() !!}
			</div>
		</div>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Listado de Empleado</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsives">
              <table id="TablaCliente" width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Cedula</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                  <th>Acciones</th>
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

</section>


@endsection
