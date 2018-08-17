<script>

    import Auth from '../services/Auth';

    export default {
        data: function () {
            let user = Auth.user();

            if (!user) {
                return {
                    links: [{
                        to: '/login',
                        name: 'Login'
                    }, {
                        to: '/register',
                        name: 'Register'
                    }]
                };
            }

            return {
                links: [{
                    to: '/example',
                    name: 'Example'
                }]
            };
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
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item" v-for="link of links">
                        <router-link class="nav-link" :to="link.to">{{ link.name }}</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>
