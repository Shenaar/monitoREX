<script>

    import Auth from '../services/Auth';

    export default {
        data: function () {
            return {};
        },
        computed: {
            getUser: () => {
                console.log('getUser', Auth.user());
                return Auth.user();
            }
        },
        methods: {
            logout() {
                Auth.logout().then(() => {
                    router.push('/login');
                });
            },
        }
    }
</script>

<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" to="/">MonitoREX</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto" v-if="!getUser">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login">Login</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" v-else>
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a href="#" @click.prevent="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>
