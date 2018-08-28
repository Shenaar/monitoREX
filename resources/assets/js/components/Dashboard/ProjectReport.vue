<script>
    import Report from '../../services/Report';
    import ElCard from "../../../../../node_modules/element-ui/packages/card/src/main.vue";

    export default {
        components: {ElCard},
        data: () => {
            return {
                loading: false,
                reports: []
            };
        },
        props: {
            project: {
                required: true,
            },
        },
        created() {
            this.loading = true;
            Report.forProject(this.project, {perPage: 5}).then( ({ data }) => {

                this.reports = data.data;
                this.loading = false;
            });

            Echo.private('Project.' + this.project.id).listen('ReportCreated', ({ report }) => {
                report.unseen = true;
                this.reports.unshift(report);
            });
        },
        beforeDestroy() {
            Echo.leave('Project.' + this.project.id);
        }
    };
</script>

<template>
    <el-card>
        <div slot="header">
            {{ project.title }}
            <i class="fa fa-refresh fa-spin fa-pull-right project-loading" v-if="loading"></i>
            <i class="fa fa-refresh fa-pull-right project-loading" v-else></i>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-bind:class="{ 'list-group-item-danger' : report.unseen }" v-for="report in reports">
                <router-link :to="{ name: 'report.view', params: { projectId: project.id, reportId: report.id } }" class="font-weight-bold mb-0">
                    <date-time v-bind:datetime="report.created_at"></date-time>: {{ report.message }}
                </router-link>
                <p class="text-danger mb-0">{{ report.class }}</p>
                <a v-bind:href="report.url" class="text-info mb-0 text-small" target="_blank">{{ report.url }}</a>
            </li>
        </ul>

    </el-card>
</template>

<style scoped>
    .project-loading {
        margin: 0;
        margin-top: 4.5px;
    }
</style>
