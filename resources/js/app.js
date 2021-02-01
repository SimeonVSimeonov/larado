import Vue from 'vue';
import router from './router';
import App from "./components/App";
//require('./bootstrap');

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

const app = new Vue({
    el: '#app',
    router,
    components: {
        App
    },
    data() {
        return {
        }
    },
    methods: {

    }
});
