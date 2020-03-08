

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import VueAxios from 'vue-axios';
import auth from './auth';
import VueAuth from '@websanova/vue-auth';

require('./bootstrap');

Vue.router = router;
Vue.use(VueRouter);

window.axios = require('axios');

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = '/api';
Vue.use(VueAuth, auth);


const app = new Vue({
    el: '#app',
    router
});

