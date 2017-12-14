$(document).ready(function($) {


	listadoPaciente = function(){
	$("#TablaPaciente").DataTable({
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

		 	"ajax": "/listadopaciente",
		 	responsive: true,
		 	 columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
		 	"columns":[
		 		{data: 'Nombres'},
		 		{data: 'Apellidos'},
		 		{data: 'Cedula'},
		 		{data: 'FechaNacimiento'},
		 		{data: 'Nacionalidad'},
		 		{data: 'Sexo'},
		 		{data: 'SeguroMedico'},
		 		{data: 'Celular'},
		 		{data: 'Telefono'},
		 		{data: 'Idpersona',
		 			render: function(data, type, row){
		 				return "<tr class='text-center'><button data-toggle='modal' data-target='#modal-default' title='Editar' onclick='EditarEmpleado(this);' value="+data+"  style='background-color:#fff;'  class='btn btn-primary'><i style='color:#114C7F; width:17px;' class='fa  fa-pencil' aria-hidden='true'></i></button> </tr>"
		 			}

		 		},
			]

	});
}
listadoPaciente();

var IdSexo = "";
	$("#IdSexo").change(function(e){
		e.preventDefault();
        IdSexo = $(this).val();
	});

	var IdNacionalidad = "";
	$("#IdNacionalidad").change(function(e){
		e.preventDefault();
        IdNacionalidad = $(this).val();
	});

	var SeguroMedico = "";
	$("#SeguroMedico").change(function(e){
		e.preventDefault();
        SeguroMedico = $(this).val();
	});


	Limpiar = function(){
		$("#Nombres,#Apellidos,#Correo,#Cedula,#FechaNacimineto,#Celular,#Telefono,#Apellido2").val("");
		$("#DivN,#DivA,#DivS,#DivE,#DivC,#DivF,#DivNc,#DivSG,#DivCl,#DivSP").removeClass('has-error');
		$('#IdSexo').prop('selectedIndex',0);
		$('#IdNacionalidad').prop('selectedIndex',0);
		$('#SeguroMedico').prop('selectedIndex',0);
		IdSexo = "";
		IdNacionalidad = "";
		SeguroMedico = "";
	}

var IdPersona = "";
EditarEmpleado = function(data){
	$("#EditarPacienteModal").modal("show");
	IdPersona= data.value;
	var route = "/paciente-mostrar/"+IdPersona+"";
	$.get(route,function(res){
		var fecha = res.FechaNacimineto;
		var ano =fecha.substring(0, 4);
		var mes = fecha.substring(5, 7);
		var	dia =fecha.substring(8, 10);
		$("#Nombres").val(res.Nombres);
		$("#Apellido1").val(res.Apellido1);
		$("#Apellido2").val(res.Apellido2);
		$("#IdSexo").val(res.IdNacionalidad);
		$("#Correo").val(res.Correo);
		$("#Cedula").val(res.Cedula);
		$("#FechaNacimineto").val(ano+"/"+mes+"/"+dia);
		$('#FechaNacimineto').datepicker({
			format: "yyyy/mm/dd",
			autoclose: true,
		});
		$("#IdNacionalidad").val(res.IdNacionalidad);
		$("#Celular").val(res.Celular);
		$("#Telefono").val(res.Telefono);
		$("#SeguroMedico").val(res.SeguroMedico);
		IdSexo = res.IdNacionalidad;
		IdNacionalidad = res.IdNacionalidad;
		SeguroMedico = res.SeguroMedico;
	});
}

$("#ActualizarCliente").click(function(e){
	e.preventDefault();
	console.log(IdPersona);
	var Nombres = $("#Nombres").val();
	var Apellido1 = $("#Apellido1").val();
	var Apellido2 = $("#Apellido2").val();
	var IdUser = $("#IdUser").val();
	var Correo = $("#Correo").val();
	var Cedula = $("#Cedula").val();
	var FechaNacimineto = $("#FechaNacimineto").val();
	var Celular = $("#Celular").val();
	var Telefono = $("#Telefono").val();
	var route = "/paciente/update";
	if(SeguroMedico != "" && IdSexo != "" && IdNacionalidad != "" && $("#Nombres").val() != "" && $("#Apellido1").val() != "" && $("#Cedula").val() != "" && $("#FechaNacimineto").val() != "" && $("#Celular").val() != ""  ){
		$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{Nombres:Nombres,Apellido1:Apellido1,Apellido2:Apellido2,IdSexo:IdSexo,Correo:Correo,
			Cedula:Cedula,FechaNacimineto:FechaNacimineto,IdNacionalidad:IdNacionalidad,
			Celular:Celular,Telefono:Telefono,IdPersona:IdPersona,SeguroMedico:SeguroMedico},

		success: function(res){
			$("#EditarPacienteModal").modal("hide");
			swal({
				  title: 'ACTUALIZADO!',
				  type: 'success',
				  html:
				    'Cliente Actualizado <b>Correctamente </b>. ',
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> OK!',
				  confirmButtonAriaLabel: 'OK!',
				});
		},
		error:function(res){
			alertify.error('Error');
		}
	});
	}else{
		var errores ="";
		if($("#Nombres").val()==""){
			$("#DivN").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Nombre.<hr>";
			}else{
				errores+="* Ingrese Nombre.<hr>";
			}
		}else{
			$("#DivN").removeClass('has-error');
		}

		if($("#Apellido1").val()==""){
			$("#DivA").addClass('has-error');
			if(errores!=""){errores+="* Primer Apellido.<hr>";
			}else{
				errores+="* Primer Apellido.<hr>";
			}
		}else{
			$("#DivA").removeClass('has-error');
		}

		if($("#Apellido2").val()==""){
			$("#DivSP").addClass('has-error');
			if(errores!=""){errores+="* Segundo Apellido.<hr>";
			}else{
				errores+="* Segundo Apellido.<hr>";
			}
		}else{
			$("#DivSP").removeClass('has-error');
		}
		if(IdSexo ==""){
			$("#DivS").addClass('has-error');
			if(errores!=""){errores+="* Seleccione Sexo.<hr>";
			}else{
				errores+="* Seleccione Sexo.<hr>";
			}
		}else{
			$("#DivS").removeClass('has-error');
		}

		if($("#Cedula").val()==""){
			$("#DivC").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Cedula.<hr>";
			}else{
				errores+="* Ingrese Cedula.<hr>";
			}
		}else{
			$("#DivC").removeClass('has-error');
		}

		if($("#FechaNacimineto").val()==""){
			$("#DivF").addClass('has-error');
			if(errores!=""){errores+="* Fecha de Nacimiento.<hr>";
			}else{
				errores+="* Fecha de Nacimiento.<hr>";
			}
		}else{
			$("#DivF").removeClass('has-error');
		}

		if(IdNacionalidad ==""){
			$("#DivNc").addClass('has-error');
			if(errores!=""){errores+="* Seleccione Pais.<hr>";
			}else{
				errores+="* Seleccione Pais.<hr>";
			}
		}else{
			$("#DivNc").removeClass('has-error');
		}

		if($("#Celular").val()==""){
			$("#DivCl").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Celular .<hr>";
			}else{
				errores+="* Ingrese Celular.<hr>";
			}
		}else{
			$("#DivCl").removeClass('has-error');
		}
		if(SeguroMedico == ""){
			$("#DivSG").addClass('has-error');
			if(errores!=""){errores+="* Seguro Medico .<hr>";
			}else{
				errores+="* Seguro Medico.<hr>";
			}
		}else{
			$("#DivSG").removeClass('has-error');
		}

		if(errores!=""){
			alertify.error(errores);
		}
	}


});

});
