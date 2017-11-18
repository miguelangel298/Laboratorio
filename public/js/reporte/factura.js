$("#ContenedorTabla").hide();
$(document).ready(function($) {

$("#BuscarFactura").click(function(e){
	e.preventDefault();
	var IdFactura = $("#IdFactura").val();
var route = "/reporte/factura/"+IdFactura+"";
var routeDetalle = "/reporte/detalle-factura/"+IdFactura+"";
var contenedorDatos = $("#contenedorDatos").empty();
	$.get(route,function(data){
		if(data != ""){
			$("#ContenedorTabla").show();
			contenedorDatos.append("<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 invoice-col'><address><strong>"+data.Paciente+"</strong><br>Cedula: "+data.Cedula+"<br>Estado: "+data.Estado+"</address></div><div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 invoice-col'> <address><strong>Edad: "+data.Edad+"</strong><br>Fecha de Nacimiento<br>"+data.FechaNacimineto+"<br></address></div><div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 invoice-col'><b>Numero de Seguro:</b><br>#"+data.SeguroMedico+"<br><b>Telefono:</b> "+data.Telefono+"<br></div></div><hr> ");
				$("#dinero").html(data.Total);
				$("#descuentoHtml").html(data.Descuento);
				$("#itbis").html(data.Itbis);
				$("#total").html(data.TotalPagar);
				$("#Fecha").html(data.Fecha);
				$("#Sucursal").html(data.Sucursal);
			}else{
				alertify.error('No hay');
			}
	});

	$.get(routeDetalle,function(data){
		var ProcedimientoList = $("#ProcedimientoList").empty();
		$(data).each(function(key,value){
			ProcedimientoList.append('<tr class="tableid"><td>'+value.IdProcedimiento+'</td><td>'+value.Procedimiento+'</td><td>'+value.Moneda+' '+value.Costo+'</td></tr>');
		});
	});
});

$("#PdfFactura").click(function(){
	var IdFactura = $("#IdFactura").val();
	var  route = "/pdf/factura/"+IdFactura+"";
	location = route;

});

});