@extends('template.header')


@section('content_header')
<h4 class="page-title">Personal</h4>

@stop


@section('content')


<body onload="ComboRoles();">
<div class="row"><!-- Inicio ROW-->
	<div class="col-md-12"><!-- Inicio de columna de row -->
		<div class="card"><!-- inicio de cuerpo card -->
			<!-- Cabecera titulo -->
			<div class="card-header">
				<div class="card-title">Nueva Personal</div>

			</div><!-- fin cabecera   -->
			<div class="card-body">
				{{-- inicio del row --}}
				<div class="form-group row " >

					<div class="card-body">
						{{-- inicio del row --}}
						<div class="form-group row " >
							{{-- <div class="col-md-4 has-error has-feedback" > --}}
								<div class="col-md-4" >
									<label>Nombre(s)</label>
									<input required="" type="text" class="form-control success" id="Nombre" name="Nombre" placeholder="Nombre(s)" onkeypress="validarN()" onkeyup="validarN()">
									{{-- {{Form::text('Nombre',null,["class" => "form-control","placeholder" => "Nombre(s)","id" => "Nombre",])}} --}}
								</div>
								<div class="col-md-4">
									<label>Apellido Paterno</label>
									<input required="" type="text" class="form-control" id="Apellido_Paterno" name="Apellido_Paterno" placeholder="Apellido Paterno " onkeypress="validarAp()" onautocomplete="validarAp()">
								</div>
								<div class="col-md-4">
									<label>Apellido Materno</label>
									<input required="" type="text" class="form-control" id="Apellido_Materno" name="Apellido_Materno" placeholder="Apellido Materno" onkeypress="validarAm()" onautocomplete="validarAm()">
								</div>
							</div>
							{{-- fin del row --}}
							{{-- inicio del row --}}
							<div class="form-group row " >
								<div class="col-md-12">
									<label>Direccion</label>
									<input required="" type="text" class="form-control" id="Direccion" name="Direccion" placeholder="Direccion " onkeypress="validarDir()" onload="validarDir()" >
								</div>

							</div>
							{{-- fin del row --}}

							{{-- inicio del row --}}
							<div class="form-group row " >
								<div class="col-md-4">
									<label>Correo Personal<span class="required-label" style="display: none;" name="co" id="co"> Repetido</span></label>
									<input  type="email" class="form-control " id="Correo_Personal" name="Correo_Personal" placeholder="Correo Personal" onkeypress="validarCor()" onautocomplete="validarCor()">
								</div>
								<div class="col-md-4">
									<label>Telefono</label>
									<input  type="number" name="Telefono" min="10000000"  class="form-control" id="Telefono" name="Telefono" placeholder="Telefono "  onkeypress="validartel()" onautocomplete="validartel()" max="9999999999" min="00000000">
								</div>
								<div class="col-md-4">
									<label>Contraseña</label>
									<input  type="password" class="form-control" id="Contra" name="Contra" placeholder="Contraseña" onkeypress="validarcontra()" >
								</div>

							</div>
							<div class="form-group row " >
								<div class="col-md-4">
									<label>Fecha Nacimiento</label>
									<input  type="date" name="Fecha" class="form-control" id="Fecha" name="Fecha" onchange="validarFecha()">
								</div>

								<div class="col-md-4">
									<label>Tipo</label>
									<select id="tUsuario" name="tUsuario" class="form-control" required onchange="validartus()">

									</select>
								</div>
							</div>	
							<div class="card-footer">{{-- inicio del row --}}
								<div class="row">
									<div class="col-md-12">
										<center>
											<button type="submit" onclick="RegistrarPersona()" class="btn btn-success" value="Registrar">Registrar</button>
											<button onclick="limpiar()" class="btn btn-success" value="Registrar">Limpiar</button>
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
	function RegistrarPersona(){
		Nombre=document.getElementById('Nombre').value;
		Ap=document.getElementById('Apellido_Paterno').value;
		Am=document.getElementById('Apellido_Materno').value;
		Direccion=document.getElementById('Direccion').value;
		Correo=document.getElementById('Correo_Personal').value;
		Telefono=document.getElementById('Telefono').value;
		Contra=document.getElementById('Contra').value;
		tUsuario=document.getElementById('tUsuario').value;
		Fecha=document.getElementById('Fecha').value;

		//alert("{{url('/nuevo_personal/registrar/')}}/"+Nombre+"/"+Ap+"/"+Am+"/"+Direccion+"/"+Correo+"/"+Telefono+"/"+Contra+"/"+tUsuario+"/"+Fecha);
		if (Nombre=="") {
			mensaje("danger","Falta llenar el Nombre");
			document.getElementById('Nombre').style.borderColor = "red"
		}else if  (Ap==""){
			mensaje("danger","Falta llenar el Apellido Paterno");
			document.getElementById('Apellido_Paterno').style.borderColor = "red"

		}else if (Am==""){
			mensaje("danger","Falta llenar el Apellido Materno");
			document.getElementById('Apellido_Materno').style.borderColor = "red"

		}else if (Direccion==""){
			mensaje("danger","Falta llenar el la Direccion");
			document.getElementById('Direccion').style.borderColor = "red"

		}else if (Correo==""){
			mensaje("danger","Falta llenar el Correo");
			document.getElementById('Correo_Personal').style.borderColor = "red"

		}else if (Telefono==""){
			mensaje("danger","Falta llenar el Telefono");
			document.getElementById('Telefono').style.borderColor = "red"

		}else if (Contra==""){
			mensaje("danger","Falta llenar el Contraseña");
			document.getElementById('Contra').style.borderColor = "red"

		}else if (Fecha==""){
			mensaje("danger","Falta llenar el la Fecha");
			document.getElementById('Fecha').style.borderColor = "red"

		}else if (tUsuario==0){
			mensaje("danger","Falta seleccionar el tipo de usuario");
			document.getElementById('tUsuario').style.borderColor = "red"

		}else{
			document.getElementById('Nombre').style.borderColor = "green";
			document.getElementById('Apellido_Paterno').style.borderColor = "green";
			document.getElementById('Apellido_Materno').style.borderColor = "green";
			document.getElementById('Direccion').style.borderColor = "green";
			document.getElementById('Correo_Personal').style.borderColor = "green";
			document.getElementById('Telefono').style.borderColor = "green";
			document.getElementById('Contra').style.borderColor = "green";
			document.getElementById('Fecha').style.borderColor = "green";
			document.getElementById('tUsuario').style.borderColor = "green";


			$.get("{{url('/nuevo_personal/registrar/')}}/"+Nombre+"/"+Ap+"/"+Am+"/"+Direccion+"/"+Correo+"/"+Telefono+"/"+Contra+"/"+tUsuario+"/"+Fecha, function(data){
				console.log(data);
				if (data == "success") {
					mensaje("success","Se registro correctamente a: <b>"+Nombre+" "+Ap+" "+Am+" </b>");
					document.getElementById('co').style.display = 'none';
					limpiar();
				}else if(data=="Repetido"){
					mensaje("danger","Ya existe un registro con el correo: "+Correo);
					document.getElementById('Correo_Personal').value="";
					document.getElementById('Correo_Personal').style.borderColor = "red"


					

				}
				
			});
		}

	}
	function limpiar(){
		document.getElementById('Nombre').style.borderColor = "";
			document.getElementById('Apellido_Paterno').style.borderColor = "";
			document.getElementById('Apellido_Materno').style.borderColor = "";
			document.getElementById('Direccion').style.borderColor = "";
			document.getElementById('Correo_Personal').style.borderColor = "";
			document.getElementById('Telefono').style.borderColor = "";
			document.getElementById('Contra').style.borderColor = "";
			document.getElementById('Fecha').style.borderColor = "";
			document.getElementById('tUsuario').style.borderColor = "";
		document.getElementById('Nombre').value="";
		document.getElementById('Apellido_Paterno').value="";
		document.getElementById('Apellido_Materno').value="";
		document.getElementById('Direccion').value="";
		document.getElementById('Correo_Personal').value="";
		document.getElementById('Telefono').value="";
		document.getElementById('Contra').value="";
		document.getElementById('tUsuario').value="0";
		document.getElementById('Fecha').value="";

	}
	function validarN(){
		Nombre=document.getElementById('Nombre').value;
		if (Nombre != "") {
			document.getElementById('Nombre').style.borderColor = "green";
		}

	}
	function validarAp(){
		Nombre=document.getElementById('Apellido_Paterno').value;
		if (Nombre != "") {
			document.getElementById('Apellido_Paterno').style.borderColor = "green";
		}

	}
	function validarAm(){
		Nombre=document.getElementById('Apellido_Materno').value;
		if (Nombre != "") {
			document.getElementById('Apellido_Materno').style.borderColor = "green";
		}
	}
	function validarDir(){
		Nombre=document.getElementById('Direccion').value;
		if (Nombre != "") {
			document.getElementById('Direccion').style.borderColor = "green";
		}

	}
	function validarCor(){
		Nombre=document.getElementById('Correo_Personal').value;
		if (Nombre != "") {
			document.getElementById('Correo_Personal').style.borderColor = "green";
		}

	}
		function validartel(){
		Nombre=document.getElementById('Telefono').value;
		if (Nombre != "") {
			document.getElementById('Telefono').style.borderColor = "green";
		}

	}
		function validarcontra(){
		Nombre=document.getElementById('Contra').value;
		if (Nombre != "") {
			document.getElementById('Contra').style.borderColor = "green";
		}

	}
		function validartus(){
		Nombre=document.getElementById('tUsuario').value;
		if (Nombre != "") {
			document.getElementById('tUsuario').style.borderColor = "green";
		}

	}
	function validarFecha(){
		Nombre=document.getElementById('Fecha').value;
		if (Nombre != "") {
			document.getElementById('Fecha').style.borderColor = "green";
		}

	}

//Combobox de los roles
  function ComboRoles(){
        $.get("{{url('/comboRoles/Roles')}}", function(data){
          var html = '<option value="0">Seleccione un Rol</option>';
          for(i=0; i<data.length; i++) {
          html+=
                      '<option value="'+data[i].id+'">'+data[i].name+'</option>';
          }
          $('#tUsuario').html(html);


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