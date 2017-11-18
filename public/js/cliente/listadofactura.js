$(document).ready(function($) {
	var IdSucursal = 1;
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

		 	"ajax": "/listadofactura/"+IdSucursal+"",
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
		 				if(row.Estado == "Activa"){
		 				return "<button onclick='desabilitar(this)' value="+data+" class='btn btn-default'  style='background: transparent; border: transparent; color:#01C613; font-size:16px; border-color: #fff;' ><i class='fa  fa-toggle-on' aria-hidden='true'></i> </button>"
		 				}else if (row.Estado == "Cancelada"){
		 				return "<button onclick='habilitar(this)' value="+data+" class='btn btn-default'  style='background: transparent; border: transparent;  font-size:16px; ' ><i class='fa  fa-toggle-off' aria-hidden='true'></i> </button>"
		 				}
		 			}

		 		},
			]

	});
}
listadoFactura();

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
