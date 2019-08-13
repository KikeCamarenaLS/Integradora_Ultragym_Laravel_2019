	<template>
		<div>


			<div class="form-group">
				<label for="nombre_producto_Busqueda" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Busqueda por nombre de producto: <span class="required-label">*</span></label>
				<input type="text" class="form-control" id="nombre_producto_Busqueda" name="nombre_producto_Busqueda" placeholder="Ingrese nombre de producto" required="">
				<button class="btn btn-info" v-on:click="PorNombre()">Buscar</button>
				<button class="btn btn-info" v-on:click="Todos()">VerTodos</button>
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
										<button class="btn btn-warning" v-on:click="EditarProducto( producto.id_producto, producto.Nombre_Producto, producto.Descripcion, producto.Precio, producto.Existencia, producto.Categoria, producto.image_url, producto.id_categoria )">
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


	<!-- Modal Editar -->

	<div class="modal fade bd-example-modal-lg" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar datos producto</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<br>

				</div>


					<div class="card-body">

						<div>
			<div class="form-group form-show-validation row">
				<label for="nombre_producto_Edit" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nombre de producto <span class="required-label">*</span></label>
				<div class="col-lg-4 col-md-9 col-sm-8">
					<input type="text" class="form-control" id="nombre_producto_Edit" name="nombre_producto" placeholder="Ingrese nombre de producto" required="" v-bind:value="Edit_Producto">
				</div>
			</div>
			<div class="form-group form-show-validation row">
				<label for="descripcion" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Descripción de producto <span class="required-label">*</span></label>
				<div class="col-lg-4 col-md-9 col-sm-8">
					<textarea class="form-control" id="descripcion_producto" name="descripcion_producto" required=""  v-bind:value="Edit_Descripcion">

					</textarea>
				</div>
			</div>

			<div class="form-group form-show-validation row">
				<label for="precio_producto" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Precio <span class="required-label">*</span></label>
				<div class="col-lg-4 col-md-9 col-sm-8">
					<div class="input-group-prepend" for="precio_producto">
						<span class="input-group-text">$</span>
						<input type="number" step="0.01" id="precio_producto" name="precio_producto" class="form-control" aria-label="Amount (to the nearest dollar)"v-bind:value="Edit_Precio" >
					</div>

				</div>
			</div>

			<div class="form-group form-show-validation row">
				<label for="existencia_producto" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Existencias <span class="required-label">*</span></label>
				<div class="col-lg-4 col-md-9 col-sm-8">
					<div class="input-group-prepend" for="existencia_producto">
						<input type="number" step="0.01" id="existencia_producto" name="existencia_producto" class="form-control" v-bind:value="Edit_Existencia" >
					</div>

				</div>
			</div>

			<div class="form-group form-show-validation row">
				<label for="CategoriaProducto" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Categoria del producto: <span class="required-label">*</span></label>
				<div class="col-lg-4 col-md-9 col-sm-8">
					<select class="form-control input-pill" id="CategoriaProducto">
						<option value="Sin">Seleccione uno</option>
						<option v-for="(tipo,index) in ArrayTipo" v-bind:value=" tipo.id_categoria " v-if="tipo.id_categoria != Edit_IdCategoria" >{{ tipo.Categoria }}</option>
						<option v-else v-bind:value="tipo.id_categoria" selected>{{ tipo.Categoria }}</option>
					</select>
				</div>
			</div>
		</div>

					</div>

					<div class="modal-footer">
						<center>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<input type="submit" v-on:click="Editar()" class="btn btn-primary" value="Actualizar">
						</center>
					</div>

			</div>
		</div>
	</div>

	<!-- Fin modal Editar -->

	</div>



	</template>

<script>

	import axios from 'axios'
	import Swal from 'sweetalert2'

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

				Edit_Foto : "",
				Edit_Producto: "",
				Edit_Categoria : "",
				Edit_Descripcion : "",
				Edit_Precio : "",
				Edit_Existencia : "",
				Edit_Id: "",
				Edit_IdCategoria: "",

				ArrayTipo: [],

				Nuevo_NombreProducto : "",
				Nuevo_PrecioProducto : "",
				Nuevo_DescripcionProducto : "",
				Nuevo_CategoriaProducto : "",
				Nuevo_ValorFoto : "",
				Nuevo_temporalFoto : "",
				Nuevo_imagen : "",

				ArrayBusqueda : [],
				NombreBusqueda : "",
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
					/*var table = $('#tabla_Productos').DataTable({});
					table.destroy();*/
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

			EditarProducto:function(id_producto, Nombre_Producto, Descripcion, Precio, Existencia, Categoria, image_url, id_categoria){

				this.Edit_Producto = Nombre_Producto;
				this.Edit_Foto = "/images/Productos/"+image_url;
				this.Edit_Categoria = Categoria;
				this.Edit_Descripcion = Descripcion;
				this.Edit_Precio = Precio;
				this.Edit_Existencia = Existencia;
				this.Edit_Id= id_producto;
				this.Edit_IdCategoria = id_categoria;
				this.getTipo();
				$('#modificarModal').modal('show');
			}, //Fin EditarProducto

			getTipo:function(){

				var UrlTipoGet = '/get-Tipo/product';
				axios.get(UrlTipoGet).then(response => {
					this.ArrayTipo = response.data
				});
			},

			Editar:function(){

				this.Nuevo_NombreProducto = document.getElementById('nombre_producto_Edit').value;
				this.Nuevo_PrecioProducto = document.getElementById('precio_producto').value;
				this.Nuevo_DescripcionProducto = document.getElementById('descripcion_producto').value;
				this.Nuevo_CategoriaProducto = document.getElementById('CategoriaProducto').value;
				this.Nuevo_existencia = document.getElementById('existencia_producto').value;
				this.RealizarEdit();
			},

			RealizarEdit:function(){

                var urlEditProduct = '/edit-product/put';
				axios.put(urlEditProduct,{
					'NombreProducto' : this.Nuevo_NombreProducto,
	                'DescripcionProducto' : this.Nuevo_DescripcionProducto,
	                'PrecioProducto' : this.Nuevo_PrecioProducto,
	                'IdTipo' : this.Nuevo_CategoriaProducto,
	                'IdProducto' : this.Edit_Id,
	                'ExistenciaProduct' : this.Nuevo_existencia,

				}).then( response => {
					this.limpiar();
					this.NotificacionSucces("Se actualizo el producto con exito");
					$('#modificarModal').modal('hide');
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
				this.ArrayProducto  = [];
				this.NombreProducto  = "";
				this.PrecioProducto  = "";
				this.DescripcionProducto  = "";

				this.ValorFoto  = "";
				this.temporalFoto  = "";
				this.imagen  = "";

				this.Modal_Foto = "";
				this.Modal_Producto = "";
				this.Modal_Categoria = "";
				this.Modal_descripcion  = "";
				this.Modal_Precio  = "";
				this.Modal_Existencia  = "";

				this.Edit_Foto  = "";
				this.Edit_Producto = "";
				this.Edit_Categoria  = "";
				this.Edit_Descripcion  = "";
				this.Edit_Precio  = "";
				this.Edit_Existencia  = "";
				this.Edit_Id = "";
				this.Edit_IdCategoria = "";

				this.ArrayTipo = [];

				this.Nuevo_NombreProducto  = "";
				this.Nuevo_PrecioProducto  = "";
				this.Nuevo_DescripcionProducto  = "";
				this.Nuevo_CategoriaProducto  = "";
				this.Nuevo_ValorFoto  = "";
				this.Nuevo_temporalFoto  = "";
				this.Nuevo_imagen  = "";
				this.getProducts();
			},

			ValidarFoto:function(){
				var tmep = document.getElementById("uploadImg").value;
				var extensiones = /(.jpg)$/i;

				if(!extensiones.exec(tmep)){
					this.MensajeError("Introduzca una imagen con extensión JPG");

						if(this.temporalFoto != ""){
							this.ValorFoto = this.temporalFoto;
							//document.getElementById("uploadImg").value = this.temporalFoto;
							//document.getElementById("previa").src = URL.createObjectURL(this.imagen[0]);
						}else{
							this.ValorFoto = "";

							document.getElementById("uploadImg").value = "";
							document.getElementById("previa").src = "/inventariospa/public/images/defecto.png";
						}

				}else{

					this.temporalFoto = document.getElementById("uploadImg").value;
					this.ValorFoto = this.temporalFoto;
					this.imagen = event.target.files[0];
				}
			}, //Fin ValidarFoto

			PorNombre:function(){

				this.NombreBusqueda = document.getElementById('nombre_producto_Busqueda').value;
				this.BusquedaNombre();
			},

			BusquedaNombre: function(){

				if( this.NombreBusqueda == null || this.NombreBusqueda == ""){
					this.MensajeError("Ingrese un nombre para realizar la busqueda");
				}else{
					var urlBusquedaNombre = '/get-Producto-Nombre/'+this.NombreBusqueda;
					axios.get(urlBusquedaNombre).then(response =>{

						var resultado = response.data

						if( resultado == 0){
							var placementFrom = 'top';
							var placementAlign = 'center';
							var state = 'warning';
							var style = 'withicon' ;
							var content = {} ;

							content.message = 'NO se encontraron resultados';
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
						}else{
							this.ArrayProducto = resultado;
						}
					});
				}

				document.getElementById('nombre_producto_Busqueda').value = "";


			},

			Todos:function(){
				this.ArrayProducto = [];
				this.getProducts();
			},

			MensajeError:function(mensaje){
				swal("Oops...", mensaje, {
					icon : "error",
					buttons: {
						confirm: {
							className : 'btn btn-danger'
						}
					},
				});
			},//fin mensaje error

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