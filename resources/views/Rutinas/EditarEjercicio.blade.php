@extends('template.header')


@section('content_header')
<h4 class="page-title">Paquetes</h4>

@stop


@section('content')


<body onload="comboRutina()">
	<div class="row"><!-- Inicio ROW-->
		<div class="col-md-12"><!-- Inicio de columna de row -->
			<div class="card"><!-- inicio de cuerpo card -->
				<!-- Cabecera titulo -->
				<div class="card-header">
					<div class="card-title">Editar Ejercicios</div>

				</div><!-- fin cabecera   -->
				<div class="card-body">	
					<div class="form-group row " >
						<div class="col-md-12">
							<center><div class="col-md-6" id="pintarCombo"></div></center>	
						</div>	
						<div class="col-md-12" id="pintarResultado"></div>		

					</div>
				</div><!-- fin cabecera   -->
			</div><!-- Fin de cuerpo de card -->
		</div><!-- fin columna card -->
	</div><!-- Fin ROW-->


	@endsection

	@section('jscustom')
	<script type="text/javascript">
		function comboRutina(){
			$.get("{{url('/cargar/combo/Rutinas')}}", function(data){ 
				var html='<label>Rutinas</label><select id="comboRutina" onchange="cargarEjercicios()" class="form-control">';
				
				html+='<option value="Selecciona una Rutina">Selecciona una Rutina</option>';
				for ( i = 0; i < data.length; i++) {
					html+='<option value="'+data[i].nombre_rutina+'">'+data[i].nombre_rutina+'</option>';
				}
				html+='</select>';

				$('#pintarCombo').html(html);
			});
		}
		function cargarEjercicios(){
			var seleccionado=document.getElementById('comboRutina').value;
			if(seleccionado=='Selecciona una Rutina'){
				mensaje('danger','Selecciona una Rutina');
				$('#pintarResultado').html("");
			}else{
				$.get("{{url('/pintar/resultado/combo/Rutinas')}}/"+seleccionado, function(data){ 
					         var html='<br><br><div class="container" >'+
'<div class="row justify-content-center" 	>';
				
          for(i=0; i<data.length; i++) {
          		var Nombre_Ejercicio="'"+data[i].Nombre_Ejercicio+"'";
				var Imagen="'"+data[i].Imagen+"'";
				var Serie="'"+data[i].Serie+"'";
				var Repeticiones="'"+data[i].Repeticiones+"'";
				var Descripcion="'"+data[i].Descripcion+"'";
          	html+='<div class="col-md-4 ">'+
						'<div class="card card-pricing card-pricing-focus card-primary">'+
							'<div class="card-header">'+
								'<h4 class="card-title">'+data[i].Nombre_Ejercicio+'</h4>'+
								'<div class="card-price">'+
									'<img class="card-img-top" src="images/FotosRutinas/'+data[i].Imagen+'" alt="Card image cap" style=" height: 220px; width: 20rem;  ">'+
								'</div>'+
							'</div>';
          	
          html+='<div class="card-body">'+
									'<ul class="specification-list">'+
										'<li>'+
											'<span class="name-specification">Serie</span>'+
											'<span class="status-specification">'+data[i].Serie+'</span>'+
										'</li>'+
										'<li>'+
											'<span class="name-specification">Repeticiones</span>'+
											'<span class="status-specification">'+data[i].Repeticiones+'</span>'+
										'</li>'+'<li>'+
											'<span class="name-specification">Descripcion</span>'+
											'<span class="status-specification">'+data[i].Descripcion+'</span>'+
										'</li>'+
									'</ul><br><a href="#" class="btn btn-success" data-toggle="modal" onclick="editarEjercicio('+Nombre_Ejercicio+','+Imagen+','+Serie+','+Repeticiones+','+Descripcion+')" data-target="#miModalPEs">Editar</a>'+
								'</div>'+
							/*	'<div class="card-footer">'+
									'<button class="btn btn-light btn-block"><b>Get Started</b></button>'+
								'</div>'+*/
							'</div></div>';
          }
          html+='</div>'+
		'</div></div>';
					$('#pintarResultado').html(html);
				});
			}
		}

		function editarEjercicio(Nombre_Ejercicio,Imagen,Serie,Repeticiones,Descripcion){
			var html='<div class="form-group row " >'+
						'<div class="col-md-4" >'+
								'<label>Rutina <span class="required-label">*</span></label>'+
								'<input  type="text" class="form-control success" id="Rutina" name="Rutina" disabled value="'+Nombre_Ejercicio+'" placeholder="Rutina" >'+
								
								'</div>'+
							'<div class="col-md-4">'+
								'<label>Series<span class="required-label">*</span></label>'+
								'<input required="" type="Number" class="form-control" id="Serie" name="Serie" value="'+Serie+'" placeholder="Serie" >'+
							'</div>'+
							'<div class="col-md-4">'+
								'<label>Repeticiones<span class="required-label">*</span></label>'+
								'<input required="" type="Number" class="form-control" id="Repeticion" value="'+Repeticiones+'" name="Repeticion" placeholder="Repeticiones" >'+
							'</div>'+
						'</div>'+
					'<div class="form-group row " >'+
							'<div class="col-md-6">'+
								'<label>Descripcion<span class="required-label">*</span></label>'+
								'<textarea class="form-control" id="Descripcion" name="Descripcion" value="'+Descripcion+'"  placeholder="Descripcion" ></textarea>'+
							'</div>'+
							'<div class="col-md-6">'+
								'<div class="input-file input-file-image">'+
									'<img class="img-upload-preview" width="150" src="http://integradora_ultragym_laravel_2019.test/images/FotosRutinas/'+Imagen+'" alt="preview">'+
									'<input type="file" class="form-control form-control-file" id="uploadImg2" name="uploadImg2" accept="image/jpeg" required="">'+
									'<label for="uploadImg2" class=" label-input-file btn btn-icon btn-default btn-round btn-lg"><i class="la la-file-image-o"></i> Cargar una Imagen</label>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div><!-- fin cabecera   -->'+
					'<div class="card-footer">	'+
						'<div class="form-group row " >'+
							'<div class="col-md-12">'+
								'<center><input  type="submit" class="btn btn-success" id="Repeticiones" name="Repeticiones" value="Actualizar"  >'+
								'</center>'+
							'</div>'+
						'</div>'+
					'</div';
					
					$('#pintarResultado').html(html);
					$('#comboRutina').attr("disabled",true);


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