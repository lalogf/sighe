$(function() {
	
	$('#tabla').fixheadertable({ 
							//caption : "", 
			 				colratio : [50,180,140,140,140,90,30,100], 
							height : 220, 
							width :900, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
	
	 var idficha=0
	var frecuencia =""
	var diapro=""
	var CodigoAsignacion=0
	var codigo_fila=0
	var can=0
	dias()
	cboturnos()
	$('input[name=checktodos]').attr('checked',false)
	 
	$("input[name=checktodos]").change(function(){
		$('input[type=checkbox]').each( function() {			
			if($("input[name=checktodos]:checked").length == 1){
				
				this.checked = true;
				InsertarB(1,$(this).attr('idficha'),$(this).attr('frecuencia'),$(this).attr('diaprogramado'))
			} else {
				this.checked = false;
					InsertarB(0,$(this).attr('idficha'),$(this).attr('frecuencia'),$(this).attr('diaprogramado'))
			}
		});
	});
	
 
 
});


function imprimir(){
	  var fecha =$("#fecha").val().substring(8,10)+"/"+$("#fecha").val().substring(5,7)+"/"+$("#fecha").val().substring(0,4)
	 //alert($("#fecha").val())
	 dia1=1
	 dia2=dia_semana(fecha,1)	
	 //alert(dia1+"-"+dia2)
	  fecha_calcu=new Date($("#fecha").val().substring(0,4),$("#fecha").val().substring(5,7),$("#fecha").val().substring(8,10))
	  
	 $.post('CONTROLADOR/Casignar.php', {
        accion: 'fecha',fecha:$("#fecha").val().substring(5,7)+"/"+$("#fecha").val().substring(8,10)+"/"+$("#fecha").val().substring(0,4),
		dias: dia1-dia2
    }, function (data) {
		 
 window.open("imprimirturnos.php?id_modulo=1&fecha="+data)
 return false;
 	})
	return false;
	
	
	}

function limpiar(){
	if (!(confirm("desea reestablecer"))) return false;
	 if($("#dia").val()==""||$("#fecha").val()==""||$("#cboturno").val()=="" ){; return false;}
	 $.post('CONTROLADOR/Casignar.php', {
		    accion: 'LIMPIAR',
			fecha : $("#fecha").val(),
			turno : $("#cboturno").val()
        }, function (data) {
			cargarLista()
		})
	 
	}
function repro(){
	 if($("#dia").val()==""||$("#fecha").val()==""||$("#cboturno").val()=="" ){; return false;}
	 $.post('CONTROLADOR/Casignar.php', {
		    accion: 'INSERTARC',
			turnotext: $("#cboturno option:selected").text(),
			turnotext2: $("#cboturno2 option:selected").text(),
			frecuencia:frecuencia,
			diaprogramado:diapro,
			fechare:$("#fecha2").val(),
			turnore:$("#cboturno2").val(),
			diare:$("#dia2").val(), 
			diare2:$("#dia2 option:selected").text(), 
		 	obs:"Reprogramando", 
			id_ficha_atencion:idficha,
			fecha : $("#fecha").val(),
			turno : $("#cboturno").val()
        }, function (data) {
			 
			if(data=="5"){alert("El paciente tiene registrado esa fecha");return false}
			 if(data=="4"){alert("No se puede editar");return false}
			if(data=="2"){
				 alert("Debe elejir otro turno o fecha")
				return false
				}
				if(data=="3"){
				 alert("El paciente Ya esta en ese turno")
				return false
				}
			cargarLista()
			 
			 
			
		})
	 
	}
function Reprogramar(idfichaz,frecuenciaz,diaproz,turnot,fechat){
	   idficha=idfichaz
	  frecuencia =frecuenciaz
	  diapro=diaproz
	$("#DivRep").show();
	 
	if(turnot){
		$("#fecha2").val(fechat)
	$("#fecha2").focus()
	$("#cboturno2").val(turnot)
		}else {
	$("#fecha2").val($("#fecha").val())
	$("#fecha2").focus()
	$("#cboturno2").val($("#cboturno").val())
	}
	
	dias2()
	 
	// $("#hab *").disable(); 
	}
	
function salir(){
	$("#DivRep").hide();
	 $("#hab *").enable();
	}	


 function Eliminar(idficha,fecha,turno){
	 if($("#dia").val()==""||$("#fecha").val()==""||$("#cboturno").val()=="") return false;
	 
	 $.post('CONTROLADOR/Casignar.php', {
		    accion: 'ELIMINAR',
		    id_ficha_atencion:idficha,
			fecha : fecha,
			turno :turno
        }, function (data) {
			 
			 cargarLista()
		})	 
	 }
	 
	 
 function InsertarB(estado,idficha,frecuencia,diapro){
	 if($("#dia").val()==""||$("#fecha").val()==""||$("#cboturno").val()==""||$("#idficha").val()==""||$("#idficha").val()==0
	  ) return false;
	 
	 $.post('CONTROLADOR/Casignar.php', {
		    accion: 'INSERTARB',
			turnotext: $("#cboturno option:selected").text(),
			frecuencia:frecuencia,
			diaprogramado:diapro,
			estado:estado,
			obs:"Cambio de Estado",
			id_ficha_atencion:idficha,
			fecha : $("#fecha").val(),
			turno : $("#cboturno").val()
        }, function (data) {
			
			//alert(data)
			  if(data=="2"){alert("No se puede editar");cargarLista()}
		})	 
	 }
	 
	 
 function InsertarA(idmodulo,idficha,frecuencia,diapro){
	 if($("#dia").val()==""||$("#fecha").val()==""||$("#cboturno").val()=="" ) return false;
	 
	 $.post('CONTROLADOR/Casignar.php', {
		    accion: 'INSERTARA',
			turnotext: $("#cboturno option:selected").text(),
			frecuencia:frecuencia,
			diaprogramado:diapro,
			idmodulo:idmodulo,
			obs:"Cambio de Modulo",
			id_ficha_atencion:idficha,
			fecha : $("#fecha").val(),
			turno : $("#cboturno").val()
        }, function (data) {
			 if(data=="2"){alert("No se puede editar");cargarLista()}
		})	 
	 }

function cargarLista(){
	 $("#tabla2").html("")
	if($("#dia").val()==""||$("#fecha").val()==""||$("#cboturno").val()=="" ) return false;
	 $.post('CONTROLADOR/Casignar.php', {
            accion: 'LISTAR',
			turnotext: $("#cboturno option:selected").text(),
			dia:$("#dia").val(),
			fecha : $("#fecha").val(),
			turno : $("#cboturno").val()
        }, function (data) {
			rese=data.split("‗‗‗")
			 $("#cadena").html(rese[1])
			 $("#tabla2").html(rese[0])
			 codigo_fila=1;
        })
	}

function PintarFila($codigo_fila, $tabla) {
    codigo_fila = $codigo_fila
    res()
    $("#" + $codigo_fila).css({
            background: "#c5dbec",
            cursor: "pointer"
        });
 

}


	 
	 function cboturnos() {
		  
		
    $.post('CONTROLADOR/Casignar.php', {
            accion: 'LISTARTURNOS'
        }, function (data) {
 
            $("#cboturno").append(data);
			 $("#cboturno2").append(data);
        })
}

function dias(){
 	var fecha =$("#fecha").val().substring(8,10)+"/"+$("#fecha").val().substring(5,7)+"/"+$("#fecha").val().substring(0,4)
	
	if($("#fecha").val()){ 
	$("#dia").val(dia_semana(fecha,0))
	 cargarLista()
	 }else {
		  
		$("#dia").val(0)	
		$("#cboturno").val(0)	
		$('input[name=checktodos]').attr('checked',false)
		$("#tabla2").html("")
		} 	
			 
		}
 
 
 function dias2(){
	 
 	var fecha =$("#fecha2").val().substring(8,10)+"/"+$("#fecha2").val().substring(5,7)+"/"+$("#fecha2").val().substring(0,4)
		
	if($("#fecha2").val()){
		 
	$("#dia2").val(dia_semana(fecha,0))

	 }else {
	 $("#dia2").val(0)	
		$("#cboturno2").val(0)	
	   
		} 	
			 
		}
function dia_semana(fecha,i){   
    fecha=fecha.split('/');  
    if(fecha.length!=3){  
         return null;  
    }  
    //Vector para calcular día de la semana de un año regular.  
    var regular =[0,3,3,6,1,4,6,2,5,0,3,5];   
    //Vector para calcular día de la semana de un año bisiesto.  
    var bisiesto=[0,3,4,0,2,5,0,3,6,1,4,6];   
    //Vector para hacer la traducción de resultado en día de la semana.  
	if(i==0){
    var semana=['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];}else {
		 var semana=[7, 1, 2, 3,4,5,6];
		}
	//Día especificado en la fecha recibida por parametro.  
    var dia=fecha[0];  
    //Módulo acumulado del mes especificado en la fecha recibida por parametro.  
    var mes=fecha[1]-1;  
    //Año especificado por la fecha recibida por parametros.  
    var anno=fecha[2];  
    //Comparación para saber si el año recibido es bisiesto.  
    if((anno % 4 == 0) && !(anno % 100 == 0 && anno % 400 != 0))  
        mes=bisiesto[mes];  
    else  
        mes=regular[mes];  
    //Se retorna el resultado del calculo del día de la semana.  
    return semana[Math.ceil(Math.ceil(Math.ceil((anno-1)%7)+Math.ceil((Math.floor((anno-1)/4)-Math.floor((3*(Math.floor((anno-1)/100)+1))/4))%7)+mes+dia%7)%7)];  
}
function padStr(i) {
    return (i < 10) ? "0" + i : "" + i;
}


 $(document).keydown(function (e) {
 if (e.keyCode == 40) {
 

            var num_fila = a_entero(codigo_fila);
            var tr = num_fila + 1;

            if (num_fila < can) {
                $('#' + num_fila).css({
                        background: '#FFFFFF'
                    });
                PintarFila(tr, 'tabla')
               
            }

            return false
        }
        if (e.keyCode == 38) {
			 
            var num_fila = a_entero(codigo_fila);
            var tr = num_fila - 1;

            if (num_fila > 1) {
                $('#' + num_fila).css({
                        background: '#FFFFFF'
                    });

                PintarFila(tr, 'tabla')
                
            }
            return false
        }
 })
 
 $.fn.disable = function() {
    return this.each(function() {          
      if (typeof this.disabled != "undefined") {
        $(this).data('jquery.disabled', this.disabled);

        this.disabled = true;
      }
    });
};

$.fn.enable = function() {
    return this.each(function() {
      if (typeof this.disabled != "undefined") {
        this.disabled = $(this).data('jquery.disabled');
      }
    });
};


 function fecDia2(){
	 
	 $("#fecha2").attr("disabled",true)
	 var fecha =$("#fecha2").val().substring(8,10)+"/"+$("#fecha2").val().substring(5,7)+"/"+$("#fecha2").val().substring(0,4)
	 //alert($("#fecha").val())
	 dia1=$("#dia2 option:selected").attr("dia")
	 dia2=dia_semana(fecha,1)	
	 //alert(dia1+"-"+dia2)
	  fecha_calcu=new Date($("#fecha2").val().substring(0,4),$("#fecha2").val().substring(5,7),$("#fecha2").val().substring(8,10))
	  
	 $.post('CONTROLADOR/Casignar.php', {
        accion: 'fecha',fecha:$("#fecha2").val().substring(5,7)+"/"+$("#fecha2").val().substring(8,10)+"/"+$("#fecha2").val().substring(0,4),
		dias: dia1-dia2
    }, function (data) {
		$("#fecha2").val(data) 
		$("#fecha2").attr("disabled",false)
	 
 	})
	  
	 }
	 

 function fecDia(){
	 
	 $("#fecha").attr("disabled",true)
	 var fecha =$("#fecha").val().substring(8,10)+"/"+$("#fecha").val().substring(5,7)+"/"+$("#fecha").val().substring(0,4)
	 //alert($("#fecha").val())
	 dia1=$("#dia option:selected").attr("dia")
	 dia2=dia_semana(fecha,1)	
	 //alert(dia1+"-"+dia2)
	  fecha_calcu=new Date($("#fecha").val().substring(0,4),$("#fecha").val().substring(5,7),$("#fecha").val().substring(8,10))
	  
	 $.post('CONTROLADOR/Casignar.php', {
        accion: 'fecha',fecha:$("#fecha").val().substring(5,7)+"/"+$("#fecha").val().substring(8,10)+"/"+$("#fecha").val().substring(0,4),
		dias: dia1-dia2
    }, function (data) {
		$("#fecha").val(data) 
		$("#fecha").attr("disabled",false)
		cargarLista()
 	})
	  
	 }
	 
	 function a_entero(valor){  
   //intento convertir a entero.  
   //si era un entero no le afecta, si no lo era lo intenta convertir  
   valor = parseInt(valor);  
  
    //comprobamos si es un valor entero  
    if (isNaN(valor)) {  
          //no es entero 0  
          return 0;  
    }else{  
          //es un valor entero  
          return valor;  
    }  
} 


