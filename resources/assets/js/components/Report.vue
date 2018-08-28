<script>

    import Report from '../services/Report';

    export default {
        data: () => {
            return {
                loading: false,
                report: null,
                project: null,
                errors: [],
            }
        },

        methods: {
            getReport() {
                this.loading = true;

                Report.get(this.$route.params.projectId, this.$route.params.reportId,).then( ({data}) => {
                    this.report  = data.report;
                    this.project = this.report.project;
                    this.loading = false;
                }).catch( (error) => {
                    this.errors.push(error.response.data.message);
                });
            }
        },

        created() {
            this.getReport();
        },

        components: {
        }
    };
</script>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-default" v-if="report">
                    <div class="card-header font-weight-bold">
                        {{ project.title }}
                    </div>
                    <div class="card-header">
                        <date-time v-bind:datetime="report.created_at"></date-time>: {{ report.message }}
                        <p class="text-danger mb-0">{{ report.class }}</p>
                        <a v-bind:href="report.url" class="text-info mb-0 text-small" target="_blank">{{ report.url }}</a>
                    </div>
                    <pre v-highlightjs><code class="php">{{ report.trace }}</code></pre>
                </div>
                <div class="alert alert-danger" v-if="errors.length">
                    <p class="mb-0" v-for="error in errors">
                        {{ error }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
