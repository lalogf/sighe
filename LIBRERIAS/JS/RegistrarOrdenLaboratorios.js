// JavaScript Document
var idexamen = 0
var opcion = 0
var caninput = 0
var codigo_fila = 0
var ventana = 1
var opcion2 = 0
var can = 0
var variable = 0
$(document).ready(function () {
    $("#buscarpaciente").attr("disabled", "disabled")
    $('#IdTablaPaciente2').fixheadertable({
        //caption : "", 
        colratio: [205, 253, 238],
        height: 200,
        width: 731,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,
        rowsPerPage: 10,
        resizeCol: true
    });

    $.post('CONTROLADOR/Corden.php', {
        accion: 'LISTAR1'
    }, function (data) { //alert(data);exit;
        $("#CuerpoOel2").html(data);
        $("input").attr("disabled", "disabled")
        $("input[type='text'],textarea").css({
            "background-color": "#98CBCB"
        });

    })
  $('#IdTablaOel2').fixheadertable({
        //caption : "", 

        colratio: [75, 200, 140, 140],
        height: 100,
        width: 565,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,

        resizeCol: true
    });

    $('#IdTablaOel').fixheadertable({
        //caption : "", 
        colratio: [60, 100, 140, 140, 60],
        height: 200,
        width: 565,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,
        rowsPerPage: 10,
        resizeCol: true
    });
});



function PintarFila2($num_fila, $tabla) {
    $("#" + $tabla + " tr  ").css({
        background: "#FFFFFF"
    });

    $("#" + $num_fila).css({
        background: "#c5dbec",
        cursor: "pointer"
    });
}



function PintarFila($num_fila, $tabla) {

    $("#" + $tabla + " tr ").css({
        background: "#FFFFFF"
    });

    $("#" + $num_fila).css({
        background: "#c5dbec",
        cursor: "pointer"
    });
    idexamen = $("#" + $num_fila).attr("idexamen")
    variable = $num_fila
}


function NuevoTipoExamen() {
    $("#buscarpaciente").attr("disabled", false)
    opcion = 1
    ventana = 2
    $("input[type='text'],textarea").css({
        "background-color": "#FFFFFF"
    });
    $("input,textarea,select").attr("disabled", false);
    $("#IdOelCodigo").attr("disabled", true);
    $("#IdExamen").attr("disabled", false);
    $("#estado").attr("disabled", false);
    $("#IdValorNormalTipoExamen").attr("disabled", false);
    $("#IdGrupoNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo").attr("disabled", false);
    $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar").attr("disabled", false);
    $("#IdGrupoCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar").attr("disabled", false);
    $("#IdGrupoBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar").attr("disabled", false);
    $("#IdGrupoEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar").attr("disabled", false);
    $.post('CONTROLADOR/Corden.php', {
        accion: 'GENERARID'
    }, function (data) {
        //   alert(data);
        idexamen = data
        $("#IdOelCodigo").val(data);
        $("#fecha").focus()
    })

}

function GrabarRegistrarPacientexd() {

    codigo = $("#IdOelCodigo").val()
    paciente = $("#IdOelPaciente").val()
    pacientetexto = $("#IdOelMostarPaciente").val()
    fecha = $("#fecha").val()
    estado = $("#IdOelEstado").val()
    obs = $("#IdOelObservacion").val()
    str = $("#form").serialize()

    if (paciente == "") {
        $("#IdOelPaciente").focus();
        alert("Llene");
        return false;
    }
    if (pacientetexto == "") {
        $("#IdOelPaciente").focus();
        alert("Llene");
        return false;
    }



    $.ajax({
        url: 'CONTROLADOR/Corden.php',
        type: 'POST',
        data: str + "&accion=GRABAR&" + "&codigo=" + codigo + "&paciente=" + paciente + "&fecha=" + fecha + "&estado=" + estado + "&observacion=" + obs + "&opcion=" + opcion,
        success: function (data) {
            if (data) {
                //alert(data)
                if (opcion == 1) {
                    alert("Guardo Ok")
                    CancelarTipoExamen()
                }
                if (opcion == 2) {
                    alert("Modifico Ok")
                    CancelarTipoExamen()
                }
            }
        }
    });




}

function LimpiarUsuario(){}

function eliminar() {

    var $id = $("#IdOelCodigo").val();
    $.post('CONTROLADOR/Corden.php', {
        accion: 'ELIMINAR',
        id: $id
    }, function (data) {
        if (data == 1) {
            alert("Elimino")

            CancelarTipoExamen();
        } else {
            alert("No se Elimino")

        }

    })
    LimpiarUsuario();
}

function CancelarTipoExamen() {


    opcion = 0
    $("input[type='text'],textarea,select").val("")
    $("input[type='text',type='date'],textarea,select").attr("disabled", true);
    $("#buscarpaciente").attr("disabled", "disabled")
    $("#fecha").attr("disabled", true);

    $("input[type='text'],textarea").css({
        "background-color": "#98CBCB"
    });


    $("#IdGrupoNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo").attr("disabled", false);
    $("#IdUsuGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
    $("#IdGrupoCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
    $("#IdGrupoBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar").attr("disabled", false);
    $("#IdGrupoEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
}




function RealizaBusquedaUsuario() {
    var $usuario = $("#IdBusquedaTipoE").val();

    $("#CuerpoTipoExamen").html("<tr><td colspan='4'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
    $.post('CONTROLADOR/Ctipo_examen.php', {
        accion: 'LISTAR',
        usuario: $usuario
    }, function (data) { //alert(data);exit;
        var $data = data.split("///");

        if ($data[0] == 0) {
            can = 0;
            $("#CuerpoTipoExamen").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");

        } else {
            can = $data[0];

            $("#CuerpoTipoExamen").html($data[1]);
            PintarFila(1)
        }

    })

}

function BuscarTipoExamenxd() {
    variable = 0
    $("#DivBuscarOel").show("slow");
    $("#IdBusquedaOel").attr("disabled", false);
    ventana = 2
    $("#IdBusquedaOel").focus()
    $("#IdBusquedaOel").val("")
    $("#CuerpoOel").html("")

}

function EliminarTipoExamen() {

}

function SalirTipoExamen() {
	$(document).off("keydown");
	
  	$("#DivRegistrarOrdenLaboratorio").html("");
    $("#DivRegistrarOrdenLaboratorio").hide("slow");
}

function CancelarBuscarTipoExamen() {
    ventana = 0
    $("#CuerpoOel").html("")
    $("#IdCuerpoPaciente2").html("")

    $("#DivBuscarTipoExamenes").hide("slow");
    $("#DivBuscarOel").hide("slow")
}




function SeleccionarBusquedaUsuario() {
    opcion = 2
    idexamen = idexamen
    $("#DivBuscarTipoExamenes").hide("slow");

    $("input").attr("disabled", false);
    $("#IdCodigoTipoExamen").attr("disabled", true);
    $("select").attr("disabled", false);
    $("input,textarea").css({
        "background-color": "#FFFFFF"
    });
    $.post('CONTROLADOR/Ctipo_examen.php', {
        accion: 'LLENAR_FORM',
        idusuario: idexamen
    }, function (data) {
        var datos = eval(data);
        $.each(datos, function (index, columna) {
            $("#IdCodigoTipoExamen").val(columna.id);
            $("#IdExamen").val(columna.examen);
            $("#IdValorNormalTipoExamen").val(columna.valornormal);
            $("#estado").val($("#" + variable).attr("estado"));

        });
    })
    $("#IdGrupoNuevo").attr("disabled", true);
    $("#IdUsuGrabar").attr("disabled", false);
    $("#IdGrupoCancelar").attr("disabled", false);
    $("#IdGrupoBuscar").attr("disabled", true);
    $("#IdGrupoEliminar").attr("disabled", false);
    $("#IdGrupoNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
    $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
    $("#IdGrupoCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
    $("#IdGrupoBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
    $("#IdGrupoEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");

}


function buscaroel() {

    var textcie10 = $("#IdBusquedaOel").val()
    if (textcie10 == "") return false;
    $.post('CONTROLADOR/Corden.php', {
        accion: 'LISTARORDEN',
        buscar: textcie10

    }, function (data) {
        var $data = data.split("///");
        $("#CuerpoOel").html($data[1]);
        can = $data[0]
        variable = 1
        PintarFila(1)
        if ($data[0] == 0) {
            $("#CuerpoOel").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");
            return;
        }
    })
}


function buscarcie102() {
    var textcie10 = $("#IdBusquedaDIA2xd").val()
    if (textcie10 == "") return false;
    $.post('CONTROLADOR/Cpaciente.php', {
        accion: 'LISTARPACIENTE',
        cie10text: textcie10

    }, function (data) {
        $("#IdCuerpoPaciente2").html(data);
        variable = 1
        if (can == 0) {
            $("#IdCuerpoPaciente2").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");
            return;
        }
    })
}


function pruebas() {
    codigo_fila = 0
    ventana = 1
    can = 0
    variable = 0
    $("#DivBuscarPacientes2").show();
    $("#IdBusquedaDIA2xd").focus()
    $("#IdBusquedaDIA2xd").val($("#IdOelPaciente").val())
    $("#IdCuerpoPaciente2").html("");

}

function asignar() {
    opcion = 2
    $("#IdOelPaciente").val($("#" + variable).attr("idficha"));
    $("#IdOelMostarPaciente").val($("#" + variable).attr("title"))
    $("#IdOelPaciente").focus()
    CancelarBuscarTurno2()

}

function ordenasignar2() {
    var idexamena = $("#" + variable).attr("idexamen")

    $("#IdOelCodigo").val($("#" + variable).attr("idexamen"));
    // $("#IdOelMostarPaciente").val($("#" + variable).attr("title"))

    $("input[type='text'],textarea").css({
        "background-color": "#FFFFFF"
    });
//alert($("#" + variable).attr("estado"))
    $.post('CONTROLADOR/Corden.php', {
        accion: 'LLENAR_FORM',
        idusuario: idexamena
    }, function (data) {
        datin = data.split("╚╚╚")

        $("#CuerpoOel2").html(datin[1])
        var datos = eval(datin[0]);
        $.each(datos, function (index, columna) {

            $("#IdOelPaciente").val(columna.id_ficha_atencion);
			 $("#IdOelPaciente").attr("disabled",true)
            $("#fecha").val(columna.fecha);
            	  $("#IdOelEstado").val($("#" + variable).attr("estado"));
            $("#IdOelObservacion").val(columna.observacion);
            $("#IdOelMostarPaciente").val(columna.apellidos + " " + columna.nombres);
        });
    })


    $("input,textarea,select").attr("disabled", false);
    $("#IdOelCodigo").attr("disabled", true);
    $("#IdExamen").attr("disabled", false);
    $("#estado").attr("disabled", false);
    $("#IdValorNormalTipoExamen").attr("disabled", false);

    $("#IdOelPaciente").focus()

    $("#IdGrupoNuevo").attr("disabled", true);
    $("#IdUsuGrabar").attr("disabled", false);
    $("#IdGrupoCancelar").attr("disabled", false);
    $("#IdGrupoBuscar").attr("disabled", true);
    $("#IdGrupoEliminar").attr("disabled", false);
    $("#IdGrupoNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
    $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
    $("#IdGrupoCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
    $("#IdGrupoBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
    $("#IdGrupoEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
    CancelarBuscarTipoExamen()
    opcion = 2


}



function CancelarBuscarTurno2() {
    //delete $verificar;   
    $("#CuerpoOel").html("")
    $("#IdCuerpoPaciente2").html("")

    $("#DivBuscarPacientes2").hide();
    ventana = 0
    //LimpiarTurno();	
}

$(document).keydown(function (e) {
    if (e.keyCode == 13) {
        if ($("#IdOelPaciente").is(":focus")) {
            pruebas()

            return false;
        }


        if (ventana == 2) {

            if ($("#IdBusquedaOel").is(":focus")) {

                $("#IdBusquedaOel").blur();
                buscaroel()

            } else {

                if (can == 0) {
                    $("#IdBusquedaOel").focus()
                    return false
                } else {
                    ordenasignar2()
                    return false
                }
            }
        }


        if (ventana == 1) {
            if ($("#IdBusquedaDIA2xd").is(":focus")) {
                $("#IdBusquedaDIA2xd").blur();
                buscarcie102()

            } else {

                if (can == 0) {
                    $("#IdBusquedaDIA2xd").focus()
                    return false
                } else {
                    $("#IdOelPaciente").val($("#" + variable).attr("idficha"));
                    $("#IdOelMostarPaciente").val($("#" + variable).attr("title"))
                    $("#IdOelPaciente").focus()
                    CancelarBuscarTurno2()
                    return false
                }
            }
        }

        return true
    }

    if (e.keyCode == 40) {
        if (ventana == 1 || ventana == 2) {

            var $num_fila = variable;
            //alert($num_fila)
            var $tr = $num_fila + 1;
            $can = can;
            if ($num_fila < $can) {
                $("#" + $num_fila).css({
                    background: "#FFFFFF"
                });
                $("#" + $tr).css({
                    background: "#c5dbec"
                });
                variable = $tr;
            }
            return false
        }

    }
    if (e.keyCode == 38) {
        if (ventana == 1 || ventana == 2) {

            var $num_fila = variable;
            //alert($num_fila)
            var $tr = $num_fila - 1;
            if ($num_fila > 1) {
                $("#" + $num_fila).css({
                    background: "#FFFFFF"
                });
                $("#" + $tr).css({
                    background: "#c5dbec"
                });
                variable = $tr;
            }
            return false
        }

    }
})