<template>
	<div><!-- div principal-->
		<div id="resultados-busqueda" style="">
			<br>
			<center>
				<p class="lead">Roles disponibles</p>
			</center>
			<br>
			<br>
			<button class="btn btn-success" v-on:click="NuevoRol()">
				<span class="btn-label">
					<i class="la la-plus-circle"></i>
				</span>
				Agregar nuevo Rol
			</button>
			<br>
			<div class="col-lg-12 ml-auto mr-auto table-responsive" ><!-- Fin div tabla -->
				<table class="table table-bordered table-bordered-bd-primary mt-4 table table-striped">
					<thead class= "thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Tipo de rol</th>
							<th scope="col">Permisos</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(rol, index) in ArrayRoles">
							<th scope="row" >{{index + 1}}</th>
							<td style="text-transform: uppercase;"> {{ rol.name }} </td>
							<td style="text-transform: uppercase;">
								<!-- <ul v-for= "(permisos, index) in ArrayPermisosRol">
									<li v-if=" permisos.id_rol == rol.id" > {{ permisos.NAME }} </li>
																		
								</ul> -->
								<select  class="form-control multrol" multiple="multiple">
									<option v-for= "(permisos, index) in ArrayPermisosRol" v-if=" permisos.id_rol == rol.id">{{ permisos.NAME }}</option>
								</select>

							</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- fin div tabla -->
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
				ArrayPermisosRol: [], //Array que obtiene los permisos de los roles
				RolUsuarios: "",
				RolPermisos: "",


				ArrayUsuariosDeRol: [], //variable que tiene los usuarios segun el rol a buscar
				ArrayPermisosPorUsuario: [],

				ArrayRolesDisponibles: [],

				RolNuevo : "",

			}//return
		}, // data

		created:function(){
			this.getRoles();
			this.getPermisosRoles();
		},// created

		methods:{

			getRoles:function(){

				var urlgetRoles = '/get-roles';
				axios.get(urlgetRoles).then(response => {
					this.ArrayRoles = response.data
				});
			},//fin getRoles

			getPermisosRoles: function(){
				var urlPermisosRoles = "/Permisos-de-rol";
				axios.get(urlPermisosRoles).then(response => {
					this.ArrayPermisosRol = response.data
				});
			},

			NuevoRol: function(){
				Swal.fire({
				  title: 'Ingrese el nuevo Rol',
				  input: 'text',
				  cancelButtonText: 'Cancelar',
				  inputAttributes: {
				    autocapitalize: 'off'
				  },
				  showCancelButton: true,
				  confirmButtonText: 'Guardar',
				  showLoaderOnConfirm: true,
				  preConfirm: (Rol) => {

				  	if(Rol == ""){
				    	Swal.showValidationMessage("Ingrese un nombre para el nuevo Rol");
				    }else{
				    	var validar = false;

				    	for( var i = 0; i < this.ArrayRoles.length; i++ ){
					  		if( this.ArrayRoles[i]["name"].toUpperCase() == Rol.toUpperCase() ){
					    		Swal.showValidationMessage("Rol Existente, Ingrese un rol diferente");
					    		validar = true;
					  		}
					  	}

					  	if( validar){

					  	}else{
					  		this.RolNuevo = Rol;
					  		this.RegistrarRol();
					  	}
				    }
				  },
				  allowOutsideClick: () => !Swal.isLoading()
				});
			},

			RegistrarRol: function(){
				
				var urlRegistroRol = '/registro-rol/';
				axios.put(urlRegistroRol, {
					'RolNuevoRegistro' : this.RolNuevo,
				}).then(response =>{
					this.NotificacionSucces('Se registro el rol exitosamente');
					this.Limpiar();
					this.getRoles();
					this.getPermisosRoles();
				}).catch(function(error){
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
			},

			Limpiar: function(){

				this.ArrayRoles = []; 
				this.ArrayPermisosRol = []; 
				this.RolUsuarios = "";
				this.RolPermisos = "";


				this.ArrayUsuariosDeRol = [];
				this.ArrayPermisosPorUsuario = [];

				this.ArrayRolesDisponibles = [];

				this.RolNuevo = "";
			}, //Fin Limpiar

			ComboRoles: function(){
				Swal.fire({
				  title: 'Select field validation',
				  input: 'select',
				  inputOptions: {
				    apples: 'Apples',
				    bananas: 'Bananas',
				    grapes: 'Grapes',
				    oranges: 'Oranges'
				  },
				  inputPlaceholder: 'Select a fruit',
				  showCancelButton: true,
				  
				});
			},

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

		}

	} //export default
	
</script>