<script>

    import Auth from '../services/Auth';

    export default {
        data () {
            return {
                user: Auth.user()
            };
        }
    }
</script>

<template>
    <div>
        HELLO
        <router-view></router-view>
    </div>
</template>
