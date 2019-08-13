<template>

	<div  class="col-md-3 pl-md-0">
				<div class="card card-pricing">
					<div class="card-header">
						<div>
							<img class="card-img-top" v-bind:src=" '/images/Productos/'+ producto.imagen" alt="Card image cap">
						</div><br>
						<h4 class="card-title"></h4>
						<div class="card-price">
							<span class="price">{{ producto.Precio }} </span>
							<span class="text">MXN</span>
						</div>
					</div>
					<div class="card-body">
						<ul class="specification-list">
							<li>
								<span class="name-specification">Producto</span>
								<span class="status-specification">{{ producto.Producto }}</span>
							</li>
							<li>
								<span class="name-specification">Descripcion</span>
								<span class="status-specification">{{ producto.Descripcion}}</span>
							</li>
						</ul>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary btn-block"><b>Comprar</b></button>
					</div>
				</div>
			</div>

</template>

<script>
	export default{

		props:{

			producto:{
				type: Object
			}
		}

	}//fin export default

</script>