@extends('template.header')


@section('content_header')
<h4 class="page-title">Editar productos</h4>

@stop


@section('content')



<div class="row"><!-- Inicio ROW-->
	<div class="col-md-12"><!-- Inicio de columna de row -->
		<div class="card padding"><!-- inicio de cuerpo card -->
			<!-- Cabecera titulo -->
			<div class="card-header">
				<div class="card-title">Producto</div>

			</div><!-- fin cabecera   -->
			<div class="card-body">
				{{-- inicio del row --}}

				<!-- 
				<div id="app">
					<listado-usuarios></listado-usuarios>
				</div>
				<script src="{{ asset('js/app.js') }}"></script>
				-->
				@include('Productos.productoForm')

			</div><!-- fin cabecera   -->


		</div><!-- Fin de cuerpo de card -->
	</div><!-- fin columna card -->


</div><!-- Fin ROW-->


@endsection

@section('jscustom')

@endsection