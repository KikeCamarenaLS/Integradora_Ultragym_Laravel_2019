<template>
	<div>

		<div class="form-group form-show-validation row">
			<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Busqueda por nombre de producto: <span class="required-label">*</span></label>
			<div class="col-lg-4 col-md-9 col-sm-8">
				<input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese nombre de producto" required="">
			</div>
			<button class="btn btn-info" v-on:click="ObtenerDatos()">Buscar</button>
		</div>
		<div class="seperator-solid"></div>
		<div>
			<center>
				<h4>Listado de Productos: </h4>
			</center>
			<div id="Resultados_div">
				<div class="col-lg-12 ml-auto mr-auto table-responsive" ><!-- Fin div tabla -->
					<table class="table table-bordered table-bordered-bd-primary mt-4 table table-striped" id="tabla_Productos">
						<thead class= "thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nombre producto</th>
								<th scope="col">Precio</th>
								<th scope="col">Existencia</th>
								<th scope="col">Categoria</th>
								<th scope="col"></th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(producto, index) in ArrayProducto">
								<th scope="row" >{{index + 1}}</th>
								<td style="text-transform: uppercase;"> {{ producto.Nombre_Producto }} </td>
								<td style="text-transform: uppercase;"> {{ producto.Precio }} </td>
								<td style="text-transform: uppercase;"> {{ producto.Existencia }} </td>
								<td style="text-transform: uppercase;"> {{ producto.Categoria }} </td>
								<td style="text-transform: uppercase;">
									<center>
										<button class="btn btn-info"
										v-on:click="DetallesProducto( producto.Nombre_Producto, producto.Descripcion, producto.Precio, producto.Existencia, producto.Categoria, producto.image_url )">
											<span class="btn-label">
												<i class="flaticon-medical"></i>
											</span>
											Ver detalles
										</button>
									</center>
								</td>
								<td style="text-transform: uppercase;">
									<center>
										<button class="btn btn-warning" v-on:click="EditarProducto( producto.id_producto )">
											<span class="btn-label">
												<i class="flaticon-pencil"></i>
											</span>
											Editar Producto
										</button>
									</center>
								</td>
							</tr>
						</tbody>
					</table>
				</div> <!-- fin div tabla -->
			</div>


		</div>

			<!--Modal: modalYT-->
	<div class="modal fade" id="Detalles_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">

		<!--Content-->
		<div class="modal-content">

			<!--Modal Body Row-->
			<div class="modal-body row">
				<!-- div columna 1 -->
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<img alt="Silverfox" class="img-fluid" v-bind:src=" '/images/Productos/' +Modal_Foto ">

				</div><!-- Fin columna 1 -->

				<!-- div columna 2 -->
				<div id="columa-contenido" class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
					<h4 class="title4-long-responsive-section izq blue font-bold text-uppercase">{{ Modal_Producto }} </h4>
					<p>Categoria: {{ Modal_Categoria }}</p>
					<div>
						<div class="form-group row">
							<div class="col-md-12">
								<label><b>Nombre de producto :</b> </label>
								<label name="firstname">{{ Modal_Producto }}</label>
							</div>
							<div class="col-md-12">
								<label><b>Descripcion :</b> </label>
								<label name="firstname">{{ Modal_descripcion }}</label>
							</div>
							<div class="col-md-12">
								<label><b>Precio :</b> </label>
								<label name="firstname">{{ Modal_Precio }}</label>
							</div>
							<div class="col-md-12">
								<label><b>Existencia :</b> </label>
								<label name="firstname">{{ Modal_Existencia }}</label>
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



</template>

<script>

	import axios from 'axios'
	import Swal from 'sweetalert2'
	import DataTable from 'laravel-vue-datatable';
	Vue.use(DataTable)

	export default{

		data(){

			return{

				ArrayProducto : [],
				NombreProducto : "",
				PrecioProducto : "",
				DescripcionProducto : "",

				ValorFoto : "",
				temporalFoto : "",
				imagen : "",

				Modal_Foto: "",
				Modal_Producto: "",
				Modal_Categoria: "",
				Modal_descripcion : "",
				Modal_Precio : "",
				Modal_Existencia : "",
			}

		},//fin data

		created: function(){
			this.getProducts();
			this.datatable();
			//this.datatable();
		},

		methods:{

			datatable: function(){
				$(function(){
					$('#tabla_Productos').DataTable({
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
			//kordell stewart

			getProducts:function(){

				var urlProductos = '/get_productos';
				axios.get(urlProductos).then( response => {
					var table = $('#tabla_Productos').DataTable({});
					table.destroy();
					this.ArrayProducto = response.data
				});

			},

			DetallesProducto:function(Nombre_Producto, Descripcion, Precio, Existencia, Categoria, Foto){
				this.Modal_Foto = Foto;
				this.Modal_Producto = Nombre_Producto;
				this.Modal_Categoria = Categoria;
				this.Modal_descripcion  = Descripcion;
				this.Modal_Precio  = Precio;
				this.Modal_Existencia  = Existencia;
				$('#Detalles_Modal').modal('show');
			},



			MensajeConfirmacion: function(){
				swal({
						title: '¿Listo para guardar?',
						text: "No se podra revertir la acción",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Guardar',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								text: 'Cancelar',
								className: 'btn btn-danger'
							}
						}
					}).then((Guardar) => {
						if (Guardar) {
							this.Almacenar();
						} else {
							swal.close();
						}
					});

			},//fin mensajeConfirmacion

			Almacenar:function(){

				//alert(this.NombreProducto);
				//envio de imagen
                let formData = new FormData();
				formData.append('Imagen', this.imagen);
                //Enviamos la peticion
                formData.append('NombreProducto', this.NombreProducto);
                formData.append('DescripcionProducto', this.DescripcionProducto);
                formData.append('PrecioProducto', this.PrecioProducto);

                var urlAlmacenar = '/productos_store';
				axios.post(urlAlmacenar,
					formData,
					{ headers: {
						'Content-Type': 'multipart/form-data'
					}

				},{
					'NombreProducto' : this.NombreProducto,
                	'DescripcionProducto': this.DescripcionProducto,
                	'PrecioProducto': this.DescripcionProducto,

				}).then( response => {
					this.limpiar();
					this.NotificacionSucces("Se registro el producto con exito");
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
			},// finAlmacenar

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

		}//fin methods

	}//fin export defaul
</script>