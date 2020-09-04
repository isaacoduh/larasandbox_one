require('./bootstrap');

import moment from "moment";
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import Index from './Index';
import router from './routes';
import FatalError from './shared/components/FatalError';
import StarRating from './shared/components/StarRating';
import Success from './shared/components/Success';
import ValidationErrors from './shared/components/ValidationErrors';

window.Vue = require('vue');


Vue.use(VueRouter);
Vue.use(Vuex);
Vue.filter("fromNow", value => moment(value).fromNow());
Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("success", Success);
Vue.component("v-errors", ValidationErrors);
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
