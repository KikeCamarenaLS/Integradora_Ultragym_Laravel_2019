<script>
	export default{
		functional: true,
		render: function(createElement, context){
			var data = {
				...context.data,
				css: "false",
				on:{ //configuracion de eventos
					beforeEnter: function(elemento){ //antes de entrar la animacion
						elemento.style.opacity = 0;
						elemento.style.transform="scale(0)";
						elemento.style.transition = "all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1)";
					},//BEefore enter

					enter: function(elemento){ //animacion cuando ele lemento entre
						const delay = 200 * elemento.dataset.index; //retraso en milisegundos de un elemento por su index
						setTimeout(() =>{
							elemento.style.opacity = 1;
							elemento.style.transform = "scale(1)";
						}, delay);

					}, //fin enter

					leave: function(elemento){
						const delat = 200 * elemento.dataset.index;
						setTimeout(() => {
							elemento.style.opacity = 0;
							elemento.style.transform = "scale(0)";
						},delat);
						
					}, //fin leave
				}
			};
		}
	}
</script>