$(document).ready(function($) {
	listadoFactura = function(){
	$("#TablaFactura").DataTable({
		destroy: true,
		   "language": {
					"sProcessing":     "Cargando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				},
			"processing": true,
		 	"serverSide": true,

		 	"ajax": "/listado-factura",
		 	responsive: true,
		 	 columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
		 	"columns":[
				{data: 'IdFactura'},
		 		{data: 'Fecha'},
		 		{data: 'Paciente'},
		 		{data: 'Sucursal'},
		 		{data: 'Total'},
		 		{data: 'Estado'},
		 		{data: 'IdFactura',
		 			render: function(data, type, row){
						html = "";
						html += "<input id='ValorFacturaRestante-" + data +"' type='hidden' value='" + row.Restante + "'><input id='ValorFacturaTotal-" + data +"' value='" + row.Total + "' type='hidden'><input type='hidden' value='" + row.Abono + "' id='ValorFacturaAbono-" + data +"'>";
		 				if(row.Estado == "Activa"){
			 				html += "<button onclick='desabilitar(this)' value="+data+" class='btn btn-default'  style='background: transparent; border: transparent; color:#01C613; font-size:16px; border-color: #fff;' ><i class='fa  fa-toggle-on' aria-hidden='true'></i> </button>";
		 				}else if (row.Estado == "Cancelada"){
			 				html += "<button onclick='habilitar(this)' value="+data+" class='btn btn-default'  style='background: transparent; border: transparent;  font-size:16px; ' ><i class='fa  fa-toggle-off' aria-hidden='true'></i> </button>";
		 				}
						if(row.Restante != 0){
							html += "<button value="+data+" class='btn btn-default btn-sm' style='margin: auto 10px;' data-toggle='modal' onclick='mostrarPendiente(this)' data-target='#abonar-modal'><i class='fa fa-usd'></i></button>";
							return html;
						}else{
							return html;

						}
		 			}

		 		},
			]

	});
}
listadoFactura();
// $('[data-mask]').inputmask();
function roundNumber(number, precision){
    precision = Math.abs(parseInt(precision)) || 0;
    var multiplier = Math.pow(10, precision);
    return (Math.round(number * multiplier) / multiplier);
}

$('#abonoMonto').keypress(function (evt) {
	var theEvent = evt || window.event;
  var keyCode = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode(keyCode);
  var regex = /[0-9]/;
	if (keyCode === 8 || keyCode === 46 || keyCode === 37 || keyCode === 38 || keyCode === 39 || keyCode === 40 || keyCode === 13 || keyCode === 110) {
		return;
	}
  if( !regex.test(key) || $('#abonoMonto').val().length >= $('#montoTotalAbono').html().length) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
});
	var IdFactura = "";
mostrarPendiente = function(btn){
	IdFactura = btn.value;
	var total = $('#ValorFacturaTotal-' + IdFactura).val();
	var restante = $('#ValorFacturaRestante-' + IdFactura).val();
	var _abono = $('#ValorFacturaAbono-' + IdFactura).val();

	$('#montoPendienteAbono').html(restante);
	$('#montoTotalAbono').html(total);
	$('#montoRestanteAbono').html(restante);

	$('#abonoMonto').change(function () {
		var abono = parseFloat($(this).val());
		var res = roundNumber(restante - abono, 2);
		if (res < 0) {
			$('#montoRestanteAbono').html(res);
			$('#montoRestanteAbono').parent().addClass('text-danger');
			$('#AbonarBtn').prop('disabled', true);
		} else {
			$('#montoRestanteAbono').html(res);
			$('#montoRestanteAbono').parent().removeClass('text-danger');
			$('#AbonarBtn').prop('disabled', false);
		}
	});
}

$("#AbonarBtn").click(function(){
var abono = $("#abonoMonto").val();
var route = '/factura-abono';
	$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{IdFactura:IdFactura,abono:abono},
		success: function(){
			listadoFactura();
			$("#abonar-modal").modal('hide');
			$("#abonoMonto").val("");
			alertify.success("Guardado");
		},
		error: function(){
			console.log("error");
		}
	});
});

var ModificadoPor = 11;

habilitar = function(btn){
	var IdEstadoFactura = 1;
	var IdFactura = btn.value;
	var route = "/estado-update-factura";

	$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{IdEstadoFactura:IdEstadoFactura,ModificadoPor:ModificadoPor,IdFactura:IdFactura},
		success: function(){
			listadoFactura();
			alertify.success("Habilitado");
		},
		error: function(){
			alertify.error("error");
		}
	});

}

desabilitar = function(btn){
	var IdEstadoFactura = 0;
	var IdFactura = btn.value;
	var route = "/estado-update-factura";


	swal({
  title: 'Quiere cancelar la factura ?',
  type: 'info',
  html:
    'Al cancelar no se tomara en ' +
    'cuenta a la hora del reporte ',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<i class="fa fa-thumbs-up"></i> Confirmar!',
  confirmButtonAriaLabel: 'Confirmar!',
  cancelButtonText:
  '<i class="fa fa-thumbs-down"></i> Cancelar',
  cancelButtonAriaLabel: 'Cancelar',
}).then(function () {
  $.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{IdEstadoFactura:IdEstadoFactura,ModificadoPor:ModificadoPor,IdFactura:IdFactura},
		success: function(){
			listadoFactura();
			alertify.success("Factura Cancelada");
		},
		error: function(){
			alertify.error("error");
		}
	});
})


}

});
