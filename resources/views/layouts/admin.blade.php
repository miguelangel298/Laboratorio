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
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications:  -->
          {{-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> --}}
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/imagen/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"> {{ Auth::user()->name }}</span>

            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/imagen/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                   {{ Auth::user()->name }} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">

                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/imagen/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ Auth::user()->name }}</p>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SECCIONES</li>
        <li class="{{ Request::is('/') ? 'active' : ''}}">
          <a href="{!! url('/')!!}">
            <i class="fa fa-bullseye"></i> <span>Inicio</span>
          </a>
        </li>
        <li class="{{ Request::is('factura') ? 'active' : ''}}">
          <a href="{!! url('/factura')!!}">
            <i class="fa fa-address-card-o"></i> <span>Facturas</span>
          </a>
        </li>
        <li class="{{ Request::is('pacientes-list') ? 'active' : ''}}">
          <a href="{!! url('/pacientes-list')!!}">
            <i class="fa fa-users"></i> <span>Paciente</span>
          </a>
        </li>
        <li class="{{ Request::is('factura-listadt') ? 'active' : ''}}">
          <a href="{!! url('/factura-listado')!!}">
            <i class="fa fa-address-card-o"></i> <span>Listado Factura</span>
          </a>
        </li>
        <li class=" {{ Request::is('mantenimiento*') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('mantenimiento/clientes') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/clientes')!!}"><i class="fa fa-circle-o"></i> Paciente</a></li>
            <li class="{{ Request::is('mantenimiento/procedimiento') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/procedimiento')!!}"><i class="fa fa-circle-o"></i> Procedimientos</a></li>
            <li class="{{ Request::is('mantenimiento/empleado') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/empleado')!!}"><i class="fa fa-circle-o"></i> Empleado</a></li>
            <li class="{{ Request::is('mantenimiento/empresa') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/empresa')!!}"><i class="fa fa-circle-o"></i>Mis Empresa</a></li>
          </ul>
        </li>
        <li class=" {{ Request::is('reporte*') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Reporte</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('reporte/ganancia') ? 'active' : ''}}"><a href="{!! url('/reporte/ganancia')!!}"><i class="fa fa-circle-o"></i> Ganancias</a></li>
            {{-- <li class="{{ Request::is('mantenimiento/procedimiento') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/procedimiento')!!}"><i class="fa fa-circle-o"></i> Procedimientos</a></li> --}}
            <li class="{{ Request::is('reporte/factura') ? 'active' : ''}}"><a href="{!! url('/reporte/factura')!!}"><i class="fa fa-circle-o"></i> Facturas</a></li>
            {{-- <li class="{{ Request::is('mantenimiento/empresa') ? 'active' : ''}}"><a href="{!! url('/mantenimiento/empresa')!!}"><i class="fa fa-circle-o"></i>Procedimientos</a></li> --}}
          </ul>
        </li>

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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
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
@yield('script')


@yield('modals')

</body>
</html>
