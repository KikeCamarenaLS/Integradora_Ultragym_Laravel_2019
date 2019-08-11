<template>
	<div>
		<div id="resultados-busqueda" style="">
			<br>
			<center>
				<p class="lead">Permisos disponibles</p>
			</center>
			<br>
			<br>
			<button class="btn btn-success" v-on:click="NuevoPermiso()">
				<span class="btn-label">
					<i class="la la-plus-circle"></i>
				</span>
				Agregar nuevo Permiso
			</button>
			<br>
			<div class="col-lg-12 ml-auto mr-auto table-responsive" ><!-- Fin div tabla -->
				<table id="tablin" class="table table-bordered table-bordered-bd-primary mt-4 table table-striped">
					<thead class= "thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Permiso</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(permiso, index) in ArrayPermisos">
							<th scope="row" >{{index + 1}}</th>
							<td style="text-transform: uppercase;"> {{ permiso.name }} </td>
						</tr>
					</tbody>
				</table>
			</div> <!-- fin div tabla -->
		</div>
		
	</div><!-- Div principal-->
	
</template>

<script>
	import axios from 'axios'
	import Swal from 'sweetalert2'

	export default{
		data(){
			return{

				ArrayPermisos : [],
				PermisoNuevo : "",
			}
		},
		created: function(){
			this.getPermisos();
			//this.datatable();
		},

		methods:{

			datatable: function(){
				$(function(){
					$('#tablin').DataTable({
						scrollX:  false,
				        scrollCollapse: true,
				        filter: false,
				        lengthMenu:   [[7, 14, 21, 28, 35, -1], [7, 14, 21, 28, 35, "Todos"]],
				        iDisplayLength: 7,
				        	"language" : {
				            	"lengthMenu" : "Mostrar _MENU_ datos",
				            	"zeroRecords" : "No existe el dato introducido",
				            	"info" : "Página _PAGE_ de _PAGES_ ",
				            	"infoEmpty" : "Sin datos disponibles",
				            	"infoFiltered": "(mostrando los datos filtrados: _MAX_)",
				            	"paginate" : {
				             		"first": "Primero",
				              		"last": "Ultimo",
				              		"next": "Siguiente",
				              		"previous": "Anterior"
				            	},
				            	"search": "Buscar",
				            	"processing" : "Buscando...",
				            	"loadingRecords" : "Cargando..."
				        	}

					});
				});
			},


			getPermisos:function(){

				var urlPermisos = '/get-permisos';
				axios.get(urlPermisos).then( response =>{
					this.ArrayPermisos = response.data
				});
			},

			NuevoPermiso: function(){
				Swal.fire({
				  title: 'Ingrese el nuevo Permiso',
				  input: 'text',
				  cancelButtonText: 'Cancelar',
				  inputAttributes: {
				    autocapitalize: 'off'
				  },
				  showCancelButton: true,
				  confirmButtonText: 'Guardar',
				  showLoaderOnConfirm: true,
				  preConfirm: (Permiso) => {

				  	if(Permiso == ""){
				    	Swal.showValidationMessage("Ingrese un nombre para el nuevo Permiso");
				    }else{
				    	var validar = false;

				    	for( var i = 0; i < this.ArrayPermisos.length; i++ ){
					  		if( this.ArrayPermisos[i]["name"].toUpperCase() == Permiso.toUpperCase() ){
					    		Swal.showValidationMessage("Permiso existente, Ingrese un rol diferente");
					    		validar = true;
					  		}
					  	}

					  	if( validar){

					  	}else{
					  		this.PermisoNuevo = Permiso;
					  		this.RegistrarPermiso();
					  	}
				    }
				  },
				  allowOutsideClick: () => !Swal.isLoading()
				});
			},

			RegistrarPermiso:function(){

				var urlRegistroPermiso = '/registrar-permiso';
				axios.put(urlRegistroPermiso,{
					'PermisoNuevo' : this.PermisoNuevo,
				}).then(response =>{

					this.NotificacionSucces('Se registro el permiso exitosamente');
					this.limpiar();
					this.getPermisos();

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

			limpiar:function(){
				this.ArrayPermisos = [];
				this.PermisoNuevo = "";
			},

			NotificacionSucces: function(mensaje){

				var placementFrom = 'top';
				var placementAlign = 'right';
				var state = 'success';
				var style = 'withicon' ;
				var content = {} ;

				content.message = mensaje;
				content.title = 'Registro exitoso';
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

			ActivarBoton:function(){
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
		}
	}
</script>