<template>
	<div>

		<button v-on:click="ActivarBoton()">
			Oprimir
		</button>
		
	</div><!-- Div principal-->
	
</template>

<script>
	import axios from 'axios'
	import Swal from 'sweetalert2'

	export default{
		data(){
			return{

			}
		},
		created: function(){

		},

		methods:{

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
			}
		}
	}
</script>