<template>

	<div><!-- div principal-->
		<div id="resultados-busqueda" style="">
			<br>
			<center>
				<p class="lead">Roles disponibles</p>
			</center>
			<br>
			<div class="col-lg-12 ml-auto mr-auto" ><!-- Fin div tabla -->
				<table class="table table-bordered table-bordered-bd-primary mt-4 table-responsive">
					<thead class= "thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Tipo de rol</th>
							<th scope="col">Usuarios</th>
							<th scope="col">Permisos</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(rol, index) in ArrayRoles">
							<th scope="row" >{{index + 1}}</th>
							<td style="text-transform: uppercase;"> {{ rol.name }} </td>
							<td>
								<center>
									<button class="btn btn-info" v-on:click="VerUsuariosRol( rol.id )">
										<span class="btn-label">
											<i class="la la-users"></i>
										</span>
										Ver usuarios con rol {{ rol.name }}
									</button>
								</center>
							</td>
							<td>
								<center>
									<button class="btn btn-info" v-on:click="VerPermisosRol( rol.id )">
										<span class="btn-label">
											<i class="la la-users"></i>
										</span>
										Ver permisos del rol {{ rol.name }}
									</button>
								</center>
							</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- fin div tabla -->
		</div>

		<!-- Modal: Modal: Usuarios de Rol-->
		<div class="modal fade right" id="Usuario_Roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true" data-backdrop="true">
		<div class="modal-dialog modal-lg modal-right modal-notify modal-info modal-dialog-scrollable " role="document">
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<h4 class="title4-long-responsive-section izq blue font-bold text-uppercase"><p class="heading lead">Usuarios de {{ RolUsuarios }}
					</p></h4>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">×</span>
					</button>
				</div>

				<!--Body-->
				<div class="modal-body">


					<!-- Radio -->
					<div>
						<div class="form-group row">
							<br>

							<div class="col-md-12" v-if="ArrayUsuariosDeRol.length == 0" >
								<h6>Sin usuarios asignados</h6>
							</div><!--fin div caracteristicas Modal -->

							<div class="col-lg-12 ml-auto mr-auto" v-else><!--div tabla -->
								<table class="table table-bordered table-bordered-bd-primary mt-4 table-responsive">
									<thead class= "thead-dark">
										<tr>
											<th scope="col">#</th>
											<th scope="col">Nombre</th>
											<th scope="col">Email</th>
											<th scope="col">Telefono</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(usuario, index) in ArrayUsuariosDeRol">
											<th scope="row" >{{index + 1}}</th>
											<td style="text-transform: uppercase;"> {{ usuario.name }} {{ usuario.apellido_P }} {{ usuario.apellido_M }} </td>
											<td>{{ usuario.email }}</td>
											<td>{{ usuario.telefono }} </td>
											<td>
												<button class="btn btn-default" v-on:click="CambiarRol( usuario.id ) ">
													<span class="btn-label">
														<i class="la la-pencil"></i>
													</span>
													Cambiar Rol
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- fin div tabla -->



						</div>
					</div>
				</div>

				<!--Footer-->
				<div class="modal-footer justify-content-center flex-column flex-md-row">

					<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
					data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal: Usuarios de Rol-->

	<!-- Modal: Modal: Usuarios de Rol-->
	<div class="modal fade right" id="Permisos_Roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true" data-backdrop="true">
	<div class="modal-dialog modal-lg modal-right modal-notify modal-info modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header">
				<h4 class="title4-long-responsive-section izq blue font-bold text-uppercase"><p class="heading lead">Permisos de {{ RolPermisos }}
				</p></h4>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="white-text">×</span>
				</button>
			</div>

			<!--Body-->
			<div class="modal-body">


				<!-- Radio -->
				<div>
					<div class="form-group row">
						<br>
						<br><br><br>

						<button class="btn btn-success">
							<span class="btn-label">
								<i class="la la-plus-circle"></i>
							</span>
							Agregar Permiso
						</button>

						<hr>

						<div class="col-md-12" v-if="ArrayPermisosPorUsuario.length == 0" >
							<h6>Sin usuarios asignados</h6>
						</div><!--fin div caracteristicas Modal -->

						<div class="col-lg-12 ml-auto mr-auto" v-else><!--div tabla -->
							<table class="table table-bordered  table-bordered-bd-primary mt-4">
								<thead class= "thead-dark">
									<tr>
										<th scope="col">#</th>
										<th scope="col">Permiso</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(permisos, index) in ArrayPermisosPorUsuario">
										<th scope="row" >{{index + 1}}</th>
										<td style="text-transform: uppercase;"> {{ permisos.permiso }} </td>
										<td>
											<button class="btn btn-danger" v:on-click="QuitarPermiso( permisos.permission_id, permisos.role_id)">
												<span class="btn-label">
													<i class="la la-times-circle"></i>
												</span>
												Quitar Permiso
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- fin div tabla -->



					</div>
				</div>
			</div>

			<!--Footer-->
			<div class="modal-footer justify-content-center flex-column flex-md-row">

				<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
				data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal: Usuarios de Rol-->

<!-- Modal -->
<div class="modal fade" id="CambioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title" id="exampleModalLongTitle">Roles</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">


				<div class="form-group col-md-9 ml-auto mr-auto" hidden>
					<center><label for="inputCity">id</label></center>
					<input type="text" class="form-control" id="NomMarcaID" name="NomMarcaID" required>
				</div>
				<div class="form-group col-md-9 ml-auto mr-auto">
					<center><label for="inputCity">Eliga el nuevo Rol:</label></center>
					<select class="form-control input-pill">
						<option>
							Seleccione uno..
						</option>
						<option v-for= "(roles, index) in ArrayArrayRolesDisponibles" >
							{{ roles.name }}
						</option>
					</select>
				</div>
				<center> <button type="submit" class="btn btn-success btn-border btn-round">Guardar Cambios</button></center>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-border btn-round" data-dismiss="modal">Cerrar</button>

			</div>
		</div>
	</div>
</div>


</div><!-- Div Principal -->

</template>


<script>

	import axios from 'axios'
	import Swal from 'sweetalert2'

	export default{
		data(){
			return{
				ArrayRoles: [], //Array que obtiene todos los roles existentes
				RolUsuarios: "",
				RolPermisos: "",

				ArrayUsuariosDeRol: [], //variable que tiene los usuarios segun el rol a buscar
				ArrayPermisosPorUsuario: [],

				ArrayRolesDisponibles: [],

				NuevoRol : "",
			}//fin return
		},//fin data

		created: function(){
			this.getRoles();
		},//fin created

		methods:{

			getRoles:function(){

				var urlgetRoles = '/get-roles';
				axios.get(urlgetRoles).then(response => {
					this.ArrayRoles = response.data
				});
			},//fin getRoles

			VerUsuariosRol:function(idRol){ //Funcion que muestra modal con los usuarios que son determinado rol
				//se recupera el id de del rol para realizar la busqueda

				this.RolUsuarios =""; //limpiar la variable RolUsuarios
				this.ArrayUsuariosDeRol = [];
				//for que recorre el array con los roles
				for(var i= 0; i< this.ArrayRoles.length; i++){
					//if para comparar si el id a buscar es igual al del array y asignar el nombre de Rol a variable RolesUsuarios
					if( this.ArrayRoles[i]["id"] == idRol ){
						this.RolUsuarios = this.ArrayRoles[i]["name"];
					}
				}

				var urlUsuariosPorRol = '/get-usuarios-by-rol/'+idRol;
				axios.get(urlUsuariosPorRol).then(response => {
					this.ArrayUsuariosDeRol = response.data
				});

				$('#Usuario_Roles').modal('show');


			}, //fin VerUsuariosRol

			VerPermisosRol:function(idRol){ //Funcion que muestra los permisos de cada rol
				this.RolPermisos =""; //limpiar la variable RolUsuarios
				this.ArrayPermisosPorUsuario = [];

				for(var i= 0; i< this.ArrayRoles.length; i++){
					//if para comparar si el id a buscar es igual al del array y asignar el nombre de Rol a variable RolesUsuarios
					if( this.ArrayRoles[i]["id"] == idRol ){
						this.RolPermisos = this.ArrayRoles[i]["name"];
					}
				}

				var urlPermisosPorRol = '/get-permisos-by-rol/'+idRol;
				axios.get(urlPermisosPorRol).then(response => {
					this.ArrayPermisosPorUsuario = response.data
				});


				$('#Permisos_Roles').modal('show');


			},

			CambiarRol:function(idPersona){ //Funcion que cambia el Rol de los Usuarios segun su id
				this.ArrayRolesDisponibles = [];

				var urlDispoblesRoles = '/Roles-disponibles-Persona/'+idPersona;
				axios.get(urlDispoblesRoles).then(response =>{
					this.ArrayRolesDisponibles = response.data
				});

				//this.DatoCategoria();
				//this.VerPermisosRol(1);
				$('#CambioModal').modal('show');
				
				//this.prueba();
			},

			prueba:function(){
				swal({
				  text: 'Search for a movie. e.g. "La La Land".',
				  content: "input",
				  button: {
				    text: "Search!",
				    closeModal: false,
				  },
				})
				.then(name => {
				  if (!name) throw null;
				 
				  return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
				})
				.then(results => {
				  return results.json();
				})
				.then(json => {
				  const movie = json.results[0];
				 
				  if (!movie) {
				    return swal("No movie was found!");
				  }
				 
				  const name = movie.trackName;
				  const imageURL = movie.artworkUrl100;
				 
				  swal({
				    title: "Top result:",
				    text: name,
				    icon: imageURL,
				  });
				})
				.catch(err => {
				  if (err) {
				    swal("Oh noes!", "The AJAX request failed!", "error");
				  } else {
				    swal.stopLoading();
				    swal.close();
				  }
				});
			}
			

		}, //fin methods

	}//fin export default

</script>