require('./bootstrap');

import moment from "moment";
import VueRouter from 'vue-router';
import Index from './Index';
import router from './routes';
import StarRating from './shared/components/StarRating';

window.Vue = require('vue');


Vue.use(VueRouter);
Vue.filter("fromNow", value => moment(value).fromNow());
Vue.component("star-rating", StarRating);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    components: {
        index: Index
    }
});
