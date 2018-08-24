<script>

    import Moment from 'moment';

    export default {
        props: [
            'datetime'
        ],
        methods: {
            getDisplay() {
                let moment = Moment(String(this.datetime));

                return moment.fromNow();
            },

            getDateTime() {
                let moment = Moment(String(this.datetime));

                return moment.format('DD.MM.YYYY HH:mm:ss');
            },
        }
    };
</script>

<template>
    <abbr v-bind:title="getDateTime()">
        {{ getDisplay() }}
    </abbr>
</template>
