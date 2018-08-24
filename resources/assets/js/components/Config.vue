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

                Config.get().then((response) => {
                    this.config = response.data;
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-default">
                    <pre v-if="config" v-highlightjs><code class="javascript">{{ config }}</code></pre>
                </div>
            </div>
        </div>
    </div>
</template>
