<script>

    import Auth from '../services/Auth';
    import Navbar from './Navbar.vue';

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
            }
        },
        components: {
            Navbar,
        }
    }
</script>

<template>
    <el-container direction="vertical">
        <navbar @toggleNavbar="toggleMenu"></navbar>
        <el-container>
            <el-aside width="auto">
                <el-menu class="el-menu-vertical" v-bind:collapse="!menuVisible" :router="true" >
                    <el-menu-item index="/config">
                        Config
                    </el-menu-item>
                    <el-menu-item index="2" @click="logout">
                        Logout
                    </el-menu-item>
                </el-menu>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>
