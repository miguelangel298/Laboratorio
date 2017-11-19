$(document).ready(function(){
	listadoProcedimiento = function(){
	$("#TablaProcedimiento").DataTable({
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

		 	"ajax": "/mantenimiento/procedimiento/listado",
		 	responsive: true,
		 	 columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
		 	"columns":[
		 		{data: 'Procedimiento'},
		 		{data: "Peso",
		 		render: function(data, type, row){
		 			return "<td>RD$ "+data+"</td>"
		 			}
		 		},
		 		{data: "Dolar",
		 		render: function(data, type, row){
		 			return "<td>US$ "+data+"</td>"
		 			}
		 		},
		 		{data: 'IdProcedimiento',
		 			render: function(data, type, row){
		 				return "<tr class='text-center'><button data-toggle='modal' data-target='#modal-default' title='Editar' onclick='Editar(this);' value="+data+"  style='background-color:#fff;'  class='btn btn-primary'><i style='color:#114C7F; width:17px;' class='fa  fa-pencil' aria-hidden='true'></i></button></tr>"
		 			}
		 		}
			]

	});
}
listadoProcedimiento();



	Limpiar = function(){
		$("#Nombre,#CostoPeso,#CostoDolar").val("");
		$("#DivN,#DivT,#DivCl").removeClass('has-error');
	}

$("#AgregarProcedimiento").click(function(e){
	e.preventDefault();
	var Nombre = $("#Nombre").val();
	var CostoPeso = $("#CostoPeso").val();
	var IdUser = $("#IdUser").val();
	var CostoDolar = $("#CostoDolar").val();
	var route = "/mantenimiento/procedimiento/nuevo";
	if($("#Nombre").val() != "" && $("#CostoPeso").val() != "" && $("#CostoDolar").val() != "" ){
		$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{Nombre:Nombre,CostoPeso:CostoPeso,IdUser:IdUser,CostoDolar:CostoDolar},
		success: function(res){
			listadoProcedimiento();
			swal({
				  title: 'GUARDADO!',
				  type: 'success',
				  html:
				    'Procedimiento Guardado <b>Correctamente </b>. ',
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> OK!',
				  confirmButtonAriaLabel: 'OK!',
				});
			Limpiar();
		},
		error:function(res){
			alertify.error('Error');
		}
	});
	}else{
		var errores ="";
		if($("#Nombre").val()==""){
			$("#DivN").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Nombre.<hr>";
			}else{
				errores+="* Ingrese Nombre.<hr>";
			}
		}else{
			$("#DivN").removeClass('has-error');
		}

		if($("#CostoPeso").val()==""){
			$("#DivCl").addClass('has-error');
			if(errores!=""){errores+="* Monto RD$.<hr>";
			}else{
				errores+="* Monto RD$.<hr>";
			}
		}else{
			$("#DivCl").removeClass('has-error');
		}

		if($("#CostoDolar").val()==""){
			$("#DivT").addClass('has-error');
			if(errores!=""){errores+="* Monto US$.<hr>";
			}else{
				errores+="* Monto US$.<hr>";
			}
		}else{
			$("#DivT").removeClass('has-error');
		}

		if(errores!=""){
			alertify.error(errores);
		}
	}


});
var IdProcedimiento ="";
Editar = function(btn){
	var EditarPorc = "/mantenimiento/procedimiento/"+btn.value+"/editar";
	$.get(EditarPorc, function(data){
		$("#NombreE").val(data.Procedimiento);
		$("#CostoPesoE").val(data.Peso);
		$("#CostoDolarE").val(data.Dolar);
		IdProcedimiento= btn.value;
	});
}

//ACTUALIZAR PROCEDIMIENTO--------------------------------------

$("#ActualizarProcedimiento").click(function(e){
	e.preventDefault();
	var Nombre = $("#NombreE").val();
	var CostoPeso = $("#CostoPesoE").val();
	var IdUser = $("#IdUser").val();
	var CostoDolar = $("#CostoDolarE").val();
	var route = "/mantenimiento/procedimiento/editar";
	if($("#NombreE").val() != "" && $("#CostoPesoE").val() != "" && $("#CostoDolarE").val() != "" ){
		$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{Nombre:Nombre,CostoPeso:CostoPeso,IdUser:IdUser,CostoDolar:CostoDolar,IdProcedimiento:IdProcedimiento},
		success: function(res){
			listadoProcedimiento();
			swal({
				  title: 'ACTUALIZADO!',
				  type: 'success',
				  html:
				    'Procedimiento Actualizado <b>Correctamente </b>, ',
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> OK!',
				  confirmButtonAriaLabel: 'OK!',
				});
			$("#modal-default").modal('toggle'),
			Limpiar();
		},
		error:function(res){
			alertify.error('Error');
		}
	});
	}else{
		var errores ="";
		if($("#NombreE").val()==""){
			$("#DivNE").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Nombre.<hr>";
			}else{
				errores+="* Ingrese Nombre.<hr>";
			}
		}else{
			$("#DivNE").removeClass('has-error');
		}

		if($("#CostoPesoE").val()==""){
			$("#DivClE").addClass('has-error');
			if(errores!=""){errores+="* Monto RD$.<hr>";
			}else{
				errores+="* Monto RD$.<hr>";
			}
		}else{
			$("#DivClE").removeClass('has-error');
		}

		if($("#CostoDolarE").val()==""){
			$("#DivTE").addClass('has-error');
			if(errores!=""){errores+="* Monto US$.<hr>";
			}else{
				errores+="* Monto US$.<hr>";
			}
		}else{
			$("#DivTE").removeClass('has-error');
		}

		if(errores!=""){
			alertify.error(errores);
		}
	}
});

});
