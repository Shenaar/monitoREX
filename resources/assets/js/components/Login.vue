<script>

    import Auth from '../services/Auth';

    export default {
        data () {
            return {
                login: '',
                password: '',
                errors: []
            };
        },
        methods: {
            submit(event) {
                this.errors = [];
                Auth.login(this.login, this.password).then(() => {
                    router.push('/');
                }).catch((error) => {
                    this.errors.push(error.response.data.message);
                });
            }
        },
    }
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" @submit.prevent="submit">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="login" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required v-model="password">
                                </div>
                            </div>

                            <div class="alert alert-danger" v-if="errors.length">
                                <p class="mb-0" v-for="error in errors">
                                    {{ error }}
                                </p>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
