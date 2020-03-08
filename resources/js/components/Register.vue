<template>
    <div class="container mt-3">
        <form @submit.prevent="register()">

            <div class="form-group">
                <label for="name">Name</label>
                <input v-model="data.name" type="text" class="form-control" :required="true" id="name"
                    placeholder="Name">
            </div>


            <div class="form-group">
                <label for="email">Email address</label>
                <input v-model="data.email" type="email" class="form-control" id="email"
                    aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input v-model="data.password" type="password"  :required="true" class="form-control" id="password"
                    placeholder="Password">
            </div>

            <div class="form-group">
                <label for="confirm password">Confirm Password</label>
                <input v-model="data.password_confirmation" type="password" :required="true" class="form-control" id="password"
                    placeholder="Password">
            </div>


            <button :disabled="status === true || loading === true" type="submit" :required="true" class="btn btn-primary">Submit</button>
            <small v-if="status === true" class="text-success"> Redirecting to login page. . . </small>
        </form>
    </div>
</template>

<script> 
    export default {
        data(){
            return {
                data: {},
                status: false,
                loading: '',
            };
        },
        methods: {
            register(){
                this.loading = false;
                var app = this
                this.$auth.register({
                    data: {
                        name: this.data.name,
                        email: this.data.email,
                        password: this.data.password,
                        password_confirmation: this.data.password_confirmation 
                    }, 
                    success: function () {
                        this.status = true;
                        this.loading = true;
                         alert("Please Login");
                        this.$router.push('/login')
                    },
                    error: function (resp) {
                        this.loading = false;
                        this.status = false;

                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });                
            }
        }
    }
</script>

<style>

</style>
