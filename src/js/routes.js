import Dashboard from './Components/Dashboard';
import Settings from './Components/Settings';
import Supports from './Components/Supports';
import FetchedData from './Components/FetchedData';
import Todos from './Components/Todos';
import NinjaTable from './Components/NinjaTable';
import GithubInfo from './Components/GithubInfo';


export const routes = [{
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
    },
    {
        path: '/ninja-table',
        name: 'ninja-table',
        component: NinjaTable
    },
    {
        path: '/github-info',
        name: 'github-info',
        component: GithubInfo
    }
];