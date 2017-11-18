
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
    

$("#CrearEmpresa").click(function(e){
	e.preventDefault();
	var Nombre = $("#Nombre").val();
    var AnoApertura = $("#AnoApertura").val();
    var Codigo = Nombre.substring(0,4)+''+AnoApertura.substring(2,5);	
	var Telefono = $("#Telefono").val();
	var Direccion = $("#Direccion").val();	
	var Estado = 1;
	var route = "/mantenimiento/empresa/crear";
	if(IdMunicipio != "" && $("#Nombre").val() != "" && $("#AnoApertura").val() != "" && $("#Telefono").val() != "" && $("#Direccion").val() != "" && $("#Estado").val() != ""  ){
		$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'POST',
		dataType:'JSON',
		data:{Nombre:Nombre,AnoApertura:AnoApertura,Telefono:Telefono,Direccion:Direccion,Estado:Estado,
			IdMunicipio:IdMunicipio,Codigo:Codigo},		
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
});

ListadoEmpresa = function(){
	var Sucursales = $("#ContenedorSucursal");
	var routalistado = "/mantenimiento/empresa/listado";
	$("#ContenedorSucursal").empty();
	$.get(routalistado, function(data){
		 $(data).each(function(key,value){
	         Sucursales.append('<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"><div class="box box-widget widget-user"><div class="widget-user-header bg-aqua-active"><div class="text-center col-md-12 col-lg-12 col-sm-12 col-xs-12"><h3 class="widget-user-username">'+value.Nombre+'</h3></div><div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"><h5 class="widget-user-desc">'+value.Direccion+'</h5></div></div><div class="widget-user-image"><img class="img-circle" width="128px" height="128" src="/imagen/logo.png" alt="User Avatar"></div><div class="box-footer"><div class="row"><div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 border-right"><div class="description-block"><h5 class="description-header">'+value.AnoApertura+'</h5><span class="description-text">Año</span></div></div><div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 border-right"><div class="description-block"><h5 class="description-header">'+value.Estado+'</h5><span class="description-text">Estado</span></div></div><div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 border-right"><div class="description-block"><h5 class="description-header">'+value.Codigo+'</h5><span class="description-text">Codigo</span></div></div></div></div></div>')
	        });
	});
}
ListadoEmpresa();
});


