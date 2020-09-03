import VueRouter from 'vue-router';
import Example2 from './components/Example2';
import Orderables from './orderables/Orderables';

const routes = [
    {
        path: "/",
        component: Orderables,
        name: "home",
    },
    {
        path: "/second",
        component: Example2,
        name: "second"
    }
];

const router = new VueRouter({routes,mode: "history"});
export default router;
