<template >
	<div>
		<a href="/carrito">Mi carrito {{ productsCount }}</a>
	</div>
</template>

<script>
	export default{
		computed:{ //propiedades cuyo valor se calcula cuando se modifica algo para su valor
			productsCount(){
				return window.store.state.productsCount;
			}
		}
	}

</script>