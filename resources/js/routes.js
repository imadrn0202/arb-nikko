import Roles from './components/Roles';
import UserRoles from './components/UserRoles';

export default {
    mode: 'history',
    routes: [
        {
            path: '/roles',
            component: Roles,
        },
        {
            path: '/userroles',
            component: UserRoles,
        }
    ]
}