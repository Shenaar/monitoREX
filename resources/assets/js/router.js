const VueRouter = require('vue-router').default;

Vue.use(VueRouter);

const Application = require('./components/Application.vue');
const ExampleComponent = require('./components/ExampleComponent.vue');
const ExampleComponent2 = require('./components/ExampleComponent2.vue');
const LoginComponent = require('./components/LoginComponent.vue');
const Page404 = require('./components/Page404.vue');

Vue.component('application', Application);

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        component: Application,
        meta: {
            authRequired: true
        },
        children: [{
            path: '/example',
            component: ExampleComponent2,
        }, {
            path: '/login',
            component: LoginComponent,
            meta: {
                authRequired: false
            },
        }, {
            path: '/404',
            component: Page404,
            meta: {
                authRequired: false
            },
        }]
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
        let last = to.matched[to.matched.length - 1];
        if (!response.data && (to.matched.some(record => record.meta.authRequired)) && (last.meta.authRequired !== false)) {
            next('/login');
        } else {
            next();
        }
    });
});

export default router;
