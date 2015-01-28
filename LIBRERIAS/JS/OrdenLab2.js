 var idficha=3; /*--------xd---------*/
var variable=0;
var variable2=0;
var variable3=0;
var idhemodialisis=0;
var can=0
var can2=0
 var can4=0
var ventana=0;
var ventana2=0
 $(document).ready(function () {
	  //buscaroel(idficha)
	  //buscaroel2(idhemodialisis)
	    //buscaroel2(idhemodialisis)
	  $('#IdTablaMedicamento2').fixheadertable({
        //caption : "", 

        colratio: [50, 300,200, 50, 50],
        height: 190,
        width: 665,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,

        resizeCol: true
    });
	  $('#IdTablaMedicamento').fixheadertable({
        //caption : "", 

        colratio: [90, 300, 90, 100],
        height: 225,
        width: 665,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,

        resizeCol: true
    });
 $('#IdTablaOel').fixheadertable({
        //caption : "", 

        colratio: [90, 90, 300, 100],
        height: 190,
        width: 665,
        zebra: true,
        sortable: false,
        sortedColId: 3,
        dateFormat: 'm/d/Y',
        pager: false,

        resizeCol: true
    });
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
	
	  });
 function PintarFila2($num_fila, $tabla) {

    $("#"+$tabla+" tr").css({
        background: "#FFFFFF"
    });

    $("#"+ $num_fila).css({
        background: "#c5dbec",
        cursor: "pointer"
    });
    idexamen = $("#" + $num_fila).attr("idexamen")
    variable = $num_fila.substr(1);
	 
}


 function PintarFila4($num_fila, $tabla) {

    $("#"+$tabla+" tr").css({
        background: "#FFFFFF"
    });

    $("#"+ $num_fila).css({
        background: "#c5dbec",
        cursor: "pointer"
    });
    idexamen = $("#" + $num_fila).attr("idexamen")
    variable3 = $num_fila.substr(1);
	 
}


 function PintarFila3($num_fila, $tabla) {

    $("#"+$tabla+" tr").css({
        background: "#FFFFFF"
    });

    $("#"+ $num_fila).css({
        background: "#c5dbec",
        cursor: "pointer"
    });
    idexamen = $("#" + $num_fila).attr("idexamen")
    variable2 = $num_fila.substr(1);
	 
}

	
 function mostrarbusmed(){
	 ventana2=1
	 $("#DivBuscarPacientes2").show("slow")
	 variable3=0
	   $("#CuerpoMedicamento2").html("");
	   $("#IdBusquedaDIA2").val("")
	 $("#IdBusquedaDIA2").focus()
	 }

	 

 function buscarmedicamentos(idprogramacion) {
	 
  variable2=0
   
    $.post('CONTROLADOR/Corden.php', {
        accion: 'LISTARMEDICAMENTOS',
        buscar: idprogramacion

    }, function (data) {
		var $data = data.split("///");
        $("#CuerpoMedicamento").html($data[1]);
        can4 = $data[0]
        variable = 1
       PintarFila3("D1","IdTablaMedicamento")
        if ($data[0] == 0) {
            $("#CuerpoMedicamento").html("<tr><td colspan='2'>No Hay Lista de Medicamentos ..</td></tr>");
            return;
        }
    })
}



 function buscaroel(idficha) {
  variable=0
   
    $.post('CONTROLADOR/Corden.php', {
        accion: 'LISTARORDEN2',
        buscar: idficha

    }, function (data) {
        var $data = data.split("///");
        $("#CuerpoOel").html($data[1]);
        can = $data[0]
        variable = 1
       PintarFila2("C1","IdTablaOel")
        if ($data[0] == 0) {
            $("#CuerpoOel").html("<tr><td colspan='2'>No Hay Examenes de Laboratorio ..</td></tr>");
            return;
        }
    })
}

function BuscarTipoExamenxd(){
	    $("#IdOelCodigo").val($("#C" + variable).attr("idexamen"));
     var id = $("#C"+variable).attr("idexamen")
	 $.post('CONTROLADOR/Corden.php', {
        accion: 'LLENAR_FORM',
        idusuario: id 
    }, function (data) {
        datin = data.split("╚╚╚")

        $("#CuerpoOel2").html(datin[1])
		$("#tablitaex input").attr("disabled",true)
		  $("input[type='text'],textarea").css({
            "background-color": "#98CBCB"
        });
        var datos = eval(datin[0]);
        $.each(datos, function (index, columna) {
		
            $("#IdOelPaciente").val(columna.id_ficha_atencion);
            $("#fecha").val(columna.fecha);
              $("#estadoooo").val($("#C" + variable).attr("estado"));
            $("#IdOelObservacion").val(columna.observacion);
            $("#IdOelMostarPaciente").val(columna.apellidos + " " + columna.nombres);
        });
		$("#Mostrar").show("slow");
    })
	
	
	}

function CancelarBuscarTurno2() {
    //delete $verificar;  
	// $(document).off("keydown") 
    $("#DivBuscarPacientes2").hide();
    ventana2  = 0
	can2=0
    //LimpiarTurno();	
	 
}
 function quitamed(){
	 $("#D"+variable2).remove();
	 
	 }
 
 function grabarmedicamentos(){
	 var str1=$("#formmedicamentos").serialize();
	 var str2= "&accion=GRABARMEDICAMENTOS&" +"idprogramacion="+$("#IdProgramacionHemo").val();
	 //alert(str1+str2)
	 
	  $.ajax({
            url: 'CONTROLADOR/Corden.php',
            type: 'POST',
            data: str1 + str2,
            success: function (data) { alert("Datos Grabados Correctamente ..");}               
       });     
        
		
		
	 
	 }

function SalirTipoExamen(){
	ventana = 0
    //$("#CuerpoOel2").html("")
	 
    $("#Mostrar").hide("slow");
 
	
	}
	 
function buscarcie102() {
 
	var textcie10 = $("#IdBusquedaDIA2").val()
    if (textcie10 == "") return false;
    $.post('CONTROLADOR/Corden.php', {
        accion: 'LISTARMEDICAMENTOS2',
        buscar: textcie10

    }, function (data) {
		var $data = data.split("///");
		 
		 can2= $data[0]
		  $("#CuerpoMedicamento2").html($data[1]);
  
       PintarFila4("E1","IdTablaMedicamento2")
        if ($data[0] == 0) {
            $("#CuerpoMedicamento2").html("<tr><td colspan='2'>No Hay Lista de Medicamentos ..</td></tr>");
            return;
        }
    })
}


 
 function seleccionar(){
	 var a = $("#D" + variable3).length
	 if(a==0){
		 var id= $("#E" + variable3).attr("idmedicamento")
	    var id2= $("#E" + variable3).attr("medicamento")
		var id3=  $("#E" + variable3).attr("unidad")
		var id4=  $("#E" + variable3).attr("codigo")
		 
		if(can4==0){$("#CuerpoMedicamento").html("<tr idexamen='"+id+"' align='center'   id='D"+id+"'   style='cursor:pointer'   onclick=\"javascript:PintarFila3('D"+id+"','IdTablaMedicamento')\"  >    <td>"+id4+"</td> 				<td>"+id2+"</td> <td><input name='MED"+id+"' id='MED"+id+"' value='0' onkeypress='return validar2(event,2)' ></td>		  <td>"+id3+"</td>  </tr>")}else {
		 $("#CuerpoMedicamento").append("<tr idexamen='"+id+"' align='center'   id='D"+id+"'   style='cursor:pointer'   onclick=\"javascript:PintarFila3('D"+id+"','IdTablaMedicamento')\"  >    <td>"+id4+"</td> 				<td>"+id2+"</td> <td><input name='MED"+id+"' id='MED"+id+"' value='0' onkeypress='return validar2(event,2)' ></td>		  <td>"+id3+"</td>  </tr>")}
		 can4=can4+1
		 
		 }
		 CancelarBuscarTurno2()
	 
	 }
 
 $(document).keydown(function (e) {
 	 if (e.keyCode == 13) {
		if(ventana2==1){
			 
        		  if ($("#IdBusquedaDIA2").is(":focus")) {
					   buscarcie102()
                $("#IdBusquedaDIA2").blur();
               
            } else {
                if (can2 == 0) {
                    $("#IdBusquedaDIA2").focus()
                } else {

                   seleccionar()
                    return false


                }

            }
			 } }

        })