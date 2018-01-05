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

	var SeguroMedico = "";
	$("#SeguroMedico").change(function(e){
		e.preventDefault();
        SeguroMedico = $(this).val();
	});

	$("#Cedula").change(function(e){
		e.preventDefault();
		var cedula = $(this).val();
		var route = '/paciente/verificacion';
		$.ajax({
			url:route,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			dataType:'JSON',
			data:{cedula:cedula},
		success: function(res){
			if(res.existencia == 1){
				$('#DivC').addClass('has-error');
				$("#AgregarCliente").attr("disabled", true);
				$('#mensajeCedulaError').removeClass('show');
				$('#mensajeCedulaError').addClass('hide');
			}else{
				$("#AgregarCliente").attr("disabled", false);
				$('#DivC').removeClass('has-error');
				$('#DivC').addClass('has-success');
				$('#mensajeCedulaError').removeClass('hide');
				$('#mensajeCedulaError').addClass('show');
			}
		},
		error:function(res){
			console.log('Error');
		}
		});
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

$("#AgregarCliente").click(function(e){
	e.preventDefault();
	var Nombres = $("#Nombres").val();
	var Apellidos = $("#Apellidos").val();
	var Apellido2 = $("#Apellido2").val();
	var IdUser = $("#IdUser").val();
	var Correo = $("#Correo").val();
	var Cedula = $("#Cedula").val();
	var NumeroSeguro = $("#NumeroSeguro").val();
	var FechaNacimineto = $("#FechaNacimineto").val();
	var Celular = $("#Celular").val();
	var Telefono = $("#Telefono").val();
	var route = "/clientes/crear";
	if(SeguroMedico != "" && IdSexo != "" && IdNacionalidad != "" && $("#Nombres").val() != "" && $("#Apellidos").val() != "" && $("#Cedula").val() != "" && $("#FechaNacimineto").val() != "" && $("#Celular").val() != ""  ){
		$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{Nombres:Nombres,Apellido1:Apellidos,Apellido2:Apellido2,IdSexo:IdSexo,Correo:Correo,
			Cedula:Cedula,FechaNacimineto:FechaNacimineto,IdNacionalidad:IdNacionalidad,
			Celular:Celular,Telefono:Telefono,IdUser:IdUser},

		success: function(res){
			swal({
				  title: 'GUARDADO!',
				  type: 'success',
				  html:
				    'Cliente Guardado <b>Correctamente </b>. ',
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> OK!',
				  confirmButtonAriaLabel: 'OK!',
				});

				var routePersona = "/obtener/personas";
				$.get(routePersona, function(data){
					var IdPersona = data.Idpersona;
					var routePaciente ="/paciente/crear";
					$.ajax({
						url:routePaciente,
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						type:'POST',
						dataType:'JSON',
						data:{IdPersona:IdPersona,SeguroMedico:SeguroMedico, NumeroSeguro:NumeroSeguro},
						success: function(res){
							Limpiar();
						},
						error: function(res){

						}
					});
				});

		},
		error:function(res){
			console.log('Error');
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

		if($("#Apellidos").val()==""){
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
