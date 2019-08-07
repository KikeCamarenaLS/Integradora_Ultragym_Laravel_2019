@extends('template.header')


@section('content_header')
<h4 class="page-title">Paquetes</h4>

@stop


@section('content')


<body onload="CargarTabla()">
<div class="row"><!-- Inicio ROW-->
	<div class="col-md-12"><!-- Inicio de columna de row -->
		<div class="card"><!-- inicio de cuerpo card -->
			<!-- Cabecera titulo -->
			<div class="card-header">
				<div class="card-title">Consulta de Paquete</div>

			</div><!-- fin cabecera   -->
			<div class="card-body">		
				<div id="pintarTabla"></div>				
				</div>
			</div><!-- fin cabecera   -->
		</div><!-- Fin de cuerpo de card -->
	</div><!-- fin columna card -->
</div><!-- Fin ROW-->


@endsection

@section('jscustom')
<script type="text/javascript">
	function CargarTabla(){
		$.get("{{url('/cargar/card/rutina')}}", function(data){
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
          	
          html+='<img class="card-img-top" src="images/FotosPaquetes/'+data[i].Foto+'" alt="Card image cap" style=" height: 220px; width: 20rem;  ">'+
				'</div><div class="card-body text-center">'+
					'<h5 class="card-title">'+data[i].Paquete+'</h5>'+
					'<p class="card-text">'+data[i].Descripcion+'</p>'+
					'<p class="card-text"><b>Precio: $</b>'+data[i].Costo+'</p>'+

					'<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#miModalPEs">Ver mas...</a>'+
				'</div>'+
				'</div></div>';
          }
          html+='</div>'+
		'</div>';
          $('#pintarTabla').html(html);        
      });
	}
	
	
</script>
@endsection