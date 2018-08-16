<script>
    export default {
        data: function () {
            return {
                answer: 42
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
                        {{ answer }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
