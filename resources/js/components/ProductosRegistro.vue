<template>
	<div>

		<div class="form-group form-show-validation row">
			<label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nombre de producto <span class="required-label">*</span></label>
			<div class="col-lg-4 col-md-9 col-sm-8">
				<input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese nombre de producto" required="">
			</div>
		</div>
		<div class="form-group form-show-validation row">
			<label for="descripcion" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Descripción de producto <span class="required-label">*</span></label>
			<div class="col-lg-4 col-md-9 col-sm-8">
				<textarea class="form-control" id="descripcion_producto" name="descripcion_producto" required="">

				</textarea>
			</div>
		</div>

		<div class="form-group form-show-validation row">
			<label for="precio_producto" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Precio <span class="required-label">*</span></label>
			<div class="col-lg-4 col-md-9 col-sm-8">
				<div class="input-group-prepend" for="precio_producto">
					<span class="input-group-text">$</span>
					<input type="number" step="0.01" id="precio_producto" name="precio_producto" class="form-control" aria-label="Amount (to the nearest dollar)">
				</div>

			</div>
		</div>

		<div class="form-group form-show-validation row">
			<label for="CategoriaProducto" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Categoria del producto: <span class="required-label">*</span></label>
			<div class="col-lg-4 col-md-9 col-sm-8">
				<select class="form-control input-pill" id="CategoriaProducto">
					<option value="Sin">Seleccione uno</option>
					<option v-for="(tipo,index) in ArrayTipo" v-bind:value=" tipo.id_categoria ">{{ tipo.Categoria }}</option>
				</select>
			</div>
		</div>


		<div class="form-group form-show-validation row">
			<label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Imagen <span class="required-label">*</span></label>
			<div class="col-lg-4 col-md-9 col-sm-8">
				<div class="input-file input-file-image">
					<img class="img-upload-preview img-circle" id="cargaImage" src="/images/default.png" alt="preview" width="100" height="100">
					<input type="file" class="form-control form-control-file" id="uploadImg" name="uploadImg" accept="image/jpeg" required="" v-on:change="ValidarFoto()">
					<label for="uploadImg" class=" label-input-file btn btn-icon btn-primary btn-round btn-lg"><i class="la la-file-image-o"></i> Subir imagen</label>
				</div>
			</div>
		</div>
		<div class="seperator-solid"></div>
		<div>
			<center>
				<button class="btn btn-success" v-on:click="ObtenerDatos()">Guardar</button>
			</center>


		</div>
	</div>
</div>
</template>

<script>

	import axios from 'axios'
	import Swal from 'sweetalert2'

	export default{

		data(){

			return{

				ArrayTipo : [],
				NombreProducto : "",
				PrecioProducto : "",
				DescripcionProducto : "",
				CategoriaProducto : "",

				ValorFoto : "",
				temporalFoto : "",
				imagen : "",
			}

		},//fin data

		created: function(){
			this.getTipo();
			//this.datatable();
			//this.datatable();
		},

		methods:{

			getTipo:function(){

				var UrlTipoGet = '/get-Tipo/product';
				axios.get(UrlTipoGet).then(response => {
					this.ArrayTipo = response.data
				});
			},

			ObtenerDatos:function(){

				this.NombreProducto = document.getElementById('nombre_producto').value;
				this.PrecioProducto = document.getElementById('precio_producto').value;
				this.DescripcionProducto = document.getElementById('descripcion_producto').value;
				this.CategoriaProducto = document.getElementById('CategoriaProducto').value;
				this.Validacion();
			}, //fin ObtenerDatos

			Validacion:function(){

				if(this.NombreProducto == "" || this.NombreProducto == null){
					this.MensajeError("Falta ingresar el nombre del producto");

				}else if(this.PrecioProducto == ""){
					this.MensajeError("Falta ingresar el precio del producto");

				}else if(this.DescripcionProducto == ""){
					this.MensajeError("Falta ingresar descripcion del producto");

				}else if(this.ValorFoto == ""){
					this.MensajeError("Falta seleccionar una foto");
				}else if(this.CategoriaProducto == "Sin"){
					this.MensajeError("Seleccione una opción valida para la categoria del producto");
				}else{
					this.MensajeConfirmacion();
				}
			}, //fin Validacion

			MensajeError: function(mensaje){
				swal("Oops...", mensaje, {
					icon : "error",
					buttons: {
						confirm: {
							className : 'btn btn-danger'
						}
					},
				});
			},//fin mensaje error

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
                formData.append('IdTipo', this.CategoriaProducto);

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

			limpiar:function(){
				this.NombreProducto = "";
				this.PrecioProducto = "";
				this.DescripcionProducto = "";

				this.ValorFoto = "";
				this.temporalFoto = "";
				this.imagen = "";

				document.getElementById('nombre_producto').value = "";
				document.getElementById('precio_producto').value= "" ;
				document.getElementById('descripcion_producto').value= "";
				document.getElementById('uploadImg').value = "";
				document.getElementById('cargaImage').src = "/images/default.png";
				document.getElementById('CategoriaProducto').selectedIndex = "0";


			}, //fin limpiar

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