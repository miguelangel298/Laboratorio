<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Factura</title>
{{--   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css"> --}}
  <style type="text/css">

    body {
      font-size: 14px;
          font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-weight: 400;
    }
    div {
    display: block;
  }
   .navbar-collapse:before, .navbar-header:after, .navbar-header:before, .navbar:after, .navbar:before, .pager:after, .pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before {
    display: table;
    content: " ";
}

    #page {
      padding-top: 20px;
    }

    #factura-table {
      margin-top: 30px;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
.col-lg-4 {
    width: 33.33333333%;
        position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}

.row {
    margin-right: -15px;
    margin-left: -15px;
}

address {
    margin-bottom: 20px;
    font-style: normal;
    line-height: 1.42857143;
}
.invoice {
    position: relative;
    background: #fff;
    border: 1px solid #f4f4f4;
    padding: 20px;
    margin: 10px 25px;
}

address {
    display: block;
}
}
  </style>
</head>
<body>
<div class="container-fluid col-lg-8" id="page">

  <h4 class="page-title">Laboratorio Clinico Dr. Garcia  </h4>
  <p></p>
  <hr/>
   <div class="row invoice-info" >
  </div>
  <div class="section" id="factura-table">
    <table width="100%" class="table">
      <thead>
        <tr>
          <th scope="col">Sucursal</th>
          <th scope="col">Caja</th>
          <th scope="col">Fecha</th>
          <th scope="col">N Factura</th>
          <th scope="col">Procedimiento</th>
          <th class="text-right" scope="col">Precio</th>
        </tr>
      </thead>
      <tbody>
  		@foreach($Ganancias as $Ganancia)
        <tr>
          <th scope="row">{{$Ganancia->Sucursal}}</th>
          <td>{{$Ganancia->Caja}}</td>
          <td >{{$Ganancia->Fecha}} </td>
          <td >{{$Ganancia->IdFactura}} </td>

          <td>{{$Ganancia->Procedimiento}}</td>
          <td class="text-right">{{$Ganancia->Simbolo}} {{$Ganancia->Costo}}</td>
        </tr>
	@endforeach
      </tbody>
    </table>
  </div><br/><br/>



  <br/><br/>
</div>
</body>
</html>