jQuery.fn.reset = function () {
    $(this).each(function () {
        this.reset();
    });
}
function auto() {
	try {
	var fecha = "";	
	var $fec=$("#fecnac").val().split('/');
	var fecha=$fec[2]+'-'+$fec[1]+'-'+$fec[0]	
    
   // fecha = $("#fecnac").val()
    var sexo = ""
    if ($("#sexo1").is(":checked")) {        sexo = 1    }
    if ($("#sexo2").is(":checked")) {        sexo = 0    }
    var apellido = $("#apellidos").val()+"";
    var nombre = $("#nombres").val()+"";
    var auto = fecha.substring(2, 4) + fecha.substring(5, 7) + fecha.substring(8, 10)+""
    var apellidos = $("#apellidos").val().split(" ")
 
    if (apellidos[0].length < 4) {
        apellidos1 = apellidos[0].substring(0, 1) + apellidos[0].substring(apellidos[0].length - 1, apellidos[0].length)
    } else {        apellidos1 = apellidos[0].substring(0, 1) + apellidos[0].substring(3, 4)    }
    if (apellidos.length >= 2) {        var apellidoseg = apellidos[apellidos.length - 1]
    }
    if (apellidoseg.length < 4) {        apellidos2 = apellidoseg.substring(0, 1) + apellidoseg.substring(apellidoseg.length - 1, apellidoseg.length)
    } else {        apellidos2 = apellidoseg.substring(0, 1) + apellidoseg.substring(3, 4)
    }
    auto = auto + sexo + apellidos1 + apellidos2 + nombre.substring(0, 1)
  $("#auto").val(auto.toUpperCase())
  }
catch (e) {	 
}
  
}
var tipo_edad = 0;
var edad = 0;
// JavaScript Document
var CodigoPaciente = 0;
var codigo_fila = 0;
var can = 0;
var ventana = 0;
var CodigoCie10 = 0;
var tipo = 1; /* tipo 1 guardar tipo 2 modificar*/
var enfocado = 1; /*tipo 1 para enfocar buscador tipo 2 para enfocar tabla */
$(document).ready(function () {
    inicializa()
    cboturnos()
    $('#IdTablaPaciente').fixheadertable({
        //caption : "", 
        colratio: [80, 370],
        height: 200,
        width: 460,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,
        rowsPerPage: 10,
        resizeCol: true
    });
    $('#IdTablaPaciente2').fixheadertable({
        //caption : "", 
        colratio: [320, 100],
        height: 200,
        width: 460,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,
        rowsPerPage: 10,
        resizeCol: true
    });
    $('#IdTablaPaciente3').fixheadertable({
        //caption : "", 
        colratio: [180, 180, 90],
        height: 200,
        width: 460,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,
        rowsPerPage: 10,
        resizeCol: true
    });
});



function inicializa() {
    $("#buscarcie").attr("onclick", "")
    $("#buscarpac").attr("onclick", "")
    $("#buscarpac").hide(0)
    CancelarBuscarTurno()
    CancelarBuscarTurno2()
    $("#formtab1").find('input, textarea, button, select').attr("checked", false);
    $("#formtab2").find('input, textarea, button, select').attr("checked", false);
    $("#formtab1").find('input, textarea, button, select').attr("disabled", true);
    $("#formtab1").find('input, textarea, select').addClass("cajaTexto");
    $("#formtab2").find('input, textarea, button, select').attr("disabled", true);
    $("#formtab2").find('input, textarea, select').addClass("cajaTexto")
    $("#auto").css({
        "background-color": "#E6FFF2"
    })
    $("#formtab1").find('input, textarea, button, select').css({
        "background-color": "#E6FFF2"
    })
    $("#formtab2").find('input, textarea, button, select').css({
        "background-color": "#E6FFF2"
    })
    $("#formtab1").reset();
    $("#formtab2").reset();
}


function habilitar() {
    CancelarBuscarTurno()
    CancelarBuscarTurno2()
    CancelarBuscarTurno3()
    $("#buscarcie").attr("onclick", "buscadorcie()")
    $("#buscarpac").attr("onclick", "buscadorpac()")

    $("#formtab1").find('input, textarea, button, select').attr("disabled", false).css({
        "background-color": "#FFFFFF"
    });;
    $("#formtab2").find('input, textarea, button, select').attr("disabled", false).css({
        "background-color": "#FFFFFF"
    });
    $("#auto").css({
        "background-color": "#FFFFFF"
    })
}

function Ver1() {
    $("#tab1").show();
    $("#tab2").hide();
}

function Ver2() {
    $("#tab2").show();
    $("#tab1").hide();
}

function NuevoRegistrarPaciente() {
    $("#idpaciente").val("")
    $("#buscarpac").show(0)
    tipo = 1
    habilitar()
    $("#IdUsuNuevo").attr("disabled", true);
    $("#IdUsuGrabar").attr("disabled", false);
    $("#IdUsuCancelar").attr("disabled", false);
    $("#IdUsuBuscar").attr("disabled", true);
    $("#IdTurEliminar").attr("disabled", true);
    $("#IdImprimir").attr("disabled", true);
    $("#IdUsuNuevo").removeClass("btnNuevo2").addClass("btnDeshabilitarNuevo2");
    $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar2").addClass("btnGrabar2");
    $("#IdUsuCancelar").removeClass("btnDeshabilitarCancelar2").addClass("btnCancelar2");
    $("#IdUsuBuscar").removeClass("btnBuscar2").addClass("btnDeshabilitarBuscar2");
    $("#IdUsuEliminar").removeClass("btnEliminar2").addClass("btnDeshabilitarEliminar2");
    $("#IdImprimir").removeClass("btnEliminar2").addClass("btnDeshabilitarEliminar2");
}

function GrabarRegistrarPaciente() {
    $apellidos = $("#apellidos").val();
    if ($apellidos == "") {
		$("#IdTituloRegistrarPac").text("Faltan Apellidos ..");
		$("#MensajeRegistrarPac").show(500);
       // alert("Faltan Apellidos ..")
        $("#apellidos").focus();
        return false;
    }
    $nombres = $("#nombres").val();
    if ($nombres == "") {
		$("#IdTituloRegistrarPac").text("Faltan nombres");
		$("#MensajeRegistrarPac").show(500);
        //alert("Faltan nombres")
        $("#nombres").focus();
        return false;
    }
    $fechaingreso = $("#fecing").val()
    if ($fechaingreso == "") {
		$("#IdTituloRegistrarPac").text("Faltan Fecha de Ingreso");
		$("#MensajeRegistrarPac").show(500);
       // alert("Faltan Fecha de Ingreso")
        $("#fecing").focus();
        return false;
    }
    $fecnac = $("#fecnac").val()
    if ($fecnac == "") {
		$("#IdTituloRegistrarPac").text("Faltan Fecha de Nacimiento");
		$("#MensajeRegistrarPac").show(500);
       // alert("Faltan Fecha de Nacimiento")
        $("#fecnac").focus();
        return false;
    }
    $cie10 = $("#cie10text").val()
    if ($cie10 == "") {
		$("#IdTituloRegistrarPac").text("Faltan Llenar el Cie10");
		$("#MensajeRegistrarPac").show(500);
       // alert("Faltan Llenar el Cie10")
        $("#cie10").focus();
        return false;
    }
    $diagnostico = $("#diagnostico").val()
    if ($diagnostico == "") {
		$("#IdTituloRegistrarPac").text("Faltan Llenar el Diagnostico");
		$("#MensajeRegistrarPac").show(500);
        //alert("Faltan Llenar el Diagnostico")
        $("#diagnostico").focus();
        return false;
    }
	auto()
    if (tipo == 1) {
        var str1 = $("#formtab1").serialize() + "&accion=INSERTAR&"
        var str2 = $("#formtab2").serialize() + "&tipo_edad=" + tipo_edad + "&edad=" + edad + "&auto=" + $("#auto").val()
        $.ajax({
            url: 'CONTROLADOR/Cpaciente.php',
            type: 'POST',
            data: str1 + str2,
            success: function (data) {
				$("#IdTituloRegistrarPac").text(data);
		        $("#MensajeRegistrarPac").show(500); 
                //alert(data)
                CancelarRegistrarPaciente()
            }
        });
    }
    if (tipo == 2) {
        var str1 = $("#formtab1").serialize() + "&accion=MODIFICAR&"
        var str2 = $("#formtab2").serialize() + "&tipo_edad=" + tipo_edad + "&edad=" + edad + "&auto=" + $("#auto").val()
        $.ajax({
            url: 'CONTROLADOR/Cpaciente.php',
            type: 'POST',
            data: str1 + str2,
            success: function (data) {
				$("#IdTituloRegistrarPac").text(data);
		        $("#MensajeRegistrarPac").show(500); 
               // alert(data)
                CancelarRegistrarPaciente()
            }
        });
    }
}

function CancelarRegistrarPaciente() {
    $("#auto").val("")
    $("#IdUsuNuevo").attr("disabled", false);
    $("#IdUsuGrabar").attr("disabled", true);
    $("#IdUsuCancelar").attr("disabled", true);
    $("#IdUsuBuscar").attr("disabled", false);
    $("#IdUsuEliminar").attr("disabled", true);
    $("#IdImprimir").attr("disabled", true);
    $("#IdUsuNuevo").attr("disabled", false);
    $("#IdUsuGrabar").attr("disabled", true);
    $("#IdUsuCancelar").attr("disabled", true);
    $("#IdUsuBuscar").attr("disabled", false);
    $("#IdUsuEliminar").attr("disabled", true);
    $("#IdUsuNuevo").removeClass("btnDeshabilitarNuevo2").addClass("btnNuevo2");
    $("#IdUsuGrabar").removeClass("btnGrabar2").addClass("btnDeshabilitarGrabar2");
    $("#IdUsuCancelar").removeClass("btnCancelar2").addClass("btnDeshabilitarCancelar2");
    $("#IdUsuBuscar").removeClass("btnDeshabilitarBuscar2").addClass("btnBuscar2");
    $("#IdUsuEliminar").removeClass("btnEliminar2").addClass("btnDeshabilitarEliminar2");
    inicializa()
}

function BuscarRegistrarPaciente() {
    $("#DivBuscarRegistrarPacientes").show("slow");
}

function EliminarRegistrarPaciente() {
idpaciente = $("#idpaciente").val()
idficha=$("#idficha").val()
  $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'ELIMINAR',
		idpaciente:idpaciente,
		idficha:idficha
    }, function (data) {
		$("#IdTituloRegistrarPac").text("Eliminado Correctamente");
		$("#MensajeRegistrarPac").show(500); 
		//alert("Eliminado Correctamente")
		CancelarRegistrarPaciente()
		inicializa()
    })

}

function SalirRegistrarPaciente() {
	$("#cie10").off("keypress");
	$("#xd").off("click");
	$(document).off("keydown");
	$("#DivRegistrarPaciente").html("")
    $("#DivRegistrarPaciente").hide("slow");
}

function CancelarBuscarRegistrarPaciente() {
    $("#DivBuscarRegistrarPacientes").hide("slow");
}

function CancelarBuscarTurno() {
    //delete $verificar;   
    $("#DivBuscarPacientes").hide();
    ventana = 0
    //LimpiarTurno();	
}

function CancelarBuscarTurno3() {
    //delete $verificar;   
    $("#DivBuscarPacientes3").hide();
    ventana = 0
    //LimpiarTurno();	
}

function CancelarBuscarTurno2() {
    //delete $verificar;   
    $("#DivBuscarPacientes2").hide();
    ventana = 0
    //LimpiarTurno();	
}

$("#cie10").keypress(function (e) {
    if (e.keyCode == 13) {
        buscadorcie()
    }
})

$("#xd").click(function (e) {

    buscadorcie()

})

function restarfechas() {
	var $ini=$("#fecnac").val();
	var $fin=$("#fecing").val();
	
  if($ini!="" && $fin!=""){	
     $.post('CONTROLADOR/Cpaciente.php',{accion:'VALIDAR_FEC',ini:$ini,fin:$fin},function(data){
		 if(data==0){
			 $("#fecnac").val('');
			 $("#IdTituloRegistrarPac").text("La fecha de Nacimiento tiene que ser menor que la fecha de ingreso ..");
			 $("#MensajeRegistrarPac").show(500);
			 }
		 })
    var $nac=$ini.split('/')
	var fecha1s=$nac[2]+'-'+$nac[1]+'-'+$nac[0]
	
	var $ing=$fin.split('/')
	var fecha2s=$ing[2]+'-'+$ing[1]+'-'+$ing[0]
    //var fecha1s = $("#fecnac").val()
   // var fecha2s = $("#fecing").val()
    var fecha1 = new fecha(fecha1s)
    var fecha2 = new fecha(fecha2s)

    //alert(fecha2.anio+'-->'+fecha2.mes);exit;
    var miFecha1 = new Date(fecha1.anio, fecha1.mes, fecha1.dia)
    var miFecha2 = new Date(fecha2.anio, fecha2.mes, fecha2.dia)
    var diferencia = miFecha2.getTime() - miFecha1.getTime()
    var anios = Math.floor(diferencia / (1000 * 60 * 60 * 24 * 365))

    var meses = Math.floor(diferencia / (1000 * 60 * 60 * 24 * 30))
    if (diferencia < 0) {
        return false;
    }
    if (anios > 0) {
        $("#edad").val(anios + " años")
        edad = anios
        tipo_edad = 1

    } else {
        $("#edad").val(meses + "meses")
        edad = meses
        tipo_edad = 2
    }

    return true
  }else{$("#edad").val('')}
}


function fecha(cadena) {

    //Separador para la introduccion de las fechas
    var separador = "-"

    //Separa por dia, mes y año
    if (cadena.indexOf(separador) != -1) {
        var posi1 = 0
        var posi2 = cadena.indexOf(separador, posi1 + 1)
        var posi3 = cadena.indexOf(separador, posi2 + 1)
        this.anio = cadena.substring(posi1, posi2)
        this.mes = cadena.substring(posi2 + 1, posi3)
        this.dia = cadena.substring(posi3 + 1, cadena.length)
    } else {
        this.dia = 0
        this.mes = 0
        this.anio = 0
    }
}

function cboturnos() {
    $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'LISTARTURNOS'
    }, function (data) {

        $("#cboturno").append(data);
    })
}

function buscarcie10() {

    var textcie10 = $("#IdBusquedaDIA").val()
    if (textcie10 == "") return false;
	
    $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'LISTARCIE10',
        cie10text: textcie10
    }, function (data) {


        $("#IdCuerpoPaciente").html(data);

        if (can == 0) {
            $("#IdCuerpoPaciente").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");
            return;
        }
    })
}

function buscarcie3() {
    var textcie10 = $("#IdBusquedaDIA3").val()
    if (textcie10 == "") return false;
    $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'LISTARPACIENTE2',
        cie10text: textcie10

    }, function (data) {
        $("#IdCuerpoPaciente3").html(data);

        if (can == 0) {
            $("#IdCuerpoPaciente3").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");
            return;
        }
    })
}


function buscarcie102() {
var k=0
	 if($("#k").is(":checked")){
		k=1
		 }
	var textcie10 = $("#IdBusquedaDIA2").val()
    if (textcie10 == "") return false;
    $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'LISTARPACIENTE',
        cie10text: textcie10,
		k:k

    }, function (data) {
        $("#IdCuerpoPaciente2").html(data);

        if (can == 0) {
            $("#IdCuerpoPaciente2").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");
            return;
        }
    })
}

function buscadorcie() {

    codigo_fila = 0
    ventana = 1
    can = 0
    $("#DivBuscarPacientes").show(1000);
    $("#IdBusquedaDIA").focus()
    $("#IdBusquedaDIA").val($("#cie10").val())
    $("#IdCuerpoPaciente2").html("");
    $("#IdCuerpoPaciente").html("");
    // buscarcie10()
}

function buscadorpac() {

    $("#IdBusquedaDIA3").val("")
    codigo_fila = 0
    ventana = 3
    can = 0
    $("#IdCuerpoPaciente").html("");
    $("#IdCuerpoPaciente2").html("");
    $("#IdCuerpoPaciente3").html("");
    $("#DivBuscarPacientes3").show();
    $("#IdBusquedaDIA3").focus()
    // buscarcie10()
}

function buscadorcie2() {
    $("#IdBusquedaDIA2").val("")
    codigo_fila = 0
    ventana = 2
    can = 0
    $("#IdCuerpoPaciente").html("");
    $("#IdCuerpoPaciente2").html("");
    $("#DivBuscarPacientes2").show();
    $("#IdBusquedaDIA2").focus()

    // buscarcie10()
}


function CancelarBuscarcie() {
    codigo_fila = 0
    ventana = 0
    can = 0
    $("#IdCuerpoPaciente2").html("");
    //delete $verificar;   
    $("#IdCuerpoPaciente").html("");
    $("#DivBuscarPacientes").hide(1000);

}

function CancelarBuscarcie2() {
    codigo_fila = 0
    ventana = 0
    can = 0
    $("#IdCuerpoPaciente").html("");
    $("#IdCuerpoPaciente2").html("");
    //delete $verificar;   
    $("#DivBuscarPacientes2").hide(1000);

}

function PintarFila($codigo_fila, $tabla) {
    codigo_fila = $codigo_fila
    $("#" + $tabla + " tr").css({
        background: "#FFFFFF"
    });
    $("#" + $codigo_fila).css({
        background: "#c5dbec",
        cursor: "pointer"
    });
    $("#IdBusquedaDIA").blur();

}

function eleccion() {
    $("#cie10").val($("#" + codigo_fila).attr("alt"));
    $("#cie10text").val($("#" + codigo_fila).attr("title"))
    $("#cie10").focus();
    CancelarBuscarTurno()
    return false

}

function RealizaBusqueda() {
    $("#IdBusquedaDIA").blur();
    buscarcie10()
}

function asignar2() {
    $("#idpaciente").val($("#" + codigo_fila).attr("alt"))

    $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'PACIENTE2',
        paciente: $("#idpaciente").val()
    }, function (data) {

        var c = data.split("¶");

        $("#apellidos").val(c[3])
        $("#nombres").val(c[4])
        $sexo = c[11]
        if ($sexo == 0) {
            $("#sexo2").attr("checked", "checked")
        }
        if ($sexo == 1) {
            $("#sexo1").attr("checked", "checked")
        }
        edad = c[19]
        tipo_edad = c[20]
		$fec_nac=c[5].split('-');
		$fecha_nac=$fec_nac[2]+'/'+$fec_nac[1]+'/'+$fec_nac[0];
		
        $("#fecnac").val($fecha_nac)
        $("#gruposang").val(c[6] + "////" + c[7])
        $("#dni").val(c[2])
		 $("#auto").val(c[8])
        restarfechas()
        tipo = 1
        CancelarBuscarTurno3()
    })
}

function asignar() {
    $("#idpaciente").val($("#" + codigo_fila).attr("idpaciente"))
	   $("#idficha").val($("#" + codigo_fila).attr("idficha"))
    $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'PACIENTEX',
		idficha:$("#idficha").val(),
        paciente: $("#idpaciente").val()
    }, function (data) {
        var c = data.split("¶");
        $("#auto").val(c[8])
        $("#idficha").val(c[12])
        $("#apellidos").val(c[3])
        $("#nombres").val(c[4])
        $sexo = c[11]
        if ($sexo == 0) {
            $("#sexo2").attr("checked", "checked")
        }
        if ($sexo == 1) {
            $("#sexo1").attr("checked", "checked")
        }
        edad = c[19]
        tipo_edad = c[20]
		
		$fec_nac=c[5].split('-');
		$fecha_nac=$fec_nac[2]+'/'+$fec_nac[1]+'/'+$fec_nac[0];
		//alert($fecha_nac);exit;
		$fec_ing=c[17].substring(0, 10).split('-');
		$fecha_ing=$fec_ing[2]+'/'+$fec_ing[1]+'/'+$fec_ing[0];
		$fec_ini=c[25].split('-')
		$fecha_ini=$fec_ini[2]+'/'+$fec_ini[1]+'/'+$fec_ini[0];
		$fec_ini2=c[26].split('-')
		$fecha_ini2=$fec_ini2[2]+'/'+$fec_ini2[1]+'/'+$fec_ini2[0];
		
		//alert($fecha_nac);exit;
        $("#fecnac").val($fecha_nac)
        $("#gruposang").val(c[6] + "////" + c[7])
        $("#fecing").val($fecha_ing)
        $("#direccion").val(c[21])
        $("#telefono").val(c[22])
        $("#contaceme").val(c[23])
        $("#teleme").val(c[24])
        $("#fecinidia").val($fecha_ini)
        $("#fecinidia2").val($fecha_ini2)
        $("#dni").val(c[2])
        $("#cie10").val(c[28])
        $("#cie10text").val(c[64])
        $("#diagnostico").val(c[27])
        $("#pesoseco").val(c[29])
        $("#cboturno").val(c[13])
        $("#alergia").val(c[37])
        restarfechas()
        if (c[30] == 1) {
            $("#d1").attr("checked", true)
        }
        if (c[31] == 1) {
            $("#d2").attr("checked", true)
        }
        if (c[32] == 1) {
            $("#d3").attr("checked", true)
        }
        if (c[33] == 1) {
            $("#d4").attr("checked", true)
        }
        if (c[34] == 1) {
            $("#d5").attr("checked", true)
        }
        if (c[35] == 1) {
            $("#d6").attr("checked", true)
        }
        if (c[36] == 1) {
            $("#d7").attr("checked", true)
        }
        $("#h1").val(c[47])
        $("#h3").val(c[48])
        $("#h5").val(c[49])
        if (c[50] == 1) {
            $("#h2").attr("checked", true)
        }
        if (c[51] == 1) {
            $("#h4").attr("checked", true)
        }
        if (c[52] == 1) {
            $("#h6").attr("checked", true)
        }
		
		$fec_fd1=c[53].split('-');
		$fd1=$fec_fd1[2]+'/'+$fec_fd1[1]+'/'+$fec_fd1[0];
		$fec_fd2=c[55].substring(0, 10).split('-');
		$fd2=$fec_fd2[2]+'/'+$fec_fd2[1]+'/'+$fec_fd2[0];
		$fec_fd3=c[57].split('-')
		$fd3=$fec_fd3[2]+'/'+$fec_fd3[1]+'/'+$fec_fd3[0];
		
		
        $("#fd1").val($fd1)
        $("#rd1").val(c[54])
        $("#fd2").val($fd2)
        $("#rd2").val(c[56])
        $("#fd3").val($fd3)
        $("#rd3").val(c[58])
        tipo = 2
        /*botones*/
        $("#IdSucNuevo").attr("disabled", true);
        $("#IdUsuGrabar").attr("disabled", false);
        $("#IdUsuCancelar").attr("disabled", false);
        $("#IdUsuBuscar").attr("disabled", true);
        $("#IdUsuEliminar").attr("disabled", false);
        $("#IdImprimir").attr("disabled", false);
        $("#IdUsuNuevo").removeClass("btnNuevo2").addClass("btnDeshabilitarNuevo2");
        $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar2").addClass("btnGrabar2");
        $("#IdUsuCancelar").removeClass("btnDeshabilitarCancelar2").addClass("btnCancelar2");
        $("#IdUsuBuscar").removeClass("btnBuscar2").addClass("btnDeshabilitarBuscar2");
        $("#IdUsuEliminar").removeClass("btnDeshabilitarEliminar2").addClass("btnEliminar2");
        $("#IdImprimir").removeClass("btnDeshabilitarEliminar2").addClass("btnEliminar2");
        /**/
        habilitar()
        CancelarBuscarTurno2()
    })
}

$(document).keydown(function (e) {

    if (ventana == 0) return true
    if (e.keyCode == 9) {
        if (ventana == 1) {
            $("#IdBusquedaDIA").focus();return false;
        }
        if (ventana == 2) {
            $("#IdBusquedaDIA2").focus();return false;
        }
		  if (ventana == 3) {
            $("#IdBusquedaDIA3").focus();return false;
        }
        return true;
    }


    if (e.keyCode == 13) {
        if (ventana == 3) {
            if ($("#IdBusquedaDIA3").is(":focus")) {
                $("#IdBusquedaDIA3").blur();
                /**/
                buscarcie3()
            } else {
                if (can == 0) {
                    $("#IdBusquedaDIA3").focus()
                } else {
                    asignar2()
                    //CancelarBuscarTurno2()
                    return false
                }
            }
        }
        if (ventana == 2) {
            if ($("#IdBusquedaDIA2").is(":focus")) {
                $("#IdBusquedaDIA2").blur();
                buscarcie102()
            } else {
                if (can == 0) {
                    $("#IdBusquedaDIA2").focus()
                } else {

                    asignar()

                    //CancelarBuscarTurno2()
                    return false


                }

            }

        }

        if (ventana == 1) {
            if ($("#IdBusquedaDIA").is(":focus")) {
                $("#IdBusquedaDIA").blur();
                buscarcie10()
            } else {
                if (can == 0) {
                    $("#IdBusquedaDIA").focus()


                } else {

                    $("#cie10").val($("#" + codigo_fila).attr("alt"));
                    $("#cie10text").val($("#" + codigo_fila).attr("title"))
                    $("#cie10").focus();
                    CancelarBuscarTurno()
                    return false
                }
            }
        }
    }


    if (e.keyCode == 40) {

        var num_fila = codigo_fila;
        var tr = num_fila + 1;

        if (num_fila < can) {
            $('#' + num_fila).css({
                background: '#FFFFFF'
            });
            PintarFila(tr, 'IdTablaPaciente')
            PintarFila(tr, 'IdTablaPaciente2')
        }

        return false
    }
    if (e.keyCode == 38) {
        var num_fila = codigo_fila;
        var tr = num_fila - 1;

        if (num_fila > 1) {
            $('#' + num_fila).css({
                background: '#FFFFFF'
            });

            PintarFila(tr, 'IdTablaPaciente')
            PintarFila(tr, 'IdTablaPaciente2')
        }
        return false
    }

}) // This is just a sample script. Paste your real code (javascript or HTML) here.

if ('this_is' == /an_example/) {
    of_beautifer();
} else {
    var a = b ? (c % d) : e[f];
}