require('./bootstrap');

import Alpine from 'alpinejs';

import Vue from 'vue';
import App from './vue/app';
window.Alpine = Alpine;

Alpine.start();

const app = new Vue({
    el: '#app',
    components: { App }
});





