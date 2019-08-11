@extends('template.header')


@section('content_header')
<h4 class="page-title">Cliente</h4>

@stop


@section('content')


<body onload="buscar();mensaje('{{$color}}','{{$mensaje}}');">
<div class="row"><!-- Inicio ROW-->
	<div class="col-md-12"><!-- Inicio de columna de row -->
		<div class="card"><!-- inicio de cuerpo card -->
			<!-- Cabecera titulo -->
			<div class="card-header">
				<div class="card-title">Modificar Cliente</div>

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
			</div>

		</div><!-- Fin de cuerpo de card -->
	</div><!-- fin columna card -->


</div><!-- Fin ROW-->


@endsection

@section('jscustom')
<script type="text/javascript">

	function limpiar(){
		document.getElementById('Nombre').value="";
		document.getElementById('Apellido_Paterno').value="";
		document.getElementById('Apellido_Materno').value="";
		document.getElementById('Direccion').value="";
		document.getElementById('Correo_Personal').value="";
		document.getElementById('Telefono').value="";
		document.getElementById('NombreB').value="";
		document.getElementById('modi').style.display = 'none';
		document.getElementById('NombreB').disabled = '';

	}

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
                    +'<th scope="col" style="color:white;">Eliminar</th>'
                    +'<th scope="col" style="color:white;">Editar</th></tr></thead>'
                    +'<tbody style=" overflow: auto;">';
          for(i=0; i<data.length; i++) {
             var nombre="'"+data[i].Nombre+"'";
             var ap="'"+data[i].A_paterno+"'";
             var am="'"+data[i].A_materno+"'";
             var ema="'"+data[i].Correo+"'";
             var dire="'"+data[i].Direccion+"'";
             var tel="'"+data[i].Telefono+"'";
          html+='<tr>'+
                      '<th scope="row">'+data[i].Nombre+" "+data[i].A_paterno+" "+data[i].A_materno+'</th>'+
                      '<th scope="row">'+data[i].Correo+'</th>'+
                      '<th scope="row">'+data[i].Direccion+'</th>'+
                      '<th scope="row">'+data[i].Telefono+'</th>'+
                      '</tr> ';
          }
          html+="</tbody></table>";
         
        }
        $('#tabla').html(html);
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