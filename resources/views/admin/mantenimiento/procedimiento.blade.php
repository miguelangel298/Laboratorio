@extends('layouts.admin')
@section('content')
 
@include('admin.mantenimiento.Modales.EditarProcedimiento')


<section class="content-header">
      <h1>
       Procedimiento
        <small>Mantenimiento</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-bullseye"></i> Inicio</a></li>
        <li class="active">Procedimiento</li>
      </ol>
</section><br>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
			<div class="col-lg-12">
		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar nuevo Procedimiento</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
           {!! Form::open(['url'=>'/mantenimiento/procedimiento/nuevo','method'=>'POST']) !!}
            <div class="col-md-12">
            <input type="hidden"  name="IdUser" id="IdUser" value="{{ Auth::user()->IdUser }}">
               <div class="form-group">
                <label>Procedimiento:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <div id="DivN" >
                   <input type="text" placeholder="Nombre del Procedimiento" class="form-control" id="Nombre" name="Nombre">              
                  </div>
                </div>               
              </div>              
            </div>
			     <div class="col-md-6">             
               <div class="form-group">
                <label>Costo en Pesos:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    RD$
                  </div>
                  <div id="DivCl">
                    <input type="number"  id="CostoPeso" class="form-control" placeholder="Costo en Peso" name="CostoPeso" >
                  </div>                  
                </div>                
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Costo en Dollar:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    US$
                  </div>
                  <div id="DivT">
                     <input type="text" id="CostoDolar"   class="form-control" placeholder="Costo en Dollar" name="CostoDolar">
                  </div>
                </div>
                <!-- /.input group -->
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <button  id="AgregarProcedimiento" type="submit" class="btn btn-primary pull-right"> Guardar</button>
        </div>
		</div>
   {!! Form::close() !!}
			</div>	
		</div>
          
        </div>
        
      </div>
   
    </section>
<div class="row">
    <div class="col-lg-12">
        <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Procedimiento Generados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsives">
              <table id="TablaProcedimiento" width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Procedimiento</th>
                  <th>Costo RD$</th>
                  <th>Costo US$</th>
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
<script src="/js/alertify.min.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/js/sweetalert/sweetalert2.min.css">
<script type="text/javascript" src="/js/sweetalert/sweetalert2.min.js"></script>
<script type="text/javascript" src="/js/mantenimiento/procedimiento.js"></script>

@endsection

