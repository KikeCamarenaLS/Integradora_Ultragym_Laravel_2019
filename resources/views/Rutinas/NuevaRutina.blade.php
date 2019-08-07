@extends('template.header')


@section('content_header')
<h4 class="page-title">Paquetes</h4>

@stop


@section('content')


<body onload="mensaje('{{$color}}','{{$mensaje}}')">
	<div class="row"><!-- Inicio ROW-->
		<div class="col-md-12"><!-- Inicio de columna de row -->
			<div class="card"><!-- inicio de cuerpo card -->
				<!-- Cabecera titulo -->
				<div class="card-header">
					<div class="card-title">Nuevo Ejercicio</div>

				</div><!-- fin cabecera   -->

				
				<div class="card-body">	
					<center>
						<div class="col-md-6">
							<label>Nombre del ejercicio </label>
							<input  type="text" class="form-control success" id="caja" name="caja" placeholder="Nombre(s)" onkeyup="buscar()">
						</div>
					</center>
					<br>
					<div class="row"><!-- Inicio ROW-->
						<div class="col-md-12" id="Resultados"><!-- Inicio de columna de row -->
						</div><!-- fin columna card -->
					</div><!-- Fin ROW-->
				</div><!-- Fin de cuerpo de card -->
			</div><!-- fin columna card -->
		</div><!-- Fin ROW-->


@endsection

@section('jscustom')
<script type="text/javascript">

	function buscar(){
		var caja=document.getElementById('caja').value;

		$.get("{{url('/cargar/card/rutina')}}/"+caja, function(data){
			
			if(data.length!=0){
			 var html='<div class="container">'+
				'<div class="row justify-content-center">';
          for(i=0; i<data.length; i++) {
          	var id_paquete="'"+data[i].id_paquete+"'";
          	var paquete="'"+data[i].Paquete+"'";
          	var Descripcion="'"+data[i].Descripcion+"'";
          	var Costo="'"+data[i].Costo+"'";
          	html+='<div class="col clearfix col-md-4">'+
			'<div class="card shadow" style="width: 20rem;">'+
				'<div class="inner" style="overflow: hidden;">';
          	
          html+='<img class="card-img-top" src="images/FotosRutinas/'+data[i].Imagen+'" alt="Card image cap" style=" height: 220px; width: 20rem;  ">'+
				'</div><div class="card-body text-center">'+
					'<h5 class="card-title">'+data[i].Nombre_Rutina+'</h5>'+
					'<p class="card-text">'+data[i].Descripcion+'</p>'+
					'<p class="card-text"><b>Series: </b>'+data[i].Serie+'</p>'+
					'<p class="card-text"><b>Repeticiones: </b>'+data[i].Repeticiones+'</p>'+

					'<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#miModalPEs">Ver mas...</a>'+
				'</div>'+
				'</div></div>';
          }
          html+='</div>'+
		'</div>';
		 $('#Resultados').html(html);
		 } else{
		 	mensaje('danger','No existen resultados');

		 }
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














