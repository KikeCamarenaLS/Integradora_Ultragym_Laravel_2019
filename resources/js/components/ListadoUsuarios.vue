<template>
	<div><!-- div principal -->
		<div id="resultados-busqueda" style="">
			<br>
			<div class="col-lg-12 ml-auto mr-auto table-responsive" ><!-- Fin div tabla -->
				<table class="table table-bordered table-bordered-bd-primary mt-4 table table-striped">
					<thead class= "thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Usuario</th>
							<th scope="col">Correo</th>
							<th scope="col">Rol</th>
							<th scope="col">Cambio de Rol</th>
							<th scope="col">Detalles</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(lista, index) in ArrayListado">
							<th scope="row" >{{index + 1}}</th>
							<td style="text-transform: uppercase;"> {{ lista.nombreUser }} </td>
							<td style="text-transform: uppercase;"> {{ lista.email }} </td>
							<td style="text-transform: uppercase;"> {{ lista.Rol }} </td>
							<td style="text-transform: uppercase;">
								<center>
									<button class="btn btn-info" v-on:click="ComboRoles( lista.idUser , lista.idRol )">
										<span class="btn-label">
											<i class="la la-users"></i>
										</span>
										Cambiar Rol
									</button>
								</center>							
							</td>
							<td style="text-transform: uppercase;">
								<center>
									<button class="btn btn-info" v-on:click="DetalleUsuario(  lista.idUser )">
										<span class="btn-label">
											<i class="la la-users"></i>
										</span>
										Ver detalles usuario
									</button>
								</center>							
							</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- fin div tabla -->

			<!--Modal: modalYT-->
			<div class="modal fade" id="Detalles_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">

				<!--Content-->
				<div class="modal-content">

					<!--Modal Body Row-->
					<div class="modal-body row">
						<h4 class="title4-long-responsive-section izq blue font-bold text-uppercase"> Detalles de usuario  </h4>
						<!-- div columna 2 -->
						<div id="columa-contenido" class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
							
							<div>
								<div class="form-group row">
									
									<div class="col-md-12">
										<label><b>Nombre :</b> </label>
										<label name="firstname">{{ nombre }}</label>
									</div>
									<div class="col-md-12">
										<label><b>Apellido paterno :</b> </label>
										<label name="firstname">{{ ApellidoP }}</label>
									</div>
									<div class="col-md-12">
										<label><b>Apellido materno :</b> </label>
										<label name="firstname">{{ ApellidoM }}</label>
									</div>
									<div class="col-md-12">
										<label><b>Correo :</b> </label>
										<label name="firstname">{{ Correo }}</label>
									</div>
									<div class="col-md-12">
										<label><b>Fecha nacimiento :</b> </label>
										<label name="firstname">{{ Nacimiento }}</label>
									</div>
									<div class="col-md-12">
										<label><b>Dirección :</b> </label>
										<label name="firstname">{{ Direccion }}</label>
									</div>
									<div class="col-md-12">
										<label><b>Telefono :</b> </label>
										<label name="firstname">{{ Telefono }}</label>
									</div>

								</div>
							</div>
						</div><!-- fin div columna 2 -->

					</div>
					<!-- Fin modal body Row-->

					<!--Footer-->
					<div class="modal-footer justify-content-center flex-column flex-md-row">

						<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
						data-dismiss="modal">Cerrar</button>


					</div>

				</div>
				<!--/.Content-->

			</div>
		</div>
		<!--Modal: modalYT-->
		</div>
		
	</div><!-- div principal -->
</template>

<script>
	import axios from 'axios'
	import Swal from 'sweetalert2'

	export default{

		data(){
			return{

				ArrayListado : [],

				ArrayRolesDisponibles : [],
				OpcionesCombo : "",

				ArrayDetalleUsuairo : [],

				nombre : "",
				ApellidoP : "",
				ApellidoM : "",
				Correo : "",
				Telefono : "",
				Direccion :"",
				Nacimiento : "",

			}//fin return

		},// fin data

		created:function(){
			this.getListado();
		},//fin created

		methods:{

			getListado:function(){

				var urlGetListado = '/get-Listado';
				axios.get(urlGetListado).then( response => {
					this.ArrayListado = response.data
				});
			}, //fin getListado

			ComboRoles:function(idUsuario, idRol){

				this.ArrayRolesDisponibles = [];
				this.OpcionesCombo = [];

				var urlRolesDiferentes = '/roles-diferent-get/'+idRol;
				axios.get(urlRolesDiferentes).then( response => {

					this.ArrayRolesDisponibles = response.data
					this.ComboDetalles(idUsuario);
				});

				
			}, //fin ComboRoles

			ComboDetalles:function(idUsuario){

				var options = {};
		        $.map(this.ArrayRolesDisponibles,
		            function(o) {
		                options[o.id_Rol] = o.name;
		            });

		        

				Swal.fire({
				  title: 'Eliga un nuevo rol',
				  input: 'select',
				  inputOptions: options,
				  inputPlaceholder: 'Seleccione nuevo rol',
				  showCancelButton: true,
				  inputValidator: (value) => {
				    return new Promise((resolve) => {
				      if (value <= 0) {
				        resolve("Seleccione una opción.")
				      } else {
				      	resolve()
				        this.modificarRol(value, idUsuario);
				      }
				    })
				  }
				})


			}, //fin ComboDetalles

			modificarRol:function(idNuevoRol, idUsuario){
				
				var ModificarRol = '/change-rol';
				axios.put(ModificarRol, {

					'IdNuevoRol' : idNuevoRol,
					'IdUsuario' : idUsuario,

				}).then( response => {
					this.NotificacionSucces('Se modifico exitosamente el rol');
					this.ArrayListado = [];
					this.ArrayRolesDisponibles = [];
					this.OpcionesCombo = "";
					this.getListado();
				}).catch(function(error) {
					var placementFrom = 'top';
					var placementAlign = 'center';
					var state = 'danger';
					var style = 'withicon' ;
					var content = {} ;

					content.message = 'Ocurrio un error, intente de nuevo porfavor'+error;
					content.title = 'Error';
					content.icon = 'la la-frown-o';
					$.notify(content,{
						type: state,
						placement: {
							from: placementFrom,
							align: placementAlign
						},
						time: 1000,
					});//fin notificacion
				});
			}, //fin modificar rol


			DetalleUsuario:function(idUsuario){
				
				var UrlGetDetalles = '/get-Detalles-usuarios/'+idUsuario;
				axios.get(UrlGetDetalles).then(response => {
					this.ArrayDetalleUsuairo = response.data;
					this.inicializacion();
				});
				
			}, //fin DetalleUsuario

			NotificacionSucces: function(mensaje){

				var placementFrom = 'top';
				var placementAlign = 'right';
				var state = 'success';
				var style = 'withicon' ;
				var content = {} ;

				content.message = mensaje;
				content.title = 'Edición exitosa';
				content.icon = 'la la-clipboard';
				$.notify(content,{
					type: state,
					placement: {
						from: placementFrom,
						align: placementAlign
					},
					time: 1000,
				});

			}, //fin Notificacion succes

			inicializacion:function(){
				
				this.nombre = this.ArrayDetalleUsuairo[0]["name"];
				this.ApellidoP = this.ArrayDetalleUsuairo[0]["apellido_P"];
				this.ApellidoM = this.ArrayDetalleUsuairo[0]["apellido_M"];
				this.Correo = this.ArrayDetalleUsuairo[0]["email"];
				this.Telefono = this.ArrayDetalleUsuairo[0]["telefono"];
				this.Direccion = this.ArrayDetalleUsuairo[0]["direccion"];
				this.Nacimiento =  this.ArrayDetalleUsuairo[0]["fecha_nacimiento"];
				$('#Detalles_Modal').modal('show');
			}, //fin inicializacion



		} // fin methods

	}// fin export default
</script>