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
        <md-app-toolbar class="md-dense main-toolbar">
            <span @click="toggleMenu" class="toggle">
                <md-icon>menu</md-icon>
            </span>
            <span class="md-title" @click="$router.push({ name : 'dashboard'})">MonitoREX</span>
            <div class="md-toolbar-section-end">
                {{ Auth.user().name }}
            </div>

        </md-app-toolbar>
        <md-app-drawer class="main-menu" :md-persistent="getPersistent()" :md-permanent="getPermanent()" :md-active.sync="menuVisible">
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
                    <md-icon>dashboard</md-icon>
                    <span class="md-list-item-text">Dashboard</span>
                </md-list-item>
                <md-list-item :to="{ name: 'projects.manage' }">
                    <md-icon>work</md-icon>
                    <span class="md-list-item-text">Projects</span>
                </md-list-item>
                <md-list-item :to="{ name: 'config' }">
                    <md-icon>settings</md-icon>
                    <span class="md-list-item-text">Config</span>
                </md-list-item>
                <md-list-item @click="logout">
                    <md-icon>exit_to_app</md-icon>
                    <span class="md-list-item-text">Logout</span>
                </md-list-item>
            </md-list>
        </md-app-drawer>
        <md-app-content>
            <router-view></router-view>
        </md-app-content>
    </md-app>
</template>

<style scoped>
    .main-menu {
        width: 250px;
    }

    .md-app .md-content {
        border-left: none;
    }

    .main-menu .md-list {
        padding-bottom: 0;
    }
</style>
