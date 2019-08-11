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
				alert(idUsuario+" , "+idRol);
			}, //fin ComboRoles

			DetalleUsuario:function(idUsuario){
				alert(idUsuario);
			}, //fin DetalleUsuario

		} // fin methods

	}// fin export default
</script>