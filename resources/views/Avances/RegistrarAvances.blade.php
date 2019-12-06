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
				<div class="card-title">Registrar Avances</div>

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
			<center><div id="Alerta" name="Alerta"></div></center>
			

			<div class="card-body" name="regi" id="regi" style="display: none">
				{{-- inicio del row --}}
				<div class="form-group row " >

					<div class="card-body">
						{{-- inicio del row --}}
						<CENTER><div id="NombreUS" name="NombreUS"></div></CENTER>
							<div class="form-group row">
															{{-- <div class="col-md-4 has-error has-feedback" > --}}
								<div class="col-md-1 ml-auto mr-auto" >
									<label>Id del Cliente</label>
									<input required="" type="number" class="form-control success" id="id" name="id" placeholder="id" disabled="">
									<input required="" type="text" class="form-control success" id="NombreUS" name="NombreUS" placeholder="id" hidden="">
									{{-- {{Form::text('Nombre',null,["class" => "form-control","placeholder" => "Nombre(s)","id" => "Nombre",])}} --}}
								</div>
								<div class="col-md-1 ml-auto mr-auto" >
									<label>Peso</label>
									<input required="" type="number" class="form-control success" id="Peso" name="Peso" placeholder="peso" onkeypress="validarN()" onkeyup ="validarN()">
									{{-- {{Form::text('Nombre',null,["class" => "form-control","placeholder" => "Nombre(s)","id" => "Nombre",])}} --}}
								</div>
								<div class="col-md-1 ml-auto mr-auto">
									<label>Altura</label>
									<input required="" type="number" class="form-control" id="Altura" name="Altura" placeholder="altura" onkeypress ="validarAp()" onkeyup="" onblur= "calcular();">
								</div>
								<div class="col-md-2 ml-auto mr-auto">
									<label>IMC</label>
									<input required="" disabled="" type="number" class="form-control" id="IMC" name="IMC" placeholder="IMC" onkeypress="validarAm()" onkeyup="validarAm()">
								
								</div>
								<div class="col-md-2 ml-auto mr-auto">
									<label>% de Grasa de los brazos</label>
									<input required="" type="number" class="form-control" id="pgb" name="pgb" placeholder="Porcentaje " onkeypress="validarDir()" onkeyup="validarDir()" >
								</div>
								<div class="col-md-2 ml-auto mr-auto">
									<label>% de Grasa del abdomen</label>
									<input  type="number" class="form-control " id="pga" name="pga" placeholder="porcentaje" onkeypress="validarCor()" onkeyup="validarCor()">
								</div>
								<div class="col-md-2 ml-auto mr-auto">
									<label>% de Grasa de las pierna</label>
									<input  type="number" class="form-control" id="pgp" name="pgp" placeholder="porcentaje "  onkeypress="validartel()" onkeyup="validartel()">
								</div>
								
							</div>
							</CENTER>
							{{-- fin del row --}}
							<div class="card-footer">{{-- inicio del row --}}
								<div class="row">
									<div class="col-md-12">
										<center>
											<button type="submit" onclick="RegistrarAvance()" class="btn btn-success" value="Registrar">Registrar</button>
											<button onclick="limpiar()" class="btn btn-danger">Cancelar</button>
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

	function calcular(){
		var peso = document.getElementById('Peso').value; 
		var altura = document.getElementById('Altura').value; 


		if(peso == "" || altura == ""){
			document.getElementById('Peso').style.borderColor = "red"
			document.getElementById('Altura').style.borderColor = "red"
		}else{
			//Formula
			//IMC = peso corporal [kg] / (altura [m])²
			//Ejemplo
			//(60 kg)/(1,69 m)² ≈ 21
			var IMC = (peso/(altura*altura));
			document.getElementById('IMC').value = IMC;
			var pesoc="";
			var categoria="";
			var icono="";
			var color="";


			if (IMC < 16) {
				//bajo de peso
				categoria="Delgadez Cevera";
				pesoc="Bajo peso";
				icono='la la-frown-o';
				color="danger";
			}else if(IMC >= 16 && IMC <= 17){
				categoria="Delgadez Moderada";
				pesoc="Bajo peso";
				icono='la la-frown-o';
				color="danger";

			}else if(IMC >=17 && IMC <= 18.5){
				categoria="Delgadez Leve";
				pesoc="Bajo peso";
				icono='la la-frown-o';
				color="danger";

			}else if(IMC >=18.5 && IMC <= 24.9){
				categoria="Peso Normal";
				pesoc="Peso normal";
				icono='la la-smile-o';
				color="success";

			}else if(IMC >=25 && IMC <= 29.9){
				categoria="Pre-Obeso";
				pesoc="Sobrepeso";
				icono='la la-frown-o';
				color="danger";

			}else if(IMC >=30 && IMC <= 34.9){
				categoria="Obesidad Tipo I";
				pesoc="Obesidad";
				icono='la la-frown-o';
				color="danger";

			}else if(IMC >=35 && IMC <= 39.9){
				categoria="Obesidad Tipo II";
				pesoc="Obesidad";
				icono='la la-frown-o';
				color="danger";

			}else if(IMC >= 40){
				categoria="Obesidad Tipo II";
				pesoc="Obesidad";
				icono='la la-frown-o';
				color="danger";

			}
			document.getElementById('Alerta').style.display="block";

			var html='<div class="col-sm-6 col-md-3">'
							+'<div class="card card-stats card-round">'
								+'<div class="card-body">'
								+'	<div class="row">'
									+'	<div class="col-5">'
									+'		<div class="icon-big text-center icon-'+color+'">'
										+'		<i class="'+icono+' text-'+color+'"></i>'
									+'		</div>'
									+'	</div>'
									+'	<div class="col-7 col-stats">'
									+'		<div class="numbers">'
									+'			<p class="card-category">'+categoria+'</p>'
									+'			<h4 class="card-title">'+pesoc+'</h4>'
									+'		</div>'
									+'	</div>'
								+'	</div>'
							+'	</div>'
						+'	</div>'
					+'	</div>'


				$('#Alerta').html(html);

		}
	}
	function RegistrarAvance(){
		id=document.getElementById('id').value;
		peso=document.getElementById('Peso').value;
		altura=document.getElementById('Altura').value;
		imc=document.getElementById('IMC').value;
		pgb=document.getElementById('pgb').value;
		pga=document.getElementById('pga').value;
		pgp=document.getElementById('pgp').value;
		Nombre=document.getElementById('NombreUS').value;

		//alert("{{url('/nuevo_personal/registrar/')}}/"+Nombre+"/"+Ap+"/"+Am+"/"+Direccion+"/"+Correo+"/"+Telefono+"/"+Contra+"/"+tUsuario+"/"+Fecha);
		if (peso=="") {
			mensaje("danger","Falta llenar el peso");
			document.getElementById('Peso').style.borderColor = "red"
		}else if  (altura==""){
			mensaje("danger","Falta llenar la altura");
			document.getElementById('Altura').style.borderColor = "red"

		}else if (imc==""){
			mensaje("danger","Falta el IMC");
			document.getElementById('IMC').style.borderColor = "red"

		}else if (pgb==""){
			mensaje("danger","Falta llenar el porcentaje de grasa de los brazos");
			document.getElementById('pgb').style.borderColor = "red"

		}else if (pga==""){
			mensaje("danger","Falta llenar el porcentaje de grasa del abdomen");
			document.getElementById('pga').style.borderColor = "red"

		}else if (pgp==""){
			mensaje("danger","Falta llenar el porcentaje de grasa de las piernas");
			document.getElementById('pgp').style.borderColor = "red"

		}else{
			document.getElementById('Peso').style.borderColor = "green";
			document.getElementById('Altura').style.borderColor = "green";
			document.getElementById('IMC').style.borderColor = "green";
			document.getElementById('pgb').style.borderColor = "green";
			document.getElementById('pga').style.borderColor = "green";
			document.getElementById('pgp').style.borderColor = "green";


			$.get("{{url('/nuevo_avance/registrar/')}}/"+id+"/"+peso+"/"+altura+"/"+imc+"/"+pgb+"/"+pga+"/"+pgp, function(data){
				console.log(data);
				if (data == "success") {
					mensaje("success","Se registro correctamente el avance de: <b>"+Nombre+"</b>");
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
		document.getElementById('Peso').style.borderColor = "";
			document.getElementById('Altura').style.borderColor = "";
			document.getElementById('IMC').style.borderColor = "";
			document.getElementById('pgb').style.borderColor = "";
			document.getElementById('pga').style.borderColor = "";
			document.getElementById('pgp').style.borderColor = "";
		document.getElementById('Peso').value="";
		document.getElementById('Altura').value="";
		document.getElementById('IMC').value="";
		document.getElementById('pgb').value="";
		document.getElementById('pgp').value="";
		document.getElementById('pga').value="";
		document.getElementById('tabla').style.display="block";
		document.getElementById('regi').style.display="none";
		document.getElementById('NombreB').disabled="";
		document.getElementById('Alerta').style.display="none";

	}

	function validarN(){
		var Nombre=document.getElementById('Peso').value;
		if (Nombre != "") {
			document.getElementById('Peso').style.borderColor = "green";
		}else if(Nombre == ""){
			document.getElementById('Peso').style.borderColor = "red";
		}

	}
	function validarAp(){
		var Nombre=document.getElementById('Altura').value;
		if (Nombre != null) {
			document.getElementById('Altura').style.borderColor = "green";
		}else{
			document.getElementById('Altura').style.borderColor = "red";
		}

	}
	function validarAm(){
		var Nombre=document.getElementById('IMC').value;
		if (Nombre != "") {
			document.getElementById('IMC').style.borderColor = "green";
		}else{
			document.getElementById('IMC').style.borderColor = "red";
		}
	}
	function validarDir(){
		var Nombre=document.getElementById('pgb').value;
		if (Nombre != "") {
			document.getElementById('pgb').style.borderColor = "green";
		}else{
			document.getElementById('pgb').style.borderColor = "red";
		}

	}
	function validarCor(){
		var Nombre=document.getElementById('pga').value;
		if (Nombre != "") {
			document.getElementById('pga').style.borderColor = "green";
		}else{
			document.getElementById('pga').style.borderColor = "red";
		}

	}
	function validartel(){
		var Nombre=document.getElementById('pgp').value;
		if (Nombre != "") {
			document.getElementById('pgp').style.borderColor = "green";
		}else{
			document.getElementById('pgp').style.borderColor = "red";
		}

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
  function Generar(id,nombre){
  	document.getElementById('id').value=id;
  	document.getElementById('NombreUS').value=nombre;
  	document.getElementById('NombreB').disabled="true";
  	document.getElementById('regi').style.display = "block";
  	var nom = '<h4>Avance para: ' +nombre+'</h4>';
  	$('#NombreUS').html(nom);
  	document.getElementById('tabla').style.display="none";
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