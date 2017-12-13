$("#Cancelar").hide();
$("#Actualizar").hide();
$(document).ready(function(){
	$('[data-mask]').inputmask();
	 $('#AnoApertura').datepicker({
      	format: " yyyy",
		viewMode: "years",
		minViewMode: "years",
   		autoclose: true
    });

var IdMunicipio = "";
	$("#IdMunicipio").change(function(e){
		e.preventDefault();
        IdMunicipio = $(this).val();
	});

Limpiar = function(){
		$("#Nombre,#Telefono,#Direccion,#AnoApertura").val("");
		$("#DivSG,#DivF,#DivCl,#DivT,#DivN").removeClass('has-error');
		$('#IdMunicipio').prop('selectedIndex',0);
		IdMunicipio = "";
	}

	function ValidarInput(){
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

		if($("#Telefono").val()==""){
			$("#DivT").addClass('has-error');
			if(errores!=""){errores+="* Telefono.<hr>";
			}else{
				errores+="* Telefono.<hr>";
			}
		}else{
			$("#DivT").removeClass('has-error');
		}

		if($("#AnoApertura").val()==""){
			$("#DivF").addClass('has-error');
			if(errores!=""){errores+="* Año de Apertura.<hr>";
			}else{
				errores+="* Año de Apertura.<hr>";
			}
		}else{
			$("#DivF").removeClass('has-error');
		}

		if($("#Direccion").val()==""){
			$("#DivCl").addClass('has-error');
			if(errores!=""){errores+="* Ingrese Direccion.<hr>";
			}else{
				errores+="* Ingrese Direccion.<hr>";
			}
		}else{
			$("#DivCl").removeClass('has-error');
		}

		if(IdMunicipio ==""){
			$("#DivSG").addClass('has-error');
			if(errores!=""){errores+="* Seleccione Municipio.<hr>";
			}else{
				errores+="* Seleccione Municipio.<hr>";
			}
		}else{
			$("#DivSG").removeClass('has-error');
		}

		if(errores!=""){
			alertify.error(errores);
		}
	}

	function validarData(){
	 	 var form = {};
		 form.Nombre = $("#Nombre").val();
		 form.AnoApertura = $("#AnoApertura").val();
		 form.Codigo = form.Nombre.substring(0,4)+''+form.AnoApertura.substring(2,5);
		 form.Telefono = $("#Telefono").val();
		 form.Direccion = $("#Direccion").val();
		 form.Estado = 1;
		 form.route = "/mantenimiento/empresa/crear";
		 if(IdMunicipio != "" && $("#Nombre").val() != "" && $("#AnoApertura").val() != "" && $("#Telefono").val() != "" && $("#Direccion").val() != "" && $("#Estado").val() != ""  ){
		 	return form;
			} else {
			return null;
			}
	}
$("#CrearEmpresa").click(function(e){
	e.preventDefault();
	var form = validarData();
	if (form !== null) {
		$.ajax({
		url:form.route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{Nombre:form.Nombre,AnoApertura:form.AnoApertura,Telefono:form.Telefono,Direccion:form.Direccion,Estado:form.Estado,
			IdMunicipio:IdMunicipio,Codigo:form.Codigo},
		success: function(res){
			Limpiar();
			ListadoEmpresa();
			swal({
				  title: 'CREADA!',
				  type: 'success',
				  html:
				    'Sucursal Creada <b>Correctamente </b>. ',
				  showCloseButton: true,
				  focusConfirm: false,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> OK!',
				  confirmButtonAriaLabel: 'OK!',
				});
		},
		error:function(res){
			console.log('Error');
		}
	});
	}else{
		ValidarInput();
	}
});

ListadoEmpresa = function(){
	var Sucursales = $("#ContenedorSucursal");
	var routalistado = "/mantenimiento/empresa/listado";
	$("#ContenedorSucursal").empty();
	$.get(routalistado, function(data){
		 $(data).each(function(key,value){
	         Sucursales.append('<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"><div class="box box-widget widget-user"><div class="widget-user-header bg-aqua-active"><div class="text-center col-md-12 col-lg-12 col-sm-12 col-xs-12"><button style="background-color: #fff; border-color: #fff;" value='+value.IdSucursal+'</ onclick="editarSucursal(this);" type="button" class="btn btn-default pull-right" name="button"> <span><i style="color:#00a7d0 " class="fa fa-pencil" aria-hidden="true"></i></span> </button><h3 class="widget-user-username">'+value.Nombre+'</h3></div><div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"><h5 class="widget-user-desc">'+value.Direccion+'</h5></div></div><div class="widget-user-image"><img class="img-circle" width="128px" height="128" src="/imagen/logo.png" alt="User Avatar"></div><div class="box-footer"><div class="row"><div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 border-right"><div class="description-block"><h5 class="description-header">'+value.AnoApertura+'</h5><span class="description-text">Año</span></div></div><div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 border-right"><div class="description-block"><h5 class="description-header">'+value.Estado+'</h5><span class="description-text">Estado</span></div></div><div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 border-right"><div class="description-block"><h5 class="description-header">'+value.Codigo+'</h5><span class="description-text">Codigo</span></div></div></div></div></div>')
	        });
	});
}
ListadoEmpresa();
var IdSucursal = "";
editarSucursal = function(btn){
	$('html, body').animate({
		scrollTop: 0
	}, 300, function () {
		$('#Nombre').focus();
	});
	IdSucursal = btn.value;
	var route = "/mantenimiento/sucursal-edit/"+IdSucursal+"";
	$.get(route, function(data){
		$("#Cancelar").show();
		$("#Actualizar").show();
		$("#CrearEmpresa").hide();
		$("#Nombre").val(data.Nombre);
		$("#Telefono").val(data.Telefono);
		$("#Direccion").val(data.Direccion);
		$("#AnoApertura").val(data.AnoApertura);
		$("#IdMunicipio").val(data.IdMunicipio);
		IdMunicipio = data.IdMunicipio;
	});
}
cancelar = function(){
	$("#Cancelar").hide();
	$("#Actualizar").hide();
	$("#CrearEmpresa").show();
	$("#Nombre").val("");
	$("#Telefono").val("");
	$("#Direccion").val("");
	$("#AnoApertura").val("");
	$('#IdMunicipio').prop('selectedIndex',0);
	// para utilizarlo con select2 $('#IdMunicipio').val(-1).trigger('change');
	IdMunicipio = "";
}

$("#Actualizar").click(function(){
	var form = validarData();
	var route = '/update-sucursal';
	if (form !== null) {
		$.ajax({
			url:route,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			dataType:'JSON',
			data:{Nombre:form.Nombre,AnoApertura:form.AnoApertura,Telefono:form.Telefono,Direccion:form.Direccion,Estado:form.Estado,
				IdMunicipio:IdMunicipio,Codigo:form.Codigo,IdSucursal:IdSucursal},
			success: function(res){
				cancelar();
				ListadoEmpresa();
				swal({
					  title: 'Actualizada!',
					  type: 'success',
					  html:
					    'Sucursal Actualizada <b>Correctamente </b>. ',
					  showCloseButton: true,
					  focusConfirm: false,
					  confirmButtonText:
					    '<i class="fa fa-thumbs-up"></i> OK!',
					  confirmButtonAriaLabel: 'OK!',
					});
			},
			error:function(res){
				console.log('Error');
			}
		});
	}else {
		ValidarInput();
	}
});
});
