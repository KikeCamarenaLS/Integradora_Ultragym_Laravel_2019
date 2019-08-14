/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


const Vuex = require('vuex');

window.store = new Vuex.Store({
	state:{
		productsCount : 0
	},
	mutations:{
		increment(state){
			return state.productsCount++
		}
	}
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('roles-consulta' , require('./components/RolesComponent.vue').default);

Vue.component('permisos-rol', require('./components/PermisosRol.vue').default);
Vue.component('roles-permiso', require('./components/RolesPermisos.vue').default);
Vue.component('listado-usuarios', require('./components/ListadoUsuarios.vue').default);
Vue.component('nuevo-producto', require('./components/ProductosRegistro.vue').default);
Vue.component('editar-producto', require('./components/ProductosEditar.vue').default);

//Tienda
Vue.component('tienda-online', require('./components/TiendaOnline.vue').default);
Vue.component('componente-producto', require('./components/ComponenteProducto.vue').default);
Vue.component('transicion-animacion', require('./components/animaciones/transiciones.vue').default);

Vue.component('boton-agregar-carrito', require('./components/BotonCarrito.vue').default);
Vue.component('producto-contador', require('./components/Contador.vue').default);
Vue.component('contador-productos', require('./components/shoppingcart/CounterComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
