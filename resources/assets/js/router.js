import Auth from './services/Auth';
import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

import ExampleComponent from './components/ExampleComponent.vue';
import Login from './components/Login.vue';
import Page404 from './components/Page404.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        component: ExampleComponent,
    }, {
        path: '/login',
        component: Login,
        meta: {
            guest: true
        },
    }, {
        path: '/404',
        component: Page404,
        meta: {
            guest: true
        },
    }]
});

router.beforeEach((to, from, next) => {
    if (!to.matched.length) {
        next('/404');
    }

    next();
});

router.beforeEach((to, from, next) => {
    Auth.check().then((response) => {

        if (!response.data && !to.matched.some(record => record.meta.guest)) {
            next('/login');
        } else {
            next();
        }
    });
});

export default router;
