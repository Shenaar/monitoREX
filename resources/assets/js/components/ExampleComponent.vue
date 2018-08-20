<script>

    import Auth from '../services/Auth';

    export default {
        data () {
            return {
                user: Auth.user()
            };
        }
    }
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        {{ user.name }}
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>
