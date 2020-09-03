import VueRouter from 'vue-router';
import Orderable from './orderable/Orderable';
import Orderables from './orderables/Orderables';

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
    }
];

const router = new VueRouter({routes,mode: "history"});
export default router;
