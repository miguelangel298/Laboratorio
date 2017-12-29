Vue.prototype.$http = axios;

App = new Vue({
	el: '#app-paciente',
	data: {
		searchQuery: '',
		pacientes: [],
		busqueda: [],
		currentPaciente: {},
	},
	mounted: function () {
		this.fetchPacientes();
	},
	watch: {
		searchQuery: function (newVal) {
			if (newVal && this.pacientes) {
				this.busqueda = this.pacientes.filter(function (paciente) {
					paciente.Nombres = paciente.Nombres || '';
					paciente.Apellidos = paciente.Apellidos || '';
					paciente.Cedula = paciente.Cedula || '';
					wildcard = paciente.Nombres + ' ' + paciente.Apellidos + ' (' + paciente.Cedula + ')';
					cedula = paciente.Cedula.replace(/\-/g, '');
					return wildcard.toLowerCase().includes(newVal.toLowerCase().trim()) || cedula.toLowerCase().includes(newVal.toLowerCase().trim());
				});
			} else {
				this.busqueda = this.pacientes;
			}
		},
	},
	methods: {
		fetchPacientes: function () {
			var app = this;
			this.$http.get('/listadopaciente')
			.then(function (response) {
				app.pacientes = response.data.data;
				app.busqueda = app.pacientes;
			}).catch(function (err) {
				console.log(err);
			});
		},
		setCurrent: function (paciente) {
			$('#IdPacienteDatos').focusout();
			this.currentPaciente = paciente;
			ObtenerCliente(paciente.Idpersona);
			this.currentPaciente = {};
			this.searchQuery = '';
			// set vue
		},
		getCurrentPaciente: function () {
				$('#IdPacienteDatos').focusout();
				paciente = this.busqueda[0];
				if (paciente) {
					ObtenerCliente(paciente.Idpersona);
					this.searchQuery = '';
				}
		},
	}
});






$("#contenidoFactura").hide();
$("#montoTotalAbono").parent().removeClass('col-md-offset-1');
$("#montoPendienteAbono").parent().hide();
$(document).ready(function($) {

$('#IdPacienteDatos').focusout(function () {
	setTimeout(function () {
		$('#livesearch').removeClass('show');
		$('#livesearch').addClass('hide');
	}, 100);
});

$('#IdPacienteDatos').focus(function () {
	$('#livesearch').removeClass('hide');
	$('#livesearch').addClass('show');
});

$('#IdPacienteDatos').click(function () {
	$('#livesearch').removeClass('hide');
	$('#livesearch').addClass('show');

});

var DollarValor = "";
var date = "";
var f=new Date();
var m2 = f.getMonth() + 1;
var mesok = (m2 < 10 ) ? '0' + m2 : m2;

var m3 = f.getHours();
var meok = (m3 < 10) ? '0' + m3 : m3;

var m6 = f.getDate();
var dia = (m6 < 10) ? '0' + m6 : m6;

date=f.getFullYear()+"-"+mesok+"-"+dia;

$("#FechaUp").html(date);

$("#IdProcedimiento").select2();

	var moneda = 1;
	$("input[name=metododinero]").change(function () {
		moneda = $(this).val();
		var codigoId = getCodigos();
		LimpiarFactura();
		$(codigoId).each(function(key,value){
			var routeProcedimiento = "/procemiento-pesos/"+moneda+"/"+value+"";
			$.get(routeProcedimiento,function(res){
				addProcedimiento(res);
				});
		});
		});
var IdPersona = "";
ObtenerCliente = function (IdPacienteDatos) {
	var RutaDatos = "/factura/cliente/datos/"+IdPacienteDatos+"";
	$.get(RutaDatos, function(data) {
		if (data.Error == 'Funciona') {
		$("#contenedorDatos").html("<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-warning'></i> Cliente no esta Registrado!</h4>Dirigirse a la seccion mantenimiento/cliente para Procesar con la Factura.</div><hr> ");

		}else{
			$("#informacion").hide();
			$("#contenidoFactura").show();
			$("#contenedorDatos").show();
			$("#contenedorDatos").html("<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 invoice-col'><address><strong>Nombre: </strong>"+data.Nombre+"<br><strong>Cedula: </strong>"+data.Cedula+"<br><strong>Correo:</strong> "+data.Correo+"</address></div><div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 invoice-col'> <address><strong>Nacionalidad: </strong>"+data.IdNacionalidad+"<br><strong>Fecha de Nacimiento: </strong>"+data.FechaNacimineto.substr(0, 10) +"<br><strong>Sexo: </strong>"+data.Sexo +"<br></address></div><div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 invoice-col'><b>Seguro de Salud: </b>"+data.SeguroMedico+"<br><b>No. de Afiliado: </b>"+data.NumeroSeguro+"<br><b>Telefono:</b> "+data.Celular+"<br></div></div><hr>");
			$("#IdCliente").val(data.IdPersona);
			IdPersona = data.IdPersona;
		}
	});
}

// $("#ObtenerCliente").click(function(e) {
//
// 	e.preventDefault();
// 	ObtenerCliente(IdPacienteDatos);
// 	//var Cedulaid = $("#Cedulaid").val();
//
// });



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

	var IdProcedimiento = "";
	$("#IdProcedimiento").change(function(e){
		e.preventDefault();
        IdProcedimiento = $(this).val();
	});

	var IdPacienteDatos = "";
	$("#IdPacienteDatos").change(function(e){
		e.preventDefault();
        IdPacienteDatos = $(this).val();
				$('#livesearch').removeClass('hide');
				$('#livesearch').addClass('show');
	});


	var suma = 0;
	var procedimientos= [];
	var order = 0;
	var resultados =0;
	var conteoDeProcedimiento = 0;
	var Itbis = 0;
	var Descuento = 0;
	var TotalPagar = 0;

$('.divisa-p').click(function () {
	IdDiv = $(this).data('value');
	$(this).parent().addClass('active');
	if (IdDiv == '1') {
		$('#dollarDivisa').parent().removeClass('active');
	} else {
		$('#pesoDivisa').parent().removeClass('active');
	}
	if (moneda == IdDiv) {
		return;
	}
	moneda = IdDiv;
	IdDivisa = 1;
	route = '/divisas/valor/' + IdDivisa;
	$.get(route, function(res){
		DollarValor = res.Valor;
		arr = procedimientos;
		arr.forEach(function (proc) {
			if (IdDiv == '1') {
				proc.precio *= parseInt(DollarValor);
			} else {
				proc.precio /= parseInt(DollarValor);
			}
		});
		setTimeout(function () {
			deleteAllProc();
			procedimientos = arr;
			getSuma();
			showProcedimientos();
		}, 200);
	});
});

	var descuentoP = 0;
	$("#Descuento").change(function(e){
		e.preventDefault();
        descuentoP = $(this).val();
        if(procedimientos != ""){
			getSuma();
        }else{

        }

	});

function roundNumber(number, precision){
    precision = Math.abs(parseInt(precision)) || 0;
    var multiplier = Math.pow(10, precision);
    return (Math.round(number * multiplier) / multiplier);
}

function getSuma() {
	var sum = 0;
	procedimientos.forEach(function (proc) {
		sum += proc.precio;
	});

	$("#dinero").html(roundNumber(sum, 2));
	var totaldescuento = sum * descuentoP;

   var subtotaldescuento = sum-totaldescuento;

   var itbisre  =subtotaldescuento*0.18;

   $("#itbis").html(roundNumber(itbisre, 2));
     Itbis = itbisre;
   $("#descuentoHtml").html(roundNumber(totaldescuento, 2));
     Descuento = totaldescuento;
   var total = subtotaldescuento+itbisre;

   $("#total").html( roundNumber(total, 2));
     TotalPagar = total;
		 $('#montoTotalAbono').html(roundNumber(total, 2));
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

$('#abonoMonto').change(function () {
	var abono = parseFloat($(this).val());
	var total = $("#montoTotalAbono").html();
	var res = roundNumber(total - abono, 2);
	if (res < 0) {
		$('#montoRestanteAbono').html('0');
		$('#AbonarBtn').prop('disabled', true);
	} else {
		$('#montoRestanteAbono').html(res);
		$('#AbonarBtn').prop('disabled', false);
	}
});

LimpiarFactura = function(){
$("#dinero,#itbis,#descuentoHtml,#total").html("");
	descuentoP = 0;
	$("#Descuento").prop('selectedIndex',0);
	$('#IdPacienteDatos').prop('selectedIndex',0).trigger('change');
	$('#IdProcedimiento').prop('selectedIndex',0).trigger('change');
	clearDataTable();
	procedimientos = [];
	order = 0;
}

function getCodigos() {
	var codigos = [];
	procedimientos.forEach(function (proc) {
		codigos.push(proc.codigo);
	});
	return codigos;
}


function clearDataTable() {
	$("#ProcedimientoList").empty();
}

function showProcedimientos() {
	$("#procCount").val(procedimientos.length);
	var dis = (parseInt($("#procCount").val()) <= 0);
	$('#GenerarFacturaTarjeta').prop('disabled', dis);
	$('#GenerarFactura').prop('disabled', dis);
	$('#AbonarFactura').prop('disabled', dis);
	procedimientos.forEach(function (proc) {
		showSingleProcedimiento(proc);
	});
}


function showSingleProcedimiento(proc) {
	 $("#ProcedimientoList").append("<tr class='tableid'><td>"+proc.codigo+"</td><td>"+proc.nombre+"</td><td>$"+roundNumber(proc.precio, 2)+"</td><td><button  title='Eliminar' onclick='deleteProcedimiento(this);' value="+proc.codigo+"  style='background-color:#fff;'  class='btn btn-danger text-center'><i style='color:red;' class='fa  fa-trash-o' aria-hidden='true'></i></button></td></tr>");
	 getSuma();
}

 deleteProcedimiento = function (codigo) {
	$("#procCount").val(parseInt($("#procCount").val()) - 1);
	var dis = (parseInt($("#procCount").val()) <= 0);
	$('#GenerarFacturaTarjeta').prop('disabled', dis);
	$('#GenerarFactura').prop('disabled', dis);
	$('#AbonarFactura').prop('disabled', dis);
	procedimientos.forEach(function (proc, i) {
		if (codigo.value == proc.codigo) {
			var idDelete = i;
			procedimientos.splice(idDelete, 1);
			clearDataTable();
			 showProcedimientos();
			 getSuma();

		}
	});


}

function showProc(codigo) {
	var proc = {};
	var order = 0;
	procedimientos.forEach(function (pr, i) {
		if (pr.codigo === codigo) {
			order = i;
			proc = pr;
		}
	});
	// console.log(order);
	// console.log(procedimientos);
	showSingleProcedimiento(proc);
}


function deleteAllProc() {
	$("#procCount").val("0");
	var dis = (parseInt($("#procCount").val()) <= 0);
	$('#GenerarFacturaTarjeta').prop('disabled', dis);
	$('#GenerarFactura').prop('disabled', dis);
	$('#AbonarFactura').prop('disabled', dis);
	procedimientos = [];
	clearDataTable();
	showProcedimientos();
}

function pushProcedimiento(proc) {
	var found = false;
	procedimientos.forEach(function (pr, i) {
		if (pr.codigo === proc.codigo) {
			found = true;
		}
	});
	if (!found) {
		procedimientos.push(proc);
		showProc(proc.codigo);
		$("#procCount").val(parseInt($("#procCount").val()) + 1);
		var dis = (parseInt($("#procCount").val()) <= 0);
		$('#GenerarFacturaTarjeta').prop('disabled', dis);
		$('#GenerarFactura').prop('disabled', dis);
		$('#AbonarFactura').prop('disabled', dis);
	} else {
		swal(
		  '...',
		  'Este procedimiento ya existe!',
		  'error'
		)
	}
}

function addProcedimiento(res) {
	var proc = {
	 	codigo: res.IdProcedimiento,
	 	nombre: res.Procedimiento,
	 	precio: res.Peso
	 };
	 if (moneda == '2') {
		 proc.precio /= parseInt(DollarValor);
	 }
	 pushProcedimiento(proc);
	 order += 1;
}

$("#AgregarProcedimiento").click(function(e){
	if (IdProcedimiento) {
		var routeProcedimiento = "/procemiento-pesos/1/"+IdProcedimiento+"";
		$.get(routeProcedimiento,function(res){
			addProcedimiento(res);
		});
	}

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


var dis = (parseInt($("#procCount").val()) <= 0);
$('#GenerarFacturaTarjeta').prop('disabled', dis);
$('#GenerarFactura').prop('disabled', dis);
$('#AbonarFactura').prop('disabled', dis);

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
					var IdPersona1 = data.Idpersona;
					var routePaciente ="/paciente/crear";
					$.ajax({
						url:routePaciente,
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						type:'POST',
						dataType:'JSON',
						data:{IdPersona:IdPersona1,SeguroMedico:SeguroMedico, NumeroSeguro:NumeroSeguro},
						success: function(res){
							App.fetchPacientes();
							$("#Cedulaid").val(Cedula);
							App.setCurrent({ Idpersona: IdPersona1 });
							$("#agregarClienteModal").modal('toggle');
							Limpiar();
						},
						error: function(res){

						}
					});
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

var array = [];
		$('.tableid').each(function(index,object){
			var obj = {};
			obj['Codigo'] = $($(object).children()[0]).html();
			array.push(obj);

		});



//GENERAL FACTURA
GenerarFactura =  function(IdTipo) {
	var IdPersona1 = $("#IdCliente").val();
	var IdMoneda =  moneda;
	var IdTipoPago = IdTipo;
	var Total = suma;
	var ItbisC = Itbis;
	var DescuentoC = Descuento;
	var TotalPagarC = TotalPagar;
	var ModificadoPorF = $("#ModificadoPor").val();
	var route = "/factura-generar";
	var monto = $("#abonoMonto").val();

	if($("#ModificadoPor").val() != ""){
	$.ajax({
			url:route,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			dataType:'JSON',
			data:{IdPersona:IdPersona1,IdMoneda:IdMoneda,IdTipoPago:IdTipoPago,Total:Total,Itbis:ItbisC,
				Descuento:DescuentoC,TotalPagar:TotalPagarC,ModificadoPor:ModificadoPorF, Monto: monto},

			success: function(res){
				$("#abonoMonto").val("");
				$('#abonar-modal').modal('hide');
				swal({
					  title: 'GUARDADO!',
					  type: 'success',
					  html:
					    'Factura Guardado <b>Correctamente </b>. ',
					  showCloseButton: true,
					  focusConfirm: false,
					  confirmButtonText:
					    '<i class="fa fa-thumbs-up"></i> OK!',
					  confirmButtonAriaLabel: 'OK!',
					});

				var array = [];
			$('.tableid').each(function(index,object){
				var obj = {};
				obj['Codigo'] = $($(object).children()[0]).html();
				array.push(obj);

			});
				$("#informacion").show();
				$("#Cedulaid").val("");
				$("#contenidoFactura").hide();
				$("#contenedorDatos").hide();
		//GENERAR DETALLE  DE FACTURA
			var routeIdF = "/factura-id";
			var IdFactura = "";
			$.get(routeIdF,  function(data){
				 IdFactura = data.IdFactura;

				$(array).each(function(key,value){
				var IdProcedimiento=value.Codigo
				var route =  "/factura/detalle/crear";
					$.ajax({
					url:route,
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:'POST',
					dataType:'JSON',
					data:{IdFactura:IdFactura,IdProcedimiento:IdProcedimiento},
						success: function(res){
							LimpiarFactura();
						}
					});
				});

				var routePrint = "/factura-print/"+IdFactura+"";
				$.get(routePrint,function(datas){

					var pdfWindows = window.open(",", "");
					pdfWindows.document.write(datas);
					pdfWindows.document.close();
					pdfWindows.focus();
					pdfWindows.print();
					pdfWindows.close();
				});
			});


			},
			error:function(res){
				alertify.error('Error');
			}
		});

	}else{
	alertify.error("Vacio");
	}
}

$("#GenerarFacturaTarjeta").click(function() {
	var IdTipo = 2
	GenerarFactura(IdTipo);
});

$("#GenerarFactura").click(function(){
var IdTipo = 1
GenerarFactura(IdTipo);

});

$('#AbonarBtn').click(function () {
	var IdTipo = 1;
	GenerarFactura(IdTipo);
});


});
