import Vue from 'vue';

import VueRouter from 'vue-router';

import Auth from './auth';
let auth = new Auth(window.user);
// console.log("from vue router js", window.user);
Vue.use(VueRouter);

import ExampleComponent from './components/ExampleComponent.vue';
import NotfundComponent from './components/NotfundComponent.vue';
import Usuarios from './components/Usuarios/Usuarios.vue';
import Roles from './components/Roles/Roles.vue';
import ProfileComponent from './components/ProfileComponent.vue';
// import UsuariosComponent from './components/views/UsuariosComponent.vue'
// import ProductosComponent from './components/views/ProductosComponent.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin',
            name: 'dashboard',
            component: ExampleComponent
        },
        {
            path: '/admin/usuarios',
            name: 'user',
            component: Usuarios,
            beforeEnter: (to, from, next) => {
                if(Vue.prototype.$auth.can('view.users')){
                    next();
                }else {
                    next('/admin');
                }
            }
        },
        {
            path: '/admin/roles',
            name: 'roles',
            component: Roles
        },
        {
            path: '/admin/productos',
            name: 'products',
            component: ExampleComponent
        },
        {
            path: '/admin/profile',
            name: 'profile',
            component: ProfileComponent
        },
        {
            path: '/admin/*',
            name: '404',
            component: NotfundComponent
        },
    ]
});

export default router;
