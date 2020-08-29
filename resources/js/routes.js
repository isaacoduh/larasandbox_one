import AllJournals from './components/AllJournals.vue';
import AddJournal from './components/AddJournal.vue';
import EditJournal from './components/EditJournal.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllJournals
    },
    {
        name: 'add',
        path: '/add',
        component: AddJournal
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditJournal
    }
];
