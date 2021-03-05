import Dashboard from './Components/Dashboard';
import Settings from './Components/Settings';
import Supports from './Components/Supports';
import FetchedData from './Components/FetchedData';
import Todos from './Components/Todos';

export const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/settings',
        name: 'settings',
        component: Settings
    },
    {
        path: '/supports',
        name: 'supports',
        component: Supports
    },
    {
        path: '/fetchdata',
        name: 'fetchdata',
        component: FetchedData
    },
    {
        path: '/todos',
        name: 'todos',
        component: Todos
    }
];
