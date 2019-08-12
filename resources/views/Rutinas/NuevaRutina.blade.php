@extends('template.header')


@section('content_header')
<h4 class="page-title">Rutina</h4>

@stop


@section('content')


<body onload="mensaje('{{$color}}','{{$mensaje}}')">
	<div class="row"><!-- Inicio ROW-->
		<div class="col-md-12"><!-- Inicio de columna de row -->
			<div class="card"><!-- inicio de cuerpo card -->
				<!-- Cabecera titulo -->
				<div class="card-header">
					<div class="card-title">Nueva Rutina</div>

				</div><!-- fin cabecera   -->

				
				<div class="card-body">	

						<div class="form-group row " >
						<div class="col-md-6">
							<label>Nombre de la Rutina </label>
							<input  type="text" required="" class="form-control success" id="Nombre_Rutina" name="Nombre_Rutina" placeholder="Nombre de la rutina">
						</div>
						<div class="col-md-6">
							<label>Nombre del ejercicio </label>
							<input  type="text" class="form-control success" id="caja" name="caja" placeholder="Buscar el Ejercicio" onkeyup="buscar()">
						</div>
					</div>
						
					<br>
					<div class="row"><!-- Inicio ROW-->
						<div class="col-md-12" id="tabla">
						</div>
						<div class="col-md-12" id="Resultados">
						</div>
					</div><!-- Fin ROW-->
				</div><!-- Fin de cuerpo de card -->
			</div><!-- fin columna card -->
		</div><!-- Fin ROW-->


@endsection

@section('jscustom')
<script type="text/javascript">
	 var id=[];
	 var nom=[];
	 var ser=[];
	 var rep=[];
	function buscar(){
		var caja=document.getElementById('caja').value;

		$.get("{{url('/cargar/card/rutina')}}/"+caja, function(data){
			
			if(data.length!=0){
			 var html='<div class="container">'+
				'<div class="row justify-content-center">';
          for(i=0; i<data.length; i++) {
          	var id_ejercicio="'"+data[i].id_ejercicio+"'";
          	var nombre="'"+data[i].Nombre_Ejercicio+"'";
          	var Serie="'"+data[i].Serie+"'";
          	var repeticiones="'"+data[i].Repeticiones+"'";
          	html+='<div class="col clearfix col-md-4">'+
			'<div class="card shadow" style="width: 20rem;">'+
				'<div class="inner" style="overflow: hidden;">';
          	
          html+='<img class="card-img-top" src="images/FotosRutinas/'+data[i].Imagen+'" alt="Card image cap" style=" height: 220px; width: 20rem;  ">'+
				'</div><div class="card-body text-center">'+
					'<h5 class="card-title">'+data[i].Nombre_Ejercicio+'</h5>'+
					'<p class="card-text">'+data[i].Descripcion+'</p>'+
					'<p class="card-text"><b>Series: </b>'+data[i].Serie+'</p>'+
					'<p class="card-text"><b>Repeticiones: </b>'+data[i].Repeticiones+'</p>'+

					'<a href="#" class="btn btn-primary" data-toggle="modal" onclick="AgregarTabla('+id_ejercicio+','+nombre+','+Serie+','+repeticiones+')" data-target="#miModalPEs">Agregar a Rutina</a>'+
				'</div>'+
				'</div></div>';
          }
          html+='</div>'+
		'</div>';
		 $('#Resultados').html(html);
		 } else{
		 	mensaje('danger','No existen resultados');
		 $('#Resultados').html('');
		 }
      }); 


	}
	function AgregarTabla(ids,nombre,serie,repe){
		id.push(ids);
		nom.push(nombre);
		ser.push(serie);
		rep.push(repe);
		var html='<table class="table"> '+
			'<thead class="bg-info" style=" overflow: 0;">'+
				'<tr>'+
					'<th scope="col" style="color:white;">ID</th>'+
					'<th scope="col" style="color:white;">Ejercicio</th>'+
					'<th scope="col" style="color:white;">Serie</th>'+
					'<th scope="col" style="color:white;">Repeticiones</th>'+
				'</tr>'+
			'</thead>'+
			'<tbody style=" overflow: auto;">';
			for (var i = 0; id.length > i; i++) {
				html+='<tr>'+
					'<th scope="row">'+id[i]+'</th>'+
					'<th scope="row">'+nom[i]+'</th>'+
					'<th scope="row">'+ser[i]+'</th>'+
					'<th scope="row">'+rep[i]+'</th>'+
				'</tr> ';
				}
				html+='</tbody>'+
		'</table>';
		html+='<br><center><input type="submit" class="btn btn-primary" onclick="registrarRutina()"> </center><br><br>';

		 $('#Resultados').html('');
		 document.getElementById('caja').value="";
		 mensaje('success','Ejercicio agregado a la lista');
		 $('#tabla').html(html);
		}

	function registrarRutina(){
		var Nombre_Rutina = document.getElementById('Nombre_Rutina').value;
		for (var i = 0; i < rep.length; i++) {
			$.get("{{url('/agregar/rutina/lista')}}/"+id[i]+"/"+Nombre_Rutina, function(data){}); 
		}
		id.splice(0,rep.length);
		nom.splice(0,rep.length);
		ser.splice(0,rep.length);
		rep.splice(0,rep.length);
		 mensaje('success','Rutina registrada correctamente');
		 $('#Resultados').html('');
		 document.getElementById('caja').value="";
		 $('#tabla').html("");
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
			content.title = 'Nueva Ejercicio';
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














