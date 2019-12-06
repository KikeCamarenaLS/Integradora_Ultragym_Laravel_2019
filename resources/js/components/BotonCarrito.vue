<template>
	<button @click="AgregarACarrito" class="btn btn-primary btn-block"><b>{{ mensaje }}</b></button>
</template>

<script>

	import axios from 'axios'
	
	export default {

		data(){
			return {
				mensaje : 'Agregar al carrito',
				endpoint : '/en_carrito',	
			}
			
		},

		props: { product: { type:Object } },

		methods:{

			AgregarACarrito(){
				axios({
					method: 'POST',
					url: this.endpoint,
					data: {
						id_producto : this.product.id
					},
					headers: {
						'Accept':'application/json',
						'Content-Type': 'application/json'
					}
				}).then(() =>{
					console.log('Agregado');
				})
			},
		}
	}
</script>