import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

const ExampleComponent = require('./components/ExampleComponent.vue');
const LoginComponent = require('./components/LoginComponent.vue');
const Page404 = require('./components/Page404.vue');

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        component: ExampleComponent,
    }, {
        path: '/login',
        component: LoginComponent,
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
    const Auth = require('./services/Auth').default;

    Auth.check().then((response) => {

        if (!response.data && !to.matched.some(record => record.meta.guest)) {
            next('/login');
        } else {
            next();
        }
    });
});

export default router;
