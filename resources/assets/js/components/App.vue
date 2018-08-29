<script>

    import Auth from '../services/Auth';

    export default {
        data () {
            return {
                Auth,
                user: Auth.user(),
                menuVisible: window.innerWidth > 767,
            };
        },
        methods: {
            logout() {
                Auth.logout().then( () => {
                    router.push({name: 'login'});
                });
            },
            toggleMenu() {
                this.menuVisible = !this.menuVisible;
            },
            getPersistent() {
                return window.innerWidth > 767 ? 'mini' : null;
            },
            getPermanent() {
                return window.innerWidth > 767 ? 'clipped' : null;
            }
        },
        components: {
        }
    }
</script>

<template>
    <md-app v-if="Auth.user()">
        <md-app-toolbar class="main-toolbar">
            <span @click="toggleMenu" class="toggle">
                <md-icon class="fa fa-bars" ></md-icon>
            </span>
            <span class="md-title" @click="$router.push({ name : 'dashboard'})">MonitoREX</span>
            <div class="md-toolbar-section-end">
                {{ Auth.user().name }}
            </div>

        </md-app-toolbar>
        <md-app-drawer :md-persistent="getPersistent()" :md-permanent="getPermanent()" :md-active.sync="menuVisible" style="width: 250px;">
            <md-toolbar class="large-navigation-toggle" md-elevation="0">
                <span>Navigation</span>

                <div class="md-toolbar-section-end" @click="toggleMenu">
                    <md-button class="md-icon-button md-dense">
                        <md-icon>keyboard_arrow_left</md-icon>
                    </md-button>
                </div>
            </md-toolbar>
            <md-list>
                <md-list-item :to="{ name: 'dashboard' }">
                    <md-icon class="fa fa-dashboard"></md-icon>
                    <span class="md-list-item-text">Dashboard</span>
                </md-list-item>
                <md-list-item :to="{ name: 'config' }">
                    <md-icon class="fa fa-gears"></md-icon>
                    <span class="md-list-item-text">Config</span>
                </md-list-item>
                <md-list-item @click="logout">
                    <md-icon class="fa fa-sign-out"></md-icon>
                    <span class="md-list-item-text">Logout</span>
                </md-list-item>
            </md-list>
        </md-app-drawer>
        <md-app-content>
            <router-view></router-view>
        </md-app-content>
    </md-app>
</template>
