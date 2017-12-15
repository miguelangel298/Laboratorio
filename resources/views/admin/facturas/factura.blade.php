@extends('layouts.admin')
@section('title')
Laboratorio | Factura
@endsection
@section('script')
<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript" src="/js/cliente/factura.js"></script>
@endsection

@section('modals')
  @include('admin.mantenimiento.Modales.AgregarCliente')
  @include('admin.mantenimiento.Modales.abono')
@endsection

@section('content')
<section class="content-header">
      <h1>
       Factura
        <small>Generar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Factura</li>
      </ol>
</section><br>
<section class="invoice" id="app-paciente">
  <input type="hidden" id="ModificadoPor" value="{{ Auth::user()->IdUser}}">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-bank"></i> Laboratorio Clinico Dr.Garcia
          <small class="pull-right">Fecha: <span id="FechaUp"></span></small>
        </h2>
      </div>
       <div class="col-md-10">
        <form role="form"  @submit.prevent="getCurrentPaciente()">
          <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-address-card"></i>
                </div>
                <div id="DivC">
                  <input type="text" id="IdPacienteDatos" maxlength="80"  class="form-control" style="width: 100%;" autocomplete="off" v-model="searchQuery" :disabled="pacientes.length === 0" placeholder="Introduzca un Nombre o Cedula">
                  <div class="row hide" id="livesearch" role="menu">
                    <ul class="list-group">
                       <li  v-for="(paciente, i) in busqueda" @click="setCurrent(paciente)" class='list-group-item' v-if="i < 10" style='position: relative; font-size:10; cursor: pointer; z-index: 1000;' v-cloak>
                         @{{ paciente.Nombres }} @{{ paciente.Apellidos }} (@{{ paciente.Cedula }})
                       </li>
                       <li class='list-group-item' style='position: relative; font-size:10; cursor: pointer; z-index: 1000;' v-if="busqueda.length == 0" v-cloak>
                         No se encontraron resultados para '@{{searchQuery}}'.
                       </li>
                    </ul>
                  </div>
                  <!-- <select id="IdPacienteDatos" class="form-control select2" >
                      <option selected="selected" disabled="">Buscar cliente..</option>
                      @foreach($clientes as $cliente)
                      <option value="{{$cliente->Idpersona}}">{{$cliente->Paciente}}</option>
                      @endforeach
                  </select> -->

                </div>
                </div>
            </div>
      </div>
      <div class="col-md-2">
        <!-- <button type="submit" value="" :disabled="busqueda.length == 0" @click.prevent="getCurrentPaciente()" id="ObtenerCliente" class="btn btn-primary">Buscar</button> -->
        <button type="button" value="" v-show="busqueda.length == 0" v-cloak class="btn btn-success" data-target="#agregarClienteModal" data-toggle="modal"><i class="fa fa-plus" style="margin-right: 10px;"></i>Agregar Paciente</button>
      </div>
      </form>
      <!-- /.col -->
    </div>
    <hr>
    <!-- info row -->
    <div class="row invoice-info" >
    <div class="text-center" id="informacion">
      <p >Por favor buscar o agregar al cliente para poder realizar la factura</p>
    </div>
    <div id="contenedorDatos" class="col-md-12" style="margin-bottom: 25px;">

    </div>
    <br>
    <p></p>
    <div id="contenidoFactura">
    <div class="row" style="padding: 10px;">
      <div class="col-xs-8 col-sm-8 col-md-2 col-lg-2">
     <div class="form-group">
        <div id="DivNc">
          <select id="Descuento" class="form-control select2" style="width: 100%;">
            <option selected="selected" disabled="">Descuento %</option>
           <option value="0.01">1%</option>
           <option value="0.02">2%</option>
           <option value="0.03">3%</option>
           <option value="0.04">4%</option>
           <option value="0.05">5%</option>
           <option value="0.06">6%</option>
           <option value="0.07">7%</option>
           <option value="0.08">8%</option>
           <option value="0.09">9%</option>
           <option value="0.1">10%</option>

          </select>
        </div>
      </div>
      </div>
      <input type="hidden" id="IdCliente" value="">
       <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
     <div class="form-group">

        <div id="DivNc">
          <select id="IdProcedimiento" class="form-control select2" style="width: 100%;">
            <option selected="selected" disabled="">Seleccione Procedimiento</option>
            @foreach($procedimientos as $procedimiento)
          <option value="{{$procedimiento->IdProcedimiento}}">{{$procedimiento->Nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
      </div>

      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <button type="button" id="AgregarProcedimiento" class="btn btn-success">Agregar</button>
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
            <th>Acciones</th>
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
      <div class="col-md-6">
        <p class="lead text-center">Metodos de Pago:</p>
        <div class="paymentWrap">
      <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
          <label class="btn paymentMethod active">
            <div class="method visa"></div>
              <input type="radio" class="moneda" value="1" name="metododinero" checked>
          </label>
          <label class="btn paymentMethod">
            <div class="method master-card"></div>
              <input type="radio" class="moneda" value="2" name="metododinero">
          </label>
      </div>
    </div>

        <p class="text-muted well well-sm no-shadow text-center" style="margin-top: 10px;">
          Asegurese de  verificar la identida del cliente y la tarjeta de cretido.<br>
          Guarde el bauche
        </p>
      </div>
      <!-- /.col -->
      <div class="col-md-6">
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

     <div class="row no-print">
        <div class="col-xs-12">
          <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <button type="button"  id="GenerarFacturaTarjeta" class="GenerarFactura btn btn-success pull-right"><i class="fa fa-credit-card"></i> Pago por Tarjeta
          </button>
          <button type="button"  id="GenerarFactura"  class="GenerarFactura btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generar
          </button>
        </div>
      </div>
      </div>
    <!-- /.row -->
  </section>


@endsection
