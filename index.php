<?php
    require_once("/xampp/htdocs/votos/view/head/head.php");
    
?>



<a href="view/candidato/create.php" class="btn btn-primary">Agregar nuevo candidato</a>

<br><br>
<script>

$(document).ready(function() {

    cargarCandidato();

    function limpiarCampos(){
            $("#nombre").val("");
            $("#alias").val("");
            $("#rut").val("");
            $("#correo").val("");
            $('#region').prop('selectedIndex',0);
            $('#comuna').prop('selectedIndex',0);
            $('#candidato').prop('selectedIndex',0);

    }

    function cargarCandidato(){
        $.ajax({
        url:'/view/votantes/llamarCandidato.php',
        type:'POST',
        }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="<option value=''>Seleccione...</option>";
        if(data.length>0){
            for (var i =0; i < data.length; i++) {
                cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#candidato").html(cadena);
            var region_id = $("#candidato").val();
        }else{
            cadena +="<option value=''>'NO SE ENCONTRARON REGISTROS'</option>";
            $("#candidato").html(cadena);

        }
    })
    }
    
    function cargarRegion(){
        $.ajax({
        url:'/view/votantes/llamarRegion.php',
        type:'POST',
        }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="<option value=''>Seleccione...</option>";
        if(data.length>0){
            for (var i =0; i < data.length; i++) {
                cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#region").html(cadena);
            var region_id = $("#region").val();
        }else{
            cadena +="<option value=''>'NO SE ENCONTRARON REGISTROS'</option>";
            $("#region").html(cadena);
            cargar_comunas(region_id);

        }
    })
    }


    cargarRegion();


    $("#region").change(function(){
            var region_id = $("#region").val();
            cargar_comunas(region_id);
    })

   function cargar_comunas(region_id)
    {
        console.log(region_id);
        $.ajax({
        url:'/view/votantes/llamarComuna.php',
        type:'POST',
        data:{
            region_id:region_id
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="<option value=''>Seleccione...</option>";
        if(data.length>0){
            for (var i =0; i < data.length; i++) {
                cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
                
            }
            $("#comuna").html(cadena);
          
        }else{
            cadena +="<option value=''>'NO SE ENCONTRARON REGISTROS'</option>";
            $("#comuna").html(cadena);
        }
    })
    }

    var Fn = {
	// Valida el rut con su cadena completa "XXXXXXXX-X"
	validaRut : function (rutCompleto) {
		rutCompleto = rutCompleto.replace("‐","-");
		if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
			return false;
		var tmp 	= rutCompleto.split('-');
		var digv	= tmp[1]; 
		var rut 	= tmp[0];
		if ( digv == 'K' ) digv = 'k' ;
		
		return (Fn.dv(rut) == digv );
	},
	dv : function(T){
		var M=0,S=1;
		for(;T;T=Math.floor(T/10))
			S=(S+T%10*(9-M++%6))%11;
		return S?S-1:'k';
	}
}


$( "#btnGuardar" ).on( "click", function() {

	if (Fn.validaRut( $("#rut").val() )){
        var rut = $("#rut").val();
        $.ajax({
        url:'/view/votantes/validarVoto.php',
        data:{
            rut:rut
        },
        type:'POST',
        }).done(function(resp){

            var data = JSON.parse(resp);

            if (data.rut  == undefined ) {
                let nombre = $("#nombre").val();
                let alias = $("#alias").val();
                let rut = $("#rut").val();
                let correo = $("#correo").val();
                let region = $("#region").val();
                let comuna = $("#comuna").val();
                let candidato = $("#candidato").val();

                $.ajax({
                    url:'/view/votantes/store.php',
                    data:{
                        nombre:nombre,
                        alias:alias,
                        rut:rut,
                        correo:correo,
                        region:region,
                        comuna:comuna,
                        candidato:candidato
                   },
                    type:'POST',
                    }).done(function(resp){
                        console.log(resp); 
                        limpiarCampos();     
                        alert("Datos guardados correctamente");              
                    })
            }
            else{
                alert("Usted ya votó");
                
            }
        
         })
	} else {
        alert("El rut no es  valido");
    	}
});
});
</script>
<h1 align="center">Formulario de Votación:</h1>


<form   method="POST" autocomplete="off">
    <div class="container">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre y Apellido </label>
            <input type="text" id="nombre" name="nombre" required class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Alias </label>
            <input type="text" id="alias" name="alias" required class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">RUT </label>
            <input type="text"  name="rut" required class="form-control" id="rut" placeholder="XXXXXXXX-X">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo </label>
            <input type="text" name="correo" required class="form-control" id="correo" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Region </label>
            <select class="form-select" id="region" aria-label="Default select example">         
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Comuna </label>
            <select class="form-select" id="comuna" aria-label="Default select example">         
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Candidato </label>
            <select class="form-select" id="candidato" aria-label="Default select example">         
            </select>
        </div>
     
      

      
        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
    </div>
</form>



<?php
    require_once("/xampp/htdocs/votos/view/head/footer.php");
?>