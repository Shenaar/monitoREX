<script>

    import Auth from '../services/Auth';
    import ElCol from "element-ui/packages/col/src/col";

    export default {
        components: {
            ElCol

        },
        data: function () {
            return {
                Auth
            };
        },
        computed: {

        },
    }
</script>

<template>
    <el-header class="navbar" v-if="Auth.user()" height="50px">
        <ul class="left">
            <li class="toggle">
                <i class="fa fa-bars" @click="$emit('toggleNavbar')"></i>
            </li>
            <li class="logo" @click="$router.push({ name:'dashboard' })">
                MonitoREX
            </li>
        </ul>
        <ul class="right hidden-xs-only">
            <li>
                {{ Auth.user().name }}
            </li>
        </ul>
    </el-header>
</template>
