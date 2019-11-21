/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


//Импорт vue-роутера
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

//Импорт корневого компонента
//import App from "./components/App";
import App from "./App";

//Создание объекта собственного маршрутизатора и его импорт 
import router from './router';

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    render : h => h(App),
    router
});
