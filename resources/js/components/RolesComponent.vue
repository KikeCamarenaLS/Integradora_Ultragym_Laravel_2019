<template>

	<div><!-- div principal-->
		<div id="resultados-busqueda" style="">
			<br>
			<center>
				<p class="lead">Roles disponibles</p>
			</center>
			<br>
			<div class="col-lg-12 ml-auto mr-auto" ><!-- Fin div tabla -->
				<table class="table table-bordered  table-bordered-bd-primary mt-4">
					<thead class= "thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Tipo de rol</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(rol, index) in ArrayRoles">
							<th scope="row" >{{index + 1}}</th>
							<td style="text-transform: uppercase;"> {{ rol.Rol }} </td>
						</tr>
					</tbody>
				</table>
			</div> <!-- fin div tabla -->
		</div>
	</div>

</template>


<script>

	import axios from 'axios'

	export default{
		data(){
			return{
				ArrayRoles: [], //Array que obtiene todos los roles existentes
			}//fin return
		},//fin data

		created: function(){
			this.getRoles();
		},//fin created

		methods:{

			getRoles:function(){

				var urlgetRoles = '/get-roles-permisos';
				axios.get(urlgetRoles).then(response => {
					this.ArrayRoles = response.data
				});
			},//fin getRoles

		}, //fin methods

	}//fin export default

</script>