import Vue from 'vue';
import moment from 'moment'
import router from './router';
import App from "./components/App";
//require('./bootstrap');

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
});

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
