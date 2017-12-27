$("#ContenedorTabla").hide();
 //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

$(document).ready(function(){

$('.select2').select2();
$('#desde').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
    });

$('#hasta').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
    });

	var IdMoneda = "";
	$("#IdMoneda").change(function(e){
		e.preventDefault();
        IdMoneda = $(this).val();
	});

var IdSucursal = "";
$("#IdSucursal").change(function(e){
	e.preventDefault();
       IdSucursal = $(this).val();
});

$("#BuscarReporteGanancia").click(function(e){
	e.preventDefault();
	var desde = $("#desde").val();
	var hasta = $("#hasta").val();
  if($("#desde").val() != "" && $("#hasta").val() != "" && IdSucursal != "" && IdMoneda != ""){
      var route = "/reporte-ganancia/"+IdMoneda+"/"+IdSucursal+"/"+desde+"/"+hasta+"";
      // location = route;
      var TablaDatos = $("#DatosReporteGanancias").empty();
      var route2 = "/reporte-ganancia-total/"+IdMoneda+"/"+IdSucursal+"/"+desde+"/"+hasta+"";
      $.get(route2, function (res) {
        var total = res.Total;
        $('#totalGananciaFactura').html(total);
      });
      $.get(route, function(data){
        if(data != ""){
          $(data).each(function(key,value){
            TablaDatos.append('<tr><td>'+value.Sucursal+'</td><td>'+value.Caja+'</td><td>'+value.Fecha+'</td><td>'+value.IdFactura+'</td><td>'+value.Procedimiento+'</td><td class="costo">'+value.Costo+'</td></tr>')
          });
          $('#TablaDeGanancia').DataTable();

          var array = [];
          $('.costo').each(function(index,object){
            var obj = {};
            obj['costo'] = $($(object).children()[0]).html();
            array.push(obj);
          });

          $("#ContenedorTabla").show();
        }else{
          $("#ContenedorTabla").hide();
          swal(
            'No existen facturas',
            'En esta fechas',
            ''
          )
        }
      });
  }else{
    var errores = "";
    if($("#desde").val() == ""){
      $("#DivD").addClass('has-error');
      if(errores != ""){
        errores += "* Seleccione fecha desde.<hr>";
      }else{
        errores += "* Seleccione fecha desde.<hr>";
      }
    }else{
      $("#DivD").removeClass('has-error');
    }
    if($("#hasta").val() == ""){
      $("#DivH").addClass('has-error');
      if(errores != ""){
        errores += "* Seleccione fecha hasta.<hr>";
      }else{
        errores += "* Seleccione fecha hasta.<hr>";
      }
    }else{
      $("#DivH").removeClass('has-error');
    }
    if(IdSucursal == ""){
      $("#DivS").addClass('has-error');
      if(errores != ""){
        errores += "* Seleccione Sucursal.<hr>";
      }else{
        errores += "* Seleccione Sucursal.<hr>";
      }
    }else{
      $("#DivS").removeClass('has-error');
    }
    if(IdMoneda == ""){
      $("#DivM").addClass('has-error');
      if(errores != ""){
        errores += "* Seleccione Moneda.<hr>";
      }else{
        errores += "* Seleccione Moneda.<hr>";
      }
    }else{
      $("#DivM").removeClass('has-error');
    }

    if(errores!=""){
			alertify.error(errores);
		}

  }

	});

	$("#PdfGanancias").click(function(){
	var desde = $("#desde").val();
	var hasta = $("#hasta").val();
	var IdSucursal = $('#IdSucursal').val();
	var route = "/pdf/reporte-ganancia/"+IdMoneda+"/"+IdSucursal+"/"+desde+"/"+hasta+"";
	location = route;

});
});
