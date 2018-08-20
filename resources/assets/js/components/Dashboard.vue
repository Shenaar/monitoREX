<script>

    import ProjectReport from './Dashboard/ProjectReport.vue';
    import Project from '../services/Project';

    export default {
        data: () => {
            return {
                loading: false,
                projects: []
            }
        },
        methods: {
            getProjects() {
                this.loading = true;

                Project.my().then((response) => {
                    this.projects = response.data;
                    this.loading = false;
                });
            }
        },
        created() {
            this.getProjects();
        },
        components: {
            ProjectReport
        }
    };
</script>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 pb-4" v-for="project in projects">
                <project-report v-bind:project="project"></project-report>
            </div>

        </div>
    </div>
</template>
