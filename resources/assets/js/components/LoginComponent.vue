<script>
    export default {
        data () {
            return {
                login: '',
                password: ''
            };
        }
    }
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Login Component</div>

                    <div class="card-body">
                        <input name="email" v-model="login"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
