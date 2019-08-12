@extends('template.header')


@section('content_header')
<h4 class="page-title">Cliente</h4>

@stop


@section('content')


<body onload="mensaje('{{$color}}','{{$mensaje}}');">
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


			<div class="card-body" id="modi" name="modi" style="display: none;">
				{{-- inicio del row --}}
				<div class="form-group row " >

					<div class="card-body">
						{{-- inicio del row --}}
						<div class="form-group row " >
							{{-- <div class="col-md-4 has-error has-feedback" > --}}
								<div class="col-md-4" hidden >
									<label>Nombre(s)</label>
									<input required="" type="text" class="form-control success" id="id" name="id" placeholder="id" >
								</div>
								<div class="col-md-4" >
									<label>Nombre(s)</label>
									<input required="" type="text" class="form-control success" id="Nombre" name="Nombre" placeholder="Nombre(s)" >
								</div>
								<div class="col-md-4">
									<label>Apellido Paterno</label>
									<input required="" type="text" class="form-control" id="Apellido_Paterno" name="Apellido_Paterno" placeholder="Apellido Paterno " >
								</div>
								<div class="col-md-4">
									<label>Apellido Materno</label>
									<input required="" type="text" class="form-control" id="Apellido_Materno" name="Apellido_Materno" placeholder="Apellido Materno">
								</div>
							</div>
							{{-- fin del row --}}
							{{-- inicio del row --}}
							<div class="form-group row " >
								<div class="col-md-12">
									<label>Direccion</label>
									<input required="" type="text" class="form-control" id="Direccion" name="Direccion" placeholder="Direccion " >
								</div>

							</div>
							{{-- fin del row --}}

							{{-- inicio del row --}}
							<div class="form-group row " >
								<div class="col-md-4">
									<label>Correo Personal<span class="required-label" style="display: none;" name="co" id="co"> Repetido</span></label>
									<input  type="email" class="form-control " id="Correo_Personal" name="Correo_Personal" placeholder="Correo Personal">
								</div>
								<div class="col-md-4">
									<label>Telefono</label>
									<input  type="number" name="Telefono" min="10000000"  class="form-control" id="Telefono" name="Telefono" placeholder="Telefono " >
								</div>

							</div>
							
							<div class="card-footer">{{-- inicio del row --}}
								<div class="row">
									<div class="col-md-12">
										<center>
											<button onclick="Modificar()" class="btn btn-success" value="Registrar">Modificar</button>
											<button onclick="limpiar()" class="btn btn-success" value="Registrar">Cancelar</button>
										</center>
									</div>
								</div>
								{{-- fin del row --}}
							</div>

						</div>

					</div>
					
				</div>


			</div><!-- fin cabecera   -->


		</div><!-- Fin de cuerpo de card -->
	</div><!-- fin columna card -->


</div><!-- Fin ROW-->


@endsection

@section('jscustom')
<script type="text/javascript">
	function Modificar(){

		id=document.getElementById('id').value;
		Nombre=document.getElementById('Nombre').value;
		Ap=document.getElementById('Apellido_Paterno').value;
		Am=document.getElementById('Apellido_Materno').value;
		Direccion=document.getElementById('Direccion').value;
		Correo=document.getElementById('Correo_Personal').value;
		Telefono=document.getElementById('Telefono').value;
		//alert("{{url('/nuevo_personal/registrar/')}}/"+Nombre+"/"+Ap+"/"+Am+"/"+Direccion+"/"+Correo+"/"+Telefono+"/"+Contra+"/"+tUsuario);


		$.get("{{url('/modificar_cliente/modificar/')}}/"+id+"/"+Nombre+"/"+Ap+"/"+Am+"/"+Direccion+"/"+Correo+"/"+Telefono, function(data){
			console.log(data);
			if (data == "success") {
				mensaje("success","Se modifico correctamente a: <b>"+Nombre+" "+Ap+" "+Am+" </b>");
				document.getElementById('co').style.display = 'none';
				limpiar();
			}else if(data=="Repetido"){
				mensaje("danger","Ya existe un registro con el correo: "+Correo);
				document.getElementById('Correo_Personal').value="";
				document.getElementById('co').style.display = 'block';
			}
			
		});

	}
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
                      '<th><form action="{{ url('cliente/eliminarRegistro') }}/'+data[i].Id_persona+'" method="POST">'+
                      '@csrf'+
                      '{{method_field('DELETE')}}'+
                      '<button type="submit" class="btn btn-danger" onclick=" return confirm("Seguro que quieres eliminarlo")">Eliminar</button></form></th>'
                      +'<th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="buscarEd('+data[i].Id_persona+','+nombre+','+ap+','+am+','+ema+','+dire+','+tel+')">Editar</button></th></tr> ';
          }
          html+="</tbody></table>";
         
        }
        $('#tabla').html(html);
        });


}

	function buscarEd(id,nombre,ap,am,ema,dire,tel){
		document.getElementById('NombreB').disabled = 'true';
		document.getElementById('modi').style.display = 'block';
		document.getElementById('tabla').style.display = 'none';
		 document.getElementById('id').value=id;
		 document.getElementById('Nombre').value=nombre;
		 document.getElementById('Apellido_Paterno').value=ap;
		 document.getElementById('Apellido_Materno').value=am;
		 document.getElementById('Correo_Personal').value=ema;
		 document.getElementById('Direccion').value=dire;
		 document.getElementById('Telefono').value=tel;
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