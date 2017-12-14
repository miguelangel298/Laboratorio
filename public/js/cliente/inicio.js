$(document).ready(function(){
IdDivisa = 0;

  obtenerUltimoDollar = function(){
    IdDivisa = 1;
    route = '/divisas/valor/' + IdDivisa;
    $.get(route, function(res){
      IdDivisa = res.IdDivisa;
      $('#Valor').val(res.Valor);
      $('#ValorText').html(res.Valor);
      $('#ValorText1').html(res.Valor);
    });
  }

  updateDollarValor = function (valor) {
    route = '/divisas/actualizar';
    $.post({
      url: route,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: 'json',
      data: {
        IdDivisa: IdDivisa,
        Valor: valor
      }
    }, function (res) {
      obtenerUltimoDollar();
      swal('Listo!',
        'Valor de divisa actualizado correctamente.',
        'success');
    });
  };

  $('#updateDivisa').click(function () {
    var valor = $('#Valor').val();
    updateDollarValor(valor);
    $('#divisa-modal').modal('hide');
  });

  obtenerUltimoDollar();
});

function drawBarChart(data) {
  datasets_ =  [];
  colors = [
    '#00C0EF',
    '#00A65A',
    '#F39C12',
    '#DD4B39',
    '#666666',
  ]
  data.forEach(function (d, i) {
    ob = {
      label               : d.label,
      backgroundColor     : colors[i],
      borderColor         : colors[i],
      pointColor          : colors[i],
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : d.data
    };
    datasets_.push(ob);
  });
  var areaChartData = {
    labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: datasets_,
  }
  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas                   = document.getElementById('barChart').getContext('2d');
  var barChartData                     = areaChartData;
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  };

  barChartOptions.datasetFill = false;
  var chart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  });
}

SucursalesData = [];

$(function () {
  var route = '/chart/ingresos';
  $.get(route, function (res) {
    SucursalesData = res;
    console.log(SucursalesData);
    var sucursales = [];
    var cantidades = [];
    var meses = [];
    res.forEach(function (dato) {
      if (!sucursales.includes(dato.sucursales)) {
        sucursales.push(dato.sucursales);
      }
    });
    data = [];
    sucursales.forEach(function(sucursal) {
      var cant = SucursalesData.filter(function (s) {
        return s.sucursales === sucursal;
      });
      var cantidades = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 , 0];
      var months = ['January', 'Febrary', 'March', 'April', 'May', 'June', 'July', 'Agosto', 'September', 'October', 'November', 'December'];
      cant.forEach(function (s) {
        months.forEach(function (m, i) {
          if (s.Mes === m) {
            cantidades[i] = s.Cantidad;
          }
        });
      });
      console.log(cantidades);
      data.push({
        label: sucursal,
        data: cantidades,
      });
    });
    // data = [{
    //   label: 'Christopher',
    //   data: [Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random()],
    // }, {
    //   label: 'Miguel Angel',
    //   data: [Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random()],
    // }, {
    //   label: 'Scarlo',
    //   data: [Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random(), Math.random()],
    // }];
    drawBarChart(data);
  });
});
