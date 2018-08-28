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

                Project.my().then( ({data}) => {
                    this.projects = data;
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
    <el-row>
        <el-col :lg="8" v-for="project in projects">
            <project-report :project="project"></project-report>
        </el-col>
    </el-row>
</template>
