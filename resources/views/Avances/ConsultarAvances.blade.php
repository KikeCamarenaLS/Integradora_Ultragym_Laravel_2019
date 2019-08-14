@extends('template.header')


@section('content_header')
<h4 class="page-title">Avances</h4>

@stop


@section('content')


<body onload="">
<div class="row"><!-- Inicio ROW-->
	<div class="col-md-12"><!-- Inicio de columna de row -->
		<div class="card"><!-- inicio de cuerpo card -->
			<!-- Cabecera titulo -->
			<div class="card-header">
				<div class="card-title">Consultar Avances</div>

			</div><!-- fin cabecera   -->
			<div class="card-body">
				<center>
					<div class="col-md-4">
						<label>Nombre(s)</label>
						<input required="" type="text" class="form-control success" id="NombreB" name="NombreB" placeholder="Nombre(s)" onkeypress="buscar()" onkeyup="buscar()">
					</div>
				</center>
					<br>
				<div id="tabla" name="tabla">
					
				</div>
				<div id="tabla2" name="tabla2">
					
				</div>
			</div>

		</div><!-- Fin de cuerpo de card -->
	</div><!-- fin columna card -->


</div><!-- Fin ROW-->


@endsection

@section('jscustom')
<script type="text/javascript">


function buscar(){
		document.getElementById('tabla').style.display = 'block';
        var Nombre= document.getElementById('NombreB').value;
        //alert("{{url('/Consulta/Personal')}}/"+Bienes+"/"+Marcas);

        $.get("{{url('/Consulta/Cliente')}}/"+Nombre, function(data){
          if (data == "No hay datos") {
            html="";
            mensaje("warning","Sin resultados");

          }else{ 

          var html = '<table class="table" >'
                    +' <thead class="bg-info" style=" overflow: 0;" ><tr>'
                    +'<th scope="col" style="color:white;">Nombre</th>'
                    +'<th scope="col" style="color:white;">Email</th>'
                    +'<th scope="col" style="color:white;">Direccion</th>'
                    +'<th scope="col" style="color:white;">Telefono</th>'
                    +'<th scope="col" style="color:white;">Generar</th>'
                    +'</tr></thead>'
                    +'<tbody style=" overflow: auto;">';
          for(i=0; i<data.length; i++) {
             var nombre="'"+data[i].Nombre+' '+data[i].A_paterno+' '+data[i].A_materno+"'";
          html+='<tr>'+
                      '<th scope="row">'+data[i].Nombre+" "+data[i].A_paterno+" "+data[i].A_materno+'</th>'+
                      '<th scope="row">'+data[i].Correo+'</th>'+
                      '<th scope="row">'+data[i].Direccion+'</th>'+
                      '<th scope="row">'+data[i].Telefono+'</th>'+
                      '<th><button onclick="Generar('+data[i].Id_persona+','+nombre+');" class="btn btn-success" value="Registrar">Generar</button></th>'
                      '</tr> ';
          }
          html+="</tbody></table>";
         
        }
        $('#tabla').html(html);
        });


}
function Generar(id,nomb){

	$.get("{{url('/Consulta/Avances')}}/"+id, function(data){
          if (data == "No hay datos") {
            html="";
            mensaje("warning","Sin resultados");

          }else{ 

          var html = '<table class="table" >'
                    +' <thead class="bg-info" style=" overflow: 0;" ><tr>'
                    +'<th scope="col" style="color:white;">Nombre</th>'
                    +'<th scope="col" style="color:white;">Peso</th>'
                    +'<th scope="col" style="color:white;">Altura</th>'
                    +'<th scope="col" style="color:white;">IMC</th>'
                    +'<th scope="col" style="color:white;">% de grasa en los brazos</th>'
                    +'<th scope="col" style="color:white;">% de grasa en el abdomen</th>'
                    +'<th scope="col" style="color:white;">% de grasa en las piernas</th>'
                    +'<th scope="col" style="color:white;">Fecha</th>'
                    +'</tr></thead>'
                    +'<tbody style=" overflow: auto;">';
          for(i=0; i<data.length; i++) {
          html+='<tr>'+
                      '<th scope="row">'+nomb+'</th>'+
                      '<th scope="row">'+data[i].Peso+'</th>'+
                      '<th scope="row">'+data[i].Altura+'</th>'+
                      '<th scope="row">'+data[i].IMC+'</th>'+
                      '<th scope="row">'+data[i].pgb+'</th>'+
                      '<th scope="row">'+data[i].pga+'</th>'+
                      '<th scope="row">'+data[i].pgp+'</th>'+
                      '<th scope="row">'+data[i].Fecha+'</th>'+
                      '</tr> ';
          }
          html+="</tbody></table>";
         
        }
        $('#tabla2').html(html);
        });


}


	function mensaje(color,mensaje){
		if(mensaje=="sin_mensaje"){

		}else{
			var placementFrom = $('#notify_placement_from option:selected').val();
			var placementAlign = $('#notify_placement_align option:selected').val();
			var state =color;
			var style = $('#notify_style option:selected').val();
			var content = {};

			content.message = mensaje;
			content.title = 'Nuevo Personal';
			if (color == "danger") {
				content.icon = 'la la-close';
			} else {
				content.icon = 'la la-check';
			}
			content.url = 'index.html';
			content.target = '_blank';

			$.notify(content,{
				type: state,
				placement: {
					from: placementFrom,
					align: placementAlign
				},
				time: 1000,
			});
		}
		
	}
	
</script>
@endsection