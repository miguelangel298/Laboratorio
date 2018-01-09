$('#CancelarUp').hide();
$('#ActualizarEmpleado').hide();
$(document).ready(function(){
	$('[data-mask]').inputmask();
    //Date picker
    $('#FechaNacimineto').datepicker({
      format: "yyyy/mm/dd",
      autoclose: true,
    });

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


	var IdSucursal = "";
	$("#IdSucursal").change(function(e){
		e.preventDefault();
        IdSucursal = $(this).val();
	});

	var IdCargo = "";
	$("#IdCargo").change(function(e){
		e.preventDefault();
        IdCargo = $(this).val();
        console.log($(this).val());
	});

	Limpiar = function(){
		$("#Pass,#PassCon,#Nombres,#Apellido1,#IdSexo,#Correo,#Cedula,#FechaNacimineto,#IdNacionalidad,#Celular,#Telefono,#Apellido2").val("");
		$("#DivN,#DivA,#DivS,#DivE,#DivC,#DivF,#DivNc,#DivSG,#DivCl,#DivSP").removeClass('has-error');
		$('#IdCargo').prop('selectedIndex',0);
		$('#IdSucursal').prop('selectedIndex',0);
		$('#IdNacionalidad').prop('selectedIndex',0);
		$('#IdSexo').prop('selectedIndex',0);
		IdSexo = "";
		IdNacionalidad = "";
		SeguroMedico = "";
		$('#TituloModal').html("Agregar nuevo Empleado");
		$(".hiddenUp").show();
		$("#AgregarEmpleado").show();
		$('#CancelarUp').hide();
		$('#ActualizarEmpleado').hide();

	}


function validarData(){
 	var form = {};
	 form.Nombres = $("#Nombres").val();
	 form.Apellidos1 = $("#Apellido1").val();
	 form.Apellido2 = $("#Apellido2").val();
	 form.IdUser = $("#IdUser").val();
	 form.Correo = $("#Correo").val();
	 form.Cedula = $("#Cedula").val();
	 form.FechaNacimineto = $("#FechaNacimineto").val();
	 form.Celular = $("#Celular").val();
	 form.Telefono = $("#Telefono").val();
	 form.route = "/mantenimiento/empleado/update";
	if(IdSucursal != "" && IdCargo != ""  && IdSexo != "" && IdNacionalidad != "" && $("#Nombres").val() != "" && $("#Apellidos").val() != "" && $("#Cedula").val() != "" && $("#FechaNacimineto").val() != ""
	&& $("#Celular").val() !=""){
	 	return form;
	} else {
		return null;
	}
}

function ValidarInput(){
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
		if(IdSucursal ==""){
			$("#DivSL").addClass('has-error');
			if(errores!=""){errores+="* Seleccione Sucursal.<hr>";
			}else{
				errores+="* Seleccione Sucursal.<hr>";
			}
		}else{
			$("#DivSL").removeClass('has-error');
		}
		if(IdCargo ==""){
			$("#DivCR").addClass('has-error');
			if(errores!=""){errores+="* Seleccione Cargo.<hr>";
			}else{
				errores+="* Seleccione Cargo.<hr>";
			}
		}else{
			$("#DivCR").removeClass('has-error');
		}


		if(errores!=""){
			alertify.error(errores);
		}
}

$("#AgregarEmpleado").click(function(e){
	e.preventDefault();
	var Nombres = $("#Nombres").val();
	var Apellidos1 = $("#Apellido1").val();
	var Apellido2 = $("#Apellido2").val();
	var IdUser = $("#IdUser").val();
	var Correo = $("#Correo").val();
	var Cedula = $("#Cedula").val();
	var FechaNacimineto = $("#FechaNacimineto").val();
	var Celular = $("#Celular").val();
	var Telefono = $("#Telefono").val();
	var Pass = $("#Pass").val();
	var route = "/mantenimiento/empleado/crear";
	if(IdSucursal != "" && IdCargo != ""  && IdSexo != "" && IdNacionalidad != "" && $("#Nombres").val() != "" && $("#Apellidos").val() != "" && $("#Cedula").val() != "" && $("#FechaNacimineto").val() != ""
  ){
		$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{Nombres:Nombres,Apellido1:Apellidos1,Apellido2:Apellido2,IdSexo:IdSexo,Correo:Correo,
			Cedula:Cedula,FechaNacimineto:FechaNacimineto,IdNacionalidad:IdNacionalidad,
			Celular:Celular,Telefono:Telefono,IdUser:IdUser,IdSucursal:IdSucursal,IdCargo:IdCargo,
			Pass:Pass},

		success: function(res){
			nuevoUsuario = res.usuarioMostrar;
			swal({
				title: 'GUARDADO!',
				type: 'success',
				html:
				  'Empleado Guardado correctamente como: <b>' + nuevoUsuario + '</b>.',
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
		ValidarInput();
	}


});

listadoEmpleado = function(){
	$("#TablaCliente").DataTable({
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

		 	"ajax": "/listado-empleado",
		 	responsive: true,
		 	 columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
		 	"columns":[
		 		{data: 'Nombre'},
		 		{data: 'Cedula'},
		 		{data: 'Usuario'},
		 		{data: 'Estado'},
		 		{data: 'IdPersona',
		 			render: function(data, type, row){
		 				return "<tr class='text-center'><button data-toggle='modal' data-target='#modal-default' title='Editar' onclick='EditarEmpleado(this);' value="+data+"  style='background-color:#fff;'  class='btn btn-primary'><i style='color:#114C7F; width:17px;' class='fa  fa-pencil' aria-hidden='true'></i></button>	<button data-toggle='modal' data-target='#modal-contraseña' title='Contraseña' onclick='Contraseña(this);' value="+row.Usuario+"  style='background-color:#189995;'  class='btn btn-primary'><i style='color:#fff; width:17px;' class='fa  fa fa-key' aria-hidden='true'></i></button> </tr>"
		 			}

		 		}
			]

	});
}

listadoEmpleado();

var UserName = "";
Contraseña = function(Usuario){
	UserName = Usuario.value;
	$("#UsuarioName").html(Usuario.value);

}

LimpiarPassword = function(){
	$("#modal-contraseña").modal("hide");
	$("#contraseña,#cContraseña").val("");
	$(".verificacionPass").removeClass("has-error");
	$("#UsuarioName").html("");
}

var IdPersona = "";
EditarEmpleado = function(data){
	// $(window).scrollTop(10);
	$('html, body').animate({
		scrollTop: 0
	}, 300, function () {
		$('#Nombres').focus();
	});
	$('#TituloModal').html("Actualizar Empleado");
	$(".hiddenUp").hide();
	$("#AgregarEmpleado").hide();
	$('#CancelarUp').show();
	$('#ActualizarEmpleado').show();
	IdPersona=data.value;
	var route = "/mostrar-empleado/"+IdPersona+"";
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
		$("#IdNacionalidad").val(res.IdNacionalidad);
		$("#Celular").val(res.Celular);
		$("#Telefono").val(res.Telefono);
		$("#IdSucursal").val(res.IdSucursal);
		$("#IdCargo").val(res.IdCargo);
		IdSexo = res.IdNacionalidad;
		IdNacionalidad = res.IdNacionalidad;
		IdSucursal = res.IdSucursal;
		IdCargo = res.IdCargo;
	});
}

$("#ActualizarEmpleado").click(function(e){
	e.preventDefault();
	var form = validarData();
	if (form !== null) {
		$.ajax({
			url:form.route,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			dataType:'JSON',
			data:{Nombres:form.Nombres,Apellido1:form.Apellidos1,Apellido2:form.Apellido2,IdSexo:IdSexo,Correo:form.Correo,
				Cedula:form.Cedula,FechaNacimineto:form.FechaNacimineto,IdNacionalidad:IdNacionalidad,
				Celular:form.Celular,Telefono:form.Telefono,IdUser:IdPersona,IdSucursal:IdSucursal,IdCargo:IdCargo},

			success: function(res){
				swal({
					title: 'ACTUALIZADO!',
					type: 'success',
					html:
					  'Empleado Actualizado <b>Correctamente </b>. ',
					showCloseButton: true,
					focusConfirm: false,
					confirmButtonText:
					  '<i class="fa fa-thumbs-up"></i> OK!',
					confirmButtonAriaLabel: 'OK!',
				});

				listadoEmpleado();
				Limpiar();
			},
			error:function(res){
				console.log('Error');
			}
		});
    }else{
	ValidarInput();
    }


});

$("#ActualizarContraseña").click(function(e){
	e.preventDefault();
	var contraseña = $("#contraseña").val() ;
	var Ccontraseña = $("#cContraseña").val();
	var route = "/update-password";
	if($("#contraseña").val() != "" && $("#cContraseña").val() != "" ){
		if(contraseña == Ccontraseña){
			$.ajax({
				url:route,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'POST',
				dataType:'JSON',
				data:{pass:Ccontraseña,UserName:UserName},
				success: function(res){
					LimpiarPassword();
					alertify.success('Actualizado');
				},
				error : function(){
					alertify.error();
				}
			});
		}else{
			swal(
			  'Opss..',
			  'Contraseña no coinciden!',
			  'error'
			)
			$(".verificacionPass").addClass("has-error");
		}
	}else{
		var errores ="";
		if($("#contraseña").val()==""){
			$("#DivPsUp").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Contraseña.<hr>";
			}else{
				errores+="* Ingrese Contraseña.<hr>";
			}
		}else{
			$("#DivPsUp").removeClass('has-error');
		}

		if($("#cContraseña").val()==""){
			$("#DivPUp").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Contraseña.<hr>";
			}else{
				errores+="* Ingrese Contraseña.<hr>";
			}
		}else{
			$("#DivPUp").removeClass('has-error');
		}
		if(errores!=""){
			alertify.error(errores);
		}
	}

});

});
