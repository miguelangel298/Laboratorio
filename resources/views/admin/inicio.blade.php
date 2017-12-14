@extends('layouts.admin')
@section('title')
  Laboratorio | Dr Garcia
@endsection
@section('modals')
  @include('admin.divisa')
@endsection
@section('script')
  <script src="/js/cliente/inicio.js" charset="utf-8"></script>
@endsection
@section('content')
<section class="content-header">
      <h1>
        Inicio
        <small>Panel de control</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-12 col-md-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-md-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-md-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-md-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>$RD<span id="ValorText"><span></h3>
              <p>1 Dolar (USD) = <span id="ValorText1"></span> Pesos Dominicano (DOP)</p>
            </div>
            <div class="icon">
              <i class="ion ion-social-usd-outline "></i>
            </div>
            <a data-toggle="modal" data-target="#divisa-modal" href="#" class="small-box-footer">Editar Divisa <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="box box-success" id="areaChart">
        <div class="box-header with-border">
          <h3 class="box-title">Ganancias mensuales por sucursal (RD$)</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height: 230px; width: 789px;" width="789" height="230"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      </div>
    </section>
@endsection
