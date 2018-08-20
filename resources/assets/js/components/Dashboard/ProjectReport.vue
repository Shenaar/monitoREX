<script>

    import Report from '../../services/Report';

    export default {
        data: () => {
            return {
                loading: false,
                reports: []
            };
        },
        props: ['project'],
        created() {
            this.loading = true;
            Report.forProject(this.project, {perPage: 5}).then((response) => {
                //this.reports = response.data.data;
                this.loading = false;
            });

            Echo.private('Project.' + this.project.id).listen('ReportCreated', (e) => {
                e.report.unseen = true;
                this.reports.unshift(e.report);
            });
        },
        beforeDestroy() {
            Echo.leave('Project.' + this.project.id);
        }
    };
</script>

<template>
    <div class="card card-default">
        <div class="card-header">
            {{ project.title }}
            <i class="fa fa-refresh fa-spin fa-pull-right project-loading" v-if="loading"></i>
            <i class="fa fa-refresh fa-pull-right project-loading" v-else></i>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-bind:class="{ 'list-group-item-danger' : report.unseen }" v-for="report in reports">
                <p class="font-weight-bold mb-0">
                    {{ report.created_at | formatDate }}: {{ report.message }}
                </p>
                <p class="text-danger mb-0">{{ report.class }}</p>
            </li>
        </ul>
    </div>
</template>

<style scoped>
    .project-loading {
        margin: 0;
        margin-top: 4.5px;
    }
</style>
