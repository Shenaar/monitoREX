<script>

    import Api from '../services/Api';
    import Navbar from './Navbar.vue';

    export default {
        data: () => {
            return {
                question: 'Unknown'
            };
        },

        components: {Navbar},

        mounted: () => {
            /**/
            console.log('Application mounted');
        }
    };
</script>

<template>
    <div>
        <navbar></navbar>
        <router-view/>
        <center>{{ question }}</center>
    </div>

</template>
