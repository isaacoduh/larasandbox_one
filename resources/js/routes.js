import VueRouter from 'vue-router';
import Orderable from './orderable/Orderable';
import Orderables from './orderables/Orderables';
import Review from './review/Review';

const routes = [
    {
        path: "/",
        component: Orderables,
        name: "home",
    },
    {
        path: "/orderable/:id",
        component: Orderable,
        name: "orderable"
    },
    {
        path: '/review/:id',
        component: Review,
        name: "review"
    }
];

const router = new VueRouter({routes,mode: "history"});
export default router;
