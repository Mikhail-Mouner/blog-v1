import categories from "./components/Categories";

require('./bootstrap');

window.Vue = require('vue');

Vue.component('global-home', require('./components/GlobalHome').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('register', require('./components/Register').default);
Vue.component('login', require('./components/Login').default);
Vue.component('nav-header', require('./components/Header').default);

import router from './routes/routes'
import stores from "./stores/stores";

//import Axios from 'axios';

const app = new Vue({
    el: '#app',
    router,
    store: stores,
});


