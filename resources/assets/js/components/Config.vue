<script>

    import Config from '../services/Config';

    export default {
        data: () => {
            return {
                loading: false,
                config: null
            }
        },
        methods: {
            getConfig() {
                this.loading = true;

                Config.get().then( ({ data }) => {
                    this.config = data;
                    this.loading = false;
                });
            }
        },
        created() {
            this.getConfig();
        },
        components: {
        }
    };
</script>
<template>
    <md-content class="md-elevation-1">
        <pre v-if="config" v-highlightjs><code class="javascript">{{ config }}</code></pre>
    </md-content>
</template>
