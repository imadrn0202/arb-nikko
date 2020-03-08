import VueRouter from 'vue-router';
import Roles from './components/Roles';
import UserRoles from './components/UserRoles';
import Login from './components/Login';
import Register from './components/Register';
import ExpenseCategory from './components/ExpenseCategory';
import Expense from './components/Expense';
import ChangePassword from './components/ChangePassword';
import Logout from './components/Logout';

const routes = [
    {
        path: '/logout',
        name: 'logout',
        component: Logout,
        meta: {
            auth: true
        }
    },
    {
        path: '/',
        name: 'expense',
        component: Expense,
        meta: {
            auth: true
        }
    },
    {
        path: '/changepassword',
        name: 'changepassword',
        component: ChangePassword,
        meta: {
            auth: true
        }
    },
    {
        path: '/expensecategory',
        name: 'expensecategory',
        component: ExpenseCategory,
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
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
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
