

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

require('./bootstrap');


Vue.use(VueRouter);

window.axios = require('axios');

const app = new Vue({
    el: '#app',

    router: new VueRouter(routes)
});

