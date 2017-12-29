<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
  <link rel="icon" href="/imagen/Iconolab.ico" sizes="32x32" />
  <!-- <meta property="og:image" content="/imagen/Iconolab.ico" /> -->
  <link rel="stylesheet" href="/css/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/font-awesome.css">
  <link rel="stylesheet" href="/js/datatime/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/css/ionicons.min.css">
  <link rel="stylesheet" href="/css/daterangepicker.css">
  <link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/css/skin-blue-light.css">
  <link rel="stylesheet" href="/css/morris.css">
  <link rel="stylesheet" type="text/css" href="/js/sweetalert/sweetalert2.min.css">
  <link rel="stylesheet" href="/css/alertify.min.css">
  <link rel="stylesheet" type="text/css" href="/iCheck/all.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="/imagen/Iconolab.ico" width="25"/></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="/imagen/logo_big.png" width="120"/></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="navbar-item"><a style="color: #777;">Usuario: <strong class="navbar-link" style="color: #555;">{{ Auth::user()->name }}</strong></a></li>
          <li class="user user-menu navbar-item">
            <a class="btn btn-link navbar-link" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" style="margin-right: 10px;"></i>Salir
            </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <div class="" style="height: 12px;">
        </div>
        <li class="{{ Request::is('/') ? 'active' : ''}}">
          <a href="{!! url('/')!!}">
            <i class="fa fa-bullseye"></i> <span>Inicio</span>
          </a>
        </li>
        @if (request()->IdCargo == 1 || request()->IdCargo == 3)
        <li class="{{ Request::is('factura') ? 'active' : ''}}">
          <a href="{!! url('/factura')!!}">
            <i class="fa fa-address-card-o"></i> <span>Nueva Factura</span>
          </a>
        </li>
        @endif
        <li class="{{ Request::is('pacientes-list') ? 'active' : ''}}">
          <a href="{!! url('/pacientes-list')!!}">
            <i class="fa fa-users"></i> <span>Pacientes</span>
          </a>
        </li>
        @if (request()->IdCargo == 1 || request()->IdCargo == 3)
        <li class="{{ Request::is('factura-listadt') ? 'active' : ''}}">
          <a href="{!! url('/factura-listado')!!}">
            <i class="fa fa-address-card-o"></i> <span>Listado Facturas</span>
          </a>
        </li>
        @endif
        <li class=" {{ Request::is('mantenimiento*') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('mantenimiento/clientes') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/clientes')!!}"><i class="fa fa-circle-o"></i> Nuevo Paciente</a></li>
            @if (request()->IdCargo == 1 || request()->IdCargo == 3)
            <li class="{{ Request::is('mantenimiento/procedimiento') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/procedimiento')!!}"><i class="fa fa-circle-o"></i> Procedimientos</a></li>
            @endif
            @if (request()->IdCargo == 1)
            <li class="{{ Request::is('mantenimiento/empleado') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/empleado')!!}"><i class="fa fa-circle-o"></i> Empleados</a></li>
            <li class="{{ Request::is('mantenimiento/empresa') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/empresa')!!}"><i class="fa fa-circle-o"></i>Sucursales</a></li>
            @endif
          </ul>
        </li>
        @if (request()->IdCargo == 1 || request()->IdCargo == 3)
        <li class=" {{ Request::is('reporte*') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if (request()->IdCargo == 1)
            <li class="{{ Request::is('reporte/ganancia') ? 'active' : ''}}"><a href="{!! url('/reporte/ganancia')!!}"><i class="fa fa-circle-o"></i> Ganancias</a></li>
            @endif
            <li class="{{ Request::is('reporte/factura') ? 'active' : ''}}"><a href="{!! url('/reporte/factura')!!}"><i class="fa fa-circle-o"></i> Facturas</a></li>
          </ul>
        </li>
        @endif

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content">
  @yield('content')
  </section>
  </div>

  @yield('modals')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>&copy; 2017 Todos los derechos reservados <a href="http://laboratoriodrgarcia.com">Laboratorio Clinico Dr. Garcia</a></strong>
  </footer>


  <div class="control-sidebar-bg"></div>
</div>



<!-- jQuery UI 1.11.4 -->
<script src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/select2.full.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/daterangepicker.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script type="text/javascript" src="/js/sweetalert/sweetalert2.min.js"></script>
<script src="/js/alertify.min.js"></script>
<script src="/js/morris.min.js"></script>
<script src="/js/jquery.slimscroll.min.js"></script>
<script src="/js/fastclick.js"></script>
<script src="/js/adminlte.min.js"></script>
<script type="text/javascript" src="/iCheck/icheck.min.js"></script>
<script src="/js/demo.js"></script>
<script src="/js/datatime/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/js/vue.min.js" charset="utf-8"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" integrity="sha256-c0m8xzX5oOBawsnLVpHnU2ieISOvxi584aNElFl2W6M=" crossorigin="anonymous"></script>
@yield('script')




</body>
</html>
