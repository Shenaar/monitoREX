import Auth from './services/Auth';
import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

import App from './components/App.vue';
import Config from './components/Config.vue';
import Dashboard from './components/Dashboard.vue';
import Login from './components/Login.vue';
import Report from './components/Report.vue';
import Page404 from './components/Page404.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        component: App,
        children: [{
            path: '/',
            component: Dashboard,
            name: 'dashboard'
        }, {
            path: '/config',
            component: Config,
            name: 'config'
        }, {
            path: '/projects/manage',
            component: null,
            name: 'projects.manage'
        }, {
            path: '/projects/:projectId/reports/:reportId',
            name: 'report.view',
            component: Report,
        }]
    }, {
        path: '/login',
        component: Login,
        name: 'login',
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
