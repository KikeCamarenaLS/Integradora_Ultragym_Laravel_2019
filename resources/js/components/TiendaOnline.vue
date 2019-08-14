<template>
	<div><!-- Div Principal -->
		<transition-group
		tag="div"
		:css="false"
		name="fadeIn"
		@before-enter="beforeEnter"
		@enter="enter"
		@leave="leave"
		class="row justify-content-center align-items-center" ><!-- Div ROw-->

			<componente-producto :key="producto.id" :data-index="index" v-bind:producto="producto" v-for="(producto, index) in ArrayProductos"></componente-producto>



		</transition-group><!-- Div ROw-->
	</div><!-- Fin div principal -->
</template>

<script>
	import axios from 'axios'
	import Swal from 'sweetalert2'

	export default{

		data(){

			return{

				nombre: 'Producto Short',
				ArrayProductos : [],

			} //fin return

		},//fin data

		created: function(){
			this.getProductsJson();
		},

		methods:{

			getProductsJson:function(){
				var urlJson = '/tienda/get-products';
				axios.get(urlJson).then(response => {
					this.ArrayProductos = response.data.data
				});
			}, //fin Products JSON

			beforeEnter(elemento){ //antes de entrar la animacion
				elemento.style.opacity = 0;
				elemento.style.transform="scale(0)";
				elemento.style.transition = "all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1)";
			},//BEefore enter

			enter(elemento){ //animacion cuando ele lemento entre
				const delay = 200 * elemento.dataset.index; //retraso en milisegundos de un elemento por su index
				setTimeout(() =>{
					elemento.style.opacity = 1;
					elemento.style.transform = "scale(1)";
				}, delay);

			}, //fin enter

			leave(elemento){
				elemento.style.opacity = 0;
				elemento.style.transform = "scale(0)";
			}, //fin leave





		}//fin methods

	}//fin export defaul

</script>