import VueRouter from 'vue-router';
import Roles from './components/Roles';
import UserRoles from './components/UserRoles';
import Login from './components/Login';
import Register from './components/Register';


const routes = [
    {
        path: '/roles',
        name: 'roles',
        component: Roles,
        meta: {
            auth: {
                roles: 1,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        }
    },
    {
        path: '/userroles',
        component: UserRoles,
        meta: {
            auth: {
                roles: 1,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
  })

export default router
