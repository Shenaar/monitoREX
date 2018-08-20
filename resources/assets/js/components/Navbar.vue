<script>

    import Auth from '../services/Auth';

    export default {
        data: function () {
            return {
                Auth
            };
        },
        computed: {

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
                <ul class="navbar-nav ml-auto" v-if="!Auth.user()">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/join">Join</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" v-else>
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth.user().name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="#" class="nav-link" @click.prevent="logout">
                                <i class="fa fa-sign-out"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>
