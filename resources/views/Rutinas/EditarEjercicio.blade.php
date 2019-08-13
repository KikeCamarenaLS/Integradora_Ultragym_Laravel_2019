@extends('template.header')


@section('content_header')
<h4 class="page-title">Rutinas</h4>

@stop


@section('content')


<body onload="mensaje('{{$color}}','{{$mensaje}}')">
	<div class="row"><!-- Inicio ROW-->
		<div class="col-md-12"><!-- Inicio de columna de row -->
			<div class="card"><!-- inicio de cuerpo card -->
				<!-- Cabecera titulo -->
				<div class="card-header">
					<div class="card-title">Editar Ejercicio</div>

				</div><!-- fin cabecera   -->

				<form method="post" action="{{url('/RegistrarRutina')}}" enctype="multipart/form-data">
					{!! csrf_field() !!}
				<div class="card-body">		
					{{-- inicio del row --}}
					<div class="form-group row " >
						{{-- <div class="col-md-4 has-error has-feedback" > --}}
								
							<div class="col-md-4" >
								<label>Rutina <span class="required-label">*</span></label>
								<input  type="text" class="form-control success" id="Rutina" name="Rutina" placeholder="Rutina" >
								{{-- {{Form::text('Nombre',null,["class" => "form-control","placeholder" => "Nombre(s)","id" => "Nombre",])}} --}}
							</div>
							<div class="col-md-4">
								<label>Series<span class="required-label">*</span></label>
								<input required="" type="Number" class="form-control" id="Serie" name="Serie" placeholder="Serie" >
							</div>
							<div class="col-md-4">
								<label>Repeticiones<span class="required-label">*</span></label>
								<input required="" type="Number" class="form-control" id="Repeticion" name="Repeticion" placeholder="Repeticiones" >
							</div>
						</div>
					<div class="form-group row " >
							<div class="col-md-6">
								<label>Descripcion<span class="required-label">*</span></label>
								<textarea class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripcion" ></textarea>
							</div>
							<div class="col-md-6">
								<div class="input-file input-file-image">
									<img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
									<input type="file" class="form-control form-control-file" id="uploadImg2" name="uploadImg2" accept="image/jpeg" required="">
									<label for="uploadImg2" class=" label-input-file btn btn-icon btn-default btn-round btn-lg"><i class="la la-file-image-o"></i> Cargar una Imagen</label>
								</div>
							</div>
						</div>
						{{-- fin del row --}}


					</div><!-- fin cabecera   -->
					<div class="card-footer">	
						<div class="form-group row " >
							<div class="col-md-12">
								<center><input  type="submit" class="btn btn-success" id="Repeticiones" name="Repeticiones" value="Registrar"  >
								</center>
							</div>
						</div>
					</div>
					</div>

							</form>
				</div><!-- Fin de cuerpo de card -->
			</div><!-- fin columna card -->
		</div><!-- Fin ROW-->


@endsection

@section('jscustom')
<script type="text/javascript">


	function mensaje(color,mensaje){
		if(mensaje=="sin_mensaje"){
			
		}else{
			var placementFrom = $('#notify_placement_from option:selected').val();
			var placementAlign = $('#notify_placement_align option:selected').val();
			var state =color;
			var style = $('#notify_style option:selected').val();
			var content = {};

			content.message = mensaje;
			content.title = 'Nueva Rutina';
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